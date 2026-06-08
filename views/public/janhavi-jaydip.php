<?php require BASE_PATH . '/views/layouts/header.php'; ?>

<div class="public-page">
    <div class="container">
        <h1 class="page-heading handwritten">Love Treasure 💎</h1>
        <p class="page-subtitle marathi">आमचं खास नातं 💕</p>

        <div class="locked-section">
            <div class="lock-icon">🔒</div>
            <h2 class="handwritten" style="color: var(--rose); font-size: 1.8rem; margin: 1rem 0;">Coming Soon</h2>
            <p style="color: var(--text-medium); max-width: 400px; margin: 0 auto; line-height: 1.8;">
                This section holds something very special.
                <br>It will be unlocked in a future update.
                <br><span class="marathi">काहीतरी खास तुझ्यासाठी... 💕</span>
            </p>
        </div>

        <div class="back-home">
            <a href="<?= BASE_URL ?>/" class="btn-back">← Back to Home</a>
        </div>
    </div>
</div>

<?php require BASE_PATH . '/views/layouts/footer.php'; ?>
