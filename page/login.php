<?php
	require_once __DIR__ . "/../start.php";

	use
		ProjectList\User;

	if (isset($_SESSION['userUID'])) {
		header("Location: /");
	}

	$user = new User();

	require "event/login.php";
	require "event/register.php";
?>

<html lang="fr" data-theme="dark">
	<head>
		<meta charset="UTF-8">
		<title>Project List</title>
		<link rel="stylesheet" href="/public/css/style.css">
		<link rel="stylesheet" href="/public/css/import/remixicon.css">
	</head>
	<body>
		<div class="mainLogin">
			<button class="actionButton themeButton" id="themeButton" style="display: none"><i class="ri-sun-line"></i></button>
			<div class="loginContainer">

				<div id="login">
					<?php
						if ($errorLoginMessage != "") {
							echo "<div class='box error'>" . $errorLoginMessage ."</div>";
						}
					?>

					<form method="POST" class="box loginItem">
						<h2><i class="ri-user-line"></i> Identification</h2>
						<input class="loginField" autocomplete="username" type="email" name="login" value="<?= isset($_POST["login"]) ? $_POST["login"] : null ?>" placeholder="Email">
						<div class="passwordContainer">
							<input class="loginField" autocomplete="current-password" type="password" name="password" value="<?= isset($_POST["password"]) ? $_POST["password"] : null ?>" placeholder="Mot de passe">
							<i class="ri-eye-off-line showPassword" id="showPassword"></i>
						</div>
						<button class="loginButton" type="submit"><i class="ri-lock-unlock-line"></i> Se connecter</button>
						<a class="external" id="toRegister">Je n'ai pas de compte</a>
					</form>
				</div>

				<div id="register" style="display: none">
					<?php
						if ($errorRegisterMessage != "") {
							echo "<div class='box error'>" . $errorRegisterMessage ."</div>";
						}
					?>

					<form method="POST" class="box loginItem">
						<h2><i class="ri-user-line"></i> Inscription</h2>
						<input class="loginField" autocomplete="username" type="email" name="register" value="<?= isset($_POST["register"]) ? $_POST["register"] : null ?>" placeholder="Email">
						<div class="passwordContainer">
							<input class="loginField" autocomplete="new-password" type="password" name="password" value="<?= isset($_POST["password"]) ? $_POST["password"] : null ?>" placeholder="Mot de passe">
							<i class="ri-eye-off-line showPassword" id="showPassword"></i>
						</div>
						<div class="passwordContainer">
							<input class="loginField" autocomplete="new-password" type="password" name="passwordConfirm" value="<?= isset($_POST["passwordConfirm"]) ? $_POST["passwordConfirm"] : null ?>" placeholder="Confirmer">
							<i class="ri-eye-off-line showPassword" id="showPassword"></i>
						</div>
						<button class="loginButton" type="submit"><i class="ri-id-card-line"></i> S'inscrire</button>
						<a class="external" id="toLogin">J'ai déjà un compte</a>
					</form>
				</div>
			</div>
		</div>

		<footer>
			<i class="ri-archive-line"></i> ProjectList - Développé avec 🧡 par <a class="footerLink" href="https://github.com/SkyWors" target="_blank">SkyWors</a> <i class="ri-external-link-line"></i>
		</footer>

		<script src="/public/js/theme.js"></script>
		<script src="/public/js/password.js"></script>
	</body>
</html>
