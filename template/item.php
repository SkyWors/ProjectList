<div class="box item column">
	<div class="row">
		<?php if ($element["url"] != "") { ?>
			<a class="itemName" id="itemName" title="<?= htmlspecialchars($element["name"]) ?>" data-id="<?= htmlspecialchars($element["name"]) ?>" href="<?= htmlspecialchars($element["url"]) ?>" target="_blank">
				<i class="ri-external-link-line"></i> <?= htmlspecialchars($element["name"]) ?>
			</a>
		<?php } else { ?>
			<a class="itemName" title="<?= htmlspecialchars($element["name"]) ?>" id="itemName"><?= htmlspecialchars($element["name"]) ?></a>
		<?php } ?>

		<div class="badgeContainer">
			<a class="language" data-id="<?= htmlspecialchars($element["name"]) ?>" title="<?= htmlspecialchars($element["language"]) ?>">
				<i class="ri-global-line"></i>
			</a>
			<a class="badge" data-id="<?= htmlspecialchars($element["name"]) ?>" title="<?= htmlspecialchars($element["tag"]) ?>">
				<i class="ri-bookmark-line"></i>
			</a>
		</div>
	</div>

	<div class="description" data-id="<?= htmlspecialchars($element["name"]) ?>" title="<?= htmlspecialchars($element["description"]) ?>">
		<a><?= htmlspecialchars($element["description"]) ?></a>
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
			<button class="simpleButton copyButton" data-id="<?= htmlspecialchars($element["name"]) ?>" id="copyButton" value="<?= htmlspecialchars($element["path"]) ?>" title="Copier le chemin">
				<i class="ri-link"></i>
			</button>
		<?php } ?>

		<button class="simpleButton editButton" id="editButton" value="<?= htmlspecialchars($element["uid"]) ?>" title="Modifier">
			<i class="ri-pencil-line"></i>
		</button>

		<form method="POST" class="actionForm row">
			<button class="simpleButton deleteButton" type="submit" name="deleteItem" value="<?= htmlspecialchars($element["name"]) ?>" onclick="return confirmForm()" title="Supprimer">
				<i class="ri-delete-bin-line"></i>
			</button>
		</form>
	</div>
</div>
