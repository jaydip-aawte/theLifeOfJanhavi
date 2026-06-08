<?php
ob_start();
?>

<!-- Dashboard Stats -->
<div class="dashboard-grid">
    <div class="dashboard-card">
        <div class="dashboard-card-icon">📋</div>
        <div class="dashboard-card-value"><?= (int)($stats['total_menus'] ?? 0) ?></div>
        <div class="dashboard-card-label">Active Menu Items</div>
    </div>
    <div class="dashboard-card">
        <div class="dashboard-card-icon">🏠</div>
        <div class="dashboard-card-value"><?= (int)($stats['landing_pages'] ?? 0) ?></div>
        <div class="dashboard-card-label">Landing Pages</div>
    </div>
    <div class="dashboard-card">
        <div class="dashboard-card-icon">🖼️</div>
        <div class="dashboard-card-value">0</div>
        <div class="dashboard-card-label">Photos Uploaded</div>
    </div>
    <div class="dashboard-card">
        <div class="dashboard-card-icon">🎵</div>
        <div class="dashboard-card-value">0</div>
        <div class="dashboard-card-label">Music Tracks</div>
    </div>
</div>

<!-- Quick Info -->
<div class="skeleton-section">
    <h3>🌸 Welcome to TheLifeOfJanhavi Admin</h3>
    <p style="color: var(--text-medium); line-height: 1.8;">
        This is your admin dashboard. From here you can manage the entire website —
        landing page content, navigation menus, music, photos, and more.
    </p>
    <p style="color: var(--text-light); margin-top: 1rem; font-size: 0.85rem;">
        <strong>Phase 1</strong> includes: Landing page management, menu system, music controls, and basic settings.
        <br>More modules (Wish photos/videos, Fun Area, Quiz, etc.) are coming in Phase 2.
    </p>
</div>

<!-- Coming Soon Modules -->
<div class="skeleton-section">
    <h3>🚀 Upcoming Modules</h3>
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1rem; margin-top: 1rem;">
        <div style="padding: 1rem; background: var(--cream); border-radius: var(--radius-sm); text-align: center;">
            <div style="font-size: 1.5rem; margin-bottom: 0.5rem;">🎁</div>
            <div style="font-weight: 500; font-size: 0.85rem;">Wish For Janhavi</div>
            <span class="coming-soon-badge" style="margin-top: 0.5rem;">Phase 2</span>
        </div>
        <div style="padding: 1rem; background: var(--cream); border-radius: var(--radius-sm); text-align: center;">
            <div style="font-size: 1.5rem; margin-bottom: 0.5rem;">💎</div>
            <div style="font-weight: 500; font-size: 0.85rem;">Love Treasure</div>
            <span class="coming-soon-badge" style="margin-top: 0.5rem;">Phase 2</span>
        </div>
        <div style="padding: 1rem; background: var(--cream); border-radius: var(--radius-sm); text-align: center;">
            <div style="font-size: 1.5rem; margin-bottom: 0.5rem;">🎮</div>
            <div style="font-weight: 500; font-size: 0.85rem;">Fun Zone</div>
            <span class="coming-soon-badge" style="margin-top: 0.5rem;">Phase 2</span>
        </div>
        <div style="padding: 1rem; background: var(--cream); border-radius: var(--radius-sm); text-align: center;">
            <div style="font-size: 1.5rem; margin-bottom: 0.5rem;">🧩</div>
            <div style="font-weight: 500; font-size: 0.85rem;">Quiz</div>
            <span class="coming-soon-badge" style="margin-top: 0.5rem;">Phase 2</span>
        </div>
    </div>
</div>

<?php
$adminContent = ob_get_clean();
require BASE_PATH . '/views/admin/layout.php';
?>
