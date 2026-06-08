<?php
ob_start();
?>

<div class="skeleton-section">
    <h3>🔑 Credentials</h3>
    <p style="color: var(--text-medium); margin-bottom: 1.5rem;">
        Change your admin username and password. Passwords are securely hashed with bcrypt.
    </p>

    <div class="skeleton-placeholder" style="height: 45px;"></div>
    <div class="skeleton-placeholder" style="height: 45px;"></div>
    <div class="skeleton-placeholder" style="height: 45px;"></div>
    <div class="skeleton-placeholder" style="height: 45px; width: 50%;"></div>

    <p style="color: var(--text-light); margin-top: 1.5rem; font-size: 0.85rem;">
        Password change form will be available in Phase 2.
        <br><strong>Reminder:</strong> Default credentials are <code>admin / admin123</code> — change them after the database is set up.
    </p>
</div>

<?php
$adminContent = ob_get_clean();
require BASE_PATH . '/views/admin/layout.php';
?>
