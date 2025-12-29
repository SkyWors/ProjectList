<?php
	use Tempora\Utils\Lang;

	$componentResetPasswordLang = new Lang(filePath: "components/actions/reset_password_button");
?>

<a href="/login/reset"><?= $componentResetPasswordLang->translate(key: "PASSWORD_FORGOT") ?></a>
