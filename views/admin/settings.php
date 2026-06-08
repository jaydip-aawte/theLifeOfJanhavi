<?php
ob_start();
$labels = [
    'decor_hearts'   => ['💗 Floating Hearts', 'Gentle hearts drifting up the page'],
    'decor_flowers'  => ['🌸 Floating Flowers', 'Soft flowers floating across pages'],
    'decor_sparkles' => ['✨ Sparkles', 'Subtle sparkles for a magical touch'],
    'decor_stars'    => ['⭐ Stars', 'Twinkling stars drifting upward'],
];
?>

<div class="content-card">
    <h3 style="margin-bottom: 0.4rem;">⚙️ Settings</h3>
    <p style="color: var(--text-medium); margin-bottom: 1.5rem;">
        Decoration system — enable or disable the floating scrapbook decorations shown across the public site.
    </p>

    <?php if (!empty($flash)): ?>
    <div class="alert alert-success" role="alert"><?= htmlspecialchars($flash) ?></div>
    <?php endif; ?>

    <form method="post" action="<?= BASE_URL ?>/admin/?page=settings">
        <?= $csrfField ?>
        <div class="row g-3">
            <?php foreach ($labels as $key => $info): ?>
            <div class="col-12 col-md-6">
                <div class="form-check form-switch p-3" style="background: var(--cream); border-radius: 12px;">
                    <input class="form-check-input" type="checkbox" role="switch"
                           id="<?= $key ?>" name="<?= $key ?>" <?= !empty($decor[$key]) ? 'checked' : '' ?>>
                    <label class="form-check-label" for="<?= $key ?>" style="margin-left: 0.5rem;">
                        <strong><?= $info[0] ?></strong><br>
                        <small style="color: var(--text-light);"><?= $info[1] ?></small>
                    </label>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <button type="submit" class="btn btn-primary mt-3">💾 Save Decorations</button>
    </form>
</div>

<?php
$adminContent = ob_get_clean();
require BASE_PATH . '/views/admin/layout.php';
?>
