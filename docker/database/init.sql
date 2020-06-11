CREATE DATABASE IF NOT EXISTS testdb CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;

use testdb;

CREATE TABLE IF NOT EXISTS `testtable` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `col_tinyint` tinyint not null default 0,
  `col_smallint` smallint not null default 0,
  `col_mediumint` mediumint not null default 0,
  `col_int` int not null default 0,
  `col_varchar` varchar(100) NOT NULL DEFAULT '',
  `create_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT IGNORE INTO testtable SET col_varchar='test english';
INSERT IGNORE INTO testtable SET col_varchar='test 繁體中文';
INSERT IGNORE INTO testtable SET col_varchar='test 简体中文';
