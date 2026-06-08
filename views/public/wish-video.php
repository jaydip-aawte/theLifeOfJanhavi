<?php
require BASE_PATH . '/views/layouts/header.php';

/* Derive a YouTube video id from an embed/watch URL for the thumbnail. */
function janhavi_youtube_id(string $url): string
{
    if ($url === '') return '';
    if (preg_match('~(?:embed/|watch\?v=|youtu\.be/)([A-Za-z0-9_-]{6,})~', $url, $m)) {
        return $m[1];
    }
    return '';
}
?>

<div class="public-page">
    <div class="container">
        <h1 class="page-heading handwritten">Video Memory Gallery 🎬</h1>
        <p class="page-subtitle marathi">व्हिडीओ शुभेच्छा 🎥</p>

        <?php if (!empty($records)): ?>
        <div class="row g-4 justify-content-center video-grid">
            <?php foreach ($records as $i => $video):
                $vid = janhavi_youtube_id($video['youtube_embed_url'] ?? ($video['youtube_url'] ?? ''));
                $thumb = $vid ? 'https://img.youtube.com/vi/' . $vid . '/hqdefault.jpg' : '';
            ?>
            <div class="col-12 col-sm-6 col-lg-4">
                <div class="video-card h-100 reveal" data-delay="<?= ($i % 5) + 1 ?>"
                     data-embed="<?= htmlspecialchars($video['youtube_embed_url'] ?? '') ?>"
                     data-name="<?= htmlspecialchars($video['name']) ?>"
                     data-text="<?= htmlspecialchars($video['wish_text'] ?? '') ?>"
                     role="button" tabindex="0">
                    <div class="video-thumb">
                        <?php if ($thumb): ?>
                        <img src="<?= htmlspecialchars($thumb) ?>" alt="<?= htmlspecialchars($video['name']) ?>" loading="lazy">
                        <?php endif; ?>
                        <div class="video-play"><span>▶</span></div>
                    </div>
                    <div class="video-body">
                        <h3 class="video-name"><?= htmlspecialchars($video['name']) ?></h3>
                        <?php if (!empty($video['wish_text'])): ?>
                        <p class="video-text"><?= htmlspecialchars(mb_strimwidth($video['wish_text'], 0, 70, '…')) ?></p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <?php else: ?>
        <div class="empty-public">
            <p>Video wishes coming soon! 🎬</p>
        </div>
        <?php endif; ?>

        <div class="back-home">
            <a href="<?= BASE_URL ?>/" class="btn-back">← Back to Home</a>
        </div>
    </div>
</div>

<!-- Video Memory modal -->
<div class="letter-overlay" id="videoModal">
    <div class="letter-paper" style="background:#fff; max-width:720px;">
        <button type="button" class="letter-close" title="Close">✕</button>
        <h3 class="letter-title video-modal-name"></h3>
        <div class="video-modal-frame"></div>
        <p class="video-modal-text"></p>
    </div>
</div>

<?php require BASE_PATH . '/views/layouts/footer.php'; ?>
