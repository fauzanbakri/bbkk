<?php

declare(strict_types=1);

require_once __DIR__ . '/config/session.php';
requireLogin();

$userName = (string) ($_SESSION['user_name'] ?? 'User');
$userEmail = (string) ($_SESSION['user_email'] ?? '-');
$userRole = (string) ($_SESSION['user_role'] ?? '-');
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Dashboard | BBKK</title>
  <link rel="icon" type="image/png" href="../template/assets/images/favicon.png">
  <link rel="stylesheet" href="../template/assets/css/styles.css">
</head>
<body>
  <div class="container py-5">
    <div class="card p-4 rounded-4">
      <h4 class="mb-3">Login berhasil</h4>
      <p class="mb-1"><strong>Nama:</strong> <?= htmlspecialchars($userName, ENT_QUOTES, 'UTF-8') ?></p>
      <p class="mb-1"><strong>Email:</strong> <?= htmlspecialchars($userEmail, ENT_QUOTES, 'UTF-8') ?></p>
      <p class="mb-4"><strong>Role:</strong> <?= htmlspecialchars($userRole, ENT_QUOTES, 'UTF-8') ?></p>
      <div>
        <a class="btn btn-primary" href="logout.php">Logout</a>
      </div>
    </div>
  </div>
</body>
</html>
