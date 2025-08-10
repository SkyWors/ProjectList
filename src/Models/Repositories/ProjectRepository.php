<?php

namespace App\Models\Repositories;

use App\Enums\Table;
use App\Models\Entities\Project;
use App\Models\Entities\User;
use Exception;
use PDO;
use Tempora\Utils\ApplicationData;
use Tempora\Utils\System;

class ProjectRepository extends Project {

	/**
	 * Create user
	 *
	 * @return Exception | ProjectRepository
	 */
	public function create(): Exception | ProjectRepository {
		$this->setUid(uid: System::uidGen(size: 16, table: Table::PROJECTS->value));

		try {
			ApplicationData::request(
				query: "INSERT INTO " . Table::PROJECTS->value . " (uid, uid_user, name, description, illustration_blob) VALUES (:uid, :uid_user, :name, :description, :illustration_blob)",
				data: [
					"uid" => $this->getUid(),
					"uid_user" => $this->getUser()->getUid(),
					"name" => $this->getName(),
					"description" => $this->getDescription(),
					"illustration_blob" => $this->getIllustrationBlob(),
				]
			);
		} catch (Exception $exception) {
			return $exception;
		}

		return $this;
	}

	public function hydrate(): void {
		try {
			$data = ApplicationData::request(
				query: "SELECT * FROM " . Table::PROJECTS->value . " WHERE uid = :uid",
				data: [
					"uid" => $this->getUid(),
				],
				returnType: PDO::FETCH_ASSOC,
				singleValue: true
			);

			$this
				->setUser(user: (new User())->setUid(uid: $data["uid_user"]))
				->setName(name: $data["name"])
				->setDescription(description: $data["description"])
				->setIllustrationBlob(illustrationBlob: $data["illustration_blob"]);
		} catch (Exception $exception) {
			throw $exception;
		}
	}
}
