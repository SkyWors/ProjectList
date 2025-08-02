--
-- Table structure for table `users`
--

CREATE TABLE `users` (
	`uid` varchar(32) NOT NULL,
	`name` varchar(255) NOT NULL,
	`surname` varchar(255) NOT NULL,
	`email` varchar(255) NOT NULL,
	`password` varchar(100) NOT NULL,
	`to_modify` tinyint(1) NOT NULL DEFAULT 0,
	`date_update` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
	`date_create` datetime NOT NULL DEFAULT current_timestamp(),
	PRIMARY KEY (`uid`),
	UNIQUE KEY `users_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Trigger for table `users`
--

DELIMITER $$

CREATE TRIGGER add_role
AFTER INSERT
ON users FOR EACH ROW
BEGIN
	INSERT INTO user_role (uid_user) VALUES (NEW.uid);
END$$

DELIMITER ;

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`name` varchar(255) NOT NULL,
	PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Data for table `roles`
--

INSERT INTO `roles` VALUES
(1,'user'),
(10,'administrator');

--
-- Table structure for table `user_role`
--

CREATE TABLE `user_role` (
	`uid_user` varchar(32) NOT NULL,
	`id_role` int(11) NOT NULL DEFAULT 1,
	`date_update` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
	PRIMARY KEY (`uid_user`,`id_role`),
	KEY `user_role_roles_FK` (`id_role`),
	CONSTRAINT `user_role_roles_FK` FOREIGN KEY (`id_role`) REFERENCES `roles` (`id`),
	CONSTRAINT `user_role_users_FK` FOREIGN KEY (`uid_user`) REFERENCES `users` (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Table structure for table `user_tokens`
--

CREATE TABLE `user_tokens` (
	`uid` varchar(32) NOT NULL,
	`uid_user` varchar(32) NOT NULL,
	`ip_address` varchar(255) NOT NULL,
	`token` text NOT NULL,
	`date_create` datetime NOT NULL DEFAULT current_timestamp(),
	PRIMARY KEY (`uid`),
	KEY `user_tokens_users_FK` (`uid_user`),
	CONSTRAINT `user_tokens_users_FK` FOREIGN KEY (`uid_user`) REFERENCES `users` (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Table structure for table `user_reset_password`
--

CREATE TABLE `user_reset_password` (
	`uid_user` varchar(32) NOT NULL,
	`link` varchar(64) NOT NULL,
	`date_create` datetime NOT NULL DEFAULT current_timestamp(),
	PRIMARY KEY (`uid_user`),
	CONSTRAINT `user_reset_password_users_FK` FOREIGN KEY (`uid_user`) REFERENCES `users` (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS profiles (
	uid varchar(32) NOT NULL PRIMARY KEY,
	uid_creator varchar(32) NOT NULL,
	CONSTRAINT profiles_users_FK FOREIGN KEY (uid_creator) REFERENCES users (uid)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS profile_access (
	uid_profile varchar(32) NOT NULL,
	uid_user varchar(32) NOT NULL,
	PRIMARY KEY (uid_user, uid_profile),
	CONSTRAINT profile_access_profiles_FK FOREIGN KEY (uid_profile) REFERENCES profiles (uid),
	CONSTRAINT profile_access_users_FK FOREIGN KEY (uid_user) REFERENCES users (uid)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS projects (
	uid varchar(32) NOT NULL PRIMARY KEY,
	uid_user varchar(32) NOT NULL,
	CONSTRAINT projects_users_FK FOREIGN KEY (uid_user) REFERENCES users (uid)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS project_profiles (
	uid_project varchar(32) NOT NULL,
	uid_profiles varchar(32) NOT NULL,
	path text NULL,
	PRIMARY KEY (uid_project, uid_profiles),
	CONSTRAINT project_profiles_profiles_FK FOREIGN KEY (uid_profiles) REFERENCES profiles (uid),
	CONSTRAINT project_profiles_projects_FK FOREIGN KEY (uid_project) REFERENCES projects (uid)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
