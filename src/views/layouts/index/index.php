<?php
	use App\Enums\Path;
?>

<?php include Path::COMPONENT_NAVBARS->value . "/navbar.php"; ?>

<main>
	<h1><?= $pageLang->translate(key: "INDEX_TITLE") ?></h1>
</main>
