
DROP DATABASE IF EXISTS `ctf`;
CREATE DATABASE IF NOT EXISTS ctf CHARACTER SET utf8mb4;
USE ctf;

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
                      `id` int(11) NOT NULL AUTO_INCREMENT,
                      `username` varchar(255) NOT NULL,
                      `password` varchar(255) NOT NULL,
                      `isadmin` int(10) NOT NULL,
                      PRIMARY KEY (`id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of user
-- ----------------------------
BEGIN;
INSERT INTO `user` (`id`, `username`, `password`, `isadmin`) VALUES (1, 'adm1n', 'Str0ngP4ssw0rd', 1);
COMMIT;

-- ----------------------------
-- Table structure for userinfo
-- ----------------------------
DROP TABLE IF EXISTS `userinfo`;
CREATE TABLE `userinfo` (
                          `id` int(11) NOT NULL,
                          `username` varchar(255) DEFAULT NULL,
                          `address` varchar(255) DEFAULT NULL,
                          PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of userinfo
-- ----------------------------
BEGIN;
INSERT INTO `userinfo` (`id`, `username`, `address`) VALUES (1, '张三', '上海市普陀区金沙江路 1518 弄');
INSERT INTO `userinfo` (`id`, `username`, `address`) VALUES (2, '李四', '四川省成都市成华区南通路143号');
INSERT INTO `userinfo` (`id`, `username`, `address`) VALUES (3, '王麻子', '北京市朝阳区热心市民路34号');
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
