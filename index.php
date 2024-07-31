<?php
	ini_set('display_startup_errors',1);
	ini_set('display_errors',1);
	error_reporting(-1);

	require("function/createButton.php");
	require("function/addProject.php");
	require("function/deleteProject.php");
	require("function/createItem.php");
	require("function/createTagList.php");

	require("background/fileEngine.php");
	require("background/tagList.php");

	require("event/add.php");
	require("event/delete.php");
	require("event/update.php");
	require("event/import.php");
?>

<html lang="fr" data-theme="dark">
	<head>
		<meta charset="UTF-8">
		<title>Project List</title>
		<link rel="stylesheet" href="/public/css/style.css">
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/remixicon@4.3.0/fonts/remixicon.css">
	</head>
	<body>
		<div class="backgroundTop"></div>
		<div class="row">
			<?php
				if (!empty($badgeList)) {
					echo createTagList($badgeList, $languageList, $filter, $languages);
				}
			?>

			<div class="column">
				<div class="top row">
					<div class="box row" id="top">
						<input class="search" type="text" id="search" placeholder="Rechercher" autocomplete="off" autofocus>
						<button class="actionButton addFormButton" id="addFormButton" title="Ajouter"><i class="ri-add-line"></i></button>
						<button class="actionButton closeFormButton" id="closeFormButton" title="Annuler" style="display: none"><i class="ri-close-line"></i></button>
						<form method="POST" id="importForm" enctype="multipart/form-data">
							<input id="importField" type="file" accept="application/JSON" style="display: none" name="import">
							<label class="actionButton importButton" for="importField" title="Importer"><i class="ri-download-2-line"></i></label>
						</form>
						<button class="actionButton exportButton" id="exportButton" title="Exporter"><i class="ri-upload-2-line"></i></button>
						<button class="actionButton themeButton" id="themeButton"><i class="ri-sun-line"></i></button>
					</div>

					<div class="box statsBox">
						<div class="column stats">
							<a class="title"><i class="ri-archive-line"></i> Projets</a>
							<a class="number"><?= count($file) ?></a>
						</div>
					</div>

					<div class="box statsBox">
						<div class="column stats">
							<a class="title"><i class="ri-eye-line"></i> Affichés</a>
							<a id="statsSelectProject" class="number"></a>
						</div>
					</div>

					<div class="box statsBox">
						<div class="column stats">
							<a class="title"><i class="ri-global-line"></i> Languages</a>
							<a id="statsSelectProject" class="number"><?= count($languageList) ?></a>
						</div>
					</div>

					<div class="box statsBox">
						<div class="column stats">
							<a class="title"><i class="ri-bookmark-line"></i> Badges</a>
							<a id="statsSelectProject" class="number"><?= count($badgeList) ?></a>
						</div>
					</div>
				</div>

				<div class="addFormContainer" id="addForm" style="display: none">
					<form class="box addForm column" id="form" method="POST">
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
									<input type="checkbox" name="edit" id="edit" disabled>
									<label for="edit">Activer VSCode ?</label>
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

				<div class="listContainer row" id="listContainer">
					<?php
						foreach($file as $name => $properties) {
							echo createItem($name, $properties, $languages, $filter);
						}
					?>
				</div>
			</div>
		</div>

		<script src="/public/js/theme.js"></script>
		<script src="/public/js/engine.js"></script>
	</body>
</html>
