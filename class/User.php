<?php

namespace ProjectList;

use
	PDO;

class User {
	private $table = "User";

	function checkUser($data = array()) {
		if (!empty($data)) {
			$whereSql = " WHERE oauth_uid = '" . $data['oauth_uid'] . "'";
			$checkQuery = "SELECT * FROM " . $this->table . $whereSql;
			$queryPrep = DATABASE->prepare($checkQuery);
			$queryPrep->execute();
			$result = $queryPrep->fetchAll(PDO::FETCH_ASSOC);

			if ($result != null) {
				$query = "UPDATE " . $this->table . " SET oauth_uid = " . $data['oauth_uid'] . $whereSql;
				DATABASE->query($query);
			} else {
				$query = "INSERT INTO " . $this->table . " (oauth_uid, email) VALUES (:oauth_uid, :email)";
				$queryPrep = DATABASE->prepare($query);
				$queryPrep->bindParam(':oauth_uid', $data["oauth_uid"]);
				$queryPrep->bindParam(':email', $data["email"]);
				$queryPrep->execute();
			}

			$result = DATABASE->query($checkQuery);
			$userData = $result->fetchAll(PDO::FETCH_ASSOC)[0];
		}

		return !empty($userData) ? $userData : false;
	}
}
