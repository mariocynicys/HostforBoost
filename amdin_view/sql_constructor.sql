#DROP DATABASE HFB;

CREATE DATABASE HFB;

USE HFB;

CREATE TABLE `Game`(
    `GID` INT AUTO_INCREMENT PRIMARY KEY,
    `GName` VARCHAR(100) NOT NULL UNIQUE,
    `GPoster` VARCHAR(100) NOT NULL UNIQUE DEFAULT("GameDefualt.jpg"),
    `GGenre` VARCHAR(80) NOT NULL DEFAULT('?'),
    `GRate` decimal(2,1) NOT NULL DEFAULT(0.0),
    `GReleasedDate` date NOT NULL,
    `GPublisher` VARCHAR(100) NOT NULL DEFAULT('Unknown'),
    `GTrailer` VARCHAR(15)
)ENGINE = InnoDB;

CREATE TABLE `Program`(
    `PID` INT AUTO_INCREMENT PRIMARY KEY,
    `PName` VARCHAR(20) NOT NULL UNIQUE,
    `PPoster` VARCHAR(100) NOT NULL UNIQUE DEFAULT("ProgramDefualt.jpg"),
    `PReleasedDate` DATE NOT NULL,
    `PPublisher` VARCHAR(50) NOT NULL DEFAULT('Unknown')
)ENGINE = InnoDB;

CREATE TABLE Users(
    `UserName` VARCHAR(20) PRIMARY KEY,
    `FirstName` VARCHAR(20) NOT NULL,
    `LastName` VARCHAR(20) NOT NULL,
    `Email` VARCHAR(100) NOT NULL UNIQUE,
    `HashedPassword` VARCHAR(255) NOT NULL,
    `UserType` VARCHAR(20) NOT NULL DEFAULT('noraml'),
    `UserPic` VARCHAR(100) NOT NULL DEFAULT("UserDefault.jpg"),
    `IsOnline` BOOLEAN NOT NULL DEFAULT(0),
    Locked BOOLEAN NOT NULL DEFAULT(0)
)ENGINE = InnoDB;

CREATE TABLE Friends(
    `UserName` VARCHAR (20) NOT NULL,
    `FriendName` VARCHAR (20) NOT NULL,
    PRIMARY KEY (`UserName`, `FriendName`),
    #KEY `FK_FRIENDS_2` (`FriendName`),
    CONSTRAINT `FK_FRIENDS_1` FOREIGN KEY (UserName) REFERENCES Users(UserName),
    CONSTRAINT `FK_FRIENDS_2` FOREIGN KEY (FriendName) REFERENCES Users(UserName)
)ENGINE = InnoDB;

CREATE TABLE GamesHistory(
    `UserName` VARCHAR (20) NOT NULL,
    `GID` INT NOT NULL,
    `GStarted` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `GEnded` VARCHAR(30) NOT NULL DEFAULT (''), #just untill we update that time
    `GState` BOOLEAN NOT NULL DEFAULT (1),
    PRIMARY KEY (`UserName`, `GID`, `GStarted`, `GEnded`),
    CONSTRAINT `FK_UGHistory_1` FOREIGN KEY (`UserName`) REFERENCES `Users` (`UserName`),
    CONSTRAINT `FK_UGHistory_2` FOREIGN KEY (`GID`)REFERENCES `Game` (`GID`)
)ENGINE = InnoDB;

CREATE TABLE ProgramsHistory(
    `UserName` VARCHAR (20) NOT NULL,
    `PID` INT NOT NULL,
    `PStarted` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `PEnded` VARCHAR(30) NOT NULL DEFAULT (''), #just untill we update that time
    `PState` BOOLEAN NOT NULL DEFAULT (1),
    PRIMARY KEY (`UserName`, `PID`, `PStarted`, `PEnded`),
    CONSTRAINT `FK_UPHistory_1` FOREIGN KEY (`UserName`) REFERENCES `Users` (`UserName`),
    CONSTRAINT `FK_UPHistory_2` FOREIGN KEY (`PID`)REFERENCES `Program` (`PID`)
)ENGINE = InnoDB;

CREATE TABLE Administrators(
    USERNAME VARCHAR(20) PRIMARY KEY,
    PASSWORD VARCHAR(16) NOT NULL
)ENGINE = InnoDB;

#------------------------------INSERT INTO GAME---------------------------------
INSERT INTO Game(GID, GName, GPoster, GGenre, GRate, GReleasedDate, GPublisher, GTrailer) VALUES
        (1, "Marvel's Avengers", "MarvelsAvengers_1x.jpg", "Action-adventure,Role-playing,Beat 'em up", 6, "2020-08-14", "Square Enix", "k-POG1-Cp1k"),
        (2, "PlayerUnknown's Battlegrounds", "PlayerUnknown_s_Battlegrounds_1x.jpg", "Battle royale game", 6.5, "2016-07-30", "PUBG Coraporation", "_LTiEXMc5J0"),
        (3, "Assassin's Creed Valhalla", "assassinscreed_valhalla_1x.jpg", "Action-adventure,Role-playing,Beat", 8, "2020-10-11", "Ubisoft", "ssrNcwxALS4"),
        (4, "Sniper Elite 4", "Sniperelite4_1x.jpg", "Third-person, Tactical shooter, Stealth game", 9, "2017-02-13", "Rebellion Developments, Game Source Entertainment, Sold-Out Software", "lGBRAEvXZ94"),
        (5, "DEAD BY DAYLIGHT", "deadbydaylight_1x.jpg", "Asymmetrical multiplayer (4vs1), Horror game", 8.5, "2017-06-13", "Starbreeze Studios", "JGhIXLO3ul8"),
        (6, "Dragon Ball Xenoverse 2", "DRAGONBALLXENOVERSE2_1x.jpg", "Role-playing, Fighting game", 9, "2016-10-25", "Bandai Namco Entertainment", "JnUbg-9v_bE"),
        (7, "Grid", "GRID_1x.jpg", "Racing video game", 6.2, "2019-10-08", "Codemasters", "kSJzeLep-Xg"),
        (8, "Hitman 2", "hitman2_1x.jpg", "Stealth video game", 9.3, "2018-11-13", "Warner Bros", "R8aRCwbZGek"),
        (9, "Monster Jam Steel Titans", "monsterjam_steeltitans_1x.jpg", "Racing video game", 7, "2019-06-25", "THQ Nordic, THQ", "aElJ0jpxVuk"),
        (10, "Cyberpunk 2077", "cyberpunk2077_1x.jpg", "Action Role-playing, First-person shooter, Open world", 7, "2020-12-09", "CD Projekt", "BO8lX3hDU30"),
        (11, "Shadow of the Tomb Raider", "Shadow_of_the_Tomb_Raider__Definitive_Edition_1x.jpg", "Action-adventure game", 8.5, "2018-09-12", "Square Enix, Feral Interactive", "b1FvYc3c64w"),
        (12, "Attack on Titan 2", "AttackonTitan2_FinalBattle_1x.jpg", "Action hack, Slash video game", 6.5, "2018-03-05", "Koei Tecmo Games, Koei Tecmo, KOEI TECMO AMERICA Corporation", "rU34JMxLJ9s"),
        (13, "Doom Eternal", "DoomEternal_1x.jpg", "Action, First-person shooter", 9, "2020-03-20", "Bethesda Softworks", "FkklG9MA0vM"),
        (14, "Wolfenstein: Youngblood", "Wolfenstein__Youngblood_1x.jpg", "Action, First-person shooter", 6, "2019-07-26", "Bethesda Softworks", "SNpgKytPcc4"),
        (15, "WWE 2K Battlegrounds", "WWEbattlegrounds_1x.jpg", "Professional wrestling video game", 5.5, "2020-09-13", "2K Games, Take-Two Interactive", "ujOqTFgFnKQ"),
        (16, "Zombie Army 4: Dead War", "Zombie_Army_4__Dead_War_1x.jpg", "Third-person shooter, Survival horror, Tactical shooter", 9, "2020-02-04", "Rebellion Developments, Game Source Entertainment", "88fFQcRe1CM");

#------------------------------INSERT INTO PROGRAM---------------------------------
INSERT INTO Program(PID, PName, PPoster, PReleasedDate, PPublisher) VALUES
        (1, "Autocad", "Autodesk-Autocad-01.jpg", "2020-05-25", "Autodesk"),
        (2, "SolidWorks", "SolidWorks-01.jpg", "2020-03-09", "SolidWorks Corp.,Dassult Systems"),
        (3, "Acrobat Standard DC", "Adobe-Acrobat-Pro-DC-01.jpg", "2020-11-03", "Adobe"),
        (4, "Premiere Pro CC 2020", "Adobe-Premiere-Pro-CC-01.jpg","2020-10-20", "Adobe"),
        (5, "Lightroom CC 2020", "Adobe-Photoshop-Lightroom-CC-01.jpg", "2020-06-16", "Adobe"),
        (6, "Illustrator CC 2021", "Adobe-Illustrator-CC-01.jpg", "2020-09-01", "Adobe"),
        (7, "Photoshop", "Adobe-Photoshop-CC-01.jpg", "2020-12-08", "Adobe"),
        (8, "Microsfot Office", "office365.png", "2018-09-24", "Microsfot"),
        (9, "Autodesk REVIT", "Autodesk-Revit-01.jpg", "2020-04-01", "Autodesk"),
        (10, "Autodesk MAYA", "Maya-01.jpg", "2020-10-06", "Autodesk"),
        (11, "Autodesk 3DS MAX", "3ds-Max-01.jpg", "2020-08-26", "Autodesk"),
        (12, "Visual Studio", "Visual-Studio-Logo.png", "2019-04-02", "Microsfot"),
        (13, "MATLAB", "matlab.png", "2020-09-17", "MathWorks"),
        (14, "Android Studio", "Andriod_studio.png", "2020-09-10", "Google"),
        (15, "Cinema 4D", "Cinema-4D-Logo.png","2020-09-08", "Maxon");


INSERT INTO Administrators(USERNAME,PASSWORD) VALUES
    ('admin','0000'),
    ('omar','1234');



