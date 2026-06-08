<?php require BASE_PATH . '/views/layouts/header.php'; ?>

<div class="public-page">
    <div class="container">
        <h1 class="page-heading handwritten">Chatpati Janhavi 🌶️</h1>
        <p class="page-subtitle marathi">जाह्नवीची मजेशीर बाजू 😄</p>

        <?php if (!empty($records)): ?>
        <div class="meme-grid">
            <?php foreach ($records as $meme): ?>
            <div class="meme-card">
                <?php if (!empty($meme['image_path'])): ?>
                <div class="meme-image-wrap">
                    <img src="<?= htmlspecialchars($meme['image_path']) ?>" alt="<?= htmlspecialchars($meme['title']) ?>" class="meme-image lazy-image" loading="lazy">
                </div>
                <?php endif; ?>
                <div class="meme-body">
                    <h3 class="meme-title"><?= htmlspecialchars($meme['title']) ?></h3>
                    <?php if (!empty($meme['meme_text'])): ?>
                    <p class="meme-text-badge"><?= htmlspecialchars($meme['meme_text']) ?></p>
                    <?php endif; ?>
                    <?php if (!empty($meme['description'])): ?>
                    <p class="meme-desc"><?= nl2br(htmlspecialchars($meme['description'])) ?></p>
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

        <div class="back-home">
            <a href="<?= BASE_URL ?>/" class="btn-back">← Back to Home</a>
        </div>
    </div>
</div>

<?php require BASE_PATH . '/views/layouts/footer.php'; ?>
