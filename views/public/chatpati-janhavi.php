<?php require BASE_PATH . '/views/layouts/header.php';
$funStickers = ['🌶️', '😜', '🍟', '🎭', '🤪', '🌟', '🍕', '😎'];
?>

<div class="public-page">
    <div class="container">
        <h1 class="page-heading handwritten">Chatpati Janhavi 🌶️</h1>
        <p class="page-subtitle marathi">जाह्नवीची मजेशीर बाजू 😄</p>

        <?php if (!empty($records)): ?>
        <div class="row g-4 justify-content-center funfact-grid">
            <?php foreach ($records as $i => $meme): ?>
            <div class="col-12 col-sm-6 col-lg-4">
                <div class="funfact-card reveal reveal-pop" data-delay="<?= ($i % 3) + 1 ?>">
                    <span class="scrap-sticker card-sticker <?= $i % 2 ? 'tilt-right' : '' ?>"><?= $funStickers[$i % count($funStickers)] ?></span>
                    <?php if (!empty($meme['image_path'])): ?>
                    <div class="meme-image-wrap" style="border-radius:14px;margin-bottom:0.8rem;">
                        <img src="<?= htmlspecialchars($meme['image_path']) ?>" alt="<?= htmlspecialchars($meme['title']) ?>" class="meme-image lazy-image" loading="lazy">
                    </div>
                    <?php else: ?>
                    <div class="funfact-emoji"><?= $funStickers[$i % count($funStickers)] ?></div>
                    <?php endif; ?>
                    <h3 class="funfact-title"><?= htmlspecialchars($meme['title']) ?></h3>
                    <?php if (!empty($meme['meme_text'])): ?>
                    <p class="meme-text-badge"><?= htmlspecialchars($meme['meme_text']) ?></p>
                    <?php endif; ?>
                    <?php if (!empty($meme['description'])): ?>
                    <p class="funfact-text"><?= nl2br(htmlspecialchars($meme['description'])) ?></p>
                    <?php endif; ?>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <?php else: ?>
        <div class="empty-public">
            <p>Memes coming soon! 😄</p>
        </div>
        <?php endif; ?>

        <?php
        $lettersHeading = 'Open When Letters 💌';
        require BASE_PATH . '/views/public/partials/letters.php';
        ?>

        <div class="back-home">
            <a href="<?= BASE_URL ?>/" class="btn-back">← Back to Home</a>
        </div>
    </div>
</div>

<?php require BASE_PATH . '/views/layouts/footer.php'; ?>
