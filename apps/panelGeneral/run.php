<?php

require '../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpWord\TemplateProcessor;

// Recoger los datos del formulario
$area = $_POST['area'];
$maestro = $_POST['maestro'];
$curso = $_POST['curso'];

// Procesar los datos (por ejemplo, guardar en una base de datos, enviar un correo, etc.)
echo "Formulario enviado correctamente. <br>";
echo "Area: " . htmlspecialchars($nombre) . "<br>";
echo "Maestro: " . htmlspecialchars($maestro) . "<br>";
echo "Curso: " . htmlspecialchars($curso) . "<br>";

imprimir($curso);
/*
// Si el archivo .xlsx es subidov a través de un formulario:
if ($_FILES['excel_file']['error'] == 0) {
    $file = $_FILES['excel_file']['tmp_name'];
    $fila = isset($_POST['fila']) ? $_POST['fila'] : '';
    $fila = $fila + 1;
    date_default_timezone_set('Europe/Madrid');
    
    // Leer el archivo .xlsx
    $spreadsheet = IOFactory::load($file);
    $sheet = $spreadsheet->getSheetByName('Form1');

    // Crear una carpeta temporal para guardar los archivos .docx
    $tempDir = 'temp_docs/';
    if (!is_dir($tempDir)) {
        mkdir($tempDir, 0777, true); // Crear carpeta si no existe
    }

    $zip = new ZipArchive();
    $zipFileName = 'Documentos_Generados.zip';
    
    // Crear un archivo ZIP
    if ($zip->open($zipFileName, ZipArchive::CREATE | ZipArchive::OVERWRITE) !== true) {
        die('Error al crear el archivo ZIP.');
    }

    // Cargar una plantilla de Word (.docx)
    $templatePath = '../plantillas/plantilla3.docx';
    if (!file_exists($templatePath)) {
        die('La plantilla de Word no existe.');
    }

    $hini = $sheet->getCell("B$fila")->getValue();
    $hfin = $sheet->getCell("C$fila")->getValue();
    $correo = $sheet->getCell("D$fila")->getValue();
    $nombre = $sheet->getCell("E$fila")->getValue();

    // Crear una copia de la plantilla
    $template = new TemplateProcessor($templatePath);

    // Reemplazar valores en la plantilla
    $template->setValue('{hini}', convertirDiasAFecha($hini));
    $template->setValue('{hfin}', convertirDiasAFecha($hfin));
    $template->setValue('{correo}', $correo);
    $template->setValue('{nombre}', $nombre);

    // Guardar el archivo generado en la carpeta temporal
    $outputFile = $tempDir . "$nombre.docx";
    $template->saveAs($outputFile);

    // Agregar el archivo al ZIP
    $zip->addFile($outputFile, "$nombre.docx");

    // Cerrar el archivo ZIP
    $zip->close();

    // Forzar la descarga del archivo ZIP
    header('Content-Type: application/zip');
    header('Content-Disposition: attachment; filename="' . $zipFileName . '"');
    header('Content-Length: ' . filesize($zipFileName));
    readfile($zipFileName);

    // Limpiar archivos temporales
    array_map('unlink', glob("$tempDir/*")); // Eliminar archivos .docx
    rmdir($tempDir); // Eliminar carpeta temporal
    unlink($zipFileName); // Eliminar archivo ZIP del servidor

    exit;
}

function convertirDiasAFecha($dias) {
    // Convertimos días en segundos desde 1900-01-01
    $segundosDesde1900 = $dias * 86400; // 86400 segundos en un día

    // La fecha Unix comienza el 1970-01-01, ajustamos el desfase
    $desfase1900a1970 = strtotime('1970-01-01') - strtotime('1900-01-01');
    
    // Sumamos los segundos desde 1900 al desfase
    $timestampUnix = $segundosDesde1900 - $desfase1900a1970;

    // Retornamos la fecha formateada
    return date('d/m/Y H:i:s', $timestampUnix);
}
*/
echo "miau";
?>