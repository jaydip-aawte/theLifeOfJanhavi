-- =============================================================
-- TheLifeOfJanhavi — Phase 2 Seed Data
-- =============================================================

USE `life_of_janhavi`;

-- Update menu routes to real public pages
UPDATE `menus` SET `route` = '/wish-photo' WHERE `module_name` = 'Wish For Janhavi';
UPDATE `menus` SET `route` = '/janhavi-sapkal' WHERE `module_name` = 'Janhavi Sapkal';
UPDATE `menus` SET `route` = '/chatpati-janhavi' WHERE `module_name` = 'Janhavi Ek Chatpati Ladki';
UPDATE `menus` SET `route` = '/janhavi-jaydip' WHERE `module_name` = 'Love Treasure';
UPDATE `menus` SET `route` = '/wish-video' WHERE `module_name` = 'Fun Zone';

-- Sample wish photos
INSERT INTO `wish_photo` (`name`, `wish_text`, `photo_path`, `rank`, `status`) VALUES
('Priya', 'Happy Birthday Janhavi! तू खूप खास आहेस 🎂', NULL, 1, 1),
('Sneha', 'Wishing you all the happiness in the world! 🌟', NULL, 2, 1),
('Rohit', 'Best wishes Janhavi! Keep shining ✨', NULL, 3, 1);

-- Sample wish videos
INSERT INTO `wish_video` (`name`, `wish_text`, `youtube_url`, `youtube_embed_url`, `rank`, `status`) VALUES
('Amit', 'A special video wish for you! 🎬', 'https://www.youtube.com/watch?v=dQw4w9WgXcQ', 'https://www.youtube.com/embed/dQw4w9WgXcQ', 1, 1);

-- Sample Janhavi Sapkal
INSERT INTO `janhavi_sapkal` (`title`, `subtitle`, `description`, `icon`, `rank`, `status`) VALUES
('The Girl Who Never Gave Up', 'Strength & Determination', 'Janhavi has always faced challenges with a smile. हार मानणं तिच्या शब्दकोशात नाही. 💪', '💪', 1, 1),
('Dream Chaser', 'Following Her Dreams', 'From dreams to reality — she makes it happen. स्वप्न पाहते आणि पूर्ण करते! ✨', '✨', 2, 1),
('PR Rockstar', 'Professional Excellence', 'A true rockstar in her professional life. 🌟', '🌟', 3, 1);

-- Sample Janhavi Jaydip
INSERT INTO `janhavi_jaydip` (`title`, `subtitle`, `description`, `content_type`, `rank`, `status`) VALUES
('Our Story Begins', 'The First Chapter', 'Where it all started... एक सुंदर सुरुवात 💕', 'story', 1, 1);

-- Sample Chatpati Janhavi
INSERT INTO `chatpati_janhavi` (`title`, `description`, `meme_text`, `rank`, `status`) VALUES
('Drama Queen Meter', 'When drama is an art form 🎭', 'Level: Expert 💯', 1, 1),
('Food Lover', 'Never come between Janhavi and food! 🍕', 'खाण्याशिवाय जगणं अशक्य! 😋', 2, 1),
('Sleep Champion', 'Professional sleeper since forever 😴', 'झोप हेच खरं सुख 💤', 3, 1);
