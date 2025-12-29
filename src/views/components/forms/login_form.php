<?php
	use Tempora\Utils\ElementBuilder\ElementBuilder;
	use Tempora\Utils\ElementBuilder\Form;
	use Tempora\Utils\Lang;

	$componentLoginLang = new Lang(filePath: "components/forms/login_form");

	$form = new Form;
	$form
		->setAttributs(
			attributs: [
				"method" => "POST",
				"class"	=> "login"
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
				"placeholder" => $componentLoginLang->translate(key: "EMAIL"),
				"required" => "",
				"autofocus" => ""
			]
		)
	;
	$form->addInput(input: $input);

	$input = new ElementBuilder;
	$input
		->setElement(element: "input")
		->setAttributs(
			attributs: [
				"type" => "password",
				"name" => "password",
				"value" => $pageData["page_password"] ?? "",
				"placeholder" => $componentLoginLang->translate(key: "PASSWORD"),
				"required" => ""
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
		->setContent(content: $componentLoginLang->translate(key: "SUBMIT"))
	;
	$form->addInput(input: $submit);

	echo $form->build();
