<?php
	use Tempora\Utils\ElementBuilder\ElementBuilder;
	use Tempora\Utils\ElementBuilder\Select;
	use Tempora\Utils\Lang;

	$action = new ElementBuilder;
	$action->setElement(element: "button");
?>

<header>
	<h1 class="title"><?= Lang::translate(key: "PROJECT_ADD_TITLE") ?></h1>

	<div class="project_header">
		<?=
			$action
				->setAttributs(
					attributs: [
						"class" => "action add",
						"aria-label" => Lang::translate(key: "MAIN_ADD"),
						"title" => Lang::translate(key: "MAIN_ADD"),
					]
				)
				->setContent(content: "<i class=\"ri-pencil-line\"></i>")
				->build()
		?>

		<div class="item profile">
			<?= (new Select())
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
	</div>
</header>
