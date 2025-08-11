<?php

namespace App\Models\Repositories;

use App\Enums\Table;
use App\Models\Entities\Profile;
use Exception;
use PDO;
use Tempora\Utils\ApplicationData;
use Tempora\Utils\System;

class ProfileRepository extends Profile {

	/**
	 * Create profile
	 *
	 * @return Exception | ProfileRepository
	 */
	public function create(): Exception | ProfileRepository {
		$this->setUid(uid: System::uidGen(size: 16, table: Table::PROFILES->value));

		try {
			ApplicationData::request(
				query: "INSERT INTO " . Table::PROFILES->value . " (uid, uid_creator, name) VALUES (:uid, :uid_creator, :name)",
				data: [
					"uid" => $this->getUid(),
					"uid_creator" => $this->getCreator()->getUid(),
					"name" => $this->getName(),
				]
			);
		} catch (Exception $exception) {
			return $exception;
		}

		return $this;
	}

	/**
	 * Get profile's projects
	 *
	 * @return Exception | bool
	 */
	public function getProjects(): Exception | array {
		try {
			return ApplicationData::request(
				query: "SELECT uid_project FROM " . Table::PROJECT_PROFILES->value . " WHERE uid_profile = :uid_profile",
				data: [
					"uid_profile" => $this->getUid(),
				],
				returnType: PDO::FETCH_COLUMN
			);
		} catch (Exception $exception) {
			return $exception;
		}
	}

	public function addProject(ProjectRepository $project): Exception | bool {
		try {
			ApplicationData::request(
				query: "INSERT INTO " . Table::PROJECT_PROFILES->value . " (uid_profile, uid_project) VALUES (:uid_profile, :uid_project)",
				data: [
					"uid_profile" => $this->getUid(),
					"uid_project" => $project->getUid(),
				]
			);
			return true;
		} catch (Exception $exception) {
			return $exception;
		}
	}
}
