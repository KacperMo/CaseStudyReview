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
    `commentID` int(32) AUTO_INCREMENT PRIMARY KEY,
    `publicationID` int(32) NOT NULL,
    `commentContent` varchar(1023) NOT NULL,
    `commentAuthor` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `authorization_data`(
    `userID` int(32) AUTO_INCREMENT PRIMARY KEY,
    `username` varchar(255) NOT NULL UNIQUE,
    `password` varchar(255) NOT NULL,
    `registrationDate` date DEFAULT CURRENT_DATE(),
    `emailAddress` varchar(255) NOT NULL UNIQUE,
    `userPermissions` varchar(255) NOT NULL,
    `lastLoginDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `publications` (
    `publicationID` int(32) AUTO_INCREMENT PRIMARY KEY,
    `isPublic` tinyint(1) NOT NULL,
    `authorID` int(32) NOT NULL,
    `caseSupervisor` varchar(255) DEFAULT NULL,
    `submissionDate` date DEFAULT CURRENT_DATE(),
    `title` varchar(255) NOT NULL,
    `category` varchar(31) NOT NULL,
    `views` int(32) NOT NULL,
    `thumbnailPath` varchar(255) DEFAULT NULL,
    `publicationPath` varchar(255) NOT NULL,
    `description` varchar(1023) NOT NULL,
    `rating` float(3,2) NOT NULL
 ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `users` (
    `userID` int(32) NOT NULL,
    `firstName` varchar(63) NOT NULL,
    `lastName` varchar(127) NOT NULL,
    `college` varchar(255) DEFAULT NULL,
    `avatarPath` varchar(255) DEFAULT NULL,
    `birthDate` date NOT NULL,
    `description` varchar(1023) DEFAULT NULL,
    `country` varchar(255) NOT NULL,
    `website` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Create admin user.
INSERT INTO `authorizationData` (`username`, `password`, `emailAddress`) VALUES
('admin', 'admincsr', 'hi@casestudyreview.com');
