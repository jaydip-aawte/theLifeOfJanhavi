<?php
ob_start();
?>

<!-- Dashboard Stats -->
<div class="dashboard-grid">
    <div class="dashboard-card">
        <div class="dashboard-card-icon">🖼️</div>
        <div class="dashboard-card-value"><?= (int)($stats['total_photos'] ?? 0) ?></div>
        <div class="dashboard-card-label">Total Photos</div>
    </div>
    <div class="dashboard-card">
        <div class="dashboard-card-icon">🎬</div>
        <div class="dashboard-card-value"><?= (int)($stats['total_videos'] ?? 0) ?></div>
        <div class="dashboard-card-label">Total Videos</div>
    </div>
    <div class="dashboard-card">
        <div class="dashboard-card-icon">🎁</div>
        <div class="dashboard-card-value"><?= (int)($stats['total_wishes'] ?? 0) ?></div>
        <div class="dashboard-card-label">Total Wishes</div>
    </div>
    <div class="dashboard-card">
        <div class="dashboard-card-icon">📋</div>
        <div class="dashboard-card-value"><?= (int)($stats['total_modules'] ?? 0) ?></div>
        <div class="dashboard-card-label">Total Modules</div>
    </div>
    <div class="dashboard-card">
        <div class="dashboard-card-icon">✨</div>
        <div class="dashboard-card-value"><?= (int)($stats['active_content'] ?? 0) ?></div>
        <div class="dashboard-card-label">Active Content</div>
    </div>
    <div class="dashboard-card">
        <div class="dashboard-card-icon">📥</div>
        <div class="dashboard-card-value" style="font-size: 1rem;"><?= $stats['last_import'] ? htmlspecialchars($stats['last_import']) : 'Never' ?></div>
        <div class="dashboard-card-label">Last Import</div>
    </div>
</div>

<!-- Quick Search -->
<div class="skeleton-section">
    <h3>🔍 Quick Search</h3>
    <form method="get" action="<?= BASE_URL ?>/admin/?page=search" class="search-form" style="margin-top: 1rem;">
        <input type="hidden" name="page" value="search">
        <input type="text" name="q" class="form-control search-input" placeholder="Search photos, videos, content (English, Marathi, Emoji)...">
        <button type="submit" class="btn-primary">Search</button>
    </form>
</div>

<!-- Quick Links -->
<div class="skeleton-section">
    <h3>🚀 Content Modules</h3>
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1rem; margin-top: 1rem;">
        <a href="<?= BASE_URL ?>/admin/?page=wish-photo" class="quick-link-card">
            <div style="font-size: 1.5rem; margin-bottom: 0.5rem;">🎁</div>
            <div style="font-weight: 500; font-size: 0.85rem;">Wish Photos</div>
        </a>
        <a href="<?= BASE_URL ?>/admin/?page=wish-video" class="quick-link-card">
            <div style="font-size: 1.5rem; margin-bottom: 0.5rem;">🎬</div>
            <div style="font-weight: 500; font-size: 0.85rem;">Wish Videos</div>
        </a>
        <a href="<?= BASE_URL ?>/admin/?page=sapkal" class="quick-link-card">
            <div style="font-size: 1.5rem; margin-bottom: 0.5rem;">👩</div>
            <div style="font-weight: 500; font-size: 0.85rem;">Janhavi Sapkal</div>
        </a>
        <a href="<?= BASE_URL ?>/admin/?page=jaydip" class="quick-link-card">
            <div style="font-size: 1.5rem; margin-bottom: 0.5rem;">💕</div>
            <div style="font-weight: 500; font-size: 0.85rem;">Janhavi Jaydip</div>
        </a>
        <a href="<?= BASE_URL ?>/admin/?page=chatpati" class="quick-link-card">
            <div style="font-size: 1.5rem; margin-bottom: 0.5rem;">🌶️</div>
            <div style="font-weight: 500; font-size: 0.85rem;">Chatpati Janhavi</div>
        </a>
        <a href="<?= BASE_URL ?>/admin/?page=import" class="quick-link-card">
            <div style="font-size: 1.5rem; margin-bottom: 0.5rem;">📥</div>
            <div style="font-weight: 500; font-size: 0.85rem;">Import Data</div>
        </a>
    </div>
</div>

<?php
$adminContent = ob_get_clean();
require BASE_PATH . '/views/admin/layout.php';
?>
