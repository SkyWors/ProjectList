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

$form->addInput(input:
	(new ElementBuilder())
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
);

$form->addInput( input:
	(new ElementBuilder())
		->setElement(element: "textarea")
		->setAttributs(
			attributs: [
				"class" => "element",
				"id" => "add_project_description",
				"name" => "description",
				"placeholder" => "Project Description"
			]
		)
);

$form->addInput(input:
	(new ElementBuilder())
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
);

$addLinksContainer = (new ElementBuilder())
	->setElement(element: "div")
	->setAttributs(
		attributs: [
			"class" => "add_links_container"
		]
	)
;
$linksContainer = (new ElementBuilder())
	->setElement(element: "div")
	->setAttributs(
		attributs: [
			"class" => "add_link_container"
		]
	)
;
$informationContainer = (new ElementBuilder())
	->setElement(element: "div")
	->setAttributs(
		attributs: [
			"class" => "information_container"
		]
	)
;

$linkName = (new ElementBuilder())
	->setElement(element: "input")
	->setAttributs(
		attributs: [
			"class" => "element",
			"type" => "text",
			"name" => "link[0][name]",
			"placeholder" => "Add a name to the link"
		]
	)
;
$linkColor = (new ElementBuilder())
	->setElement(element: "input")
	->setAttributs(
		attributs: [
			"class" => "element",
			"type" => "color",
			"name" => "link[0][color]"
		]
	)
;
$linkIcon = (new ElementBuilder())
	->setElement(element: "input")
	->setAttributs(
		attributs: [
			"class" => "element number",
			"type" => "number",
			"name" => "link[0][icon]"
		]
	)
;
$linkLink = (new ElementBuilder())
	->setElement(element: "input")
	->setAttributs(
		attributs: [
			"class" => "element",
			"type" => "text",
			"name" => "link[0][link]",
			"placeholder" => "Add a link"
		]
	)
;

$addLinkButton = (new ElementBuilder())
	->setElement(element: "button")
	->setAttributs(
		attributs: [
			"type" => "button",
			"class" => "add_link",
			"id" => "add_link"
		]
	)
	->setContent(content: "Add Link")
;

$informationContainer->setContent(content:
	$linkName->build()
	. $linkColor->build()
	. $linkIcon->build()
);
$linksContainer->setContent(content:
	$informationContainer->build()
	. $linkLink->build()
	. $addLinkButton->build()
);
$addLinksContainer->setContent(content: $linksContainer->build());

$form->addInput(input: $addLinksContainer);

$submit = (new ElementBuilder())
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
