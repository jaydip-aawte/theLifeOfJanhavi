<?php
/* Phase 3: random emotional quote + decoration toggles (DB-driven, fail-soft) */
$footerQuote = null;
$decorEmojis = [];
try {
    require_once BASE_PATH . '/models/EmotionalQuote.php';
    require_once BASE_PATH . '/models/Setting.php';
    $footerQuote = (new EmotionalQuote())->random();

    $settingModel = new Setting();
    $decorMap = [
        'decor_hearts'   => ['💗', '💕', '💖'],
        'decor_flowers'  => ['🌸', '🌷', '🌻'],
        'decor_sparkles' => ['✨', '💫'],
        'decor_stars'    => ['⭐', '🌟'],
    ];
    foreach ($decorMap as $key => $emojis) {
        if ($settingModel->get($key, '0') === '1') {
            $decorEmojis = array_merge($decorEmojis, $emojis);
        }
    }
} catch (\Throwable $e) {
    $footerQuote = null;
    $decorEmojis = [];
}
?>
    <?php if (!empty($footerQuote)): ?>
    <!-- Phase 3: Emotional Quote (random) -->
    <div class="container">
        <div class="quote-banner reveal">
            <p class="quote-text"><?= htmlspecialchars($footerQuote['quote_text']) ?></p>
            <?php if (!empty($footerQuote['author_text'])): ?>
            <p class="quote-author">— <?= htmlspecialchars($footerQuote['author_text']) ?></p>
            <?php endif; ?>
        </div>
    </div>
    <?php endif; ?>

    <!-- Footer -->
    <footer class="footer">
        <p class="handwritten">Made with <span class="heart">💓</span> for Janhavi</p>
        <p style="margin-top: 0.5rem;">तू खूप खास आहेस 🌸</p>
    </footer>

    <?php if (!empty($decorEmojis)): ?>
    <!-- Phase 3: Floating decorations (admin-toggleable) -->
    <div class="scrap-decor-layer" id="decorLayer" data-decor="<?= htmlspecialchars(implode(',', $decorEmojis)) ?>"></div>
    <?php endif; ?>

    <!-- Bootstrap 5 bundle (self-hosted, includes Popper) -->
    <script src="<?= BASE_URL ?>/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core JS -->
    <script src="<?= BASE_URL ?>/assets/js/app.js"></script>
    <!-- Phase 3 scrapbook interactions -->
    <script src="<?= BASE_URL ?>/assets/js/scrapbook.js"></script>
</body>
</html>
