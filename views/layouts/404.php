<?php
$appConfig = require BASE_PATH . '/config/app.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page Not Found — <?= htmlspecialchars($appConfig['meta']['title']) ?></title>
    <!-- Bootstrap 5 (self-hosted, no CDN) -->
    <link rel="stylesheet" href="<?= rtrim($appConfig['base_url'], '/') ?>/assets/vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= rtrim($appConfig['base_url'], '/') ?>/assets/css/style.css">
    <link rel="icon" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><text y='.9em' font-size='90'>💓</text></svg>">
</head>
<body>
    <div style="min-height: 100vh; display: flex; align-items: center; justify-content: center; text-align: center; padding: 2rem;">
        <div>
            <div style="font-size: 5rem; margin-bottom: 1rem;">🌸</div>
            <h1 class="handwritten" style="font-size: 3rem; color: var(--rose); margin-bottom: 1rem;">Oops!</h1>
            <p style="font-size: 1.1rem; color: var(--text-medium); margin-bottom: 2rem;">
                This page wandered off somewhere...<br>
                <span class="marathi">हे पान सापडले नाही 🥺</span>
            </p>
            <a href="<?= rtrim($appConfig['base_url'], '/') ?>" class="landing-modal-btn" style="text-decoration: none;">
                ✨ Go Back Home ✨
            </a>
        </div>
    </div>
</body>
</html>
