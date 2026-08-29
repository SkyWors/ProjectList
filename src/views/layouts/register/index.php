<?php
	use App\Enums\Path;
?>

<?php include Path::COMPONENT_NAVBARS->value . "/navbar.php"; ?>

<main>
	<div class="register_container">
		<h1><?= $pageLang->translate(key: "REGISTER_TITLE") ?></h1>

		<?php include Path::COMPONENT_FORMS->value . "/register_form.php"; ?>
	</div>
</main>
