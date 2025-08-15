<?php

use Tempora\Utils\ElementBuilder\ElementBuilder;
use Tempora\Utils\ElementBuilder\Form;
use Tempora\Utils\Lang;

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
			"id" => "add_project_name",
			"type" => "text",
			"name" => "name",
			"max" => 36,
			"value" => Lang::translate(key: "PROJECT_NAME_DEFAULT"),
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
			"id" => "add_project_description",
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
			"id" => "add_project_illustration",
			"type" => "file",
			"name" => "illustration",
			"accept" => "image/*",
			"max-file-size" => 512000
		]
	)
;
$form->addInput(input: $input);

$links = new ElementBuilder();
$links
	->setElement(element: "div")
	->setAttributs(
		attributs: [
			"class" => "add_link_container"
		]
	)
	->setContent(content:
		(new ElementBuilder())
			->setElement(element: "input")
			->setAttributs(
				attributs: [
					"class" => "element",
					"type" => "text",
					"name" => "link[0][link]",
					"placeholder" => "Add a link"
				]
			)
			->build()
			. (new ElementBuilder())
				->setElement(element: "input")
				->setAttributs(
					attributs: [
						"class" => "element",
						"type" => "color",
						"name" => "link[0][color]"
					]
				)
				->build()
			. (new ElementBuilder())
				->setElement(element: "input")
				->setAttributs(
					attributs: [
						"class" => "element",
						"type" => "text",
						"name" => "link[0][icon]",
						"placeholder" => "Add an icon"
					]
				)
				->build()
			. (new ElementBuilder())
				->setElement(element: "button")
				->setAttributs(
					attributs: [
						"type" => "button",
						"class" => "add_link",
						"id" => "add_link"
					]
				)
				->setContent(content: "Add Link")
				->build()
	)
;
$form->addInput(input: $links);

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
