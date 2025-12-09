<?php
function sustituyeEspacios($filename) {
    $filename = trim($filename);
    $filename = str_replace(' ', '%20', $filename);
    return $filename;
}

function imprimir($texto){
    echo $texto;
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
?>