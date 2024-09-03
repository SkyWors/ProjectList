<?php

$errorRegisterMessage = "";

if (isset($_POST["register"])) {
	if ($user->getUID($_POST["register"]) == null) {
		if ($_POST["password"] == $_POST["passwordConfirm"]) {
			$_SESSION["userUID"] = $user->create($_POST["register"], $_POST["password"]);
			header("Location: /");
		} else {
			$errorRegisterMessage = "Le mot de passe ne correspond pas.";
		}
	} else {
		$errorRegisterMessage = "Cet Email est déjà utilisé.";
	}
	echo "<script> var register = true</script>";
}
