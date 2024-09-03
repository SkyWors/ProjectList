<?php

namespace ProjectList;

use
	PDO;

class Project {
	private $profilTable = "Profile";
	private $projectTable = "Project";
	private $profileProjectTable = "ProfileProject";
	private $applicationTable = "Application";

	public function getProjects($uid, $profilName) {
		$query = "SELECT id FROM " . $this->profilTable . " p WHERE id_User = '" . $uid . "' AND name = '" . $profilName . "'";
		$queryPrep = DATABASE->prepare($query);
		$queryPrep->execute();
		$profilId = $queryPrep->fetchAll(PDO::FETCH_COLUMN)[0] ?? null;

		if (!$profilId) {
			return null;
		}

		$query = "SELECT p.id FROM " . $this->projectTable . " p, " . $this->profileProjectTable . " pp WHERE pp.id_Profile = " . $profilId . " AND pp.id_Project = p.id";
		$queryPrep = DATABASE->prepare($query);
		$queryPrep->execute();
		$projects = $queryPrep->fetchAll(PDO::FETCH_ASSOC) ?? null;

		if ($projects) {
			return $projects;
		}
		return null;
	}

	public function getProject($uid, $profileName, $projectName) {
		$query = "SELECT project.id FROM " . $this->projectTable . " project, " . $this->profilTable . " profile, " . $this->profileProjectTable . " profilep WHERE profilep.id_Project = project.id AND profile.id = profilep.id_Profile AND profile.name = '" . $profileName . "' AND project.id_User = '" . $uid . "' AND project.name = '" . $projectName . "'";
		$queryPrep = DATABASE->prepare($query);
		$queryPrep->execute();
		return $queryPrep->fetchAll(PDO::FETCH_COLUMN)[0];
	}

	public function getProfile($uid, $profilName) {
		$query = "SELECT id FROM " . $this->profilTable . " WHERE id_User = '" . $uid . "' AND name = '" . $profilName . "'";
		$queryPrep = DATABASE->prepare($query);
		$queryPrep->execute();
		return $queryPrep->fetchAll(PDO::FETCH_COLUMN)[0];
	}

	public function getProfiles($uid) {
		$query = "SELECT * FROM " . $this->profilTable . " WHERE id_User = '" . $uid . "'";
		$queryPrep = DATABASE->prepare($query);
		$queryPrep->execute();
		return $queryPrep->fetchAll(PDO::FETCH_ASSOC);
	}

	public function getProperties($projectId) {
		$query = "SELECT * FROM " . $this->projectTable . " p, " . $this->applicationTable . " a WHERE p.id = :id AND a.id_Project = :id";
		$queryPrep = DATABASE->prepare($query);
		$queryPrep->bindParam(":id", $projectId);
		$queryPrep->execute();
		return $queryPrep->fetchAll(PDO::FETCH_ASSOC)[0];
	}

	public function addProject($uid, $profilName, $properties) {
		$query = "INSERT INTO " . $this->projectTable . " (id_User, name, description, path, url, language, tag) VALUES (:uid, :name, :description, :path, :url, :language, :tag)";
		$queryPrep = DATABASE->prepare($query);
		$queryPrep->bindParam(":uid", $uid);
		$queryPrep->bindParam(":name", $properties["name"]);
		$queryPrep->bindParam(":description", $properties["description"]);
		$queryPrep->bindParam(":path", $properties["path"]);
		$queryPrep->bindParam(":url", $properties["url"]);
		$queryPrep->bindParam(":language", $properties["language"]);
		$queryPrep->bindParam(":tag", $properties["tag"]);
		$queryPrep->execute();

		$projectId = DATABASE->lastInsertId();
		$profilId = $this->getProfile($uid, $profilName);

		$vscode = (int)$properties["vscode"];
		$idea = (int)$properties["idea"];

		$query = "INSERT INTO " . $this->applicationTable . " (id_Project, github, gitlab, vscode, idea) VALUES (:id, :github, :gitlab, :vscode, :idea)";
		$queryPrep = DATABASE->prepare($query);
		$queryPrep->bindParam(":id", $projectId);
		$queryPrep->bindParam(":github", $properties["github"]);
		$queryPrep->bindParam(":gitlab", $properties["gitlab"]);
		$queryPrep->bindParam(":vscode", $vscode);
		$queryPrep->bindParam(":idea", $idea);
		$queryPrep->execute();

		$query = "INSERT INTO " . $this->profileProjectTable . " (id_Project, id_Profile) VALUES (" . $projectId . ", " . $profilId . ")";
		$queryPrep = DATABASE->prepare($query);
		$queryPrep->execute();
	}

	public function updateProject($uid, $profileName, $properties) {
		$projectId = $this->getProject($uid, $profileName, $properties["oldname"]);

		$query = "UPDATE " . $this->projectTable . " SET name = :name, description = :description, path = :path, url = :url, language = :language, tag = :tag WHERE id = :id";
		$queryPrep = DATABASE->prepare($query);
		$queryPrep->bindParam(":id", $projectId);
		$queryPrep->bindParam(":name", $properties["name"]);
		$queryPrep->bindParam(":description", $properties["description"]);
		$queryPrep->bindParam(":path", $properties["path"]);
		$queryPrep->bindParam(":url", $properties["url"]);
		$queryPrep->bindParam(":language", $properties["language"]);
		$queryPrep->bindParam(":tag", $properties["tag"]);
		$queryPrep->execute();

		$vscode = (int)$properties["vscode"];
		$idea = (int)$properties["idea"];

		$query = "UPDATE " . $this->applicationTable . " SET github = :github, gitlab = :gitlab, vscode = :vscode, idea = :idea WHERE id_Project = :id";
		$queryPrep = DATABASE->prepare($query);
		$queryPrep->bindParam(":id", $projectId);
		$queryPrep->bindParam(":github", $properties["github"]);
		$queryPrep->bindParam(":gitlab", $properties["gitlab"]);
		$queryPrep->bindParam(":vscode", $vscode);
		$queryPrep->bindParam(":idea", $idea);
		$queryPrep->execute();
	}

	public function deleteProject($uid, $profileName, $projectName) {
		$projectId = $this->getProject($uid, $profileName, $projectName);

		$query = "DELETE FROM " . $this->profileProjectTable . " WHERE id_Project = " . $projectId;
		$queryPrep = DATABASE->prepare($query);
		$queryPrep->execute();

		$query = "DELETE FROM " . $this->applicationTable . " WHERE id_Project = " . $projectId;
		$queryPrep = DATABASE->prepare($query);
		$queryPrep->execute();

		$query = "DELETE FROM " . $this->projectTable . " WHERE id = " . $projectId;
		$queryPrep = DATABASE->prepare($query);
		$queryPrep->execute();
	}

	public function addProfile($uid, $profileName) {
		$query = "INSERT INTO " . $this->profilTable . " (id_User, name) VALUES (:uid, :name)";
		$queryPrep = DATABASE->prepare($query);
		$queryPrep->bindParam(":uid", $uid);
		$queryPrep->bindParam(":name", $profileName);
		$queryPrep->execute();
	}

	public function updateProfile($uid, $oldName, $profileName) {
		$query = "UPDATE " . $this->profilTable . " SET name = :name WHERE id_User = :uid AND name = :oldname";
		$queryPrep = DATABASE->prepare($query);
		$queryPrep->bindParam(":uid", $uid);
		$queryPrep->bindParam(":oldname", $oldName);
		$queryPrep->bindParam(":name", $profileName);
		$queryPrep->execute();
	}

	public function deleteProfile($uid, $profileName) {
		$query = "DELETE FROM " . $this->profilTable . " WHERE id_User = :uid AND name = :name";
		$queryPrep = DATABASE->prepare($query);
		$queryPrep->bindParam(":uid", $uid);
		$queryPrep->bindParam(":name", $profileName);
		$queryPrep->execute();
	}
}
