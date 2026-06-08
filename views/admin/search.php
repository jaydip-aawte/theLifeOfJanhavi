<?php
ob_start();
?>

<div class="search-section">
    <form method="get" action="<?= BASE_URL ?>/admin/?page=search" class="search-form">
        <input type="hidden" name="page" value="search">
        <input type="text" name="q" value="<?= htmlspecialchars($q) ?>" class="form-control search-input" placeholder="Search across all modules (English, Marathi, Emoji)...">
        <button type="submit" class="btn-primary">🔍 Search</button>
    </form>
</div>

<?php if ($q !== ''): ?>
    <?php if (empty($results)): ?>
    <div class="empty-state">
        <div class="empty-icon">🔍</div>
        <p>No results found for "<strong><?= htmlspecialchars($q) ?></strong>"</p>
    </div>
    <?php else: ?>
        <?php foreach ($results as $group): ?>
        <div class="search-group">
            <h3><?= $group['icon'] ?> <?= htmlspecialchars($group['label']) ?> (<?= count($group['records']) ?>)</h3>
            <div class="search-results">
                <?php foreach ($group['records'] as $row): ?>
                <div class="search-result-card">
                    <div class="search-result-body">
                        <?php
                        $title = $row['title'] ?? $row['name'] ?? $row['quote_text'] ?? '—';
                        $desc = $row['description'] ?? $row['wish_text'] ?? $row['meme_text'] ?? $row['letter_content'] ?? $row['author_text'] ?? '';
                        ?>
                        <strong><?= htmlspecialchars($title) ?></strong>
                        <?php if ($desc): ?>
                        <p><?= htmlspecialchars(mb_strimwidth($desc, 0, 120, '…')) ?></p>
                        <?php endif; ?>
                    </div>
                    <a href="<?= BASE_URL ?>/admin/?page=<?= $group['page'] ?>&action=edit&id=<?= $row['id'] ?>" class="btn-sm btn-edit">Edit</a>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endforeach; ?>
    <?php endif; ?>
<?php endif; ?>

<?php
$adminContent = ob_get_clean();
require BASE_PATH . '/views/admin/layout.php';
?>
