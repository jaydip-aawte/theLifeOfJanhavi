<?php require BASE_PATH . '/views/layouts/header.php'; ?>

<div class="public-page">
    <div class="container">
        <h1 class="page-heading handwritten">Love Treasure 💎</h1>
        <p class="page-subtitle marathi">एक खास खजिना तुझ्यासाठी 💕</p>

        <div class="treasure-wrap reveal reveal-pop">
            <div class="treasure-chest">🧰</div>
            <div class="treasure-lock">🔒</div>
            <p class="treasure-msg">
                This treasure will unlock when you answer a few special questions ❤️
                <br><span class="marathi">काही खास प्रश्नांची उत्तरं दिल्यावर हा खजिना उघडेल 🌸</span>
            </p>
            <span class="treasure-badge">🔐 Locked for now — coming soon</span>
        </div>

        <div class="back-home">
            <a href="<?= BASE_URL ?>/" class="btn-back">← Back to Home</a>
        </div>
    </div>
</div>

<?php require BASE_PATH . '/views/layouts/footer.php'; ?>
