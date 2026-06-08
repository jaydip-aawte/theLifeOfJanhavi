<?php
ob_start();
$isEdit = !empty($record);
$formAction = $isEdit
    ? BASE_URL . '/admin/?page=' . $pageSlug . '&action=update'
    : BASE_URL . '/admin/?page=' . $pageSlug . '&action=store';
?>

<div class="content-form-header">
    <a href="<?= BASE_URL ?>/admin/?page=<?= $pageSlug ?>" class="btn-outline">← Back to List</a>
</div>

<div class="content-form-card">
    <form method="post" action="<?= $formAction ?>" enctype="multipart/form-data">
        <?= $csrfField ?>
        <?php if ($isEdit): ?>
        <input type="hidden" name="id" value="<?= (int)$record['id'] ?>">
        <?php endif; ?>

        <?php foreach ($fields as $f):
            $name = $f['name'];
            $label = $f['label'];
            $type = $f['type'] ?? 'text';
            $required = !empty($f['required']);
            $value = $isEdit ? ($record[$name] ?? '') : '';
        ?>
        <div class="form-group">
            <label for="field_<?= $name ?>"><?= htmlspecialchars($label) ?> <?= $required ? '<span class="required">*</span>' : '' ?></label>

            <?php if ($type === 'textarea'): ?>
                <textarea id="field_<?= $name ?>" name="<?= $name ?>" class="form-control" rows="4" <?= $required ? 'required' : '' ?>><?= htmlspecialchars($value) ?></textarea>

            <?php elseif ($type === 'select'): ?>
                <select id="field_<?= $name ?>" name="<?= $name ?>" class="form-control" <?= $required ? 'required' : '' ?>>
                    <option value="">— Select —</option>
                    <?php foreach (($f['options'] ?? []) as $optVal => $optLabel): ?>
                    <option value="<?= htmlspecialchars($optVal) ?>" <?= $value === $optVal ? 'selected' : '' ?>><?= htmlspecialchars($optLabel) ?></option>
                    <?php endforeach; ?>
                </select>

            <?php elseif ($type === 'date'): ?>
                <input type="date" id="field_<?= $name ?>" name="<?= $name ?>" class="form-control" value="<?= htmlspecialchars($value) ?>" <?= $required ? 'required' : '' ?>>

            <?php elseif ($type === 'file'): ?>
                <?php if ($isEdit && !empty($value)): ?>
                <div class="current-file">
                    <img src="<?= htmlspecialchars($value) ?>" alt="" class="preview-img" loading="lazy">
                    <small>Current file — upload a new one to replace.</small>
                </div>
                <?php endif; ?>
                <input type="file" id="field_<?= $name ?>" name="<?= $name ?>" class="form-control" accept="image/jpeg,image/png,image/webp">

            <?php else: ?>
                <input type="text" id="field_<?= $name ?>" name="<?= $name ?>" class="form-control" value="<?= htmlspecialchars($value) ?>" <?= $required ? 'required' : '' ?>>
            <?php endif; ?>
        </div>
        <?php endforeach; ?>

        <div class="form-actions">
            <button type="submit" class="btn-primary"><?= $isEdit ? '💾 Update' : '✨ Create' ?></button>
            <a href="<?= BASE_URL ?>/admin/?page=<?= $pageSlug ?>" class="btn-outline">Cancel</a>
        </div>
    </form>
</div>

<?php
$adminContent = ob_get_clean();
require BASE_PATH . '/views/admin/layout.php';
?>
