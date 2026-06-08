<?php require BASE_PATH . '/views/layouts/header.php'; ?>

    <!-- Floating Hearts Background -->
    <div class="floating-hearts" id="floatingHearts"></div>

    <!-- Landing Modal (first visit) -->
    <div class="landing-modal-overlay" id="landingModal">
        <div class="landing-modal">
            <h2>Hey Janhavi ❤️</h2>
            <p>This is not just a website.</p>
            <p>
                This is a small world built from memories,<br>
                laughter, dreams and countless emotions.
            </p>
            <p style="margin-top: 1rem;">
                Today is about <span class="emphasis">you</span>.
            </p>
            <p class="emphasis">Only you.</p>
            <p style="margin-top: 1rem;">So before we begin...</p>
            <p class="marathi" style="font-size: 1.1rem; margin-top: 0.5rem;">
                तुझ्यासाठी एक स्माईल घेऊन चल 🌸
            </p>
            <button class="landing-modal-btn" id="beginJourney" onclick="closeLandingModal()">
                ✨ Let's Begin The Journey ✨
            </button>
        </div>
    </div>

    <!-- Hero Section -->
    <section class="hero">
        <div class="container">
            <!-- Decorative Stickers -->
            <span class="sticker" style="top: 10%; left: 5%; animation-delay: 0s;">🌸</span>
            <span class="sticker" style="top: 5%; right: 8%; animation-delay: 1s;">🦋</span>
            <span class="sticker" style="bottom: 10%; left: 10%; animation-delay: 2s;">✨</span>
            <span class="sticker" style="bottom: 5%; right: 5%; animation-delay: 0.5s;">🌷</span>

            <div class="hero-image-wrapper">
                <img
                    src="<?= htmlspecialchars($heroImage) ?>"
                    alt="Janhavi"
                    class="lazy-image"
                    data-src="<?= htmlspecialchars($heroImage) ?>"
                    onerror="this.src='data:image/svg+xml,<svg xmlns=\'http://www.w3.org/2000/svg\' viewBox=\'0 0 280 280\'><rect fill=\'%23F9B7D1\' width=\'280\' height=\'280\'/><text x=\'50%25\' y=\'50%25\' font-size=\'80\' text-anchor=\'middle\' dy=\'.35em\'>👩</text></svg>'"
                >
            </div>

            <h1 class="hero-title">💓 TheLifeOfJanhavi 💓</h1>
            <p class="hero-subtitle marathi">जाह्नवी ❤️ तू खूप खास आहेस 🌸</p>
        </div>
    </section>

    <!-- Navigation Cards Section -->
    <section class="section">
        <div class="container">
            <h2 class="section-title">Explore Her World ✨</h2>

            <div class="nav-cards">
                <?php foreach ($menus as $index => $menu): ?>
                <a href="<?= htmlspecialchars($menu['route']) ?>" class="nav-card" style="animation-delay: <?= $index * 0.1 ?>s;">
                    <span class="nav-card-rank"><?= (int)($menu['rank'] ?? $index + 1) ?></span>
                    <span class="nav-card-icon"><?= $menu['icon'] ?? '📌' ?></span>
                    <h3 class="nav-card-title"><?= htmlspecialchars($menu['module_name']) ?></h3>
                </a>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Music Player (if music available) -->
    <?php if ($bgMusic): ?>
    <audio id="bgMusic" preload="none">
        <source src="<?= htmlspecialchars($bgMusic) ?>" type="audio/mpeg">
    </audio>
    <?php endif; ?>

    <button class="music-btn" id="musicBtn" title="Play / Pause Music" <?= $bgMusic ? '' : 'style="display:none;"' ?>>
        <span class="icon-play">🎵</span>
        <span class="icon-pause">⏸️</span>
    </button>

<?php require BASE_PATH . '/views/layouts/footer.php'; ?>
