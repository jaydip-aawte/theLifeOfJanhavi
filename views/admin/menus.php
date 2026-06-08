<?php
ob_start();
?>

<div class="skeleton-section">
    <h3>📋 Menu Management</h3>
    <p style="color: var(--text-medium); margin-bottom: 1.5rem;">
        Control the navigation cards displayed on the homepage. Drag to reorder, toggle visibility.
    </p>

    <!-- Preview of current menu items -->
    <div style="display: grid; gap: 0.75rem; margin-top: 1rem;">
        <?php
        $defaultMenus = [
            ['icon' => '🎁', 'name' => 'Wish For Janhavi', 'rank' => 1],
            ['icon' => '👩', 'name' => 'Janhavi Sapkal', 'rank' => 2],
            ['icon' => '🌶️', 'name' => 'Janhavi Ek Chatpati Ladki', 'rank' => 3],
            ['icon' => '💎', 'name' => 'Love Treasure', 'rank' => 4],
            ['icon' => '🎮', 'name' => 'Fun Zone', 'rank' => 5],
        ];
        foreach ($defaultMenus as $menu):
        ?>
        <div style="display: flex; align-items: center; gap: 1rem; padding: 0.75rem 1rem; background: var(--cream); border-radius: var(--radius-sm);">
            <span style="font-size: 1.5rem;"><?= $menu['icon'] ?></span>
            <span style="flex: 1; font-weight: 500;"><?= htmlspecialchars($menu['name']) ?></span>
            <span style="background: var(--pink-light); color: var(--rose); padding: 0.2rem 0.6rem; border-radius: 50px; font-size: 0.75rem;">Rank <?= $menu['rank'] ?></span>
            <span style="color: #27ae60; font-size: 0.8rem;">● Active</span>
        </div>
        <?php endforeach; ?>
    </div>

    <p style="color: var(--text-light); margin-top: 1.5rem; font-size: 0.85rem;">
        Full drag-and-drop reordering will be available in Phase 2.
    </p>
</div>

<?php
$adminContent = ob_get_clean();
require BASE_PATH . '/views/admin/layout.php';
?>
