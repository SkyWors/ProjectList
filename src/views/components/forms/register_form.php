<?php
	use Tempora\Utils\ElementBuilder\ElementBuilder;
	use Tempora\Utils\ElementBuilder\Form;
	use Tempora\Utils\Lang;

	$componentRegister = new Lang(filePath: "components/forms/register_form");

	$form = new Form();
	$form
		->setAttributs(
			attributs: [
				"method" => "POST",
				"class"	=> "register"
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
				"name" => "name",
				"value" => $pageData["form_name"] ?? "",
				"placeholder" => $componentRegister->translate(key: "NAME"),
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
				"type" => "text",
				"name" => "surname",
				"value" => $pageData["form_surname"] ?? "",
				"placeholder" => $componentRegister->translate(key: "SURNAME"),
				"required" => ""
			]
		)
	;
	$form->addInput(input: $input);

	$input = new ElementBuilder;
	$input
		->setElement(element: "input")
		->setAttributs(
			attributs: [
				"type" => "text",
				"name" => "email",
				"value" => $pageData["form_email"] ?? "",
				"placeholder" => $componentRegister->translate(key: "EMAIL"),
				"required" => ""
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
				"value" => $pageData["form_password"] ?? "",
				"placeholder" => $componentRegister->translate(key: "PASSWORD"),
				"required" => ""
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
				"name" => "password_confirm",
				"value" => $pageData["form_password_confirm"] ?? "",
				"placeholder" => $componentRegister->translate(key: "CONFIRM_PASSWORD"),
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
		->setContent(content: $componentRegister->translate(key: "SUBMIT"))
	;
	$form->addInput(input: $submit);

	echo $form->build();
