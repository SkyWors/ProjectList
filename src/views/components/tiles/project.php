<?php
	use Tempora\Utils\ElementBuilder\ElementBuilder;
	use Tempora\Utils\Minifier\Image;
?>

<div class="project_container">
	<?php if ($project->getIllustrationBlob() !== null) { ?>
		<img class="illustration" id="project_illustration" src="data:image/png;base64,<?= base64_encode(string: $project->getIllustrationBlob()) ?>">
	<?php } else { ?>
		<img class="illustration" id="project_illustration" src="<?= Image::import(image: "noimage.png") ?>">
	<?php } ?>

	<div class="content">
		<h3 class="name" id="project_name" title="<?= htmlspecialchars(string: $project->getName()) ?>"><?= htmlspecialchars(string: $project->getName()) ?></h3>
		<p class="description" id="project_description" title="<?= htmlspecialchars(string: $project->getDescription()) ?>"><?= htmlspecialchars(string: $project->getDescription()) ?></p>

		<?php if (count(value: $project->getLinks()) > 0) { ?>
			<div class="link">
				<?php
					foreach ($project->getLinks() as $link) {
						$attribute = [
							"class" => "link_icon",
							"href" => htmlspecialchars(string: $link["link"]),
						];

						if (!empty($link["color"])) {
							$attribute["data-color"] = htmlspecialchars(string: $link["color"]);
						}
						if (strpos(haystack: $link["link"], needle: "http") === 0) {
							$attribute["target"] = "_blank";
						}

						echo (new ElementBuilder())
							->setElement(element: "a")
							->setAttributs(attributs: $attribute)
							->setContent(content: "<i class=\"" . htmlspecialchars(string: $link["icon"]) . "\"></i>")
							->build();
					}
				?>
				<!-- <a href="<?= htmlspecialchars(string: $link["link"]) ?>" <?= $link["color"] ? "data-color=\"" . htmlspecialchars(string: $link["color"]) . "\"" : "" ?> <?= (strpos(haystack: $link["link"], needle: "http") === 0) ? "target=\"_blank\"" : "" ?>>
						<i class="<?= htmlspecialchars(string: $link["icon"]) ?>"></i>
					</a> -->
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
