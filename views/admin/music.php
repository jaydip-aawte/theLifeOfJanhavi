<?php
ob_start();
?>

<div class="skeleton-section">
    <h3>🎵 Music Management</h3>
    <p style="color: var(--text-medium); margin-bottom: 1.5rem;">
        Upload and manage background music for the homepage. Only one track plays at a time.
        Music never autoplays — visitors must click the floating music button.
    </p>

    <div class="skeleton-placeholder" style="height: 60px;"></div>
    <div class="skeleton-placeholder" style="height: 45px; width: 50%;"></div>

    <p style="color: var(--text-light); margin-top: 1.5rem; font-size: 0.85rem;">
        Upload functionality will be available in Phase 2. The frontend music framework is already in place.
    </p>
</div>

<?php
$adminContent = ob_get_clean();
require BASE_PATH . '/views/admin/layout.php';
?>
