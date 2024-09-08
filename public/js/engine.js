let url = new URL(window.location.href);
let params = url.searchParams;

var languages = params.get("language")?.split(",") ?? [];
var filters = params.get("tag")?.split(",") ?? [];

function updateURL() {
	if (filters.length > 0) {
		params.set("tag", filters.join(","));
	} else {
		params.delete("tag");
	}
	if (languages.length > 0) {
		params.set("language", languages.join(","));
	} else {
		params.delete("language");
	}

	window.location.href = url;
}

var addButtons = document.querySelectorAll("#addFOrmButton");
addButtons.forEach((element) => {
	element.addEventListener("click", () => {
		document.getElementById("addForm").style.display = "flex";
	})
})

document.getElementById("profilEditButton").addEventListener("click", () => {
	document.getElementById("profilForm").style.display = "flex";
	document.getElementById("profilAdd").focus();
})

document.getElementById("addForm").addEventListener("click", (event) => {
	if (event.target.id == "addForm") {
		document.getElementById("addForm").style.display = "none";
	}
})

document.getElementById("profilForm").addEventListener("click", (event) => {
	if (event.target.id == "profilForm") {
		document.getElementById("profilForm").style.display = "none";
	}
})

document.addEventListener("keydown", function (event) {
	if (event.key === "Escape") {
		document.getElementById("addForm").style.display = "none";
		document.getElementById("profilForm").style.display = "none";
	}
})

var addProfilField = document.getElementById("addProfilField");
addProfilField.addEventListener("click", () => {
	let value = document.getElementById("profilAdd").value;
	if (value != "") {
		createForm("profilAddName", value);
	}
})

document.getElementById("profilAdd").addEventListener("keydown", (event) => {
	if (event.key === "Enter") {
		addProfilField.click();
	}
});

let switchProfil = document.querySelectorAll("#switchProfil");
switchProfil.forEach((element) => {
	element.addEventListener("click", () => {
		url = new URL(window.location.origin);
		params = url.searchParams;

		params.set("profile", element.value);

		window.location.href = url;
	})
})

function createForm(name, value, name2 = "", value2 = "") {
	let form = document.createElement("form");
	form.style.display = "none";
	form.method = "POST";

	let input = document.createElement("input");
	input.name = name;
	input.value = value;

	let input2 = document.createElement("input");
	input2.name = name2;
	input2.value = value2;

	form.appendChild(input);
	form.appendChild(input2);
	document.body.appendChild(form);
	form.submit();
}

var updateProfil = document.querySelectorAll("#saveProfil");
updateProfil.forEach((element) => {
	element.addEventListener("click", (event) => {
		let element = event.target.value;
		if (event.target.id != "saveProfil") {
			element = event.target.parentElement.value;
		}
		createForm("profilUpdateNewName", document.querySelector(`input[data-id=${element}]`).value, "profilUpdateName", element);
	})
})

var deleteProfil = document.querySelectorAll("#deleteProfil");
deleteProfil.forEach((element) => {
	element.addEventListener("click", (event) => {
		let element = event.target.value;
		if (event.target.id != "deleteProfil") {
			element = event.target.parentElement.value;
		}
		createForm("profilDeleteName", element);
	})
})

var language = document.querySelectorAll('#language');
language.forEach((element) => {
	element.addEventListener("click", () => {
		let language = element.getAttribute("value");
		if (languages.includes(language)) {
			languages.splice(languages.indexOf(language), 1);
		} else {
			languages.push(language);
		}
		updateURL();
	})
});

var filter = document.querySelectorAll('#filter');
filter.forEach(function (element) {
	element.addEventListener("click", () => {
		let badge = element.getAttribute("value")
		if (filters.includes(badge)) {
			filters.splice(filters.indexOf(badge), 1);
		} else {
			filters.push(badge);
		}
		updateURL();
	})
});

var profilSelect = document.getElementById("profilSelect");
profilSelect.addEventListener("change", () => {
	url = new URL(window.location.origin);
	params = url.searchParams;

	params.set("profile", profilSelect.value);

	window.location.href = url;
})

document.getElementById("statsSelectProject").textContent = document.querySelectorAll('#itemName').length;

let currentListItems = document.querySelectorAll('#itemName');
if (currentListItems.length <= 0) {
	document.getElementById("noItem").style.display = "flex";
}

document.getElementById("search").addEventListener("input", function (event) {
	var searchTerm = event.target.value.toLowerCase();
	var listItems = document.querySelectorAll('#itemName');
	let count = 0;

	console.log(event.target.value);

	listItems.forEach(function (item) {
		var itemText = item.textContent.toLowerCase();

		if (itemText.includes(searchTerm)) {
			let width = item.parentElement.parentElement.offsetWidth;
			item.parentElement.parentElement.setAttribute("style", `max-width: ${width-44}px;`);
			console.log(width)
			item.parentElement.parentElement.style.display = "flex";
			count++;
		} else {
			item.parentElement.parentElement.style.display = "none";
		}

		if (event.target.value == "") {
			item.parentElement.parentElement.removeAttribute("style");
		}
	})

	if (count <= 0) {
		document.getElementById("noItem").style.display = "flex";
	} else {
		document.getElementById("noItem").style.display = "none";
	}

	document.getElementById("statsSelectProject").textContent = count;
});

let list = document.querySelectorAll("#itemName");
document.getElementById("formName").addEventListener("input", function(event) {
	try {
		list.forEach(function(item) {
			if (item.textContent == event.target.value && event.target.value != "") {
				document.getElementById("add").setAttribute("disabled", "true");
				event.target.style = "box-shadow: inset 0 0 0 2px #c20000";
				event.target.title = "Ce projet existe déjà.";
				throw BreakException;
			} else {
				document.getElementById("add").removeAttribute("disabled");
				event.target.style = "border: none";
				event.target.title = "";
			}
		})
	} catch (e) {}
})

document.getElementById("formPath").addEventListener("input", function(event) {
	if (event.target.value == "") {
		document.getElementById("vscode").setAttribute("disabled", "true");
		document.getElementById("idea").setAttribute("disabled", "true");
	} else {
		document.getElementById("vscode").removeAttribute("disabled");
		document.getElementById("idea").removeAttribute("disabled");
	}
});

document.getElementById("exportButton").addEventListener("click", (event) => {
	eventElement = event.target;
	if (event.target.id != "exportButton") {
		eventElement = event.target.parentElement;
	}
	window.location.href = "export?profile=" + eventElement.value;
});

function confirmForm() {
	if (confirm("Es-tu sûr de vouloir supprimer ce projet de la liste ?")) {
		return true;
	}
	return false;
}

document.querySelectorAll("#copyButton").forEach(function (element) {
	element.addEventListener("click", async (event) => {
		var copyText = document.createElement("textarea");
		copyText.value = event.currentTarget.value;
		document.body.appendChild(copyText);
		copyText.select();
		document.execCommand("copy");
		document.body.removeChild(copyText);
	});
});

document.querySelectorAll("#editButton").forEach(function (element) {
	element.addEventListener("click", (event) => {
		let eventElement = event.target;
		if (event.target.id != "editButton") {
			eventElement = eventElement.parentElement;
		}

		let i = 0;
		let project = "";
		projectList.forEach(element => {
			if (element.uid == eventElement.value) {
				project = projectList[i];
			}
			i++;
		});

		document.getElementById("addFormButton").click();

		document.getElementById("form").children[0].textContent = "Modifier un projet";

		document.getElementById("formName").value = project["name"];
		document.getElementById("formPath").value = project["path"];
		document.getElementById("formDesc").value = project["description"];
		document.getElementById("formURL").value = project["url"];
		document.getElementById("formGitHub").value = project["github"];
		document.getElementById("formGitLab").value = project["gitlab"];
		document.getElementById("formLang").value = project["language"];
		document.getElementById("formBadge").value = project["tag"];

		if (document.getElementById("formPath").value == "") {
			document.getElementById("vscode").setAttribute("disabled", "true");
			document.getElementById("idea").setAttribute("disabled", "true");
		} else {
			document.getElementById("vscode").removeAttribute("disabled");
			document.getElementById("idea").removeAttribute("disabled");

			!project["vscode"] || document.getElementById("formPath").value == "" ? document.getElementById("vscode").removeAttribute("checked") : document.getElementById("vscode").setAttribute("checked", "true");
			!project["idea"] || document.getElementById("formPath").value == "" ? document.getElementById("idea").removeAttribute("checked") : document.getElementById("idea").setAttribute("checked", "true");
		}

		document.getElementById("add").textContent = "Modifier";
		document.getElementById("add").name = "update";
		document.getElementById("add").value = project["name"];
	});
});

document.getElementById("importField").addEventListener("change", () => {
	document.getElementById("importForm").submit();
})
