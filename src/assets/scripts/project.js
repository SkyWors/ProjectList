const link = document.querySelectorAll(".content > .link")
const searchInput = document.getElementById("search");
const addProjectForm = document.querySelector("#add_project_form");

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
