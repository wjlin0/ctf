DROP DATABASE ctf;

-- 创建数据库 ctf
CREATE DATABASE ctf;

-- 修改字符集设置
ALTER DATABASE ctf SET client_encoding = 'UTF8';
ALTER DATABASE ctf SET default_transaction_isolation TO 'READ COMMITTED';
ALTER DATABASE ctf SET timezone TO 'UTC';

\c ctf

-- ----------------------------
-- Table structure for flag
-- ----------------------------
CREATE TABLE flag (
    flag VARCHAR(255)
);

-- ----------------------------
-- Records of flag
-- ----------------------------
INSERT INTO flag VALUES ('flag{********************************}');

-- ----------------------------
-- Table structure for users
-- ----------------------------

CREATE TABLE users (
                       id SERIAL PRIMARY KEY,
                       username VARCHAR(255) NOT NULL,
                       password VARCHAR(255) NOT NULL
);

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO users (id, username, password) VALUES (1, 'admin', '37f5a03e27fbe570aa63e089b1d78f34');
INSERT INTO users (id, username, password) VALUES (2, 'wjlin0', '37f5a03e27fbe570aa63e089b1d78f34');
INSERT INTO users (id, username, password) VALUES (3, 'ctf', '37f5a03e27fbe570aa63e089b1d78f34');
