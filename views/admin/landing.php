<?php
ob_start();
?>

<div class="skeleton-section">
    <h3>🏠 Landing Page Management</h3>
    <p style="color: var(--text-medium); margin-bottom: 1.5rem;">
        Manage the landing page hero image, title, subtitle, and background music.
    </p>

    <!-- Skeleton placeholders for future form -->
    <div class="skeleton-placeholder" style="height: 45px;"></div>
    <div class="skeleton-placeholder" style="height: 45px;"></div>
    <div class="skeleton-placeholder" style="height: 120px;"></div>
    <div class="skeleton-placeholder" style="height: 45px; width: 60%;"></div>

    <p style="color: var(--text-light); margin-top: 1.5rem; font-size: 0.85rem;">
        Full CRUD will be available in Phase 2. Currently displaying data from database seed.
    </p>
</div>

<?php
$adminContent = ob_get_clean();
require BASE_PATH . '/views/admin/layout.php';
?>
