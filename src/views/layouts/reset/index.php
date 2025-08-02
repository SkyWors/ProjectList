<?php
	use App\Enums\Path;
	use Tempora\Utils\Lang;
?>

<?php include Path::COMPONENT_NAVBARS->value . "/navbar.php"; ?>

<main>
	<div class="reset_password_container">
		<h1><?= Lang::translate(key: "RESET_TITLE") ?></h1>

		<?php
			$oldPassword = false;
			include Path::COMPONENT_FORMS->value . "/update_password_form.php";
		?>
	</div>
</main>
