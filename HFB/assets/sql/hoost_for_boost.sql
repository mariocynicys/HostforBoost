-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 10, 2021 at 12:58 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hoost_for_boost`
--

-- --------------------------------------------------------

--
-- Table structure for table `administrators`
--

CREATE TABLE `administrators` (
  `USERNAME` varchar(20) NOT NULL,
  `PASSWORD` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `administrators`
--

INSERT INTO `administrators` (`USERNAME`, `PASSWORD`) VALUES
('admin', '0000'),
('omar', '1234');

-- --------------------------------------------------------

--
-- Table structure for table `friends`
--

CREATE TABLE `friends` (
  `UserName` varchar(20) NOT NULL,
  `FriendName` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `friends`
--

INSERT INTO `friends` (`UserName`, `FriendName`) VALUES
('GamerBeast', 'bigfish'),
('GamerBeast', 'nullbyte'),
('nullbyte', 'bigfish'),
('nullbyte', 'Elonsol'),
('nullbyte', 'zero'),
('zero', 'bigfish');

-- --------------------------------------------------------

--
-- Table structure for table `game`
--

CREATE TABLE `game` (
  `GID` int(11) NOT NULL,
  `GName` varchar(80) NOT NULL,
  `GPoster` varchar(100) NOT NULL DEFAULT 'defualt.jpg',
  `GGenre` varchar(50) NOT NULL DEFAULT '?',
  `GRate` decimal(2,1) NOT NULL DEFAULT 0.0,
  `GReleasedDate` date NOT NULL,
  `GPublisher` varchar(100) NOT NULL DEFAULT 'Unknown',
  `GTrailer` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `game`
--

INSERT INTO `game` (`GID`, `GName`, `GPoster`, `GGenre`, `GRate`, `GReleasedDate`, `GPublisher`, `GTrailer`) VALUES
(1, 'Marvel\'s Avengers', 'MarvelsAvengers_1x.jpg', 'Action-adventure,Role-playing,Beat \'em up', '6.0', '2020-08-14', 'Square Enix', 'k-POG1-Cp1k'),
(2, 'PlayerUnknown\'s Batt', 'PlayerUnknown_s_Battlegrounds_1x.jpg', 'Battle royale game', '6.5', '2016-07-30', 'PUBG Coraporation', '_LTiEXMc5J0'),
(3, 'Assassin\'s Creed Val', 'assassinscreed_valhalla_1x.jpg', 'Action-adventure,Role-playing,Beat', '8.0', '2020-10-11', 'Ubisoft', 'ssrNcwxALS4'),
(4, 'Sniper Elite 4', 'Sniperelite4_1x.jpg', 'Third-person, Tactical shooter, Stealth game', '9.0', '2017-02-13', 'Rebellion Developments, Game Source Entertainment, Sold-Out Software', 'lGBRAEvXZ94'),
(5, 'DEAD BY DAYLIGHT', 'deadbydaylight_1x.jpg', 'Asymmetrical multiplayer (4vs1), Horror game', '8.5', '2017-06-13', 'Starbreeze Studios', 'JGhIXLO3ul8'),
(6, 'Dragon Ball Xenovers', 'DRAGONBALLXENOVERSE2_1x.jpg', 'Role-playing, Fighting game', '9.0', '2016-10-25', 'Bandai Namco Entertainment', 'JnUbg-9v_bE'),
(7, 'Grid', 'GRID_1x.jpg', 'Racing video game', '6.2', '2019-10-08', 'Codemasters', 'kSJzeLep-Xg'),
(8, 'Hitman 2', 'hitman2_1x.jpg', 'Stealth video game', '9.3', '2018-11-13', 'Warner Bros', 'R8aRCwbZGek'),
(9, 'Monster Jam Steel Ti', 'monsterjam_steeltitans_1x.jpg', 'Racing video game', '7.0', '2019-06-25', 'THQ Nordic, THQ', 'aElJ0jpxVuk'),
(10, 'Cyberpunk 2077', 'cyberpunk2077_1x.jpg', 'Action Role-playing, First-person shooter, Open wo', '7.0', '2020-12-09', 'CD Projekt', 'BO8lX3hDU30'),
(11, 'Shadow of the Tomb R', 'Shadow_of_the_Tomb_Raider__Definitive_Edition_1x.jpg', 'Action-adventure game', '8.5', '2018-09-12', 'Square Enix, Feral Interactive', 'b1FvYc3c64w'),
(12, 'Attack on Titan 2', 'AttackonTitan2_FinalBattle_1x.jpg', 'Action hack, Slash video game', '6.5', '2018-03-05', 'Koei Tecmo Games, Koei Tecmo, KOEI TECMO AMERICA Corporation', 'rU34JMxLJ9s'),
(13, 'Doom Eternal', 'DoomEternal_1x.jpg', 'Action, First-person shooter', '9.0', '2020-03-20', 'Bethesda Softworks', 'FkklG9MA0vM'),
(14, 'Wolfenstein: Youngbl', 'Wolfenstein__Youngblood_1x.jpg', 'Action, First-person shooter', '6.0', '2019-07-26', 'Bethesda Softworks', 'SNpgKytPcc4'),
(15, 'WWE 2K Battlegrounds', 'WWEbattlegrounds_1x.jpg', 'Professional wrestling video game', '5.5', '2020-09-13', '2K Games, Take-Two Interactive', 'ujOqTFgFnKQ'),
(16, 'Zombie Army 4: Dead ', 'Zombie_Army_4__Dead_War_1x.jpg', 'Third-person shooter, Survival horror, Tactical sh', '9.0', '2020-02-04', 'Rebellion Developments, Game Source Entertainment', '88fFQcRe1CM'),
(17, 'Celeste', 'Celeste_1x.jpg', 'Platform Game', '9.2', '2018-01-25', 'Matt Makes Games', '70d9irlxiB4'),
(18, 'Ary and the Secret', 'ary_secretofseasons.jpg', 'Action-Adventure game', '7.0', '2020-09-01', 'Modus Games, Maximum Games', 'p1F9gZzDKLI'),
(19, 'Strange Brigade', 'Strange_Brigade_1x.jpg', 'Cooperative, Third-person shooter video game', '9.0', '2018-08-28', 'Rebellion Developments', 'f5Df508visY'),
(20, 'Ghost Recon Breakpoi', 'GhostReconBreakpoint_1x.jpg', 'Online, Worldwide, Tactical shooter video game', '7.5', '2019-06-26', 'Ubisoft, Nouredine Abboud ', 'y-9_d3IT_yA'),
(21, 'FIFA 20', 'fifa20.jpg', 'Football simulation video gamenre', '9.0', '2019-09-24', 'Electronic Arts', 'vgQNOIhRsV4');

-- --------------------------------------------------------

--
-- Table structure for table `gameshistory`
--

CREATE TABLE `gameshistory` (
  `UserName` varchar(20) NOT NULL,
  `GID` int(11) NOT NULL,
  `GStarted` datetime NOT NULL DEFAULT current_timestamp(),
  `GEnded` varchar(30) NOT NULL DEFAULT '',
  `GState` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `gameshistory`
--

INSERT INTO `gameshistory` (`UserName`, `GID`, `GStarted`, `GEnded`, `GState`) VALUES
('nullbyte', 1, '2021-01-08 13:56:51', '2021-01-08 12:57:58', 0),
('nullbyte', 2, '2021-01-02 12:15:10', '2021-01-02 11:35:26', 0),
('nullbyte', 2, '2021-01-02 12:35:37', '2021-01-02 11:35:54', 0),
('nullbyte', 3, '2021-01-08 13:58:04', '2021-01-08 12:58:11', 0),
('nullbyte', 5, '2021-01-02 12:37:34', '2021-01-02 11:37:49', 0);

-- --------------------------------------------------------

--
-- Table structure for table `gamespublishershistory`
--

CREATE TABLE `gamespublishershistory` (
  `UserName` varchar(20) NOT NULL,
  `GID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `program`
--

CREATE TABLE `program` (
  `PID` int(11) NOT NULL,
  `PName` varchar(80) NOT NULL,
  `PPoster` varchar(50) NOT NULL DEFAULT 'defualt.jpg',
  `PReleasedDate` date NOT NULL,
  `PPublisher` varchar(50) NOT NULL DEFAULT 'Unknown'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `program`
--

INSERT INTO `program` (`PID`, `PName`, `PPoster`, `PReleasedDate`, `PPublisher`) VALUES
(1, 'Autocad', 'Autodesk-Autocad-01.jpg', '2020-05-25', 'Autodesk'),
(2, 'SolidWorks', 'SolidWorks-01.jpg', '2020-03-09', 'SolidWorks Corp.,Dassult Systems'),
(3, 'Acrobat Standard DC', 'Adobe-Acrobat-Pro-DC-01.jpg', '2020-11-03', 'Adobe'),
(4, 'Premiere Pro CC 2020', 'Adobe-Premiere-Pro-CC-01.jpg', '2020-10-20', 'Adobe'),
(5, 'Lightroom CC 2020', 'Adobe-Photoshop-Lightroom-CC-01.jpg', '2020-06-16', 'Adobe'),
(6, 'Illustrator CC 2021', 'Adobe-Illustrator-CC-01.jpg', '2020-09-01', 'Adobe'),
(7, 'Photoshop', 'Adobe-Photoshop-CC-01.jpg', '2020-12-08', 'Adobe'),
(8, 'Microsfot Office', 'office365.png', '2018-09-24', 'Microsfot'),
(9, 'Autodesk REVIT', 'Autodesk-Revit-01.jpg', '2020-04-01', 'Autodesk'),
(10, 'Autodesk MAYA', 'Maya-01.jpg', '2020-10-06', 'Autodesk'),
(11, 'Autodesk 3DS MAX', '3ds-Max-01.jpg', '2020-08-26', 'Autodesk'),
(12, 'Visual Studio', 'Visual-Studio-Logo.png', '2019-04-02', 'Microsfot'),
(13, 'MATLAB', 'matlab.png', '2020-09-17', 'MathWorks'),
(14, 'Android Studio', 'Andriod_studio.png', '2020-09-10', 'Google'),
(15, 'Cinema 4D', 'Cinema-4D-Logo.png', '2020-09-08', 'Maxon'),
(16, 'OBS: Open Broadcaster Software', 'obs.png', '2020-12-14', 'Hugh \'Jim\' Bailey'),
(17, 'Intel Quartus Prime', 'quartus.jpg', '2013-03-04', 'Intel'),
(18, 'Microsoft SQL Server ', 'sql-server_logo.jpg', '2019-05-29', 'Microsoft'),
(19, 'Incspace', 'incspace.png', '2005-07-03', 'Nathan Hurst, Ted Gould'),
(20, 'GIMP - GNU Image Manipulation Program', 'gimp.png', '2019-02-12', 'Spencer Kimball, Peter Mattis');

-- --------------------------------------------------------

--
-- Table structure for table `programshistory`
--

CREATE TABLE `programshistory` (
  `UserName` varchar(20) NOT NULL,
  `PID` int(11) NOT NULL,
  `PStarted` datetime NOT NULL DEFAULT current_timestamp(),
  `PEnded` varchar(30) NOT NULL DEFAULT '',
  `PState` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `programshistory`
--

INSERT INTO `programshistory` (`UserName`, `PID`, `PStarted`, `PEnded`, `PState`) VALUES
('nullbyte', 2, '2021-01-08 13:57:27', '2021-01-08 12:57:55', 0),
('nullbyte', 3, '2021-01-02 12:35:46', '2021-01-02 11:35:50', 0);

-- --------------------------------------------------------

--
-- Table structure for table `programspublishershistory`
--

CREATE TABLE `programspublishershistory` (
  `UserName` varchar(20) NOT NULL,
  `PID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `UserName` varchar(20) NOT NULL,
  `FirstName` varchar(20) NOT NULL,
  `LastName` varchar(20) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `HashedPassword` varchar(255) NOT NULL,
  `UserType` varchar(20) NOT NULL DEFAULT 'noraml',
  `UserPic` varchar(100) NOT NULL DEFAULT 'UserDefault.jpg',
  `IsOnline` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserName`, `FirstName`, `LastName`, `Email`, `HashedPassword`, `UserType`, `UserPic`, `IsOnline`) VALUES
('bigfish', 'ahmed', 'mohamed', 'ahmed@gmail.com', '$2y$10$lA9D091ROwEa.QX1BBtHB.8KqPF0NxQFS8h9Z2cQSk1pMB4zw3BuC', 'normal', 'UserDefault.png', 1),
('carslen00', 'magnus', 'max', 'mc@gmail.com', '$2y$10$Jlq/iwzh7ogrCyur/HGMHu0YdccaeMzBgWyIPoj02WnQaSme9AHEC', 'normal', 'UserDefault.jpg', 0),
('chess960', 'maxim', 'vachir', 'maxim@chess.com', '$2y$10$XhtMndk/74Wl70DtCSYBEelloVx/yriYnb//l2VqFMYB/mPw/4GXi', 'normal', 'UserDefault.jpg', 0),
('Elonsol', 'mostafa', 'sobhy', 'm123@gmail.com', '$2y$10$tVVi.fHRw6Da.qnMe0FC/en0XXf.li3g1EFQ3LK0oDp/pqf4Wr7xi', 'normal', 'UserDefault.png', 1),
('fifa2020', 'game', 'pubme', 'fifa@gmail.com', '$2y$10$JNsmGJWJzqg8wvOTaEjZ2ulpro880WN4PCHysFhxj3m.7Lq1TWRVu', 'game_publisher', 'UserDefault.png', 0),
('gameinc1', 'game', 'incman', 'inc1@gmail.com', '$2y$10$fSW4JEJnZO4TXBotJklr5.I7/8Whsji1nBafaFNJM8KjG.kcyWpdy', 'game_publisher', '5ff715f9318613.76945458.png', 0),
('GameINC2020', 'GameINC', 'GameINC', 'gameinc23@gmail.com', '$2y$10$PIbnw7CfGElRml8w9ljbvOWl4k2jppuOkVHqC/75xn8sA6AP.Y3dy', 'game_publisher', 'UserDefault.jpg', 0),
('GamerBeast', 'walied', 'zeyad', 'GamerBeast@hr.com', '$2y$10$wnyV3E3q2s3qcV7rOEptGuaANf2dnDF63x4oO1QIMb7WG6NzasCJ.', 'normal', 'UserDefault.jpg', 0),
('killer', 'zeyad ', 'aly', 'k@k.com', '$2y$10$DY8ubAibbojJrQaaIW2IRejl4T9hONRiw78beWq/sYneaWtcy3Nly', 'normal', 'UserDefault.png', 0),
('newGameInc', 'ayekalam', 'test', 'ayekalam@gmail.com', '$2y$10$UwjQijO9FIAATdl/xR10hukIU9/HjPEY.pNVmxsYG/51V5MRXQRAm', 'game_publisher', 'UserDefault.jpg', 0),
('newKiller', 'Mohamed', 'Ali', 'newKiller@gmail.com', '$2y$10$KyHA2eYZfntUpFu1G5W1fuZeyDJ/BKkQiDWv3CFaRtGWWl52Oawlu', 'program_publisher', 'UserDefault.jpg', 0),
('newMan', 'man', 'man', 'newMan@gmail.com', '$2y$10$j2iXtGp5FDxPZrMxeTo/uOeBoNzGtEZotfet.6ukXA9UuqNC/YYWm', 'normal', 'UserDefault.jpg', 0),
('nullbyte', 'fake', 'null', 'null@gmail.com', '$2y$10$8GADqJm2xhtJUulIkYZSYO49QXb8ddmrM0KKb6L5XmmWflKpLGWzm', 'normal', 'UserDefault.png', 0),
('nullbyte2', 'max', 'pro', 'newemail@gmail.com', '$2y$10$7pnR9qJDRD61PDDzBUMi6.aej6atlH6aJILoOWHHKWVrMoWul9O.G', 'normal', 'UserDefault.png', 1),
('pinc1', 'program', 'one', 'pinc1@tempmail.com', '$2y$10$alJFbEp/QS./H2ghrc/7COST2F9lfH0hP.agQ3ws7CDhY.fNQu.46', 'program_publisher', 'UserDefault.jpg', 0),
('ProgramINC35', 'ali', 'hassan', 'ali@yahoo.com', '$2y$10$17/VwbQXHAtvIVsYE/s9DO8N/0B9voxoJj3pudsCUk9Nj1s/1G8R2', 'program_publisher', 'UserDefault.jpg', 0),
('superMario', 'super', 'mario', 'sm@mail.com', '$2y$10$hQZx2mVlTGGHlj8hILw0Zuz0bCw8PLbGyXGJj5MqJZVcxIOtQqYvu', 'game_publisher', 'UserDefault.jpg', 0),
('zero', 'zeyad', 'ahmed', 'zero@gmail.com', '$2y$10$rsj2qkDOr665vK1U2hVtge4hthop2HlL6i.PAg6ZlKjSkN1k/M4e6', 'normal', 'UserDefault.png', 0),
('zero2021', 'Zero', 'AbdElhamid', 'zero20125@gmail.com', '$2y$10$LYK/tQ.3Hx5xmJBNi4bo5uBKTkO3LGISgtEPaWcOvEXn8Gg25oPOi', 'normal', 'UserDefault.png', 0),
('zezo01', 'zeyad', 'hassan', 'zezo@gamilc.om', '$2y$10$GgLE/JwsqgVpZ7lvDEFxbe4cIEWvYx5w4KoohF3mRr6Wi38q9YjHy', 'normal', 'UserDefault.jpg', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `administrators`
--
ALTER TABLE `administrators`
  ADD PRIMARY KEY (`USERNAME`);

--
-- Indexes for table `friends`
--
ALTER TABLE `friends`
  ADD PRIMARY KEY (`UserName`,`FriendName`),
  ADD KEY `FK_FRIENDS_2` (`FriendName`);

--
-- Indexes for table `game`
--
ALTER TABLE `game`
  ADD PRIMARY KEY (`GID`),
  ADD UNIQUE KEY `GName` (`GName`),
  ADD UNIQUE KEY `GPoster` (`GPoster`);

--
-- Indexes for table `gameshistory`
--
ALTER TABLE `gameshistory`
  ADD PRIMARY KEY (`UserName`,`GID`,`GStarted`,`GEnded`),
  ADD KEY `FK_UGHistory_2` (`GID`);

--
-- Indexes for table `gamespublishershistory`
--
ALTER TABLE `gamespublishershistory`
  ADD PRIMARY KEY (`UserName`,`GID`),
  ADD KEY `FK_GPHistory_2` (`GID`);

--
-- Indexes for table `program`
--
ALTER TABLE `program`
  ADD PRIMARY KEY (`PID`),
  ADD UNIQUE KEY `PName` (`PName`),
  ADD UNIQUE KEY `PPoster` (`PPoster`);

--
-- Indexes for table `programshistory`
--
ALTER TABLE `programshistory`
  ADD PRIMARY KEY (`UserName`,`PID`,`PStarted`,`PEnded`),
  ADD KEY `FK_UPHistory_2` (`PID`);

--
-- Indexes for table `programspublishershistory`
--
ALTER TABLE `programspublishershistory`
  ADD PRIMARY KEY (`UserName`,`PID`),
  ADD KEY `FK_PPHistory_2` (`PID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserName`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `game`
--
ALTER TABLE `game`
  MODIFY `GID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `program`
--
ALTER TABLE `program`
  MODIFY `PID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `friends`
--
ALTER TABLE `friends`
  ADD CONSTRAINT `FK_FRIENDS_1` FOREIGN KEY (`UserName`) REFERENCES `users` (`UserName`),
  ADD CONSTRAINT `FK_FRIENDS_2` FOREIGN KEY (`FriendName`) REFERENCES `users` (`UserName`);

--
-- Constraints for table `gameshistory`
--
ALTER TABLE `gameshistory`
  ADD CONSTRAINT `FK_UGHistory_1` FOREIGN KEY (`UserName`) REFERENCES `users` (`UserName`),
  ADD CONSTRAINT `FK_UGHistory_2` FOREIGN KEY (`GID`) REFERENCES `game` (`GID`);

--
-- Constraints for table `gamespublishershistory`
--
ALTER TABLE `gamespublishershistory`
  ADD CONSTRAINT `FK_GPHistory_1` FOREIGN KEY (`UserName`) REFERENCES `users` (`UserName`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_GPHistory_2` FOREIGN KEY (`GID`) REFERENCES `game` (`GID`) ON DELETE CASCADE;

--
-- Constraints for table `programshistory`
--
ALTER TABLE `programshistory`
  ADD CONSTRAINT `FK_UPHistory_1` FOREIGN KEY (`UserName`) REFERENCES `users` (`UserName`),
  ADD CONSTRAINT `FK_UPHistory_2` FOREIGN KEY (`PID`) REFERENCES `program` (`PID`);

--
-- Constraints for table `programspublishershistory`
--
ALTER TABLE `programspublishershistory`
  ADD CONSTRAINT `FK_PPHistory_1` FOREIGN KEY (`UserName`) REFERENCES `users` (`UserName`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_PPHistory_2` FOREIGN KEY (`PID`) REFERENCES `program` (`PID`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
