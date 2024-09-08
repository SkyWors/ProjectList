<?php

namespace ProjectList;

use
	PDO;

class Utils {
	public static function isUID($uid, $table) {
		$query = "SELECT uid FROM " . $table . " WHERE uid = '" . $uid . "'";
		$queryPrep = DATABASE->prepare($query);
		$queryPrep->execute();
		return $queryPrep->fetchAll(PDO::FETCH_COLUMN)[0] ?? NULL;
	}
}
