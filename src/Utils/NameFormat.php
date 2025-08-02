<?php

namespace App\Utils;

class NameFormat {
	/**
	 * Format language name
	 *
	 * @param string $name Language identifiant
	 *
	 * @return string
	 */
	public static function langFormat(string $name): string {
		switch ($name) {
			case "fr_FR":
				return "🇫🇷";
			case "en_GB":
				return "🇬🇧";
			default:
				return "";
		}
	}
}
