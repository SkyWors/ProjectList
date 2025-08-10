<?php
	use App\Enums\Path;
	use App\Models\Entities\Project;
	use App\Models\Repositories\ProjectRepository;
	use Tempora\Utils\ElementBuilder\ElementBuilder;
	use Tempora\Utils\ElementBuilder\Select;
	use Tempora\Utils\Lang;
	use Tempora\Utils\System;

	$action = new ElementBuilder;
	$action->setElement(element: "button");
?>

<?php include Path::COMPONENT_DRAWERS->value . "/drawer.php"; ?>

<main>
	<header>
		<?=
			$action
				->setAttributs(
					attributs: [
						"class" => "action export",
						"aria-label" => Lang::translate(key: "MAIN_EXPORT"),
						"title" => Lang::translate(key: "MAIN_EXPORT"),
					]
				)
				->setContent(content: "<i class=\"ri-upload-2-line\"></i>")
				->build()
		?>

		<?=
			$action
				->setAttributs(
					attributs: [
						"class" => "action import",
						"aria-label" => Lang::translate(key: "MAIN_IMPORT"),
						"title" => Lang::translate(key: "MAIN_IMPORT"),
					]
				)
				->setContent(content: "<i class=\"ri-download-2-line\"></i>")
				->build()
		?>

		<div class="item profile">
			<?= (new Select)
				->setAttributs(
					attributs: [
						"id" => "profile_select",
						"class" => "element",
						"aria-label" => Lang::translate(key: "DASHBOARD_PROFILE_SELECT"),
						"title" => Lang::translate(key: "DASHBOARD_PROFILE_SELECT"),
					]
				)
				->setOptions(options: ["Home", "Work", "Move", "Modding"])
				->setSelected(selected: $_GET["profile"] ?? 0)
				->build()
			?>
			<i class="ri-arrow-down-s-line"></i>
		</div>

		<div class="item search">
			<?= (new ElementBuilder)
				->setElement(element: "input")
				->setAttributs(
					attributs: [
						"class" => "element",
						"id" => "search",
						"type" => "text",
						"placeholder" => Lang::translate(key: "DASHBOARD_SEARCH_PLACEHOLDER"),
						"autofocus" => true,
					]
				)
				->build()
			?>
			<i class="ri-search-line"></i>
		</div>
	</header>

	<div class="projects_container">
		<?php
			foreach ($projectsUid as $projectUid) {
				$project = new ProjectRepository;
				$project
					->setUid(uid: $projectUid)
					->hydrate()
				;

				include Path::COMPONENT_TILES->value . "/project.php";
			}
		?>
		<?php
			// $project = new Project;
			// $project
			// 	->setUid(uid: System::uidGen())
			// 	->setName(name: "ProjectList - Tempora Project Management")
			// 	->setDescription(description: "A simple project management tool to keep track of your projects and tasks.")
			// 	->setIllustrationBlob(illustrationBlob: "projectlist.png")
			// ;

			// include Path::COMPONENT_TILES->value . "/project.php";
			// include Path::COMPONENT_TILES->value . "/project.php";
			// include Path::COMPONENT_TILES->value . "/project.php";
			// include Path::COMPONENT_TILES->value . "/project.php";
			// include Path::COMPONENT_TILES->value . "/project.php";
			// include Path::COMPONENT_TILES->value . "/project.php";
			// include Path::COMPONENT_TILES->value . "/project.php";
			// include Path::COMPONENT_TILES->value . "/project.php";
			// include Path::COMPONENT_TILES->value . "/project.php";
			// include Path::COMPONENT_TILES->value . "/project.php";
			// include Path::COMPONENT_TILES->value . "/project.php";
			// include Path::COMPONENT_TILES->value . "/project.php";
			// include Path::COMPONENT_TILES->value . "/project.php";
			// include Path::COMPONENT_TILES->value . "/project.php";
			// include Path::COMPONENT_TILES->value . "/project.php";
		?>

		<?php
			// $project = new Project;
			// $project
			// 	->setUid(uid: System::uidGen())
			// 	->setName(name: "Tempora Project")
			// 	->setDescription(description: "A simple project management tool to keep track of your projects and tasks.")
			// ;

			// include Path::COMPONENT_TILES->value . "/project.php";
			// include Path::COMPONENT_TILES->value . "/project.php";
			// include Path::COMPONENT_TILES->value . "/project.php";
			// include Path::COMPONENT_TILES->value . "/project.php";
			// include Path::COMPONENT_TILES->value . "/project.php";
			// include Path::COMPONENT_TILES->value . "/project.php";
			// include Path::COMPONENT_TILES->value . "/project.php";
		?>
	</div>
</main>
