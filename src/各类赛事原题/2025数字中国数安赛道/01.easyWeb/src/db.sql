DROP DATABASE IF EXISTS `ctf`;
CREATE DATABASE IF NOT EXISTS ctf CHARACTER SET utf8mb4;
USE ctf;

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for ocr_records
-- ----------------------------
DROP TABLE IF EXISTS `ocr_records`;
CREATE TABLE `ocr_records` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `ip_address` VARCHAR(255) NOT NULL,
    `timestamp` DATETIME NOT NULL,
    `recognized_text` TEXT NOT NULL
) ENGINE = MyISAM CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for flag
-- ----------------------------
DROP TABLE IF EXISTS `flag`;
CREATE TABLE `flag` (
    `flag` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL
) ENGINE = MyISAM CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of flag
-- ----------------------------
INSERT INTO `flag` VALUES ('flag{********************************}');


-- 设置 root 用户密码
ALTER USER 'root'@'localhost' IDENTIFIED BY 'root';  -- 设置 root 密码
FLUSH PRIVILEGES;