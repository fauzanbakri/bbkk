<?php

declare(strict_types=1);

require_once __DIR__ . '/config/session.php';
startSecureSession();

if (!empty($_SESSION['user_id'])) {
    header('Location: dashboard.php');
    exit;
}

$error = isset($_GET['error']) ? trim((string) $_GET['error']) : '';
$success = isset($_GET['success']) ? trim((string) $_GET['success']) : '';
$emailOld = isset($_GET['email']) ? trim((string) $_GET['email']) : '';

if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="theme-color" content="#316AFF">
  <title>Login | BBKK</title>

  <link rel="icon" type="image/png" href="../template/assets/images/favicon.png">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="../template/assets/libs/flaticon/css/all/all.css">
  <link rel="stylesheet" href="../template/assets/libs/lucide/lucide.css">
  <link rel="stylesheet" href="../template/assets/libs/fontawesome/css/all.min.css">
  <link rel="stylesheet" href="../template/assets/libs/simplebar/simplebar.css">
  <link rel="stylesheet" href="../template/assets/libs/node-waves/waves.css">
  <link rel="stylesheet" href="../template/assets/libs/bootstrap-select/css/bootstrap-select.min.css">
  <link rel="stylesheet" href="../template/assets/css/styles.css">
</head>
<body>
  <div class="page-layout">
    <div class="auth-wrapper min-vh-100 px-2" style="background-image: url('../template/assets/images/auth/auth.webp'); background-size: cover; background-position: center; background-repeat: no-repeat;">
      <div class="row g-0 min-vh-100">
        <div class="col-xl-5 col-lg-6 ms-auto px-sm-4 align-self-center py-4">
          <div class="card card-body p-4 p-sm-5 maxw-450px m-auto rounded-4 auth-card" data-simplebar>
            <div class="mb-4 text-center">
              <a href="login.php" aria-label="BBKK logo">
                <img class="visible-light" src="../template/assets/images/logo-full.svg" alt="BBKK logo">
                <img class="visible-dark" src="../template/assets/images/logo-full-white.svg" alt="BBKK logo">
              </a>
            </div>

            <div class="text-center mb-4">
              <h5 class="mb-1">Welcome to BBKK</h5>
              <p>Silakan login untuk masuk ke sistem BBKK.</p>
            </div>

            <?php if ($error !== ''): ?>
              <div class="alert alert-danger" role="alert"><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?></div>
            <?php endif; ?>

            <?php if ($success !== ''): ?>
              <div class="alert alert-success" role="alert"><?= htmlspecialchars($success, ENT_QUOTES, 'UTF-8') ?></div>
            <?php endif; ?>

            <form action="authenticate.php" method="post" novalidate>
              <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token'], ENT_QUOTES, 'UTF-8') ?>">

              <div class="mb-4">
                <label class="form-label" for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="nama@email.com" value="<?= htmlspecialchars($emailOld, ENT_QUOTES, 'UTF-8') ?>" required>
              </div>

              <div class="mb-4">
                <label class="form-label" for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="********" required>
              </div>

              <div class="mb-4">
                <div class="form-check mb-0">
                  <input class="form-check-input" type="checkbox" id="rememberMe" name="remember_me" disabled>
                  <label class="form-check-label" for="rememberMe">Ingat saya (next)</label>
                </div>
              </div>

              <div class="mb-3">
                <button type="submit" class="btn btn-primary waves-effect waves-light w-100">Login</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="../template/assets/libs/global/global.min.js"></script>
  <script src="../template/assets/js/appSettings.js"></script>
  <script src="../template/assets/js/main.js"></script>
</body>
</html>
