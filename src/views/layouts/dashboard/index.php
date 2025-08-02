<?php
	use App\Enums\Path;
	use Tempora\Utils\ElementBuilder\ElementBuilder;
	use Tempora\Utils\ElementBuilder\Select;
	use Tempora\Utils\Lang;

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
				->setContent(content: "<i class=\"ri-download-2-line\"></i>")
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
				->setContent(content: "<i class=\"ri-upload-2-line\"></i>")
				->build()
		?>

		<div class="item profile">
			<?= (new Select)
				->setAttributs(
					attributs: [
						"id" => "profile_select",
						"class" => "element",
						"aria-label" => Lang::translate(key: "PROFILE_SELECT"),
						"title" => Lang::translate(key: "PROFILE_SELECT"),
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
						"placeholder" => Lang::translate(key: "SEARCH_PLACEHOLDER"),
						"autofocus" => true,
					]
				)
				->build()
			?>
			<i class="ri-search-line"></i>
		</div>
	</header>

	<h1><?= Lang::translate(key: "DASHBOARD_TITLE") ?></h1>
</main>
