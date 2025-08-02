<?php
	use App\Enums\Path;
	use Tempora\Utils\Lang;
?>

<?php include Path::COMPONENT_NAVBARS->value . "/navbar.php"; ?>

<main>
	<div class="login_reset_container">
		<h1><?= Lang::translate(key: "LOGIN_RESET_TITLE") ?></h1>

		<?php include Path::COMPONENT_FORMS->value . "/login_reset_form.php"; ?>
	</div>
</main>
