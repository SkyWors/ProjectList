<?php

namespace ProjectList;

use
	PDO;

class Project {
	private $profileTable = "Profile";
	private $projectTable = "Project";
	private $profileProjectTable = "ProfileProject";
	private $applicationTable = "Application";

	public function getProjects($userUID, $profileName) {
		$profileUID = $this->getProfile($userUID, $profileName);

		if (!$profileUID) {
			return null;
		}

		$query = "SELECT p.uid FROM " . $this->projectTable . " p, " . $this->profileProjectTable . " pp WHERE pp.uid_Profile = '" . $profileUID . "' AND pp.uid_Project = p.uid ORDER BY p.name";
		$queryPrep = DATABASE->prepare($query);
		$queryPrep->execute();
		$projects = $queryPrep->fetchAll(PDO::FETCH_ASSOC) ?? null;

		if ($projects) {
			return $projects;
		}
		return null;
	}

	public function getProject($userUID, $profileName, $projectName) {
		$query = "SELECT project.uid FROM " . $this->projectTable . " project, " . $this->profileTable . " profile, " . $this->profileProjectTable . " profilep WHERE profilep.uid_Project = project.uid AND profile.uid = profilep.uid_Profile AND profile.name = '" . $profileName . "' AND project.uid_User = '" . $userUID . "' AND project.name = '" . $projectName . "'";
		$queryPrep = DATABASE->prepare($query);
		$queryPrep->execute();
		return $queryPrep->fetchAll(PDO::FETCH_COLUMN)[0];
	}

	public function getProfile($userUID, $profilName) {
		$query = "SELECT uid FROM " . $this->profileTable . " WHERE uid_User = '" . $userUID . "' AND name = '" . $profilName . "'";
		$queryPrep = DATABASE->prepare($query);
		$queryPrep->execute();
		return $queryPrep->fetchAll(PDO::FETCH_COLUMN)[0];
	}

	public function getProfiles($userUID) {
		$query = "SELECT * FROM " . $this->profileTable . " WHERE uid_User = '" . $userUID . "'";
		$queryPrep = DATABASE->prepare($query);
		$queryPrep->execute();
		return $queryPrep->fetchAll(PDO::FETCH_ASSOC);
	}

	public function getProperties($projectUID) {
		$query = "SELECT * FROM " . $this->projectTable . " p, " . $this->applicationTable . " a WHERE p.uid = :uid AND a.uid_Project = :uid";
		$queryPrep = DATABASE->prepare($query);
		$queryPrep->bindParam(":uid", $projectUID);
		$queryPrep->execute();
		return $queryPrep->fetchAll(PDO::FETCH_ASSOC)[0];
	}

	public function addProject($userUID, $profilName, $properties) {
		$projectUID = uidGen();
		while (Utils::isUID($projectUID, $this->projectTable) != null) {
			$projectUID = uidGen();
		}

		$query = "INSERT INTO " . $this->projectTable . " (uid, uid_User, name, description, path, url, language, tag) VALUES (:uid, :uid_User, :name, :description, :path, :url, :language, :tag)";
		$queryPrep = DATABASE->prepare($query);
		$queryPrep->bindParam(":uid", $projectUID);
		$queryPrep->bindParam(":uid_User", $userUID);
		$queryPrep->bindParam(":name", $properties["name"]);
		$queryPrep->bindParam(":description", $properties["description"]);
		$queryPrep->bindParam(":path", $properties["path"]);
		$queryPrep->bindParam(":url", $properties["url"]);
		$queryPrep->bindParam(":language", $properties["language"]);
		$queryPrep->bindParam(":tag", $properties["tag"]);
		$queryPrep->execute();

		$profileUID = $this->getProfile($userUID, $profilName);

		$vscode = (int)$properties["vscode"];
		$idea = (int)$properties["idea"];

		$query = "INSERT INTO " . $this->applicationTable . " (uid_Project, github, gitlab, vscode, idea) VALUES (:uid, :github, :gitlab, :vscode, :idea)";
		$queryPrep = DATABASE->prepare($query);
		$queryPrep->bindParam(":uid", $projectUID);
		$queryPrep->bindParam(":github", $properties["github"]);
		$queryPrep->bindParam(":gitlab", $properties["gitlab"]);
		$queryPrep->bindParam(":vscode", $vscode);
		$queryPrep->bindParam(":idea", $idea);
		$queryPrep->execute();

		$query = "INSERT INTO " . $this->profileProjectTable . " (uid_Project, uid_Profile) VALUES ('" . $projectUID . "', '" . $profileUID . "')";
		$queryPrep = DATABASE->prepare($query);
		$queryPrep->execute();
	}

	public function updateProject($userUID, $profileName, $properties) {
		$projectId = $this->getProject($userUID, $profileName, $properties["oldname"]);
		$name = htmlspecialchars($properties["name"]);

		$query = "UPDATE " . $this->projectTable . " SET name = :name, description = :description, path = :path, url = :url, language = :language, tag = :tag WHERE uid = :uid";
		$queryPrep = DATABASE->prepare($query);
		$queryPrep->bindParam(":uid", $projectId);
		$queryPrep->bindParam(":name", $name);
		$queryPrep->bindParam(":description", $properties["description"]);
		$queryPrep->bindParam(":path", $properties["path"]);
		$queryPrep->bindParam(":url", $properties["url"]);
		$queryPrep->bindParam(":language", $properties["language"]);
		$queryPrep->bindParam(":tag", $properties["tag"]);
		$queryPrep->execute();

		$vscode = (int)$properties["vscode"];
		$idea = (int)$properties["idea"];

		$query = "UPDATE " . $this->applicationTable . " SET github = :github, gitlab = :gitlab, vscode = :vscode, idea = :idea WHERE uid_Project = :uid";
		$queryPrep = DATABASE->prepare($query);
		$queryPrep->bindParam(":uid", $projectId);
		$queryPrep->bindParam(":github", $properties["github"]);
		$queryPrep->bindParam(":gitlab", $properties["gitlab"]);
		$queryPrep->bindParam(":vscode", $vscode);
		$queryPrep->bindParam(":idea", $idea);
		$queryPrep->execute();
	}

	public function deleteProject($projectUID) {
		$query = "DELETE FROM " . $this->projectTable . " WHERE uid = '" . $projectUID . "'";
		$queryPrep = DATABASE->prepare($query);
		$queryPrep->execute();
	}

	public function addProfile($userUID, $profileName) {
		$uid = uidGen();
		while (Utils::isUID($uid, $this->profileTable) != null) {
			$uid = uidGen();
		}

		$query = "INSERT INTO " . $this->profileTable . " (uid, uid_User, name) VALUES (:uid, :uid_User, :name)";
		$queryPrep = DATABASE->prepare($query);
		$queryPrep->bindParam(":uid", $uid);
		$queryPrep->bindParam(":uid_User", $userUID);
		$queryPrep->bindParam(":name", $profileName);
		$queryPrep->execute();
	}

	public function updateProfile($userUID, $oldName, $profileName) {
		$query = "UPDATE " . $this->profileTable . " SET name = :name WHERE uid_User = :uid AND name = :oldname";
		$queryPrep = DATABASE->prepare($query);
		$queryPrep->bindParam(":uid", $userUID);
		$queryPrep->bindParam(":oldname", $oldName);
		$queryPrep->bindParam(":name", $profileName);
		$queryPrep->execute();
	}

	public function deleteProfile($userUID, $profileName) {
		$query = "DELETE FROM " . $this->profileTable . " WHERE uid_User = :uid AND name = :name";
		$queryPrep = DATABASE->prepare($query);
		$queryPrep->bindParam(":uid", $userUID);
		$queryPrep->bindParam(":name", $profileName);
		$queryPrep->execute();
	}
}
