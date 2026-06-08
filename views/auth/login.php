<?php
$appConfig = require BASE_PATH . '/config/app.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login — <?= htmlspecialchars($appConfig['meta']['title']) ?></title>
    <!-- Bootstrap 5 (self-hosted, no CDN) -->
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/style.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/admin.css">
    <link rel="icon" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><text y='.9em' font-size='90'>💓</text></svg>">
</head>
<body>
    <div class="login-page">
        <div class="login-card">
            <h1>💓 Admin Panel</h1>
            <p>TheLifeOfJanhavi</p>

            <?php if (!empty($error)): ?>
                <div class="alert-error"><?= htmlspecialchars($error) ?></div>
            <?php endif; ?>

            <form method="POST" action="<?= BASE_URL ?>/admin/?page=login" autocomplete="off">
                <?= $csrfField ?>

                <div class="form-group">
                    <label for="username">Username</label>
                    <input
                        type="text"
                        id="username"
                        name="username"
                        class="form-control"
                        placeholder="Enter username"
                        required
                        autofocus
                    >
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input
                        type="password"
                        id="password"
                        name="password"
                        class="form-control"
                        placeholder="Enter password"
                        required
                    >
                </div>

                <button type="submit" class="btn-primary">
                    ✨ Login ✨
                </button>
            </form>

            <p style="margin-top: 1.5rem; font-size: 0.8rem; color: var(--text-light);">
                <a href="<?= BASE_URL ?>/">← Back to Website</a>
            </p>
        </div>
    </div>
</body>
</html>
