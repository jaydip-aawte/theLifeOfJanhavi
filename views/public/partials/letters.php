<?php
/**
 * Reusable Open When Letters section.
 * Expects: $letters (array), $lettersHeading (string, optional)
 * Renders envelope cards + the shared letter overlay (once).
 */
$letters = $letters ?? [];
$lettersHeading = $lettersHeading ?? 'Open When Letters 💌';
$catLabels = [
    'sad'        => 'Open When Sad',
    'angry'      => 'Open When Angry',
    'happy'      => 'Open When Happy',
    'missing_me' => 'Open When Missing Me',
];
$catEmoji = ['sad' => '😢', 'angry' => '😤', 'happy' => '😄', 'missing_me' => '🥺'];
if (!empty($letters)):
?>
<section class="letters-section">
    <h2 class="letters-heading"><?= htmlspecialchars($lettersHeading) ?></h2>
    <div class="row g-4 justify-content-center">
        <?php foreach ($letters as $i => $letter):
            $cat = $letter['category'] ?? 'happy';
            $label = $catLabels[$cat] ?? $letter['title'];
            $color = $letter['envelope_color'] ?? 'pink';
        ?>
        <div class="col-12 col-sm-6 col-lg-4">
            <div class="envelope color-<?= htmlspecialchars($color) ?> reveal reveal-pop" data-delay="<?= ($i % 3) + 1 ?>"
                 data-title="<?= htmlspecialchars($letter['title']) ?>"
                 data-content="<?= htmlspecialchars($letter['letter_content'] ?? '') ?>"
                 role="button" tabindex="0">
                <div class="envelope-flap"></div>
                <div class="envelope-seal"><?= $catEmoji[$cat] ?? '💌' ?></div>
                <div class="envelope-body">
                    <span class="envelope-label"><?= htmlspecialchars($label) ?></span>
                </div>
            </div>
            <p class="envelope-hint">tap to open 💌</p>
        </div>
        <?php endforeach; ?>
    </div>
</section>

<!-- Shared letter overlay -->
<div class="letter-overlay" id="letterOverlay">
    <div class="letter-paper">
        <button type="button" class="letter-close" title="Close">✕</button>
        <h3 class="letter-title"></h3>
        <div class="letter-content"></div>
    </div>
</div>
<?php endif; ?>
