const link = document.querySelectorAll(".content > .link")
const searchInput = document.getElementById("search");
const addProjectForm = document.querySelector("#add_project_form");
const addLinkFieldButton = document.getElementById("add_link");

const projectTileName = document.getElementById("project_name");
const projectTileDescription = document.getElementById("project_description");

const projectFormName = document.getElementById("add_project_name");
const projectFormDescription = document.getElementById("add_project_description");

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
	addProjectForm.addEventListener("submit", function(event) {
		const fileInput = addProjectForm.querySelector('input[name="illustration"]');

		if (
			fileInput
			&& fileInput.files.length > 0
		) {
			const file = fileInput.files[0];

			if (file.size > 512 * 1024) { // 512 KB
				event.preventDefault();
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
            <input class="element" type="text" name="link[${nextIndex}][link]" placeholder="Add a link">
            <input class="element" type="color" name="link[${nextIndex}][color]">
            <input class="element" type="text" name="link[${nextIndex}][icon]" placeholder="Add an icon">
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
		if (event.target.value.length > 46) {
			event.target.value = event.target.value.slice(0, 46);
		}
		projectTileName.textContent = event.target.value;
	});

	projectFormDescription.addEventListener("input", function(event) {
		// if (event.target.value.length > 46) {
		// 	event.target.value = event.target.value.slice(0, 46);
		// }
		projectTileDescription.textContent = event.target.value;
	});
}
