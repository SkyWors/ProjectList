CREATE TABLE `User` (
	`uid` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
	`email` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
	`password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
	`update` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	`creation` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `Project` (
	`uid` varchar(50) NOT NULL,
	`uid_User` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
	`name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
	`description` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
	`path` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
	`url` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
	`language` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
	`tag` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
	`update` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	`creation` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY (`uid`),
	KEY `Project_User_FK` (`uid_User`),
	CONSTRAINT `Project_User_FK` FOREIGN KEY (`uid_User`) REFERENCES `User` (`uid`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `Application` (
	`uid_Project` varchar(50) NOT NULL,
	`github` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
	`gitlab` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
	`vscode` tinyint(1) NOT NULL DEFAULT '0',
	`idea` tinyint(1) NOT NULL DEFAULT '0',
	PRIMARY KEY (`uid_Project`),
	CONSTRAINT `Application_Project_FK` FOREIGN KEY (`uid_Project`) REFERENCES `Project` (`uid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `Profile` (
	`uid` varchar(50) NOT NULL,
	`uid_User` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
	`name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
	PRIMARY KEY (`uid`),
	KEY `Profile_User_FK` (`uid_User`),
	CONSTRAINT `Profile_User_FK` FOREIGN KEY (`uid_User`) REFERENCES `User` (`uid`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `ProfileProject` (
	`uid_Project` varchar(50) NOT NULL,
	`uid_Profile` varchar(50) NOT NULL,
	PRIMARY KEY (`uid_Project`),
	KEY `ProfileProject_Profile_FK` (`uid_Profile`),
	CONSTRAINT `ProfileProject_Profile_FK` FOREIGN KEY (`uid_Profile`) REFERENCES `Profile` (`uid`) ON DELETE CASCADE ON UPDATE CASCADE,
	CONSTRAINT `ProfileProject_Project_FK` FOREIGN KEY (`uid_Project`) REFERENCES `Project` (`uid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
