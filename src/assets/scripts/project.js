const link = document.querySelectorAll(".content > .link")
const searchInput = document.getElementById("search");
const addProjectForm = document.querySelector("#add_project_form");
const addLinkFieldButton = document.getElementById("add_link");

const projectTileName = document.getElementById("project_name");
const projectTileDescription = document.getElementById("project_description");
const projectTileImage = document.getElementById("project_illustration");

const projectFormName = document.getElementById("add_project_name");
const projectFormDescription = document.getElementById("add_project_description");
const projectFormIllustration = document.getElementById("add_project_illustration");

if (isElementExist(searchInput)) {
	searchInput.addEventListener("input", function(event) {
		const searchValue = event.target.value.toLowerCase().replace(" ", "");
		const projectTiles = document.querySelectorAll(".project_container");

		projectTiles.forEach((tile) => {
			const title = tile.querySelector("#project_name").textContent.toLowerCase().replace(" ", "");
			if (title.includes(searchValue)) {
				tile.style.display = "";
			} else {
				tile.style.display = "none";
			}
		});
	});
}

link.forEach((action) => {
	Array.from(action.children).forEach((element) => {
		if (element.dataset.color != undefined) {
			element.style.backgroundColor = element.dataset.color;
		}
	});
});

if (isElementExist(addProjectForm)) {
	if (projectFormIllustration) {
		projectFormIllustration.addEventListener("change", function(event) {
			const file = event.target.files[0];

			if (file) {
				if (file.size > 512 * 1024) { // 512 KB
					alert("The selected file is larger than 512KB.");
					event.target.value = "";
					projectTileImage.src = `${window.location.origin}/assets/images/noimage.webp`;
					return;
				}

				const reader = new FileReader();
				reader.onload = function(e) {
					const img = new Image();
					img.onload = function() {
						const canvas = document.createElement("canvas");
						canvas.width = 80;
						canvas.height = 80;
						const ctx = canvas.getContext("2d");
						ctx.drawImage(img, 0, 0, 80, 80);
						const resizedDataUrl = canvas.toDataURL("image/png");
						projectTileImage.src = resizedDataUrl;
					};
					img.src = e.target.result;
					projectTileImage.src = e.target.result;
				};
				reader.readAsDataURL(file);
			}
		});
	}

	addProjectForm.addEventListener("submit", function(event) {
		if (
			projectFormIllustration
			&& projectFormIllustration.files.length > 0
		) {
			const file = projectFormIllustration.files[0];

			if (file.size > 512 * 1024) { // 512 KB
				event.preventDefault();
				projectTileImage.src = `${window.location.origin}/assets/images/noimage.webp`;
				alert("The selected file is larger than 512KB.");
			}
		}
	});
}

if (isElementExist(addLinkFieldButton)) {
	addLinkFieldButton.addEventListener("click", function(event) {
		const linkContainers = document.querySelectorAll(".add_link_container");
		const nextIndex = linkContainers.length;

		const newLinkContainer = document.createElement("div");
		newLinkContainer.className = "add_link_container";

		newLinkContainer.innerHTML = `
			<div class="information_container">
				<input class="element" type="text" name="link[${nextIndex}][name]" placeholder="Add a name to the link">
				<input class="element" type="color" name="link[${nextIndex}][color]">
				<input class="element number" type="number" name="link[${nextIndex}][icon]">
			</div>
			<input class="element" type="text" name="link[${nextIndex}][link]" placeholder="Add a link">
			<button type="button" class="add_link">Add Link</button>
		`;

		const newAddButton = newLinkContainer.querySelector(".add_link");
		newAddButton.addEventListener("click", arguments.callee);

		const lastContainer = linkContainers[linkContainers.length - 1];
		lastContainer.parentNode.insertBefore(newLinkContainer, lastContainer.nextSibling);
	});
}

// Tile updater
if (isElementExist(projectTileName)) {
	projectFormName.addEventListener("input", function(event) {
		if (event.target.value.length > 38) {
			event.target.value = event.target.value.slice(0, 38);
		}
		projectTileName.textContent = event.target.value;
	});

	projectFormDescription.addEventListener("input", function(event) {
		if (event.target.value.length > 62) {
			event.target.value = event.target.value.slice(0, 62);
		}
		projectTileDescription.textContent = event.target.value;
	});
}
