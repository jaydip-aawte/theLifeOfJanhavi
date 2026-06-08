<?php require BASE_PATH . '/views/layouts/header.php'; ?>

<div class="public-page">
    <div class="container">
        <h1 class="page-heading handwritten">Wishes For Janhavi 🎁</h1>
        <p class="page-subtitle marathi">मित्रांकडून शुभेच्छा 🌸</p>

        <?php if (!empty($records)): ?>
        <div class="polaroid-grid">
            <?php foreach ($records as $wish): ?>
            <div class="polaroid-card">
                <?php if (!empty($wish['photo_path'])): ?>
                <div class="polaroid-photo">
                    <img src="<?= htmlspecialchars($wish['photo_path']) ?>" alt="<?= htmlspecialchars($wish['name']) ?>" loading="lazy" class="lazy-image">
                </div>
                <?php else: ?>
                <div class="polaroid-photo polaroid-placeholder">
                    <span>📸</span>
                </div>
                <?php endif; ?>
                <div class="polaroid-body">
                    <h3 class="polaroid-name"><?= htmlspecialchars($wish['name']) ?></h3>
                    <?php if (!empty($wish['wish_text'])): ?>
                    <p class="polaroid-text"><?= nl2br(htmlspecialchars($wish['wish_text'])) ?></p>
                    <?php endif; ?>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <?php else: ?>
        <div class="empty-public">
            <p>Wishes coming soon! 🌟</p>
        </div>
        <?php endif; ?>

        <div class="back-home">
            <a href="<?= BASE_URL ?>/" class="btn-back">← Back to Home</a>
        </div>
    </div>
</div>

<?php require BASE_PATH . '/views/layouts/footer.php'; ?>
