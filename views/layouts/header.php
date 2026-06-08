<?php
$appConfig = $appConfig ?? require BASE_PATH . '/config/app.php';
$meta = $appConfig['meta'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- SEO Meta -->
    <title><?= htmlspecialchars($meta['title']) ?></title>
    <meta name="description" content="<?= htmlspecialchars($meta['description']) ?>">
    <meta name="keywords" content="<?= htmlspecialchars($meta['keywords']) ?>">
    <meta name="author" content="<?= htmlspecialchars($meta['author']) ?>">

    <!-- Open Graph -->
    <meta property="og:type" content="website">
    <meta property="og:title" content="<?= htmlspecialchars($meta['title']) ?>">
    <meta property="og:description" content="<?= htmlspecialchars($meta['description']) ?>">
    <meta property="og:image" content="<?= htmlspecialchars(BASE_URL . $meta['og_image']) ?>">
    <meta property="og:url" content="<?= htmlspecialchars(BASE_URL) ?>">

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?= htmlspecialchars($meta['title']) ?>">
    <meta name="twitter:description" content="<?= htmlspecialchars($meta['description']) ?>">

    <!-- Favicon -->
    <link rel="icon" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><text y='.9em' font-size='90'>💓</text></svg>">

    <!-- Bootstrap 5 (self-hosted, no CDN) -->
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/vendor/bootstrap/css/bootstrap.min.css">
    <!-- Styles (fonts self-hosted via style.css → assets/fonts/fonts.css). Loaded AFTER Bootstrap so the scrapbook theme wins. -->
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/style.css">
</head>
<body>
