<?php require BASE_PATH . '/views/layouts/header.php'; ?>

<div class="public-page">
    <div class="container">
        <h1 class="page-heading handwritten">Polaroid Memory Wall 🎁</h1>
        <p class="page-subtitle marathi">मित्रांकडून शुभेच्छा 🌸</p>

        <?php if (!empty($records)): ?>
        <div class="sky-btn-wrap">
            <button type="button" class="btn-sky" id="takeToSky">✨ Take Wishes To The Sky ✨</button>
        </div>

        <div class="row g-4 justify-content-center polaroid-grid">
            <?php foreach ($records as $i => $wish): ?>
            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                <div class="polaroid-card h-100 reveal reveal-pop" data-delay="<?= ($i % 5) + 1 ?>">
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
                        <?php if (!empty($wish['wish_date'])): ?>
                        <p class="polaroid-date"><?= htmlspecialchars(date('d M Y', strtotime($wish['wish_date']))) ?></p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

        <!-- Data island for the night-sky animation -->
        <script type="application/json" id="wishData"><?= json_encode(array_map(function ($w) {
            return ['name' => $w['name'], 'text' => $w['wish_text'] ?? ''];
        }, $records), JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT) ?></script>

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

<!-- Night Sky overlay (Take Wishes To The Sky) -->
<div class="night-sky" id="nightSky">
    <button type="button" class="night-sky-close" title="Close">✕</button>
    <p class="night-sky-title handwritten">Every wish is a star for you ✨ — एक तारा दाबून बघ 🌟</p>
    <div class="star-reader">
        <p class="sr-name"></p>
        <p class="sr-text"></p>
    </div>
</div>

<?php require BASE_PATH . '/views/layouts/footer.php'; ?>
