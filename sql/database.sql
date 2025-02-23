--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `uid` varchar(32) NOT NULL,
  `name` varchar(255) NOT NULL,
  `surname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(100) NOT NULL,
  `date_update` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `date_create` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`uid`),
  UNIQUE KEY `users_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Trigger for table `users`
--

CREATE OR REPLACE TRIGGER add_role
AFTER INSERT
ON users FOR EACH ROW
BEGIN
	INSERT INTO user_role (uid_user) VALUES (NEW.uid);
END

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

CREATE TABLE `projects` (
  `uid` varchar(32) NOT NULL,
  `uid_user` varchar(32) NOT NULL,
  PRIMARY KEY (`uid`),
  KEY `projects_users_FK` (`uid_user`),
  CONSTRAINT `projects_users_FK` FOREIGN KEY (`uid_user`) REFERENCES `users` (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `profiles` (
  `uid` varchar(32) NOT NULL,
  `uid_creator` varchar(32) NOT NULL,
  PRIMARY KEY (`uid`),
  KEY `profiles_users_FK` (`uid_creator`),
  CONSTRAINT `profiles_users_FK` FOREIGN KEY (`uid_creator`) REFERENCES `users` (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `project_profiles` (
  `uid_project` varchar(32) NOT NULL,
  `uid_profiles` varchar(32) NOT NULL,
  `path` text DEFAULT NULL,
  PRIMARY KEY (`uid_project`,`uid_profiles`),
  KEY `project_profiles_profiles_FK` (`uid_profiles`),
  CONSTRAINT `project_profiles_profiles_FK` FOREIGN KEY (`uid_profiles`) REFERENCES `profiles` (`uid`),
  CONSTRAINT `project_profiles_projects_FK` FOREIGN KEY (`uid_project`) REFERENCES `projects` (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `profile_access` (
  `uid_profile` varchar(32) NOT NULL,
  `uid_user` varchar(32) NOT NULL,
  PRIMARY KEY (`uid_user`,`uid_profile`),
  KEY `profile_access_profiles_FK` (`uid_profile`),
  CONSTRAINT `profile_access_profiles_FK` FOREIGN KEY (`uid_profile`) REFERENCES `profiles` (`uid`),
  CONSTRAINT `profile_access_users_FK` FOREIGN KEY (`uid_user`) REFERENCES `users` (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
