-- =============================================================
-- TheLifeOfJanhavi — Phase 2 Database Schema
-- Charset: utf8mb4 | Collation: utf8mb4_unicode_ci
-- =============================================================

USE `life_of_janhavi`;

-- -----------------------------------------------------------
-- Wish Photo Wall
-- -----------------------------------------------------------
CREATE TABLE IF NOT EXISTS `wish_photo` (
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(255) NOT NULL,
    `wish_text` TEXT DEFAULT NULL,
    `photo_path` VARCHAR(500) DEFAULT NULL,
    `rank` INT UNSIGNED NOT NULL DEFAULT 0,
    `status` TINYINT(1) NOT NULL DEFAULT 1,
    `deleted_at` TIMESTAMP NULL DEFAULT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX `idx_status_rank` (`status`, `rank`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -----------------------------------------------------------
-- Wish Video Wall
-- -----------------------------------------------------------
CREATE TABLE IF NOT EXISTS `wish_video` (
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(255) NOT NULL,
    `wish_text` TEXT DEFAULT NULL,
    `youtube_url` VARCHAR(500) DEFAULT NULL,
    `youtube_embed_url` VARCHAR(500) DEFAULT NULL,
    `rank` INT UNSIGNED NOT NULL DEFAULT 0,
    `status` TINYINT(1) NOT NULL DEFAULT 1,
    `deleted_at` TIMESTAMP NULL DEFAULT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX `idx_status_rank` (`status`, `rank`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -----------------------------------------------------------
-- Janhavi Sapkal (Proud Of You)
-- -----------------------------------------------------------
CREATE TABLE IF NOT EXISTS `janhavi_sapkal` (
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `title` VARCHAR(500) NOT NULL,
    `subtitle` VARCHAR(500) DEFAULT NULL,
    `description` TEXT DEFAULT NULL,
    `image_path` VARCHAR(500) DEFAULT NULL,
    `icon` VARCHAR(50) DEFAULT '🌟',
    `rank` INT UNSIGNED NOT NULL DEFAULT 0,
    `status` TINYINT(1) NOT NULL DEFAULT 1,
    `deleted_at` TIMESTAMP NULL DEFAULT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX `idx_status_rank` (`status`, `rank`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -----------------------------------------------------------
-- Janhavi Jaydip (Relationship Content)
-- -----------------------------------------------------------
CREATE TABLE IF NOT EXISTS `janhavi_jaydip` (
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `title` VARCHAR(500) NOT NULL,
    `subtitle` VARCHAR(500) DEFAULT NULL,
    `description` TEXT DEFAULT NULL,
    `image_path` VARCHAR(500) DEFAULT NULL,
    `youtube_embed_url` VARCHAR(500) DEFAULT NULL,
    `content_type` VARCHAR(50) NOT NULL DEFAULT 'photo',
    `rank` INT UNSIGNED NOT NULL DEFAULT 0,
    `status` TINYINT(1) NOT NULL DEFAULT 1,
    `deleted_at` TIMESTAMP NULL DEFAULT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX `idx_status_rank` (`status`, `rank`),
    INDEX `idx_content_type` (`content_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -----------------------------------------------------------
-- Chatpati Janhavi (Funny Side)
-- -----------------------------------------------------------
CREATE TABLE IF NOT EXISTS `chatpati_janhavi` (
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `title` VARCHAR(500) NOT NULL,
    `description` TEXT DEFAULT NULL,
    `image_path` VARCHAR(500) DEFAULT NULL,
    `meme_text` VARCHAR(500) DEFAULT NULL,
    `rank` INT UNSIGNED NOT NULL DEFAULT 0,
    `status` TINYINT(1) NOT NULL DEFAULT 1,
    `deleted_at` TIMESTAMP NULL DEFAULT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX `idx_status_rank` (`status`, `rank`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -----------------------------------------------------------
-- Import Log (framework for future Excel import)
-- -----------------------------------------------------------
CREATE TABLE IF NOT EXISTS `import_log` (
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `module_name` VARCHAR(255) NOT NULL,
    `file_name` VARCHAR(500) NOT NULL,
    `records_imported` INT UNSIGNED NOT NULL DEFAULT 0,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
