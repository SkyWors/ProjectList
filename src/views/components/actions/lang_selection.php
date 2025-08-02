<?php
	use App\Enums\Path;
	use App\Utils\NameFormat;
	use Tempora\Utils\ElementBuilder\Select;
	use Tempora\Utils\Lang;
	use Tempora\Utils\System;
?>

<?php
	$options = [];
	foreach (System::getFiles(path: Path::PUBLIC->value . "/langs") as $file) {
		$file = str_replace(search: ".json", replace: "", subject: $file);
		$options[$file] = NameFormat::langFormat(name: $file);
	}

	$select = new Select;
	$select
		->setAttributs(
			attributs: [
				"class" => "button lang_selection",
				"id" => "lang_selection",
				"aria-label" => Lang::translate(key: "ACCESSIBILITY_LANG"),
				"title" => Lang::translate(key: "ACCESSIBILITY_LANG"),
			]
		)
		->setOptions(options: $options)
		->setSelected(selected: $_COOKIE["LANG"])
		->setTranslate(translate: false)
	;
?>

<?= $select->build() ?>
