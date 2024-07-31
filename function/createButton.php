<?php

function vscodeButton($path, $name) {
	return '<a class="button vscode" data-id="' . $name . '" href="vscode://file/' . $path . '"><img src="/public/icon/vscode.svg"></a>';
}

function ideaButton($path, $name) {
	return '<a class="button idea" data-id="' . $name . '" href="idea://' . $path . '"><img src="/public/icon/idea.png"></a>';
}

function githubButton($url, $name) {
	return '<a class="button github" data-id="' . $name . '" href="' . $url . '" target="_blank"><img src="/public/icon/github.svg"></a>';
}

function gitlabButton($url, $name) {
	return '<a class="button gitlab" data-id="' . $name . '" href="' . $url . '" target="_blank"><img src="/public/icon/gitlab.svg"></a>';
}

