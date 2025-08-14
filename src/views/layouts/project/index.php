<?php
	use App\Enums\Path;
	use App\Models\Repositories\ProjectRepository;

	include Path::COMPONENT_FORMS->value . "/add_project.php";
?>

<?php include Path::COMPONENT_DRAWERS->value . "/drawer.php"; ?>

<main>
	<?php include Path::COMPONENT_ACTIONS->value . "/project_header.php"; ?>

	<div class="projects_container">
		<?php
			$project = new ProjectRepository;
			include Path::COMPONENT_TILES->value . "/project.php";
		?>
	</div>

	<?= $form->build(); ?>
</main>
