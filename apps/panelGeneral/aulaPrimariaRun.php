<?php
require_once '../includes/config.php';
require_once '../includes/authPanel.php';

require_once '../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $area = $_POST['area'];
    $maestro = $_POST['maestro'];
    $curso = $_POST['curso'];

    $templatePath = '../plantillas/plantilla_prueba.xlsx';
    $outputPath = '../generados/Memoria_Aula_Primaria.xlsx';

    // 1️⃣ Verificar si la plantilla existe
    if (!file_exists($templatePath)) {
        die('Error: La plantilla no existe.');
    }

    try {
        // 2️⃣ Cargar la plantilla
        $spreadsheet = IOFactory::load($templatePath);
        $sheet = $spreadsheet->getSheetByName('Índice');

        if (!$sheet) {
            die('Error: La hoja "Índice" no existe en la plantilla.');
        }

        // 3️⃣ Insertar los valores
        $sheet->setCellValue('B1', $area);
        $sheet->setCellValue('B2', $maestro);
        $sheet->setCellValue('B3', $curso);

        // 4️⃣ Asegurar que la carpeta "generados" existe
        if (!is_dir('../generados')) {
            mkdir('../generados', 0777, true);
        }

        // 5️⃣ Guardar el archivo en el servidor
        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save($outputPath);

        // 6️⃣ Verificar si el archivo realmente se guardó
        if (!file_exists($outputPath) || filesize($outputPath) == 0) {
            die('Error: No se pudo guardar correctamente el archivo.');
        }

        // 7️⃣ Limpiar cualquier salida previa que pueda romper el archivo
        if (ob_get_length()) {
            ob_end_clean();
        }

        $filename = "Memoria Aula Primaria - $curso.xlsx";

        // 8️⃣ Forzar la descarga con encabezados correctos
        header('Content-Description: File Transfer');
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="'.$filename.'"');
        header('Content-Length: ' . filesize($outputPath));
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Expires: 0');
        header('Pragma: public');

        // 9️⃣ Leer el archivo y enviarlo
        readfile($outputPath);
        flush(); // Asegurar que todo el contenido se envíe antes de cerrar
        exit;
    } catch (Exception $e) {
        die('Error: ' . $e->getMessage());
    }
}
?>
