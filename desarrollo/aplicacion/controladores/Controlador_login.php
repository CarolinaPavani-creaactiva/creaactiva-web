<?php
// aplicacion/controladores/Controlador_login.php
$renderView = false;
$handled = false;

$errors = [];
$old = [];
$valor_correo = '';
$token_csrf = null;

// Cargar config
$configPath = __DIR__ . '/../config.php';
if (!file_exists($configPath)) {
    $errors[] = 'Falta config.php en aplicacion/';
    $renderView = true;
    return;
}
$config = include $configPath;

// Iniciar sesión si no lo está
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

// Si ya hay usuario logueado, redirigir según rol (evita ver la página de login estando logueado)
if (!empty($_SESSION['usuario'])) {
    $sessRole = $_SESSION['usuario']['role'] ?? $_SESSION['usuario']['rol'] ?? null;
    if ($sessRole === 'admin') {
        header('Location: ?page=panelAdmin');
        exit;
    } else {
        header('Location: ?page=inicio');
        exit;
    }
}

// Generar/obtener token CSRF
if (empty($_SESSION['_csrf_token'])) {
    try {
        $_SESSION['_csrf_token'] = bin2hex(random_bytes(16));
    } catch (Exception $e) {
        $_SESSION['_csrf_token'] = bin2hex(openssl_random_pseudo_bytes(16));
    }
}
$token_csrf = $_SESSION['_csrf_token'];

// Si recibimos POST, procesar intento de login
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $inputUser = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $token = $_POST['_csrf'] ?? '';

    $old['email'] = $inputUser;
    $valor_correo = $inputUser;

    // Validaciones básicas
    if (empty($token) || !hash_equals($_SESSION['_csrf_token'] ?? '', $token)) {
        $errors[] = 'Token CSRF inválido.';
    }
    if ($inputUser === '') {
        $errors[] = 'Introduce tu email o usuario.';
    }
    if (strlen($password) < 1) {
        $errors[] = 'Introduce la contraseña.';
    }

    if (empty($errors)) {
        try {
            // Conexión PDO
            $db = $config['db'];
            $dsn = "mysql:host={$db['host']};port={$db['port']};dbname={$db['name']};charset=utf8mb4";
            $pdo = new PDO($dsn, $db['user'], $db['pass'], [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            ]);

            // Buscar por email o name (case-insensitive)
            $sql = 'SELECT * FROM users WHERE LOWER(email) = :u OR LOWER(name) = :u LIMIT 1';
            $stmt = $pdo->prepare($sql);
            $param = mb_strtolower($inputUser);
            $stmt->execute(['u' => $param]);
            $user = $stmt->fetch();

            // Si no encontrado con LOWER, intentar exact match by name (cover collations)
            if (!$user) {
                $stmt2 = $pdo->prepare('SELECT * FROM users WHERE name = :n LIMIT 1');
                $stmt2->execute(['n' => $inputUser]);
                $user2 = $stmt2->fetch();
                if ($user2) $user = $user2;
            }

            if ($user) {
                $stored = $user['password'] ?? null;
                $userId = $user['id'] ?? ($user['ID'] ?? null);
                $emailShown = $user['email'] ?? '';
                $nameShown = $user['name'] ?? '';

                $ok = false;
                $used_method = null;

                // 1) password_hash (bcrypt/argon)
                if (!empty($stored)) {
                    $info = password_get_info($stored);
                    if ($info['algo'] !== 0) {
                        if (password_verify($password, $stored)) {
                            $ok = true;
                            $used_method = 'password_hash';
                        }
                    }
                }

                // 2) SHA1 legacy
                if (!$ok && !empty($stored) && hash_equals(sha1($password), $stored)) {
                    $ok = true;
                    $used_method = 'sha1';
                }

                // 3) MD5 legacy
                if (!$ok && !empty($stored) && hash_equals(md5($password), $stored)) {
                    $ok = true;
                    $used_method = 'md5';
                }

                // 4) Plaintext fallback (último recurso)
                if (!$ok && !empty($stored) && hash_equals($stored, $password)) {
                    $ok = true;
                    $used_method = 'plain';
                }

                if ($ok) {
                    // Si era legacy, migrar a password_hash()
                    if ($used_method !== 'password_hash' && $userId !== null) {
                        try {
                            $newHash = password_hash($password, PASSWORD_DEFAULT);
                            $upd = $pdo->prepare('UPDATE users SET password = :ph WHERE id = :id');
                            $upd->execute(['ph' => $newHash, 'id' => $userId]);
                            if (!empty($config['env']) && $config['env'] === 'development') {
                                error_log("Controlador_login - migrado hash para user id={$userId} ({$used_method} -> password_hash)");
                            }
                        } catch (Exception $e) {
                            error_log('Controlador_login - no se pudo actualizar hash: ' . $e->getMessage());
                        }
                    }

                    // Crear sesión y guardar datos (guardamos ambas claves role y rol)
                    session_regenerate_id(true);
                    $sessionRole = $user['role'] ?? ($user['rol'] ?? 'usuario');
                    $_SESSION['usuario'] = [
                        'id' => $userId,
                        'email' => $emailShown,
                        'name' => $nameShown,
                        'role' => $sessionRole,
                        'rol' => $sessionRole,
                    ];

                    // Redirección según rol
                    if ($sessionRole === 'admin') {
                        header('Location: ?page=panelAdmin');
                        exit;
                    } else {
                        // Por defecto al home (puedes cambiar a la ruta que uses para clientes)
                        header('Location: ?page=inicio');
                        exit;
                    }
                } else {
                    $errors[] = 'Correo o contraseña incorrectos.';
                    error_log("Controlador_login: intento fallido para {$inputUser}");
                }
            } else {
                $errors[] = 'Correo o contraseña incorrectos.';
                error_log("Controlador_login: usuario no encontrado para {$inputUser}");
            }
        } catch (Exception $e) {
            error_log('Controlador_login - error: ' . $e->getMessage());
            if (!empty($config['env']) && $config['env'] === 'development') {
                // Mensaje detallado solo en desarrollo
                $errors[] = 'Error del servidor: ' . $e->getMessage();
            } else {
                $errors[] = 'Error del servidor, inténtalo más tarde.';
            }
        }
    }

    // Errores -> renderizar vista con $errors y $old
    $renderView = true;
    return;
}

// GET: mostrar la vista de login (si no está logueado)
$renderView = true;
return;
