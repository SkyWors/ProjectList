<?php
	use Tempora\Utils\ElementBuilder\ElementBuilder;
	use Tempora\Utils\ElementBuilder\Select;
	use Tempora\Utils\Lang;

	$componentProjectHeaderLang = new Lang(filePath: "components/actions/project_header");

	$action = new ElementBuilder;
	$action->setElement(element: "button");
?>

<header>
	<h1 class="title"><?= $componentProjectHeaderLang->translate(key: "PROJECT_ADD_TITLE") ?></h1>

	<div class="project_header">
		<?=
			$action
				->setAttributs(
					attributs: [
						"class" => "action add",
						"aria-label" => $componentProjectHeaderLang->translate(key: "ADD"),
						"title" => $componentProjectHeaderLang->translate(key: "ADD"),
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
						"aria-label" => $componentProjectHeaderLang->translate(key: "PROFILE_SELECT"),
						"title" => $componentProjectHeaderLang->translate(key: "PROFILE_SELECT"),
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
