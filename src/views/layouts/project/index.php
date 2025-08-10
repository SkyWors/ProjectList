<?php
	use App\Enums\Path;

	include Path::COMPONENT_FORMS->value . "/add_project.php";
?>

<?php include Path::COMPONENT_DRAWERS->value . "/drawer.php"; ?>

<main>
	<?= $form->build(); ?>
</main>
