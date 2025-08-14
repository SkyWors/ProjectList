<?php
	use App\Enums\Path;
	use App\Models\Repositories\ProjectRepository;
?>

<?php include Path::COMPONENT_DRAWERS->value . "/drawer.php"; ?>

<main>
	<?php include Path::COMPONENT_ACTIONS->value . "/dashboard_header.php"; ?>

	<div class="projects_container">
		<?php
			foreach ($projectsUid as $projectUid) {
				$project = new ProjectRepository;
				$project
					->setUid(uid: $projectUid)
					->hydrate()
				;

				include Path::COMPONENT_TILES->value . "/project.php";
			}
		?>
	</div>
</main>
