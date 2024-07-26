<?php
	ini_set('display_startup_errors',1);
	ini_set('display_errors',1);
	error_reporting(-1);

	$file = json_decode(file_get_contents("data/project.json"), true);
?>

<html lang="fr">
	<head>
		<meta charset="UTF-8">
		<title>Project List</title>
		<link rel="stylesheet" href="style.css">
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/remixicon@4.3.0/fonts/remixicon.css">
	</head>
	<body>
		<div class="addFormContainer" id="addForm" style="display: none">
			<button class="closeFormButton" id="closeFormButton"><i class="ri-close-line"></i></button>
			<form class="box addForm" method="POST">
				<input class="" type="text" name="name" placeholder="Nom*" required>
				<input class="" type="text" name="path" placeholder="Chemin*" required>
				<input class="" type="text" name="description" placeholder="Description" required>
				<input class="" type="url" name="url" placeholder="URL">
				<input class="" type="url" name="github" placeholder="GitHub">
				<input class="" type="url" name="gitlab" placeholder="GitLab">
				<input class="" type="text" name="badge" placeholder="Tags*" required>
				<div>
					<input type="checkbox" name="edit" id="edit" checked>
					<label for="edit">Ce projet est-il modifiable ?</label>
				</div>
				<button type="input" name="add">Ajouter</button>
			</form>
		</div>

		<div class="top" id="top">
			<button class="addFormButton" id="addFormButton"><i class="ri-add-line"></i></button>

			<input class="search" type="text" id="search" placeholder="Rechercher" autofocus>

			<?php
				if (isset($_GET["filter"])) {
					$filter = explode(",", $_GET["filter"]);
				}

				$badgeList = array();
				foreach($file as $name => $properties) {
					foreach($properties["badge"] as $badge) {
						if (!in_array($badge, $badgeList)) {
							array_push($badgeList, $badge);
						}
					}
				}

				echo "<div class='badgeList'>";
				foreach($badgeList as $badge) {
					if (isset($_GET["filter"]) && in_array($badge, $filter)) {
						echo "<a id='filter' class='badge focus'>" . $badge . "</a>";
					} else {
						echo "<a id='filter' class='badge'>" . $badge . "</a>";
					}
				}
				echo "</div>";
			?>

		</div>

		<div class="listContainer" id="listContainer">

			<?php
				foreach($file as $name => $properties) {
					$box = "<div class='box item'>";

					if ($properties["url"] != "") {
						$box .= "<a class='itemName' id='itemName' title='" . $properties["description"] . "' href='" . $properties["url"] . "' target='_blank'><i class='ri-external-link-line'></i> " . $name . "</a>";
					} else {
						$box .= "<a class='itemName' id='itemName' title='" . $properties["description"] . "'>" . $name . "</a>";
					}
					$box .= "<div class='buttonContainer'>" . pathButton($properties["path"]);

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

					foreach ($properties["badge"] as $badge) {
						$box .= "<a class='badge'>" . $badge . "</a>";
					}

					$box .= "</div></div>";

					if (isset($_GET["filter"]) && array_intersect($filter, $properties["badge"])) {
						echo $box;
					} else {
						if (!isset($_GET["filter"])) {
							echo $box;
						}
					}
				}
			?>
		</div>

		<script src="/public/js/engine.js"></script>
	</body>
</html>

<?php
	function vscodeButton($path) {
		return '<a class="button vscode" href="vscode://file/' . $path . '"><img src="/public/icon/vscode.svg"></a>';
	}
	function pathButton($path) {
		return '<a class="button path" href="file://' . $path . '" target="_blank"><img src="/public/icon/explorer.svg"></a>';
	}
	function githubButton($url) {
		return '<a class="button github" href="' . $url . '" target="_blank"><img src="/public/icon/github.svg"></a>';
	}
	function gitlabButton($url) {
		return '<a class="button gitlab" href="' . $url . '" target="_blank"><img src="/public/icon/gitlab.svg"></a>';
	}
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
				"badge" => explode(" ", $_POST["badge"])
			));

		$file = array_merge($file, $temp);
		file_put_contents("data/project.json", json_encode($file, JSON_PRETTY_PRINT));
	}
?>
