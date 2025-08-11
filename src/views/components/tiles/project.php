<?php
	use Tempora\Utils\Minifier\Image;
?>

<div class="project_container">
	<?php if ($project->getIllustrationBlob() !== null) { ?>
		<img class="illustration" src="data:image/png;base64,<?= base64_encode(string: $project->getIllustrationBlob()) ?>">
	<?php } else { ?>
		<img class="illustration" src="<?= Image::import(image: "noimage.png") ?>">
	<?php } ?>

	<div class="content">
		<i class="info ri-information-line"></i>
		<h3 class="name" id="project_name" title="<?= $project->getName() ?>"><?= $project->getName() ?></h3>
		<p class="description" title="<?= $project->getDescription() ?>"><?= $project->getDescription() ?></p>

		<?php //if (count(value: $links) > 0) { ?>
			<div class="link">
				<a href="vscode://" data-color="#F00"><i class="ri-code-line"></i></a>
				<a href="" data-color="#FFFF00"><i class="ri-github-line"></i></a>
				<a href=""><i class="ri-github-line"></i></a>
				<a href="" data-color="#903842"><i class="ri-github-line"></i></a>
				<a href=""><i class="ri-github-line"></i></a>
				<a href=""><i class="ri-github-line"></i></a>
			</div>
		<?php //} ?>
	</div>

	<div class="actions">
		<button class="link clock"><i class="ri-time-line"></i></button>
		<button class="link"><i class="ri-link"></i></button>
		<a class="link" href="project/<?= $project->getUid() ?>"><i class="ri-pencil-line"></i></a>
	</div>
</div>
