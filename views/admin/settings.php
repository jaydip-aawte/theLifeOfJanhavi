<?php
ob_start();
?>

<div class="skeleton-section">
    <h3>⚙️ Settings</h3>
    <p style="color: var(--text-medium); margin-bottom: 1.5rem;">
        Global site settings — site name, tagline, feature toggles, maintenance mode.
    </p>

    <div class="skeleton-placeholder" style="height: 45px;"></div>
    <div class="skeleton-placeholder" style="height: 45px;"></div>
    <div class="skeleton-placeholder" style="height: 45px; width: 40%;"></div>

    <p style="color: var(--text-light); margin-top: 1.5rem; font-size: 0.85rem;">
        Settings editor will be available in Phase 2.
    </p>
</div>

<?php
$adminContent = ob_get_clean();
require BASE_PATH . '/views/admin/layout.php';
?>
