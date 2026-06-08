<?php
ob_start();
$flashError = $_SESSION['flash_error'] ?? '';
$flashSuccess = $_SESSION['flash_success'] ?? '';
unset($_SESSION['flash_error'], $_SESSION['flash_success']);
?>

<?php if ($flashError): ?>
<div class="alert-error"><?= htmlspecialchars($flashError) ?></div>
<?php endif; ?>
<?php if ($flashSuccess): ?>
<div class="alert-success"><?= htmlspecialchars($flashSuccess) ?></div>
<?php endif; ?>

<div class="content-header">
    <a href="<?= BASE_URL ?>/admin/?page=<?= $pageSlug ?>&action=create" class="btn-primary">+ Add New</a>
</div>

<?php if (!empty($records)): ?>
<form method="post" action="<?= BASE_URL ?>/admin/?page=<?= $pageSlug ?>&action=bulk" class="bulk-form">
    <?= $csrfField ?>
    <div class="bulk-bar">
        <select name="bulk_action" class="form-control bulk-select">
            <option value="">Bulk Actions</option>
            <option value="activate">Activate</option>
            <option value="deactivate">Deactivate</option>
            <option value="delete">Delete</option>
        </select>
        <button type="submit" class="btn-sm btn-outline" onclick="return confirm('Apply bulk action?')">Apply</button>
        <label class="select-all-label"><input type="checkbox" id="selectAll"> Select All</label>
    </div>

    <div class="content-table-wrap">
        <table class="content-table">
            <thead>
                <tr>
                    <th style="width:40px;"><input type="checkbox" id="selectAllHead"></th>
                    <th style="width:60px;">Rank</th>
                    <?php foreach ($fields as $f): ?>
                        <?php if (($f['type'] ?? 'text') !== 'file'): ?>
                        <th><?= htmlspecialchars($f['label']) ?></th>
                        <?php endif; ?>
                    <?php endforeach; ?>
                    <?php if ($uploadField): ?>
                    <th>Image</th>
                    <?php endif; ?>
                    <th>Status</th>
                    <th style="width:200px;">Actions</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($records as $row): ?>
                <tr class="<?= !empty($row['deleted_at']) ? 'row-deleted' : '' ?>">
                    <td><input type="checkbox" name="selected[]" value="<?= $row['id'] ?>" class="row-check"></td>
                    <td>
                        <span class="rank-badge"><?= (int)$row['rank'] ?></span>
                        <?php if (empty($row['deleted_at'])): ?>
                        <div class="rank-btns">
                            <a href="<?= BASE_URL ?>/admin/?page=<?= $pageSlug ?>&action=moveup&id=<?= $row['id'] ?>" title="Move Up" class="rank-btn">▲</a>
                            <a href="<?= BASE_URL ?>/admin/?page=<?= $pageSlug ?>&action=movedown&id=<?= $row['id'] ?>" title="Move Down" class="rank-btn">▼</a>
                        </div>
                        <?php endif; ?>
                    </td>
                    <?php foreach ($fields as $f): ?>
                        <?php if (($f['type'] ?? 'text') === 'file') continue; ?>
                        <td>
                            <?php
                            $val = $row[$f['name']] ?? '';
                            if (($f['type'] ?? 'text') === 'textarea') {
                                echo htmlspecialchars(mb_strimwidth($val, 0, 80, '…'));
                            } else {
                                echo htmlspecialchars(mb_strimwidth($val, 0, 50, '…'));
                            }
                            ?>
                        </td>
                    <?php endforeach; ?>
                    <?php if ($uploadField): ?>
                    <td>
                        <?php if (!empty($row[$uploadField])): ?>
                        <img src="<?= htmlspecialchars($row[$uploadField]) ?>" alt="" class="thumb-img" loading="lazy">
                        <?php else: ?>
                        <span class="no-image">—</span>
                        <?php endif; ?>
                    </td>
                    <?php endif; ?>
                    <td>
                        <?php if (empty($row['deleted_at'])): ?>
                            <a href="<?= BASE_URL ?>/admin/?page=<?= $pageSlug ?>&action=toggle&id=<?= $row['id'] ?>"
                               class="status-badge <?= $row['status'] ? 'active' : 'inactive' ?>">
                                <?= $row['status'] ? 'Active' : 'Inactive' ?>
                            </a>
                        <?php else: ?>
                            <span class="status-badge deleted">Deleted</span>
                        <?php endif; ?>
                    </td>
                    <td class="actions-cell">
                        <?php if (empty($row['deleted_at'])): ?>
                        <a href="<?= BASE_URL ?>/admin/?page=<?= $pageSlug ?>&action=edit&id=<?= $row['id'] ?>" class="btn-sm btn-edit">Edit</a>
                        <a href="<?= BASE_URL ?>/admin/?page=<?= $pageSlug ?>&action=delete&id=<?= $row['id'] ?>" class="btn-sm btn-delete" onclick="return confirm('Delete this record?')">Delete</a>
                        <?php else: ?>
                        <a href="<?= BASE_URL ?>/admin/?page=<?= $pageSlug ?>&action=restore&id=<?= $row['id'] ?>" class="btn-sm btn-restore">Restore</a>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</form>
<?php else: ?>
<div class="empty-state">
    <div class="empty-icon"><?= $pageIcon ?></div>
    <p>No records yet. <a href="<?= BASE_URL ?>/admin/?page=<?= $pageSlug ?>&action=create">Create the first one!</a></p>
</div>
<?php endif; ?>

<script>
document.querySelectorAll('#selectAll, #selectAllHead').forEach(function(el) {
    el.addEventListener('change', function() {
        document.querySelectorAll('.row-check').forEach(function(cb) { cb.checked = el.checked; });
        document.querySelectorAll('#selectAll, #selectAllHead').forEach(function(o) { o.checked = el.checked; });
    });
});
</script>

<?php
$adminContent = ob_get_clean();
require BASE_PATH . '/views/admin/layout.php';
?>
