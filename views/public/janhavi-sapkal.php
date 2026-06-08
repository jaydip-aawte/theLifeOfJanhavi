<?php require BASE_PATH . '/views/layouts/header.php'; ?>

<div class="public-page">
    <div class="container">
        <h1 class="page-heading handwritten">Proud Of You 👩</h1>
        <p class="page-subtitle marathi">Janhavi Sapkal — तुझा अभिमान आहे 🌟</p>

        <?php if (!empty($records)): ?>
        <div class="row g-4 justify-content-center proud-cards">
            <?php foreach ($records as $i => $item): ?>
            <div class="col-12 col-sm-6 col-lg-4">
                <div class="proud-card h-100 reveal <?= $i % 2 ? 'reveal-right' : 'reveal-left' ?>" data-delay="<?= ($i % 3) + 1 ?>">
                    <div class="proud-icon"><?= $item['icon'] ?? '🌟' ?></div>
                    <?php if (!empty($item['image_path'])): ?>
                    <img src="<?= htmlspecialchars($item['image_path']) ?>" alt="<?= htmlspecialchars($item['title']) ?>" class="proud-image lazy-image" loading="lazy">
                    <?php endif; ?>
                    <h3 class="proud-title"><?= htmlspecialchars($item['title']) ?></h3>
                    <?php if (!empty($item['subtitle'])): ?>
                    <p class="proud-subtitle"><?= htmlspecialchars($item['subtitle']) ?></p>
                    <?php endif; ?>
                    <?php if (!empty($item['description'])): ?>
                    <p class="proud-desc"><?= nl2br(htmlspecialchars($item['description'])) ?></p>
                    <?php endif; ?>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <?php else: ?>
        <div class="empty-public">
            <p>Content coming soon! ✨</p>
        </div>
        <?php endif; ?>

        <div class="back-home">
            <a href="<?= BASE_URL ?>/" class="btn-back">← Back to Home</a>
        </div>
    </div>
</div>

<?php require BASE_PATH . '/views/layouts/footer.php'; ?>
