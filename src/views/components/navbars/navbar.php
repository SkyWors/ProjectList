<?php
	use App\Enums\Path;
	use App\Enums\Role;
	use Tempora\Utils\Cache\Route;
	use Tempora\Utils\ElementBuilder\ElementBuilder;
	use Tempora\Utils\Lang;
	use Tempora\Utils\Minifier\Image;

	$itemContainer = new ElementBuilder();
	$itemContainer
		->setElement(element: "div")
		->setAttributs(
			attributs: [
				"class" => "item",
			]
		)
	;
?>

<nav>
	<?=
		(new ElementBuilder)
			->setElement(element: "a")
			->setAttributs(
				attributs: [
					"href" => Route::getPath(name: "app_home_get"),
					"title" => APP_NAME,
				]
			)
			->setContent(content:
				(new ElementBuilder)
					->setElement(element: "img")
					->setAttributs(
						attributs: [
							"src" => Image::import(image: "projectlist.png"),
							"width" => "18",
							"alt" => APP_NAME,
						]
					)
					->build()
			)
			->build()
	?>

	<?=
		$itemContainer
			->setContent(content:
				(new ElementBuilder)
					->setElement(element: "a")
					->setAttributs(
						attributs: [
							"class" => "button button_secondary",
							"href" => Route::getPath(name: "app_home_get"),
							"title" => Lang::translate(key: "NAVBAR_HOME"),
						]
					)
					->setContent(content: "<i class='ri-home-2-line'></i> " . Lang::translate(key: "NAVBAR_HOME"))
					->build()
				)
			->build()
	?>

	<?=
		$itemContainer
			->setContent(content:
				(new ElementBuilder)
					->setElement(element: "a")
					->setAttributs(
						attributs: [
							"class" => "button button_secondary",
							"href" => Route::getPath(name: "app_dashboard_get"),
							"title" => Lang::translate(key: "NAVBAR_DASHBOARD"),
						]
					)
					->setContent(content: "<i class='ri-speed-up-line'></i> " . Lang::translate(key: "NAVBAR_DASHBOARD"))
					->build()
			)
			->setAccessRoles(
				accessRoles: [
					Role::USER->value
				]
			)
			->setNeedLoginToBe(needLoginToBe: true)
			->build()
	?>

	<?=
		$itemContainer
			->setContent(content:
				(new ElementBuilder)
					->setElement(element: "a")
					->setAttributs(
						attributs: [
							"class" => "button button_secondary",
							"href" => Route::getPath(name: "app_account_disconnect_get"),
							"title" => Lang::translate(key: "NAVBAR_DISCONNECT"),
						]
					)
					->setContent(content: "<i class='ri-logout-box-line'></i>")
					->build()
			)
			->setNeedLoginToBe(needLoginToBe: true)
			->build()
	?>

	<?=
		$itemContainer
			->setContent(content:
				(new ElementBuilder)
					->setElement(element: "a")
					->setAttributs(
						attributs: [
							"class" => "button button_secondary",
							"href" => Route::getPath(name: "app_account_login_get"),
							"title" => Lang::translate(key: "NAVBAR_LOGIN"),
						]
					)
					->setContent(content: "<i class='ri-login-box-line'></i> " . Lang::translate(key: "NAVBAR_LOGIN"))
					->build()
			)
			->setAccessRoles(accessRoles: [])
			->setNeedLoginToBe(needLoginToBe: false)
			->build()
	?>

	<?=
		$itemContainer
			->setContent(content:
				(new ElementBuilder)
					->setElement(element: "a")
					->setAttributs(
						attributs: [
							"class" => "button button_secondary",
							"href" => Route::getPath(name: "app_account_register_get"),
							"title" => Lang::translate(key: "NAVBAR_REGISTER"),
						]
					)
					->setContent(content: "<i class='ri-user-add-line'></i> " . Lang::translate(key: "NAVBAR_REGISTER"))
					->build()
			)
			->setAccessRoles(accessRoles: [])
			->setNeedLoginToBe(needLoginToBe: false)
			->build()
	?>

	<?=
		(new ElementBuilder)
			->setElement(element: "i")
			->setAttributs(
				attributs: [
					"class" => "ri-sun-line",
					"id" => "theme_button",
				]
			)
			->build()
	?>

	<?php include Path::COMPONENT_ACTIONS->value . "/lang_selection.php"; ?>
</nav>
