-- =============================================================
-- TheLifeOfJanhavi — Phase 3 Seed Data
-- Marathi + emoji content for envelopes, quotes, decorations.
-- Charset: utf8mb4 | Collation: utf8mb4_unicode_ci
-- =============================================================

USE `life_of_janhavi`;

-- -----------------------------------------------------------
-- Open When Letters
-- -----------------------------------------------------------
INSERT INTO `open_when_letters` (`title`, `category`, `letter_content`, `envelope_color`, `rank`, `status`) VALUES
('Open When You Are Sad', 'sad',
 'जाह्नवी, जर तू हे वाचत असशील तर थोडा वेळ थांब आणि एक मोठा श्वास घे. 🌸\n\nVaait divas kaymacha nasto. तू खूप strong आहेस आणि हे पण निघून जाईल. Remember how far you have come. 💗\n\nतुझ्या smile ची किंमत संपूर्ण जगाला आहे. So please, smile again. 🥹', 'lavender', 1, 1),
('Open When You Are Angry', 'angry',
 'अरे रागावलीस का? 😤\n\nThoda paani pi, ek deep breath ghe. राग येणं normal आहे, पण तो तुला हरवू देऊ नकोस. 🌷\n\nYou are too precious to stay upset. आता एक छानशी smile दे बघू. 😉❤️', 'peach', 2, 1),
('Open When You Are Happy', 'happy',
 'Yesss! आज तू खुश आहेस! 🎉\n\nहा क्षण साठवून ठेव, कारण तुझ्या happiness ने आजूबाजूचं सगळं उजळून जातं. ✨\n\nKeep shining, keep laughing. तू अशीच हसत रहा. 🌻💛', 'pink', 3, 1),
('Open When You Miss Me', 'missing_me',
 'मला माहित आहे तू मला miss करतेयस. 🥺\n\nDolе band kar aani athav — आपले सगळे क्षण, ती हसी, ते भांडण, सगळं. मी नेहमी तुझ्यासोबत आहे. 💞\n\nDistance is just a number. तू माझ्या प्रत्येक विचारात असतेस. ❤️', 'rose', 4, 1);

-- -----------------------------------------------------------
-- Emotional Quotes (English + Marathi)
-- -----------------------------------------------------------
INSERT INTO `emotional_quotes` (`quote_text`, `author_text`, `rank`, `status`) VALUES
('तू जशी आहेस तशीच परिपूर्ण आहेस. 🌸', 'With love', 1, 1),
('You are someone''s reason to smile today. 💗', 'Always', 2, 1),
('स्वप्नं बघत रहा, ती नक्की पूर्ण होतील. ✨', 'Believe', 3, 1),
('Be soft. Do not let the world make you hard. 🌷', 'Remember', 4, 1),
('तुझं हसू हीच सगळ्यात सुंदर गोष्ट आहे. 😊', 'Forever', 5, 1),
('You are braver than you believe, stronger than you seem. 🦋', 'Truly', 6, 1);

-- -----------------------------------------------------------
-- Decoration toggles (Module 9) — admin can enable/disable
-- -----------------------------------------------------------
INSERT INTO `settings` (`setting_key`, `setting_value`, `created_at`, `updated_at`) VALUES
('decor_hearts', '1', NOW(), NOW()),
('decor_flowers', '1', NOW(), NOW()),
('decor_sparkles', '1', NOW(), NOW()),
('decor_stars', '0', NOW(), NOW())
ON DUPLICATE KEY UPDATE `setting_value` = VALUES(`setting_value`);

-- -----------------------------------------------------------
-- Repoint "Love Treasure" nav card to the new locked page.
-- (Phase 2 pointed it at /janhavi-jaydip; Phase 3 splits them:
--  /love-treasure = locked chest, /janhavi-jaydip = missing-me letters)
-- -----------------------------------------------------------
UPDATE `menus` SET `route` = '/love-treasure'
    WHERE `route` IN ('/janhavi-jaydip', 'janhavi-jaydip') AND `module_name` LIKE '%Treasure%';
