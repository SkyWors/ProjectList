let url = new URL(window.location.href);
let params = url.searchParams;

var languages = params.get("language")?.split(",") ?? [];
var filters = params.get("filter")?.split(",") ?? [];

function updateURL() {
	if (filters.length > 0) {
		params.set("filter", filters.join(","));
	} else {
		params.delete("filter");
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

		params.set("profil", element.value);

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
		let language = element.textContent.toString();
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
		let badge = element.textContent.toString();
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

	params.set("profil", profilSelect.value);

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

	listItems.forEach(function (item) {
		var itemText = item.textContent.toLowerCase();

		if (itemText.includes(searchTerm)) {
			item.parentElement.parentElement.style.display = "flex";
			count++;
		} else {
			item.parentElement.parentElement.style.display = "none";
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
			if (item.textContent.toLowerCase().replace(" ", "") == event.target.value.toLowerCase() && event.target.value != "") {
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
		document.getElementById("edit").setAttribute("disabled", "true");
		document.getElementById("idea").setAttribute("disabled", "true");
	} else {
		document.getElementById("edit").removeAttribute("disabled");
		document.getElementById("idea").removeAttribute("disabled");
	}
});

document.getElementById("exportButton").addEventListener("click", (event) => {
	var link = document.createElement("a");
	eventElement = event.target.value;
	if (event.target.id != "exportButton") {
		eventElement = event.target.parentElement.value;
	}
	link.download = eventElement;
	link.href = "data/" + eventElement;

	document.body.appendChild(link);
	link.click();
	document.body.removeChild(link);
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
		let eventElement = event.target.parentElement.parentElement.parentElement;
		if (event.target.id == "editButton") {
			eventElement = eventElement.children[0];
		}

		let name = eventElement.children[0].textContent.replace(" ", "");

		document.getElementById("addFormButton").click();

		document.getElementById("form").children[0].textContent = "Modifier un projet";

		document.getElementById("formName").value = name;
		document.getElementById("formPath").value = document.querySelector(`button.copyButton[data-id=${name}]`)?.value ?? null;
		document.getElementById("formDesc").value = document.querySelector(`div.description[data-id=${name}]`).textContent;
		document.getElementById("formURL").value = document.querySelector(`a.itemName[data-id=${name}]`)?.href ?? null;
		document.getElementById("formGitHub").value = document.querySelector(`a.github[data-id=${name}]`)?.href ?? null;
		document.getElementById("formGitLab").value = document.querySelector(`a.gitlab[data-id=${name}]`)?.href ?? null;
		document.getElementById("formLang").value = document.querySelector(`a.language[data-id=${name}]`).title;
		document.getElementById("formBadge").value = document.querySelector(`a.badge[data-id=${name}]`).title;

		if (document.getElementById("formPath").value == "") {
			document.getElementById("edit").setAttribute("disabled", "true");
			document.getElementById("idea").setAttribute("disabled", "true");
		} else {
			document.getElementById("edit").removeAttribute("disabled");
			document.getElementById("idea").removeAttribute("disabled");

			!document.querySelector(`a.vscode[data-id=${name}]`) || document.getElementById("formPath").value == "" ? document.getElementById("edit").removeAttribute("checked") : document.getElementById("edit").setAttribute("checked", "true");
			!document.querySelector(`a.idea[data-id=${name}]`) || document.getElementById("formPath").value == "" ? document.getElementById("idea").removeAttribute("checked") : document.getElementById("idea").setAttribute("checked", "true");
		}

		document.getElementById("add").textContent = "Modifier";
		document.getElementById("add").name = "update";
		document.getElementById("add").value = name;
	});
});

document.getElementById("importField").addEventListener("change", () => {
	document.getElementById("importForm").submit();
})
