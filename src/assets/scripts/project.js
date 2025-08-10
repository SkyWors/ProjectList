const link = document.querySelectorAll(".content > .link")
const addProjectForm = document.querySelector("#add_project_form");

link.forEach((action) => {
	Array.from(action.children).forEach((element) => {
		if (element.dataset.color != undefined) {
			element.style.backgroundColor = element.dataset.color;
		}
	});
});

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
