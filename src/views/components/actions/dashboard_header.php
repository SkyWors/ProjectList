<?php
	use Tempora\Utils\ElementBuilder\ElementBuilder;
	use Tempora\Utils\ElementBuilder\Select;
	use Tempora\Utils\Lang;

	$componentDashboardHeaderLang = new Lang(filePath: "components/actions/dashboard_header");

	$action = new ElementBuilder;
	$action->setElement(element: "button");
?>

<header>
	<?=
		$action
			->setAttributs(
				attributs: [
					"class" => "action export",
					"aria-label" => $componentDashboardHeaderLang->translate(key: "EXPORT"),
					"title" => $componentDashboardHeaderLang->translate(key: "EXPORT"),
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
					"aria-label" => $componentDashboardHeaderLang->translate(key: "IMPORT"),
					"title" => $componentDashboardHeaderLang->translate(key: "IMPORT"),
				]
			)
			->setContent(content: "<i class=\"ri-download-2-line\"></i>")
			->build()
	?>

	<div class="item profile">
		<?= (new Select())
			->setAttributs(
				attributs: [
					"id" => "profile_select",
					"class" => "element",
					"aria-label" => $componentDashboardHeaderLang->translate(key: "PROFILE_SELECT"),
					"title" => $componentDashboardHeaderLang->translate(key: "PROFILE_SELECT"),
				]
			)
			->setOptions(options: ["Home", "Work", "Move", "Modding"])
			->setSelected(selected: $_GET["profile"] ?? 0)
			->build()
		?>
		<i class="ri-arrow-down-s-line"></i>
	</div>

	<div class="item search">
		<?= (new ElementBuilder())
			->setElement(element: "input")
			->setAttributs(
				attributs: [
					"class" => "element",
					"id" => "search",
					"type" => "text",
					"placeholder" => $componentDashboardHeaderLang->translate(key: "SEARCH_PLACEHOLDER"),
					"autofocus" => true,
				]
			)
			->build()
		?>
		<i class="ri-search-line"></i>
	</div>
</header>
