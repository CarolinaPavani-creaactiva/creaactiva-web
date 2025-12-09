<?php
// base_de_datos.php — carga config y crea $conn o null si falla

$configPath = __DIR__ . '/../aplicacion/config.php';
$config = file_exists($configPath) ? include $configPath : include __DIR__ . '/../aplicacion/config.example.php';
$db = $config['db'] ?? [];

$host = $db['host'] ?? '127.0.0.1';
$port = isset($db['port']) ? (int)$db['port'] : 3306;
$user = $db['user'] ?? 'root';
$pass = $db['pass'] ?? '';
$name = $db['name'] ?? 'creaactiva_local';

mysqli_report(MYSQLI_REPORT_OFF);

$conn = @new mysqli($host, $user, $pass, $name, $port);

if ($conn === null || $conn->connect_errno) {
    $errno = $conn ? $conn->connect_errno : 0;
    $errstr = $conn ? $conn->connect_error : 'No connection object';

    // Log para Apache error.log
    error_log("DB connect error ({$errno}): {$errstr}");

    if (defined('APP_ENV') && APP_ENV === 'development') {
        echo "<div style='background:#fff0f0;border:1px solid #ff8a8a;padding:10px;margin:10px 0;font-family:Arial,sans-serif;'>
                <strong>Aviso DEV:</strong> No se pudo conectar a la base de datos ({$errno}). Revisa credenciales/BD.
              </div>";
    }
    $conn = null;
} else {
    // Conexión OK
    $conn->set_charset('utf8mb4');
}

// Exportar $conn globalmente si otras partes lo esperan
$GLOBALS['conn'] = $conn;
