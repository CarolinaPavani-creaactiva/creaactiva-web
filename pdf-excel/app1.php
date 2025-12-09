<?php
require 'vendor/autoload.php';

use Smalot\PdfParser\Parser;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Color;

if (!isset($_FILES['pdf_file']) || $_FILES['pdf_file']['error'] !== UPLOAD_ERR_OK) {
    die("Error al subir el archivo PDF.");
}

$pdfPath = $_FILES['pdf_file']['tmp_name'];
$parser = new Parser();
$pdf = $parser->parseFile($pdfPath);
$text = $pdf->getText();

$lines = explode("\n", $text);
$spreadsheet = new Spreadsheet();

// Crear hoja general
$mainSheet = $spreadsheet->getActiveSheet();
$mainSheet->setTitle("Tots");
$headers = ['NIA', 'Cognoms', 'Nom', 'Edat', 'Grup', 'Tutor'];
$mainSheet->fromArray($headers, null, 'A1');

$rowMain = 2;
$groupSheets = [];
$currentGroup = '';
$currentTutor = '';
$centreName = '';
$foundCentre = false;

foreach ($lines as $i => $line) {
    $line = trim($line);

    // Detectar nombre del centro real justo después de la línea que dice "CENTRE"
    if (!$foundCentre && preg_match('/^CENTRE$/i', $line)) {
        $centreName = trim($lines[$i + 2]);
        $foundCentre = true;
        continue;
    }

    // Detectar GRUP y TUTOR
    if (preg_match('/^GRUP:\s+([^\s]+)[^\:]*TUTOR:\s+(.+)/', $line, $matches)) {
        $currentGroup = $matches[1];
        $currentTutor = trim($matches[2]);

        // Crear hoja por grupo si no existe
        if (!isset($groupSheets[$currentGroup])) {
            $sheet = $spreadsheet->createSheet();
            $sheet->setTitle($currentGroup);
            $sheet->fromArray($headers, null, 'A1');
            $groupSheets[$currentGroup] = [
                'sheet' => $sheet,
                'row' => 2
            ];
        }

        continue;
    }

    // Extraer datos de alumno
    if (preg_match('/^\d+\s+(\d{8})\s+(.+?,)\s+(.+?)\s+\S+(\d{2})$/u', $line, $matches)) {
        $nia = $matches[1];
        $cognoms = trim(rtrim($matches[2], ','));
        $nom = trim($matches[3]);
        $edat = $matches[4];

        $rowData = [$nia, $cognoms, $nom, $edat, $currentGroup, $currentTutor];

        // Añadir a hoja general
        $mainSheet->fromArray($rowData, null, 'A' . $rowMain++);
        
        // Añadir a hoja del grupo
        $groupSheetInfo = $groupSheets[$currentGroup];
        $groupSheetInfo['sheet']->fromArray($rowData, null, 'A' . $groupSheetInfo['row']++);
        $groupSheets[$currentGroup] = $groupSheetInfo;
    }
}

// Función para aplicar estilos a una hoja
function formatSheet($sheet, $lastRow) {
    $columnCount = 6;
    $endColumn = chr(ord('A') + $columnCount - 1);
    
    // Encabezado: negrita, fondo gris, centrado
    $sheet->getStyle("A1:$endColumn" . '1')->applyFromArray([
        'font' => ['bold' => true],
        'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => 'D9D9D9']],
        'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
        'borders' => ['allBorders' => ['borderStyle' => Border::BORDER_THIN]]
    ]);

    // Bordes y ajuste para datos
    $sheet->getStyle("A2:$endColumn$lastRow")->applyFromArray([
        'borders' => ['allBorders' => ['borderStyle' => Border::BORDER_THIN]]
    ]);

    // Ajuste de tamaño de columnas
    foreach (range('A', $endColumn) as $col) {
        $sheet->getColumnDimension($col)->setAutoSize(true);
    }

    // AutoFiltro
    $sheet->setAutoFilter("A1:$endColumn" . '1');
}

// Aplicar formato a hoja general
formatSheet($mainSheet, $rowMain - 1);

// Aplicar formato a hojas por grupo
foreach ($groupSheets as $info) {
    formatSheet($info['sheet'], $info['row'] - 1);
}

// Nombre de archivo limpio
$centreSlug = preg_replace('/[^a-zA-Z0-9]/', '_', $centreName);
$filename = "{$centreSlug} - Llistat d'alumnes.xlsx";

$writer = new Xlsx($spreadsheet);
$writer->save($filename);

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header("Content-Disposition: attachment; filename=\"$filename\"");
readfile($filename);
unlink($filename);
exit;
