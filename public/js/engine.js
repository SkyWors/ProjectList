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

document.getElementById("addFormButton").addEventListener("click", () => {
	document.getElementById("addForm").style.display = "flex";
	document.getElementById("addFormButton").style.display = "none";
	document.getElementById("closeFormButton").style.display = "block";
	window.scrollTo(0, 0);
})

document.getElementById("closeFormButton").addEventListener("click", () => {
	document.getElementById("addForm").style.display = "none";
	document.getElementById("addFormButton").style.display = "block";
	document.getElementById("closeFormButton").style.display = "none";
})

var language = document.querySelectorAll('#language');
language.forEach(function (element) {
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

document.getElementById("statsSelectProject").textContent = document.querySelectorAll('#itemName').length;

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
	});
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

document.getElementById("exportButton").addEventListener("click", function() {
	var link = document.createElement("a");
	link.download = "project.json";
	link.href = "data/project.json";

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
		let eventElement = event.target.parentElement.parentElement;
		let name = eventElement.children[0].textContent;

		document.getElementById("addFormButton").click();

		document.getElementById("form").children[0].textContent = "Modifier un projet";

		document.getElementById("formName").value = name;
		document.getElementById("formPath").value = eventElement.children[1].value;
		document.getElementById("formDesc").value = eventElement.children[0].title;
		document.getElementById("formURL").value = eventElement.children[0].href;
		document.getElementById("formGitHub").value = document.querySelector(`a.github[data-id=${name}]`)?.href ?? null;
		document.getElementById("formGitLab").value = document.querySelector(`a.gitlab[data-id=${name}]`)?.href ?? null;
		document.getElementById("formLang").value = document.querySelector(`a.language[data-id=${name}]`).title;
		document.getElementById("formBadge").value = document.querySelector(`a.badge[data-id=${name}]`).title;

		document.getElementById("add").textContent = "Modifier";
		document.getElementById("add").name = "update";
		document.getElementById("add").value = name;
	});
});

document.getElementById("importField").addEventListener("change", () => {
	document.getElementById("importForm").submit();
})
