<div class="box item column">
	<div class="row">
		<?php if ($element["url"] != "") { ?>
			<a class="itemName" id="itemName" title="<?= $element["name"] ?>" data-id="<?= $element["name"] ?>" href="<?= $element["url"] ?>" target="_blank">
				<i class="ri-external-link-line"></i> <?= $element["name"] ?>
			</a>
		<?php } else { ?>
			<a class="itemName" title="<?= $element["name"] ?>" id="itemName"><?= $element["name"] ?></a>
		<?php } ?>

		<div class="badgeContainer">
			<a class="language" data-id="<?= $element["name"] ?>" title="<?= $element["language"] ?>">
				<i class="ri-global-line"></i>
			</a>
			<a class="badge" data-id="<?= $element["name"] ?>" title="<?= $element["tag"] ?>">
				<i class="ri-bookmark-line"></i>
			</a>
		</div>
	</div>

	<div class="description" data-id="<?= $element["name"] ?>" title="<?= $element["description"] ?>">
		<a><?= $element["description"] ?></a>
	</div>

	<div class="buttonContainer row">
		<?php
			if ($element["vscode"]) {
				echo vscodeButton($element["path"], $element["name"]);
			}
			if ($element["idea"]) {
				echo ideaButton($element["path"], $element["name"]);
			}
			if ($element["github"]) {
				echo githubButton($element["github"], $element["name"]);
			}
			if ($element["gitlab"]) {
				echo gitlabButton($element["gitlab"], $element["name"]);
			}
		?>
	</div>

	<div class="actionButtonContainer row">
		<?php $date = date("H:m:s d/m/Y", strtotime($element["update"])) ?>
		<button class="simpleButton lastUpdateDate" title="Dernière modification : <?= $date ?>">
			<i class="ri-time-line"></i>
		</button>

		<?php if ($element["path"]) { ?>
			<button class="simpleButton copyButton" data-id="<?= $element["name"] ?>" id="copyButton" value="<?= $element["path"] ?>" title="Copier le chemin">
				<i class="ri-link"></i>
			</button>
		<?php } ?>

		<button class="simpleButton editButton" id="editButton" value="<?= $element["uid"] ?>" title="Modifier">
			<i class="ri-pencil-line"></i>
		</button>

		<form method="POST" class="actionForm row">
			<button class="simpleButton deleteButton" type="submit" name="deleteItem" value="<?= $element["name"] ?>" onclick="return confirmForm()" title="Supprimer">
				<i class="ri-delete-bin-line"></i>
			</button>
		</form>
	</div>
</div>
