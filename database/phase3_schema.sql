-- =============================================================
-- TheLifeOfJanhavi — Phase 3 Database Schema
-- Emotional scrapbook: Open When Letters + Emotional Quotes
-- Charset: utf8mb4 | Collation: utf8mb4_unicode_ci
-- =============================================================

USE `life_of_janhavi`;

-- -----------------------------------------------------------
-- Open When Letters (envelope system)
-- Categories: sad | angry | happy | missing_me
-- -----------------------------------------------------------
CREATE TABLE IF NOT EXISTS `open_when_letters` (
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `title` VARCHAR(255) NOT NULL,
    `category` VARCHAR(50) NOT NULL DEFAULT 'happy',
    `letter_content` TEXT DEFAULT NULL,
    `envelope_color` VARCHAR(20) DEFAULT 'pink',
    `rank` INT UNSIGNED NOT NULL DEFAULT 0,
    `status` TINYINT(1) NOT NULL DEFAULT 1,
    `deleted_at` TIMESTAMP NULL DEFAULT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX `idx_status_rank` (`status`, `rank`),
    INDEX `idx_category` (`category`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -----------------------------------------------------------
-- Emotional Quotes (random rotating quotes across pages)
-- -----------------------------------------------------------
CREATE TABLE IF NOT EXISTS `emotional_quotes` (
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `quote_text` TEXT NOT NULL,
    `author_text` VARCHAR(255) DEFAULT NULL,
    `rank` INT UNSIGNED NOT NULL DEFAULT 0,
    `status` TINYINT(1) NOT NULL DEFAULT 1,
    `deleted_at` TIMESTAMP NULL DEFAULT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX `idx_status_rank` (`status`, `rank`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -----------------------------------------------------------
-- Add `wish_date` to wish_photo (shown on polaroid cards)
-- Guarded so re-running is safe on MySQL 8 (IF NOT EXISTS).
-- -----------------------------------------------------------
ALTER TABLE `wish_photo`
    ADD COLUMN IF NOT EXISTS `wish_date` DATE NULL DEFAULT NULL AFTER `wish_text`;
