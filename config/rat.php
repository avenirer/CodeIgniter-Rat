<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * "store_in" allows you to set your preference regarding the storage of your logs.
 * You can store the logs inside a database by passing "database" as value,
 * or inside a directory by passing the directory location as value (relative to APPPATH).
 * If nothing is set, it will save the logs inside the "logs" directory.
 *
 * If you decide to store the logs inside a database this is the sql for the "rat_lib" table
 *
 *
SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `rat`;
CREATE TABLE `rat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `date_time` datetime DEFAULT NULL,
  `code` int(11) DEFAULT NULL,
  `message` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
 *
 *
 * If you decide to store the logs inside a directory make sure the directory and its files are writable (755).
 */
$config['store_in'] = 'database'; // !FOR THE MOMENT ONLY WORKS WITH DATABASE!
$config['session_user_id'] = 'user_id'; // You can tell the library to take the user id from a session variable
$config['table_name'] = ''; // If you prefer to name the table other than "rat" you can set it here...