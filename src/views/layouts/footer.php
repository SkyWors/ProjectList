<?php
	use Tempora\Utils\Git;
?>

	<footer>
		<i class="ri-archive-line"></i> ProjectList - Développé avec 🧡 par <a class="link" href="https://github.com/SkyWors" target="_blank">SkyWors</a> <i class="ri-external-link-line"></i>
		<a class="footerLink git" href="<?= Git::getRepoUrl() ?>/tree/<?= Git::getCommit() ?>" target="_blank"><i class="ri-github-fill"></i> <?= Git::getBranch() . " #" . substr(string: Git::getCommit(), offset: 0, length: 7) ?></a>
	</footer>
</body>
</html>
