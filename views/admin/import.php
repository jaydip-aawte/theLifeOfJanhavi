<?php
ob_start();
?>

<?php if ($error): ?>
<div class="alert-error"><?= htmlspecialchars($error) ?></div>
<?php endif; ?>
<?php if ($message): ?>
<div class="alert-success"><?= htmlspecialchars($message) ?></div>
<?php endif; ?>

<div class="skeleton-section">
    <h3>📥 Import Data</h3>
    <p style="color: var(--text-medium); margin-bottom: 1.5rem;">
        Upload a CSV or Excel file to import data into a module. Full parsing will be available in a future phase — for now, the framework logs the upload.
    </p>

    <form method="post" action="<?= BASE_URL ?>/admin/?page=import" enctype="multipart/form-data" class="import-form">
        <?= $csrfField ?>
        <div class="form-group">
            <label>Target Module</label>
            <select name="module_name" class="form-control" required>
                <option value="">— Select Module —</option>
                <option value="wish_photo">Wish Photos</option>
                <option value="wish_video">Wish Videos</option>
                <option value="janhavi_sapkal">Janhavi Sapkal</option>
                <option value="janhavi_jaydip">Janhavi Jaydip</option>
                <option value="chatpati_janhavi">Chatpati Janhavi</option>
            </select>
        </div>
        <div class="form-group">
            <label>File (CSV, XLSX, XLS)</label>
            <input type="file" name="import_file" class="form-control" accept=".csv,.xlsx,.xls" required>
        </div>
        <button type="submit" class="btn-primary">📥 Upload</button>
    </form>
</div>

<?php if (!empty($logs)): ?>
<div class="skeleton-section" style="margin-top: 2rem;">
    <h3>📋 Import History</h3>
    <div class="content-table-wrap">
        <table class="content-table">
            <thead>
                <tr>
                    <th>Module</th>
                    <th>File</th>
                    <th>Records Imported</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($logs as $log): ?>
                <tr>
                    <td><?= htmlspecialchars($log['module_name']) ?></td>
                    <td><?= htmlspecialchars($log['file_name']) ?></td>
                    <td><?= (int)$log['records_imported'] ?></td>
                    <td><?= htmlspecialchars($log['created_at']) ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<?php endif; ?>

<?php
$adminContent = ob_get_clean();
require BASE_PATH . '/views/admin/layout.php';
?>
