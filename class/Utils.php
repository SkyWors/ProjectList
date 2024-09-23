<?php

namespace ProjectList;

use
	PDO;

class Utils {
	public static function isUID($uid, $table) {
		$query = "SELECT uid FROM " . $table . " WHERE uid = :uid";
		$queryPrep = DATABASE->prepare($query);
		$queryPrep->bindParam(":uid", $uid);
		$queryPrep->execute();
		return $queryPrep->fetchAll(PDO::FETCH_COLUMN)[0] ?? NULL;
	}

	public static function uidGen($size) {
		$char = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ_";
		$result = "";
		$randomByte = random_bytes($size);

		foreach (str_split($randomByte) as $byte) {
			$random = ord($byte) % strlen($char);
			$result .= $char[$random];
		}

		return $result;
	}

	public static function jwtCreator($userUID) {
		$header = json_encode(["typ" => "JWT", "alg" => "HS256"]);
		$payload = json_encode(["user_id" => $userUID]);

		$base64UrlHeader = str_replace(["+", "/", "="], ["-", "_", ""], base64_encode($header));
		$base64UrlPayload = str_replace(["+", "/", "="], ["-", "_", ""], base64_encode($payload));

		$signature = hash_hmac("sha256", $base64UrlHeader . "." . $base64UrlPayload, $_ENV["SIGNATURE_KEY"], true);
		$base64UrlSignature = str_replace(["+", "/", "="], ["-", "_", ""], base64_encode($signature));

		$jwt = $base64UrlHeader . "." . $base64UrlPayload . "." . $base64UrlSignature;

		return $jwt;
	}
}
