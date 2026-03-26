<?php

declare(strict_types=1);

function startSecureSession(): void
{
    if (session_status() === PHP_SESSION_ACTIVE) {
        return;
    }

    session_set_cookie_params([
        'lifetime' => 0,
        'path' => '/',
        'httponly' => true,
        'secure' => isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off',
        'samesite' => 'Lax',
    ]);

    session_start();
}

function requireLogin(): void
{
    startSecureSession();

    if (empty($_SESSION['user_id'])) {
        header('Location: login.php?error=Silakan+login+terlebih+dahulu');
        exit;
    }
}
