<?php
	require_once __DIR__ . "/../start.php";

	if (!isset($_SESSION["userUID"])) {
		header("Location: /login");
	}

	use
		ProjectList\Project;

	$project = new Project;
	$profiles = $project->getProfiles($_SESSION["userUID"]);
	$profilesName = array();
	$projects = array();
	$languageList = array();
	$tagList = array();

	// Get profiles name
	foreach ($profiles as $element) {
		array_push($profilesName, $element["name"]);
	}

	// Get selected profile page
	if (isset($_GET["profile"]) && in_array($_GET["profile"], $profilesName)) {
		$selectedProfile = $_GET["profile"];
	} else {
		$selectedProfile = $profilesName[0];
	}

	// Get projects from selected profile page
	$projectsId = $project->getProjects($_SESSION["userUID"], $selectedProfile);
	if (!empty($projectsId)) {
		foreach ($projectsId as $id) {
			array_push($projects, $project->getProperties($id["id"]));
		}
	}

	// Get languages from projects
	foreach ($projects as $element) {
		foreach (explode(" ", $element["language"]) as $language) {
			if (!in_array($language, $languageList)) {
				array_push($languageList, $language);
			}
		}
	}

	// Get tags from projects
	foreach ($projects as $element) {
		foreach (explode(" ", $element["tag"]) as $tag) {
			if (!in_array($tag, $tagList)) {
				array_push($tagList, $tag);
			}
		}
	}

	isset($_GET["language"]) ? $selectedLanguages = explode(",", $_GET["language"]) : $selectedLanguages = null;
	isset($_GET["tag"]) ? $selectedTags = explode(",", $_GET["tag"]) : $selectedTags = null;

	require "event/add.php";
	require "event/delete.php";
	require "event/update.php";
	require "event/import.php";
	require "event/addProfil.php";
	require "event/deleteProfil.php";
	require "event/updateProfil.php";
?>

<html lang="fr" data-theme="dark">
	<head>
		<meta charset="UTF-8">
		<title>Project List</title>
		<link rel="stylesheet" href="/public/css/style.css">
		<link rel="stylesheet" href="/public/css/import/remixicon.css">
	</head>
	<body>
		<div class="formContainer" id="addForm" style="display: none">
			<form class="box form column" id="form" method="POST">
				<a>Ajouter un projet</a>
				<div class="row">
					<div class="column">
						<input id="formName" type="text" name="name" placeholder="Nom*" required>
						<input id="formPath" type="text" name="path" placeholder="Chemin">
						<input id="formDesc" type="text" name="description" placeholder="Description*" required>
					</div>
					<div class="column">
						<input id="formURL" type="url" name="url" placeholder="URL">
						<input id="formGitHub" type="url" name="github" placeholder="GitHub">
						<input id="formGitLab" type="url" name="gitlab" placeholder="GitLab">
					</div>
					<div class="column">
						<input id="formLang" type="text" name="language" placeholder="Langages*" required>
						<input id="formBadge" type="text" name="badge" placeholder="Tags*" required>
						<div>
							<input type="checkbox" name="vscode" id="vscode" disabled>
							<label for="vscode">Activer VSCode ?</label>
						</div>
						<div>
							<input type="checkbox" name="idea" id="idea" disabled>
							<label for="idea">Activer Idea ?</label>
						</div>
					</div>
				</div>
				<button type="input" name="add" id="add">Ajouter</button>
			</form>
		</div>

		<div class="formContainer" id="profilForm" style="display: none">
			<div class="box form column profilForm" id="form">
				<a>Ajouter un profil</a>
				<table>
					<?php
						foreach ($profilesName as $element) {
							echo "
					<tr>
						<td>
							<input type='text' data-id='" . $element . "' value='" . $element . "' id='profil'>
						</td>";
							echo "
						<td>
							<div class='profilButtonContainer'>
								<button class='simpleButton profilSaveButton' id='saveProfil' value='" . $element . "' title='Enregistrer'><i class='ri-save-2-line'></i></button>
								<button class='simpleButton profilDeleteButton' id='deleteProfil' value='" . $element . "' onclick='return confirmForm()' title='Retirer'><i class='ri-delete-bin-line'></i></button>
							</div>
						</td>
					</tr>";
						}
					?>
					<tr>
						<td>
							<input type="text" id="profilAdd" placeholder="Nom">
						</td>
						<td>
							<div class="profilButtonContainer">
								<button class="simpleButton profilAddButton" id="addProfilField" title="Ajouter un profil"><i class='ri-add-line'></i></button>
							</div>
						</td>
					</tr>
				</table>
			</div>
		</div>

		<div class="main">
			<div class="backgroundTop"></div>
			<div class="column">
				<div class="row box top">
					<select id="profilSelect">
						<?php
							foreach ($profilesName as $element) {
								if ($element == $selectedProfile) {
									echo "<option selected>" . htmlspecialchars($element) . "</option>";
								} else {
									echo "<option>" . htmlspecialchars($element) . "</option>";
								}
							}
						?>
					</select>
					<div class="profilActionButton">
						<?= getArrowProfil($profilesName, $selectedProfile) ?>
						<button class="simpleButton arrowButton editProfilButton" id="profilEditButton" title="Ajouter un profil"><i class='ri-pencil-line'></i></button>
					</div>
					<noscript>
						<div class="box noscript">
							Merci d'activer les scripts pour le bon fonctionnement de l'application.
						</div>
					</noscript>
					<div class="row topSearch" id="top">
						<div class="statsBox">
							<div class="column stats">
								<a class="title"><i class="ri-archive-line"></i> Projets</a>
								<a class="number"><?= !empty($projectsId) ? count($projectsId) : 0 ?></a>
							</div>
						</div>

						<div class="statsBox">
							<div class="column stats">
								<a class="title"><i class="ri-eye-line"></i> Affichés</a>
								<a id="statsSelectProject" class="number"></a>
							</div>
						</div>

						<div class="statsBox">
							<div class="column stats">
								<a class="title"><i class="ri-global-line"></i> Languages</a>
								<a id="statsSelectProject" class="number"><?= count($languageList) ?></a>
							</div>
						</div>

						<div class="statsBox">
							<div class="column stats">
								<a class="title"><i class="ri-bookmark-line"></i> Badges</a>
								<a id="statsSelectProject" class="number"><?= count($tagList) ?></a>
							</div>
						</div>

						<button class="actionButton addFormButton" id="addFormButton" title="Ajouter"><i class="ri-add-line"></i></button>
						<form method="POST" id="importForm" enctype="multipart/form-data">
							<input id="importField" type="file" accept="application/JSON" style="display: none" name="import">
							<label class="actionButton importButton" for="importField" title="Importer"><i class="ri-download-2-line"></i></label>
						</form>
						<button class="actionButton exportButton" id="exportButton" value="<?= $selectedFile ?>" title="Exporter"><i class="ri-upload-2-line"></i></button>
						<button class="actionButton themeButton" id="themeButton"><i class="ri-sun-line"></i></button>
						<input class="search" type="text" id="search" placeholder="Rechercher" autocomplete="off" autofocus>
						<a class="simpleButton logoutButton" href="logout" title="Se déconnecter"><i class="ri-logout-box-r-line"></i></a>
					</div>
				</div>

				<div class="row">
					<?php
						if (!empty($tagList)) {
							echo createFilterList($languageList, $tagList, $selectedLanguages, $selectedTags);
						}
					?>

					<div class="noItemContainer" id="noItem" style="display: none">
						<div class="box noItem">
							<a>Aucun projets trouvés.</a>
						</div>
					</div>

					<div class="listContainer" id="listContainer">
						<?php
							foreach($projects as $element) {
								$projectFilters = array_merge(explode(" ", $element["language"]), explode(" ", $element["tag"]));

								if ($selectedLanguages != null && $selectedTags != null) {
									$getFilters = array_merge($selectedLanguages, $selectedTags);
								} else {
									if ($selectedLanguages != null) {
										$getFilters = $selectedLanguages;
									} else {
										$getFilters = $selectedTags;
									}
								}

								if ($getFilters) {
									if (array_intersect($getFilters, $projectFilters) == $getFilters) {
										echo createItem($element);
									} else {
										if (isset($selectedLanguages) && isset($selectedTags)) {
											echo createItem($element);
										}
									}
								} else {
									echo createItem($element);
								}
							}
						?>
					</div>
				</div>
			</div>
		</div>

		<footer>
			<i class="ri-archive-line"></i> ProjectList - Développé avec 🧡 par <a class="footerLink" href="https://github.com/SkyWors" target="_blank">SkyWors</a> <i class="ri-external-link-line"></i>
		</footer>

		<script src="/public/js/theme.js"></script>
		<script src="/public/js/engine.js"></script>
	</body>
</html>
