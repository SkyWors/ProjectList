<?php
	use Tempora\Utils\ElementBuilder\ElementBuilder;
	use Tempora\Utils\ElementBuilder\Form;
	use Tempora\Utils\Lang;

	$componentResetLang = new Lang(filePath: "components/forms/login_reset_form");

	$form = new Form;
	$form
		->setAttributs(
			attributs: [
				"method" => "POST",
				"class"	=> "login_reset"
			]
		)
		->setCsrf(csrf: true)
	;

	$input = new ElementBuilder;
	$input
		->setElement(element: "input")
		->setAttributs(
			attributs: [
				"type" => "text",
				"name" => "email",
				"value" => $pageData["form_email"] ?? "",
				"placeholder" => $componentResetLang->translate(key: "EMAIL"),
				"required" => "",
				"autofocus" => ""
			]
		)
	;
	$form->addInput(input: $input);

	$submit = new ElementBuilder;
	$submit
		->setElement(element: "button")
		->setAttributs(
			attributs: [
				"type" => "submit"
			]
		)
		->setContent(content: $componentResetLang->translate(key: "SUBMIT"))
	;
	$form->addInput(input: $submit);

	echo $form->build();
