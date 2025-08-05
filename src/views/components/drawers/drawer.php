<?php
	use App\Enums\Path;
	use Tempora\Utils\Cache\Route;
	use Tempora\Utils\ElementBuilder\ElementBuilder;
	use Tempora\Utils\Lang;
	use Tempora\Utils\Minifier\Image;
?>

<aside class="action_drawer">
	<?=
		(new ElementBuilder)
			->setElement(element: "a")
			->setAttributs(
				attributs: [
					"class" => "logo",
					"href" => Route::getPath(name: "app_home_get"),
					"title" => APP_NAME,
					"aria-label" => APP_NAME,
				]
			)
			->setContent(content:
				(new ElementBuilder)
					->setElement(element: "img")
					->setAttributs(
						attributs: [
							"src" => Image::import(image: "projectlist.png")
						]
					)
					->build()
				. "<h1>" . APP_NAME . "</h1>"
			)
			->build()
	?>

	<button class="drawer_state"><i class="ri-arrow-left-s-line"></i></button>

	<nav>
		<?=
			(new ElementBuilder)
				->setElement(element: "a")
				->setAttributs(
					attributs: [
						"href" => Route::getPath(name: "app_home_get"),
						"class" => "action_button",
						"title" => Lang::translate(key: "INDEX_TITLE"),
						"aria-label" => Lang::translate(key: "INDEX_TITLE"),
					]
				)
				->setContent(content: "<i class=\"ri-home-2-line\"></i> " . Lang::translate(key: "INDEX_TITLE"))
				->build()
		?>

		<?=
			(new ElementBuilder)
				->setElement(element: "a")
				->setAttributs(
					attributs: [
						"href" => Route::getPath(name: "app_dashboard_get"),
						"class" => "action_button",
						"title" => Lang::translate(key: "DASHBOARD_TITLE"),
						"aria-label" => Lang::translate(key: "DASHBOARD_TITLE"),
					]
				)
				->setContent(content: "<i class=\"ri-dashboard-line\"></i> " . Lang::translate(key: "DASHBOARD_TITLE"))
				->build()
		?>

		<?=
			(new ElementBuilder)
				->setElement(element: "a")
				->setAttributs(
					attributs: [
						"href" => Route::getPath(name: "app_project_add_get"),
						"class" => "action_button",
						"title" => Lang::translate(key: "MAIN_ADD"),
						"aria-label" => Lang::translate(key: "MAIN_ADD"),
					]
				)
				->setContent(content: "<i class=\"ri-add-large-line\"></i> " . Lang::translate(key: "MAIN_ADD"))
				->build()
		?>
	</nav>

	<div class="filters">
		<div class="tags">
			<div class="drophover tags" id="drawer_drophover">
				<h2><?= Lang::translate(key: "MAIN_TAGS") ?></h2>
				<i class="ri-arrow-down-s-line"></i>
			</div>
			<div class="dropdown">
				<button class="options selected">Extensions <i class="ri-check-line"></i></button>
				<button class="options">Tools</button>
				<button class="options">Project</button>
				<button class="options selected">Scrap <i class="ri-check-line"></i></button>
				<button class="options selected">Exteeeeeeeeeeeeeeeeeensions <i class="ri-check-line"></i></button>
				<button class="options">Tools</button>
				<button class="options">Project</button>
				<button class="options selected">Scrap <i class="ri-check-line"></i></button>
				<button class="options">Extensions</button>
				<button class="options">Tools</button>
				<button class="options">Project</button>
				<button class="options selected">Scrap <i class="ri-check-line"></i></button>
				<button class="options selected">Extensions <i class="ri-check-line"></i></button>
				<button class="options">Tools</button>
				<button class="options">Project</button>
				<button class="options selected">Scrap <i class="ri-check-line"></i></button>
			</div>
		</div>
		<div class="languages">
			<div class="drophover languages" id="drawer_drophover">
				<h2><?= Lang::translate(key: "MAIN_LANGUAGES") ?></h2>
				<i class="ri-arrow-down-s-line"></i>
			</div>
			<div class="dropdown">
				<button class="options selected">PHP <i class="ri-check-line"></i></button>
				<button class="options selected">HTML <i class="ri-check-line"></i></button>
				<button class="options">JavaScript</button>
			</div>
		</div>
	</div>

	<div class="actions">
		<?=
			(new ElementBuilder)
				->setElement(element: "a")
				->setAttributs(
					attributs: [
						"href" => Route::getPath(name: "app_account_get"),
						"class" => "button",
						"title" => Lang::translate(key: "ACCOUNT_TITLE"),
						"aria-label" => Lang::translate(key: "ACCOUNT_TITLE"),
					]
				)
				->setContent(content: "<i class=\"ri-user-line\"></i>")
				->build()
		?>

		<?=
			(new ElementBuilder)
				->setElement(element: "a")
				->setAttributs(
					attributs: [
						"href" => Route::getPath(name: "app_account_disconnect_get"),
						"class" => "button",
						"title" => Lang::translate(key: "DISCONNECT_TITLE"),
						"aria-label" => Lang::translate(key: "DISCONNECT_TITLE"),
					]
				)
				->setContent(content: "<i class=\"ri-logout-box-line\"></i>")
				->build()
		?>

		<?php include Path::COMPONENT_ACTIONS->value . "/lang_selection.php"; ?>

		<?=
			(new ElementBuilder)
				->setElement(element: "button")
				->setAttributs(
					attributs: [
						"class" => "button",
						"id" => "theme_button",
						"title" => Lang::translate(key: "MAIN_THEME_TITLE"),
						"aria-label" => Lang::translate(key: "MAIN_THEME_TITLE"),
					]
				)
				->setContent(content: "<i class=\"ri-sun-line\"></i>")
				->build()
		?>
	</div>
</aside>
