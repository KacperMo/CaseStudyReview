SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+01:00";

-- Create csr database.
CREATE DATABASE `csr`;

-- Choose which database to use when querying.
USE `csr`;

-- Create required tables.
CREATE TABLE `comments`(
    `comment_id` int(32) AUTO_INCREMENT PRIMARY KEY,
    `publication_id` int(32) NOT NULL,
    `comment_content` varchar(1023) NOT NULL,
    `comment_author` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `authorization_data`(
    `user_id` int(32) AUTO_INCREMENT PRIMARY KEY,
    `user_name` varchar(255) NOT NULL UNIQUE,
    `password` varchar(255) NOT NULL,
    `registration_date` date DEFAULT CURRENT_DATE(),
    `user_email` varchar(255) NOT NULL UNIQUE,
    `user_permissions` varchar(255) NOT NULL,
    `last_login_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `publications` (
    `publication_id` int(32) AUTO_INCREMENT PRIMARY KEY,
    `is_public` tinyint(1) NOT NULL,
    `author_id` int(32) NOT NULL,
    `case_supervisor` varchar(255) DEFAULT NULL,
    `submission_date` date DEFAULT CURRENT_DATE(),
    `title` varchar(255) NOT NULL,
    `category` varchar(31) NOT NULL,
    `views` int(32) NOT NULL,
    `thumbnail_path` varchar(255) DEFAULT NULL,
    `publication_path` varchar(255) NOT NULL,
    `description` varchar(1023) NOT NULL,
    `rating` float(3,2) NOT NULL
 ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `users` (
    `user_id` int(32) NOT NULL,
    `first_name` varchar(63) NOT NULL,
    `last_name` varchar(127) NOT NULL,
    `college` varchar(255) DEFAULT NULL,
    `avatar_path` varchar(255) DEFAULT NULL,
    `birth_date` date NOT NULL,
    `description` varchar(1023) DEFAULT NULL,
    `country` varchar(255) NOT NULL,
    `website` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Create admin user.
INSERT INTO `authorization_data` (`user_name`, `password`, `user_email`) VALUES
('admin', 'admincsr', 'hi@casestudyreview.com');
