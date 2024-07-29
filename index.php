<?php
	ini_set('display_startup_errors',1);
	ini_set('display_errors',1);
	error_reporting(-1);

	if (!file_exists("data/project.json")) {
		fopen("data/project.json", "a");
		file_put_contents("data/project.json", "{}");
	}

	$file = json_decode(file_get_contents("data/project.json"), true);
	ksort($file);
?>

<?php
	if (isset($_POST["add"])) {
		$description = $_POST["description"] ?? "";
		$url = $_POST["url"] ?? "";
		$github = $_POST["github"] ?? "";
		$gitlab = $_POST["gitlab"] ?? "";
		$checkbox = $_POST["edit"] ?? false;

		$temp = array($_POST["name"]
			=> array(
				"path" => $_POST["path"],
				"edit" => $checkbox,
				"description" => $description,
				"url" => $url,
				"github" => $github,
				"gitlab" => $gitlab,
				"language" => explode(" ", $_POST["language"]),
				"badge" => explode(" ", $_POST["badge"])
			));

		$file = array_merge($file, $temp);
		file_put_contents("data/project.json", json_encode($file, JSON_PRETTY_PRINT));
		header("Refresh:0");
	}
?>

<html lang="fr">
	<head>
		<meta charset="UTF-8">
		<title>Project List</title>
		<link rel="stylesheet" href="/public/css/style.css">
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/remixicon@4.3.0/fonts/remixicon.css">
	</head>
	<body>
		<div class="addFormContainer" id="addForm" style="display: none">
			<div class="actionButtonContainer">
				<button class="actionButton closeFormButton" id="closeFormButton" title="Retour"><i class="ri-close-line"></i></button>
			</div>
			<form class="box addForm" method="POST">
				<input class="" type="text" name="name" placeholder="Nom*" required>
				<input class="" type="text" name="path" placeholder="Chemin*" required>
				<input class="" type="text" name="description" placeholder="Description*" required>
				<input class="" type="url" name="url" placeholder="URL">
				<input class="" type="url" name="github" placeholder="GitHub">
				<input class="" type="url" name="gitlab" placeholder="GitLab">
				<input class="" type="text" name="language" placeholder="Langages*" required>
				<input class="" type="text" name="badge" placeholder="Tags*" required>
				<div>
					<input type="checkbox" name="edit" id="edit" checked>
					<label for="edit">Ce projet est-il modifiable ?</label>
				</div>
				<button type="input" name="add">Ajouter</button>
			</form>
		</div>

		<div id="mainScreen" class="row">
			<?php
				if (isset($_GET["filter"])) {
					$filter = explode(",", $_GET["filter"]);
				} else {
					$filter = array();
				}
				if (isset($_GET["language"])) {
					$languages = explode(",", $_GET["language"]);
				} else {
					$languages = array();
				}

				$badgeList = array();
				foreach($file as $name => $properties) {
					foreach($properties["badge"] as $badge) {
						if (!in_array($badge, $badgeList)) {
							array_push($badgeList, $badge);
						}
					}
				}
				$languageList = array();
				foreach($file as $name => $properties) {
					foreach($properties["language"] as $language) {
						if (!in_array($language, $languageList)) {
							array_push($languageList, $language);
						}
					}
				}

				sort($badgeList);
				sort($languageList);

				echo "<div class='box filterContainer column'>";
					echo "<div class='badgeList'>";
					foreach($badgeList as $badge) {
						if (isset($_GET["filter"]) && in_array($badge, $filter)) {
							echo "<a id='filter' class='badge focus'>" . $badge . "</a>";
						} else {
							echo "<a id='filter' class='badge'>" . $badge . "</a>";
						}
					}
					echo "</div>";

					echo "<div class='languageList'>";
					foreach($languageList as $language) {
						if (isset($_GET["language"]) && in_array($language, $languages)) {
							echo "<a id='language' class='language focus'>" . $language . "</a>";
						} else {
							echo "<a id='language' class='language'>" . $language . "</a>";
						}
					}
					echo "</div>";
				echo "</div>";
			?>

			<div class="column">
				<div class="box top row" id="top">
					<input class="search" type="text" id="search" placeholder="Rechercher" autocomplete="off" autofocus>

					<button class="actionButton addFormButton" id="addFormButton" title="Ajouter"><i class="ri-add-line"></i></button>
					<button class="actionButton importButton" id="importButton" title="Importer"><i class="ri-download-2-line"></i></button>
					<button class="actionButton exportButton" id="exportButton" title="Exporter"><i class="ri-upload-2-line"></i></button>
				</div>

				<div class="listContainer row" id="listContainer">

					<?php
						foreach($file as $name => $properties) {

							$filters = array_merge($properties["language"], $properties["badge"]);

							$box = "<div class='box item'>";

							if ($properties["url"] != "") {
								$box .= "<a class='itemName' id='itemName' title='" . $properties["description"] . "' href='" . $properties["url"] . "' target='_blank'><i class='ri-external-link-line'></i> " . $name . "</a>";
							} else {
								$box .= "<a class='itemName' id='itemName' title='" . $properties["description"] . "'>" . $name . "</a>";
							}
							$box .= "<div class='buttonContainer'>";

							if ($properties["edit"] == true) {
								$box .= vscodeButton($properties["path"]);
							}
							if ($properties["github"] != "") {
								$box .= githubButton($properties["github"]);
							}
							if ($properties["gitlab"] != "") {
								$box .= gitlabButton($properties["gitlab"]);
							}

							$box .= "</div><div class='badgeContainer'>";

							$tempBadgeList = "";
							foreach ($properties["badge"] as $badge) {
								$tempBadgeList .= $badge . " ";
							}
							$tempLanguageList = "";
							foreach ($properties["language"] as $language) {
								$tempLanguageList .= $language . " ";
							}
							$box .= "<a class='badge' title='" . $tempBadgeList . "'>Tags</a>";
							$box .= "<a class='language' title='" . $tempLanguageList . "'>Langages</a>";

							$box .= "</div></div>";

							$projectFilters = array_merge($properties["language"], $properties["badge"]);
							$getFilters = array_merge($languages, $filter);

							if (array_intersect($getFilters, $projectFilters) == $getFilters) {
								echo $box;
							} else {
								if (empty($_GET["language"]) && empty($_GET["filter"])) {
									echo $box;
								}
							}
						}
					?>
				</div>
			</div>
		</div>

		<script src="/public/js/engine.js"></script>
	</body>
</html>

<?php
	function vscodeButton($path) {
		return '<a class="button vscode" href="vscode://file/' . $path . '"><img src="/public/icon/vscode.svg"></a>';
	}
	function githubButton($url) {
		return '<a class="button github" href="' . $url . '" target="_blank"><img src="/public/icon/github.svg"></a>';
	}
	function gitlabButton($url) {
		return '<a class="button gitlab" href="' . $url . '" target="_blank"><img src="/public/icon/gitlab.svg"></a>';
	}
?>
