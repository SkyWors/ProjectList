<?php

namespace ProjectList;

use
	PDO;

class User {
	private $table = "User";

	function create($email, $password) {
		$uid = uidGen();
		$passwordHash = password_hash($password, PASSWORD_BCRYPT);

		$query = "INSERT INTO " . $this->table . " (oauth_uid, email, password) VALUES (:uid, :email, :password)";
		$queryPrep = DATABASE->prepare($query);
		$queryPrep->bindParam(":uid", $uid);
		$queryPrep->bindParam(":email", $email);
		$queryPrep->bindParam(":password", $passwordHash);
		$queryPrep->execute();

		$project = new Project();
		$project->addProfile($uid, "Projets");

		return $uid;
	}

	function getUID($email) {
		$query = "SELECT oauth_uid FROM " . $this->table . " WHERE email = '" . $email . "'";
		$queryPrep = DATABASE->prepare($query);
		$queryPrep->execute();
		return $queryPrep->fetchAll(PDO::FETCH_COLUMN)[0] ?? NULL;
	}

	function verifyPassword($email, $password) {
		$query = "SELECT password FROM " . $this->table . " WHERE email = '" . $email . "'";
		$queryPrep = DATABASE->prepare($query);
		$queryPrep->execute();
		$passwordHash = $queryPrep->fetchAll(PDO::FETCH_COLUMN)[0] ?? "";

		return password_verify($password, $passwordHash) ?? NULL;
	}
}
