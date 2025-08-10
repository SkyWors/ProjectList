<?php

use Tempora\Utils\ElementBuilder\ElementBuilder;
use Tempora\Utils\ElementBuilder\Form;

$form = new Form();
$form
	->setAttributs(
		attributs: [
			"class" => "add_project_form",
			"id" => "add_project_form",
			"method" => "POST",
			"enctype" => "multipart/form-data"
		]
	)
	->setCsrf(csrf: true)
;

$input = new ElementBuilder();
$input
	->setElement(element: "input")
	->setAttributs(
		attributs: [
			"class" => "element",
			"type" => "text",
			"name" => "name",
			"placeholder" => "Project Name",
			"required" => "",
			"autofocus" => ""
		]
	)
;
$form->addInput(input: $input);

$input = new ElementBuilder();
$input
	->setElement(element: "textarea")
	->setAttributs(
		attributs: [
			"class" => "element",
			"name" => "description",
			"placeholder" => "Project Description"
		]
	)
;
$form->addInput(input: $input);

$input = new ElementBuilder();
$input
	->setElement(element: "input")
	->setAttributs(
		attributs: [
			"class" => "element",
			"type" => "file",
			"name" => "illustration",
			"accept" => "image/*",
			"max-file-size" => 512000
		]
	)
;
$form->addInput(input: $input);

$submit = new ElementBuilder();
$submit
	->setElement(element: "button")
	->setAttributs(
		attributs: [
			"type" => "submit",
			"class" => "submit"
		]
	)
	->setContent(content: "Add Project")
;
$form->addInput(input: $submit);
