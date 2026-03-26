<?php

declare(strict_types=1);

require_once __DIR__ . '/config/database.php';
require_once __DIR__ . '/config/session.php';

startSecureSession();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: login.php');
    exit;
}

$csrfToken = (string) ($_POST['csrf_token'] ?? '');
$sessionToken = (string) ($_SESSION['csrf_token'] ?? '');

if ($csrfToken === '' || $sessionToken === '' || !hash_equals($sessionToken, $csrfToken)) {
    header('Location: login.php?error=CSRF+token+tidak+valid');
    exit;
}

$email = trim((string) ($_POST['email'] ?? ''));
$password = (string) ($_POST['password'] ?? '');

if ($email === '' || $password === '') {
    $query = http_build_query([
        'error' => 'Email dan password wajib diisi',
        'email' => $email,
    ]);
    header("Location: login.php?{$query}");
    exit;
}

try {
    $pdo = db();

    $stmt = $pdo->prepare('SELECT id, full_name, email, password_hash, role, is_active FROM users WHERE email = :email LIMIT 1');
    $stmt->execute(['email' => $email]);
    $user = $stmt->fetch();

    if (!$user || (int) $user['is_active'] !== 1 || !password_verify($password, (string) $user['password_hash'])) {
        $query = http_build_query([
            'error' => 'Email atau password salah',
            'email' => $email,
        ]);
        header("Location: login.php?{$query}");
        exit;
    }

    session_regenerate_id(true);
    $_SESSION['user_id'] = (int) $user['id'];
    $_SESSION['user_name'] = (string) $user['full_name'];
    $_SESSION['user_email'] = (string) $user['email'];
    $_SESSION['user_role'] = (string) $user['role'];

    $updateStmt = $pdo->prepare('UPDATE users SET last_login_at = NOW() WHERE id = :id');
    $updateStmt->execute(['id' => (int) $user['id']]);

    header('Location: dashboard.php');
    exit;
} catch (Throwable $e) {
    header('Location: login.php?error=Terjadi+kesalahan+pada+server');
    exit;
}
