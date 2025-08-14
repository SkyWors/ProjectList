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
		<?php if ($project->getUid()) { ?>
			<i class="info ri-information-line"></i>
		<?php } ?>
		<h3 class="name" id="project_name" title="<?= $project->getName() ?>"><?= $project->getName() ?></h3>
		<p class="description" id="project_description" title="<?= $project->getDescription() ?>"><?= $project->getDescription() ?></p>

		<?php if (count(value: $project->getLinks()) > 0) { ?>
			<div class="link">
				<?php foreach ($project->getLinks() as $link) { ?>
					<a href="<?= $link["link"] ?>" <?= $link["color"] ? "data-color=\"" . $link["color"] . "\"" : "" ?>><i class="<?= $link["icon"] ?>"></i></a>
				<?php } ?>
			</div>
		<?php } ?>
	</div>

	<div class="actions">
		<button class="link clock"><i class="ri-time-line"></i></button>
		<button class="link"><i class="ri-link"></i></button>
		<?php if ($project->getUid()) { ?>
			<a class="link" href="project/<?= $project->getUid() ?>"><i class="ri-pencil-line"></i></a>
		<?php } ?>
	</div>
</div>
