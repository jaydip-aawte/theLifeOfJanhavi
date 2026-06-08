-- =============================================================
-- TheLifeOfJanhavi — Seed Data
-- Default admin: admin / admin123 (change immediately!)
-- =============================================================

USE `life_of_janhavi`;

-- Default admin (password: admin123, bcrypt hashed)
INSERT INTO `admins` (`username`, `password`, `display_name`) VALUES
('admin', '$2y$12$3LyRrlhbbb4NlAikDLkWQ.kZVVqAFr1cJ1cZHTP1aKDP//8JeXDPu', 'Jaydip')
ON DUPLICATE KEY UPDATE `username` = `username`;

-- Default menu items
INSERT INTO `menus` (`module_name`, `route`, `icon`, `rank`, `status`) VALUES
('Wish For Janhavi', '#wish', '🎁', 1, 1),
('Janhavi Sapkal', '#about', '👩', 2, 1),
('Janhavi Ek Chatpati Ladki', '#chatpati', '🌶️', 3, 1),
('Love Treasure', '#love', '💎', 4, 1),
('Fun Zone', '#fun', '🎮', 5, 1)
ON DUPLICATE KEY UPDATE `module_name` = VALUES(`module_name`);

-- Default landing page
INSERT INTO `landing_page` (`title`, `subtitle`, `hero_image`, `background_music`, `rank`, `status`) VALUES
('💓 TheLifeOfJanhavi 💓', 'A digital emotional scrapbook built with love', '/assets/images/hero-placeholder.svg', NULL, 1, 1)
ON DUPLICATE KEY UPDATE `title` = VALUES(`title`);

-- Default settings
INSERT INTO `settings` (`setting_key`, `setting_value`) VALUES
('site_name', '💓 TheLifeOfJanhavi 💓'),
('site_tagline', 'तू खूप खास आहेस 🌸'),
('landing_modal_enabled', '1'),
('music_enabled', '1'),
('maintenance_mode', '0')
ON DUPLICATE KEY UPDATE `setting_key` = `setting_key`;
