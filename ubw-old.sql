-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 06 Paź 2021, 19:49
-- Wersja serwera: 10.4.11-MariaDB
-- Wersja PHP: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `ubw`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `coments`
--

CREATE TABLE `coments` (
  `commentID` int(11) NOT NULL,
  `publicationID` int(11) NOT NULL,
  `coment` varchar(255) NOT NULL,
  `autofOfComenrt` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `logindata`
--

CREATE TABLE `logindata` (
  `IdOfUser` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `dateOfRegistration` date DEFAULT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `logindata`
--

INSERT INTO `logindata` (`IdOfUser`, `name`, `password`, `dateOfRegistration`, `email`) VALUES
(1, 'Admin', '123', NULL, 'ader@mail.pl');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `publications`
--

CREATE TABLE `publications` (
  `publicationID` int(11) NOT NULL,
  `isPublic` tinyint(1) NOT NULL,
  `authorID` int(11) NOT NULL,
  `autornIFnotlLogIn` varchar(16) DEFAULT NULL,
  `supervisor` varchar(15) DEFAULT '',
  `date` date NOT NULL,
  `IMGsrc` varchar(120) NOT NULL,
  `title` varchar(100) NOT NULL,
  `category` varchar(11) NOT NULL,
  `views` int(10) NOT NULL,
  `retailBranch` varchar(60) NOT NULL,
  `PDFsrc` varchar(100) NOT NULL,
  `src` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `abstract` varchar(255) NOT NULL,
  `stars` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `publications`
--

INSERT INTO `publications` (`publicationID`, `isPublic`, `authorID`, `autornIFnotlLogIn`, `supervisor`, `date`, `IMGsrc`, `title`, `category`, `views`, `retailBranch`, `PDFsrc`, `src`, `description`, `abstract`, `stars`) VALUES
(106, 0, 0, 'Kacper', 'Kacper', '2020-04-16', 'UsersFoldres/AnonymusPublication2020-04-16-7703/publication/2020-04-16_(12-45)/komentarze.png', 'Sample', 'Medycyna', 0, 'IT', 'UsersFoldres/AnonymusPublication2020-04-16-7703/publication/2020-04-16_(12-45)/sample.pdf', '', 'Publikacja testowa', '', NULL),
(107, 0, 0, 'Marcin M', 'dr Antoni', '2020-06-15', 'UsersFoldres/AnonymusPublication2020-06-15-76342/publication/2020-06-15_(06-21)/20200605_232505.jpg', 'PDF to JPG conventer inPHP', 'Nauki społe', 0, 'architektura', 'UsersFoldres/AnonymusPublication2020-06-15-76342/publication/2020-06-15_(06-21)/sample.pdf', '', 'opis dokładny opracowania', 'Abstrakt krótkie wprowadzenie', NULL),
(108, 0, 0, 'asd', 'asd', '2020-06-15', 'UsersFoldres/AnonymusPublication2020-06-15-36755/publication/2020-06-15_(06-27)/cracow-map.jpg', 'PDF to JPG conventer inPHP', 'Nauki społe', 0, '1', 'UsersFoldres/AnonymusPublication2020-06-15-36755/publication/2020-06-15_(06-27)/sample.pdf', 'UsersFoldres/AnonymusPublication2020-06-15-36755/publication/2020-06-15_(06-27)/', 'asd', 'sad', NULL),
(110, 0, 0, 'admin', 'admin', '2020-06-16', 'UsersFoldres/AnonymusPublication2020-06-16-44103/publication/2020-06-16_(07-41)/20200605_232505.jpg', 'Sample PDF file', 'Technika', 0, 'automatyka elektronika', 'UsersFoldres/AnonymusPublication2020-06-16-44103/publication/2020-06-16_(07-41)/Sample (1).pdf', 'UsersFoldres/AnonymusPublication2020-06-16-44103/publication/2020-06-16_(07-41)/', '$sqlUploadPublication=\"INSERT INTO `publications`( `isPublic`,`authorID`, `autornIFnotlLogIn`,`supervisor`, `date`,`IMGsrc`, `title`, `category`, `retailBranch`, `PDFsrc`, `src`, `description`, `abstract`) \r\n                                                    VALUES (:isPublic ,:userID, :autornIFnotlLogIn, :supervisor, :date, :JPGsrc, :Title, :category, :retailBranch, :PDFsrc, :src, :description, :abstract);\";\r\n            \r\n        $InsertPublicationData= $pdo->prepare($sqlUploadPublication);\r\n        $InsertPublicationData->bindValue(\'isPublic\', $isPublic, PDO::PARAM_INT);        \r\n        $InsertPublicationData->bindValue(\'userID\', $userID, PDO::PARAM_STR);\r\n        $InsertPublicationData->bindValue(\'autornIFnotlLogIn\', $autor, PDO::PARAM_STR);\r\n        $InsertPublicationData->bindValue(\'supervisor\', $supervisor, PDO::PARAM_STR);\r\n        $InsertPublicationData->bindValue(\'date\', $date, PDO::PARAM_STR);\r\n        $InsertPublicationData->bindValue(\'JPGsrc\', $JPGsrc, PDO::PARAM_STR);\r\n        $InsertPublicationData->bindValue(\'Title\', $Title, PDO::PARAM_STR);        \r\n        $InsertPublicationData->bindValue(\'category\', $category, PDO::PARAM_STR);\r\n        $InsertPublicationData->bindValue(\'retailBranch\', $retailBranch, PDO::PARAM_STR);\r\n        $InsertPublicationData->bindValue(\'PDFsrc\', $PDFsrc, PDO::PARAM_STR);\r\n        $InsertPublicationData->bindValue(\'src\', $Src, PDO::PARAM_STR);\r\n        $InsertPublicationData->bindValue(\'description\', $description, PDO::PARAM_STR);        \r\n        //$InsertPublicationData->bindValue(\'Tags\', $Tags, PDO::PARAM_STR);\r\n        $InsertPublicationData->bindValue(\'abstract\', $abstract, PDO::PARAM_STR);\r\n        $isLoginDataInserd = $InsertPublicationData->execute();\r\n             echo \"end\";\r\n        echo $InsertPublicationData->debugDumpParams();', '$sqlUploadPublication=\"INSERT INTO `publications`( `isPublic`,`authorID`, `autornIFnotlLogIn`,`supervisor`, `date`,`IMGsrc`, `title`, `category`, `retailBranch`, `PDFsrc`, `src`, `description`, `abstract`) \r\n                                               ', NULL);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--


CREATE TABLE `users` (
  `userID` int(11) NOT NULL,
  `accountName` text NOT NULL,
  `name` varchar(64) NOT NULL,
  `surname` varchar(64) NOT NULL,
  `college` varchar(64) NOT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `years` int(3) DEFAULT NULL,
  `descriptions` varchar(255) DEFAULT NULL,
  `lastLoginDate` date NOT NULL,
  `dateOfRegistration` date DEFAULT NULL,
  `email` varchar(535) NOT NULL,
  `website` varchar(535) NOT NULL,
  `country` text NOT NULL,
  `motto` text NOT NULL,
  `aboutMe` text NOT NULL,
  `colleges` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `users`
--


INSERT INTO `users` (`userID`, `accountName`, `name`, `surname`, `college`, `avatar`, `years`, `descriptions`, `lastLoginDate`, `dateOfRegistration`, `email`, `website`, `country`, `motto`, `aboutMe`, `colleges`) VALUES
(0, '', '', '', '', NULL, NULL, NULL, '0000-00-00', NULL, '', '', '', '', '', 'Uniwersytet Ekonomiczny w Krakowie'),
(1, '', '', '', '', 'img/defoultAvatar', NULL, 'Im new here.', '0000-00-00', NULL, '', '', '', '', '', ''),
 (2, 'kciesla34', 'Kamil', '', '', 'null', 99, 'null', '0000-00-00', '0000-00-00', 'kamilciesla34@gmail.com', 'kej', 'pl', 'Never give up', 'ok', '');


--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `coments`
--
ALTER TABLE `coments`
  ADD PRIMARY KEY (`commentID`);

--
-- Indeksy dla tabeli `logindata`
--
ALTER TABLE `logindata`
  ADD PRIMARY KEY (`IdOfUser`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indeksy dla tabeli `publications`
--
ALTER TABLE `publications`
  ADD PRIMARY KEY (`publicationID`);

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `coments`
--
ALTER TABLE `coments`
  MODIFY `commentID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `logindata`
--
ALTER TABLE `logindata`
  MODIFY `IdOfUser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT dla tabeli `publications`
--
ALTER TABLE `publications`
  MODIFY `publicationID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=116;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
