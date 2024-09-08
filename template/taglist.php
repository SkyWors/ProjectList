<div class="box filterContainer column">
	<a class="tagListTitle"><i class="ri-bookmark-line"></i> Tags</a>
	<div class="badgeList">
		<?php foreach ($tagList as $element) { ?>
			<div id="filter" value="<?= htmlspecialchars($element) ?>">
				<?php if (isset($selectedTags) && in_array($element, $selectedTags)) { ?>
					<input type="checkbox" checked>
				<?php } else { ?>
					<input type="checkbox">
				<?php } ?>
				<label><?= $element ?></label>
			</div>
		<?php } ?>
	</div>

	<a class="tagListTitle"><i class="ri-global-line"></i> Langages</a>
	<div class="languageList">
		<?php foreach ($languageList as $element) { ?>
			<div id="language" value="<?= htmlspecialchars($element) ?>">
				<?php if (isset($selectedLanguages) && in_array($element, $selectedLanguages)) { ?>
					<input type="checkbox" checked>
				<?php } else { ?>
					<input type="checkbox">
				<?php } ?>
				<label><?= $element ?></label>
			</div>
		<?php } ?>
	</div>
</div>
