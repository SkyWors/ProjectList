<?php
	use App\Enums\Path;
	use Tempora\Utils\Lang;
?>

<?php include Path::COMPONENT_NAVBARS->value . "/navbar.php"; ?>

<main>
	<div class="login_container">
		<h1><?= $pageLang->translate(key: "LOGIN_TITLE") ?></h1>

		<?php include Path::COMPONENT_FORMS->value . "/login_form.php"; ?>
		<?php include Path::COMPONENT_ACTIONS->value . "/reset_password_button.php"; ?>
	</div>
</main>
