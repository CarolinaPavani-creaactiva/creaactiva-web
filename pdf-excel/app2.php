<?php
require 'vendor/autoload.php';

use Smalot\PdfParser\Parser;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

if (!isset($_FILES['pdf_file']) || $_FILES['pdf_file']['error'] !== UPLOAD_ERR_OK) {
    die("Error al subir el archivo PDF.");
}

$pdfPath = $_FILES['pdf_file']['tmp_name'];
$parser = new Parser();
$pdf = $parser->parseFile($pdfPath);
$text = $pdf->getText();

// Normalizar saltos de línea
$text = str_replace("\r\n", "\n", $text);
$lines = explode("\n", $text);

// Variables de estado
$rows = [];
$currentGroup = null;
$inMateriasBlock = false;
$previousProfessor = null;
$centreName = null;

// Función auxiliar para limpiar materia: quitar paréntesis y espacios redundantes
function cleanMateria($s) {
    // quitar códigos entre paréntesis y lo que quede fuera es la materia
    $s = preg_replace('/\([^)]*\)/u', '', $s);
    $s = trim(preg_replace('/\s+/', ' ', $s));
    // quitar guiones finales sobrantes
    $s = preg_replace('/\s*-\s*$/u', '', $s);
    return $s;
}

// Recorrer líneas
foreach ($lines as $rawLine) {
    $line = trim($rawLine);

    // Filtrar vacíos y marcas de agua / timestamps / cabeceras de Peñalara u otros
    if ($line === '' ||
        preg_match('/Peñalara Software/i', $line) ||
        preg_match('/\/~\s*Peñalara/i', $line) ||
        preg_match('/\d{2}\/\d{2}\/\d{4},?\s*\d{2}:\d{2}/', $line)
    ) {
        continue;
    }

    // Detectar nombre del centro (primera coincidencia típica: IES ...)
    if ($centreName === null && preg_match('/^(IES|CEIP|CIPF|CIFP)\b.*$/iu', $line)) {
        $centreName = trim($line);
        continue;
    }

    // Detectar nombre del grupo (ej. "1ºCFGB-A" o variantes)
    if (preg_match('/^\d+º[A-Z0-9À-ÿ\-\s]+$/u', $line)) {
        $currentGroup = $line;
        $inMateriasBlock = false;
        $previousProfessor = null;
        continue;
    }

    // Iniciar bloque de "Lectivas" / materias
    if (preg_match('/Lectivas:/i', $line) || preg_match('/MateriasProfesores/i', $line)) {
        $inMateriasBlock = true;
        continue;
    }

    if ($inMateriasBlock) {
        // Líneas que comienzan con horas (número)
        if (preg_match('/^\s*(\d+)\s+(.*)$/u', $line, $m)) {
            $horas = $m[1];
            $rest = trim($m[2]);

            // --- CAMBIO CLAVE ---
            // Si la línea comienza con '' (repetición de profesor), **reutilizamos sólo el profesor anterior**
            // pero **NO** la materia: la materia se extrae de la parte restante de la línea actual.
            if (preg_match('/^[\'"]{2}\s*(.*)$/u', $rest, $m2)) {
                // reutilizar profesor anterior
                $profesor = $previousProfessor ?: '';
                // $m2[1] contiene el texto restante (que incluye la materia que debemos extraer)
                $materiaRaw = trim($m2[1]);
                $materia = cleanMateria($materiaRaw);
            } else {
                // Línea con profesor explícito. Extraer profesor y materia.
                // Intentamos extraer el profesor como la parte antes del primer paréntesis con código,
                // si existe: "NOMBRE APELLIDOS (XYZ) resto..."
                if (preg_match('/^(.*?)\s*\([A-Z0-9ÑÁÉÍÓÚÜ]{1,8}\)/u', $rest, $mp)) {
                    $profesor = trim($mp[1]);
                    // Materia es lo que queda después del profesor
                    $materiaPart = trim(substr($rest, strlen($mp[0]))); // parte después del primer paréntesis-código
                    // Si queda poco, podemos también intentar tomar lo que hay después del nombre
                    if ($materiaPart === '') {
                        $materiaPart = trim(substr($rest, strlen($profesor)));
                    }
                    $materia = cleanMateria($materiaPart);
                } else {
                    // Si no hay código entre paréntesis, asumimos el profesor son las primeras 2-4 palabras
                    // y el resto es la materia. Esto es heurístico para casos sin código.
                    $parts = preg_split('/\s+/', $rest);
                    $takeProf = min(4, count($parts));
                    $profesorCandidate = implode(' ', array_slice($parts, 0, $takeProf));
                    // Tomamos profesorCandidate como profesor y el resto como materia
                    $profesor = trim($profesorCandidate);
                    $materiaPart = trim(substr($rest, strlen($profesor)));
                    $materia = cleanMateria($materiaPart);
                    // Si queda vacía la materia, fallback a todo sin paréntesis
                    if ($materia === '') {
                        $materia = cleanMateria($rest);
                    }
                }
            }

            // Normalizar espacios
            $profesor = trim(preg_replace('/\s+/', ' ', $profesor));
            $materia = trim($materia);

            // Guardar la fila sólo si hay materia o profesor detectado
            if ($profesor !== '' || $materia !== '') {
                $rows[] = [
                    'Grupo' => $currentGroup ?: '',
                    'Profesor' => $profesor,
                    'Materia' => $materia,
                    'Horas' => $horas
                ];
            }

            // Actualizar previousProfessor (solo el profesor, NO la materia)
            if ($profesor !== '') {
                $previousProfessor = $profesor;
            }

            continue;
        }

        // Si no empieza por número podemos encontrar fin de bloque; en PDF la estructura varía,
        // pero para robustez no cerramos el bloque automáticamente aquí.
    }
}

// Crear Excel
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
$sheet->setTitle('Módulos');

// Encabezados: "Módulos" en vez de "Materias"
$headers = ['Grupo', 'Profesor', 'Módulo', 'Horas'];
$sheet->fromArray($headers, null, 'A1');

// Rellenar filas
$row = 2;
foreach ($rows as $r) {
    $sheet->setCellValue('A' . $row, $r['Grupo']);
    $sheet->setCellValue('B' . $row, $r['Profesor']);
    $sheet->setCellValue('C' . $row, $r['Materia']);
    $sheet->setCellValue('D' . $row, $r['Horas']);
    $row++;
}

// Formato: encabezado gris, negrita, bordes, autofiltro
$endRow = $row - 1;
$endCol = 'D';
$sheet->getStyle("A1:{$endCol}1")->applyFromArray([
    'font' => ['bold' => true],
    'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => 'D9D9D9']],
    'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
    'borders' => ['allBorders' => ['borderStyle' => Border::BORDER_THIN]]
]);
$sheet->getStyle("A2:{$endCol}{$endRow}")->applyFromArray([
    'borders' => ['allBorders' => ['borderStyle' => Border::BORDER_THIN]]
]);
$sheet->setAutoFilter("A1:{$endCol}1");
foreach (range('A', $endCol) as $col) {
    $sheet->getColumnDimension($col)->setAutoSize(true);
}

// Nombre del archivo: "Nombre del centro - Relación Módulos.xlsx"
$centreSlug = $centreName ? preg_replace('/[^\w\sÁÉÍÓÚÑÜáéíóúñü\-]/u', '', $centreName) : 'Centro';
$filename = trim($centreSlug) . " - Relación Módulos.xlsx";

$tempFile = sys_get_temp_dir() . DIRECTORY_SEPARATOR . $filename;
$writer = new Xlsx($spreadsheet);
$writer->save($tempFile);

// Enviar descarga
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header("Content-Disposition: attachment; filename=\"" . $filename . "\"");
header('Content-Length: ' . filesize($tempFile));
readfile($tempFile);
unlink($tempFile);
exit;
