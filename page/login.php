<?php

require_once __DIR__ . "/../start.php";

use
	ProjectList\User;

$google_oauthV2 = new Google_Service_Oauth2(GCLIENT);

if (isset($_GET['code'])) {
	GCLIENT->authenticate($_GET['code']);
	$_SESSION['token'] = GCLIENT->getAccessToken();
	header('Location: ' . filter_var($_ENV["GOOGLE_REDIRECT_URL"], FILTER_SANITIZE_URL));
}

if (isset($_SESSION['token'])) {
	GCLIENT->setAccessToken($_SESSION['token']);
}

if (GCLIENT->getAccessToken()) {
	$gpUserProfile = $google_oauthV2->userinfo->get();

	$user = new User();

	$gpUserData = array();
	$gpUserData['oauth_uid'] = !empty($gpUserProfile['id']) ? $gpUserProfile['id'] : '';
	$gpUserData['email'] = !empty($gpUserProfile['email']) ? $gpUserProfile['email'] : '';

	$_SESSION['userData'] = $user->checkUser($gpUserData);

	if (!empty($_SESSION['userData'])) {
		header("Location: /");
	} else {
		$output = '<h3 style="color:red">Some problem occurred, please try again.</h3>';
	}
} else {
	$authUrl = GCLIENT->createAuthUrl();
	$output = '<a href="'.filter_var($authUrl, FILTER_SANITIZE_URL).'" class="login-btn">Sign in with Google</a>';
}

?>

<div class="container">
	<?php echo $output; ?>
</div>
