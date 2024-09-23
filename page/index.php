<?php
	if (!isset($_SESSION["userUID"])) {
		header("Location: /login");
		exit();
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
		setcookie("profile", $selectedProfile, time() + 60*60*24*30);
	} else {
		$selectedProfile = $profilesName[0];
		if (isset($_COOKIE["profile"]) && in_array($_COOKIE["profile"], $profilesName)) {
			$selectedProfile = $_COOKIE["profile"];
		}
	}

	// Get projects from selected profile page
	$projectsId = $project->getProjects($_SESSION["userUID"], $selectedProfile);
	if (!empty($projectsId)) {
		foreach ($projectsId as $uid) {
			array_push($projects, $project->getProperties($uid["uid"]));
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
	sort($languageList);

	// Get tags from projects
	foreach ($projects as $element) {
		foreach (explode(" ", $element["tag"]) as $tag) {
			if (!in_array($tag, $tagList)) {
				array_push($tagList, $tag);
			}
		}
	}
	sort($tagList);

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

	<?php include "template/header.php" ?>

	<body>
		<div class="formContainer" id="addForm" style="display: none">
			<form class="box form column" id="form" method="POST">
				<a>Ajouter un projet</a>
				<div class="row">
					<div class="column">
						<input id="formName" type="text" name="name" placeholder="Nom*" maxlength="50" required>
						<input id="formPath" type="text" name="path" placeholder="Chemin" maxlength="100">
						<input id="formDesc" type="text" name="description" placeholder="Description*" required>
					</div>
					<div class="column">
						<input id="formURL" type="url" name="url" placeholder="URL"  maxlength="100">
						<input id="formGitHub" type="url" name="github" placeholder="GitHub" maxlength="100">
						<input id="formGitLab" type="url" name="gitlab" placeholder="GitLab" maxlength="100">
					</div>
					<div class="column">
						<input id="formLang" type="text" name="language" placeholder="Langages*" maxlength="100" required>
						<input id="formBadge" type="text" name="badge" placeholder="Tags*" maxlength="100" required>
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
					<?php foreach ($profilesName as $element) { ?>
						<tr>
							<td>
								<input type='text' data-id='<?= htmlspecialchars($element) ?>' value='<?= htmlspecialchars($element) ?>' id='profil'>
							</td>
							<td>
								<div class='profilButtonContainer'>
									<button class='simpleButton profilSaveButton' id='saveProfil' value='<?= htmlspecialchars($element) ?>' title='Enregistrer'><i class='ri-save-2-line'></i></button>
									<?php if (count($profilesName) > 1) { ?>
										<button class='simpleButton profilDeleteButton' id='deleteProfil' value='<?= htmlspecialchars($element) ?>' onclick='return confirmForm()' title='Retirer'><i class='ri-delete-bin-line'></i></button>
									<?php } ?>
								</div>
							</td>
						</tr>
					<?php } ?>
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
								if ($element == $selectedProfile) { ?>
									<option selected><?= htmlspecialchars($element) ?></option>
								<?php } else { ?>
									<option><?= htmlspecialchars($element) ?></option>
								<?php }
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
						<button class="actionButton exportButton" id="exportButton" value="<?= $selectedProfile ?>" title="Exporter"><i class="ri-upload-2-line"></i></button>
						<button class="actionButton themeButton" id="themeButton"><i class="ri-sun-line"></i></button>
						<input class="search" type="text" id="search" placeholder="Rechercher" autocomplete="off" autofocus>
						<a class="simpleButton logoutButton" href="logout" title="Se déconnecter"><i class="ri-logout-box-r-line"></i></a>
					</div>
				</div>

				<div class="row">
					<?php
						if (!empty($tagList)) {
							include "template/taglist.php";
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
										include "template/item.php";
									} else {
										if (isset($selectedLanguages) && isset($selectedTags)) {
											include "template/item.php";
										}
									}
								} else {
									include "template/item.php";
								}
							}
						?>
					</div>
				</div>
			</div>
		</div>

		<?php include "template/footer.php" ?>

		<script> var projectList = <?= json_encode($projects) ?>; </script>
		<script src="/public/js/theme.js"></script>
		<script src="/public/js/engine.js"></script>
	</body>
</html>
