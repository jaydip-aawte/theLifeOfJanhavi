<?php require BASE_PATH . '/views/layouts/header.php'; ?>

<div class="public-page">
    <div class="container">
        <h1 class="page-heading handwritten">Video Wishes 🎬</h1>
        <p class="page-subtitle marathi">व्हिडीओ शुभेच्छा 🎥</p>

        <?php if (!empty($records)): ?>
        <div class="video-grid">
            <?php foreach ($records as $video): ?>
            <div class="video-card">
                <?php if (!empty($video['youtube_embed_url'])): ?>
                <div class="video-embed">
                    <iframe
                        data-src="<?= htmlspecialchars($video['youtube_embed_url']) ?>"
                        title="<?= htmlspecialchars($video['name']) ?>"
                        frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen
                        loading="lazy"
                        class="lazy-iframe"></iframe>
                </div>
                <?php endif; ?>
                <div class="video-body">
                    <h3 class="video-name"><?= htmlspecialchars($video['name']) ?></h3>
                    <?php if (!empty($video['wish_text'])): ?>
                    <p class="video-text"><?= nl2br(htmlspecialchars($video['wish_text'])) ?></p>
                    <?php endif; ?>
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

<script>
document.addEventListener('DOMContentLoaded', function() {
    if ('IntersectionObserver' in window) {
        var observer = new IntersectionObserver(function(entries) {
            entries.forEach(function(entry) {
                if (entry.isIntersecting) {
                    var iframe = entry.target;
                    iframe.src = iframe.dataset.src;
                    observer.unobserve(iframe);
                }
            });
        }, {rootMargin: '200px'});
        document.querySelectorAll('.lazy-iframe').forEach(function(el) { observer.observe(el); });
    } else {
        document.querySelectorAll('.lazy-iframe').forEach(function(el) { el.src = el.dataset.src; });
    }
});
</script>

<?php require BASE_PATH . '/views/layouts/footer.php'; ?>
