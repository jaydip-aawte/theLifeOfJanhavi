<?php
$appConfig = require BASE_PATH . '/config/app.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($pageTitle ?? 'Admin') ?> — Admin Panel</title>
    <!-- Bootstrap 5 (self-hosted, no CDN) -->
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/style.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/admin.css">
    <link rel="icon" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><text y='.9em' font-size='90'>💓</text></svg>">
</head>
<body>
    <!-- Mobile Toggle -->
    <button class="admin-toggle" id="sidebarToggle" onclick="toggleSidebar()">☰</button>

    <div class="admin-layout">
        <!-- Sidebar -->
        <aside class="admin-sidebar" id="adminSidebar">
            <div class="admin-sidebar-brand">
                <h2>💓 Admin</h2>
                <small>TheLifeOfJanhavi</small>
            </div>

            <ul class="admin-nav">
                <li class="admin-nav-item">
                    <a href="<?= BASE_URL ?>/admin/?page=dashboard" class="admin-nav-link <?= ($activePage ?? '') === 'dashboard' ? 'active' : '' ?>">
                        <span class="nav-icon">📊</span> Dashboard
                    </a>
                </li>

                <div class="admin-nav-divider"></div>

                <li class="admin-nav-item">
                    <a href="<?= BASE_URL ?>/admin/?page=landing" class="admin-nav-link <?= ($activePage ?? '') === 'landing' ? 'active' : '' ?>">
                        <span class="nav-icon">🏠</span> Landing Page
                    </a>
                </li>
                <li class="admin-nav-item">
                    <a href="<?= BASE_URL ?>/admin/?page=menus" class="admin-nav-link <?= ($activePage ?? '') === 'menus' ? 'active' : '' ?>">
                        <span class="nav-icon">📋</span> Menu Management
                    </a>
                </li>
                <li class="admin-nav-item">
                    <a href="<?= BASE_URL ?>/admin/?page=music" class="admin-nav-link <?= ($activePage ?? '') === 'music' ? 'active' : '' ?>">
                        <span class="nav-icon">🎵</span> Music Management
                    </a>
                </li>

                <li class="admin-nav-item">
                    <a href="<?= BASE_URL ?>/admin/?page=search" class="admin-nav-link <?= ($activePage ?? '') === 'search' ? 'active' : '' ?>">
                        <span class="nav-icon">🔍</span> Search
                    </a>
                </li>

                <div class="admin-nav-divider"></div>

                <li class="admin-nav-item">
                    <a href="<?= BASE_URL ?>/admin/?page=wish-photo" class="admin-nav-link <?= ($activePage ?? '') === 'wish-photo' ? 'active' : '' ?>">
                        <span class="nav-icon">🎁</span> Wish Photos
                    </a>
                </li>
                <li class="admin-nav-item">
                    <a href="<?= BASE_URL ?>/admin/?page=wish-video" class="admin-nav-link <?= ($activePage ?? '') === 'wish-video' ? 'active' : '' ?>">
                        <span class="nav-icon">🎬</span> Wish Videos
                    </a>
                </li>
                <li class="admin-nav-item">
                    <a href="<?= BASE_URL ?>/admin/?page=sapkal" class="admin-nav-link <?= ($activePage ?? '') === 'sapkal' ? 'active' : '' ?>">
                        <span class="nav-icon">👩</span> Janhavi Sapkal
                    </a>
                </li>
                <li class="admin-nav-item">
                    <a href="<?= BASE_URL ?>/admin/?page=jaydip" class="admin-nav-link <?= ($activePage ?? '') === 'jaydip' ? 'active' : '' ?>">
                        <span class="nav-icon">💕</span> Janhavi Jaydip
                    </a>
                </li>
                <li class="admin-nav-item">
                    <a href="<?= BASE_URL ?>/admin/?page=chatpati" class="admin-nav-link <?= ($activePage ?? '') === 'chatpati' ? 'active' : '' ?>">
                        <span class="nav-icon">🌶️</span> Chatpati Janhavi
                    </a>
                </li>
                <li class="admin-nav-item">
                    <a href="<?= BASE_URL ?>/admin/?page=letters" class="admin-nav-link <?= ($activePage ?? '') === 'letters' ? 'active' : '' ?>">
                        <span class="nav-icon">💌</span> Open When Letters
                    </a>
                </li>
                <li class="admin-nav-item">
                    <a href="<?= BASE_URL ?>/admin/?page=quotes" class="admin-nav-link <?= ($activePage ?? '') === 'quotes' ? 'active' : '' ?>">
                        <span class="nav-icon">💭</span> Emotional Quotes
                    </a>
                </li>
                <li class="admin-nav-item">
                    <a href="<?= BASE_URL ?>/admin/?page=import" class="admin-nav-link <?= ($activePage ?? '') === 'import' ? 'active' : '' ?>">
                        <span class="nav-icon">📥</span> Import Data
                    </a>
                </li>

                <div class="admin-nav-divider"></div>

                <li class="admin-nav-item">
                    <a href="#" class="admin-nav-link" style="opacity: 0.5; cursor: default;">
                        <span class="nav-icon">🎮</span> Fun Area
                        <span class="coming-soon-badge">Soon</span>
                    </a>
                </li>
                <li class="admin-nav-item">
                    <a href="#" class="admin-nav-link" style="opacity: 0.5; cursor: default;">
                        <span class="nav-icon">🧩</span> Quiz
                        <span class="coming-soon-badge">Soon</span>
                    </a>
                </li>
                <li class="admin-nav-item">
                    <a href="#" class="admin-nav-link" style="opacity: 0.5; cursor: default;">
                        <span class="nav-icon">💡</span> Suggestions
                        <span class="coming-soon-badge">Soon</span>
                    </a>
                </li>

                <div class="admin-nav-divider"></div>

                <li class="admin-nav-item">
                    <a href="<?= BASE_URL ?>/admin/?page=credentials" class="admin-nav-link <?= ($activePage ?? '') === 'credentials' ? 'active' : '' ?>">
                        <span class="nav-icon">🔑</span> Credentials
                    </a>
                </li>
                <li class="admin-nav-item">
                    <a href="<?= BASE_URL ?>/admin/?page=settings" class="admin-nav-link <?= ($activePage ?? '') === 'settings' ? 'active' : '' ?>">
                        <span class="nav-icon">⚙️</span> Settings
                    </a>
                </li>
                <li class="admin-nav-item">
                    <a href="<?= BASE_URL ?>/admin/?page=logout" class="admin-nav-link">
                        <span class="nav-icon">🚪</span> Logout
                    </a>
                </li>
            </ul>
        </aside>

        <!-- Main Content -->
        <main class="admin-main">
            <div class="admin-header">
                <h1><?= htmlspecialchars($pageTitle ?? 'Admin') ?></h1>
                <div class="admin-user-info">
                    <span>👤 <?= htmlspecialchars($_SESSION['admin_username'] ?? 'Admin') ?></span>
                </div>
            </div>

            <!-- Page Content (injected by child views) -->
            <?= $adminContent ?? '' ?>
        </main>
    </div>

    <!-- Bootstrap 5 bundle (self-hosted) -->
    <script src="<?= BASE_URL ?>/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script>
        function toggleSidebar() {
            document.getElementById('adminSidebar').classList.toggle('open');
        }

        // Close sidebar on outside click (mobile)
        document.addEventListener('click', function(e) {
            const sidebar = document.getElementById('adminSidebar');
            const toggle = document.getElementById('sidebarToggle');
            if (window.innerWidth <= 768 && sidebar.classList.contains('open')) {
                if (!sidebar.contains(e.target) && !toggle.contains(e.target)) {
                    sidebar.classList.remove('open');
                }
            }
        });
    </script>
</body>
</html>
