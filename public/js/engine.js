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
	document.getElementById("mainScreen").style.display = "none";
})

document.getElementById("closeFormButton").addEventListener("click", () => {
	document.getElementById("addForm").style.display = "none";
	document.getElementById("mainScreen").style.display = "flex";
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

document.getElementById("search").addEventListener("input", function (event) {
	var searchTerm = event.target.value.toLowerCase();
	var listItems = document.querySelectorAll('#itemName');

	listItems.forEach(function (item) {
		var itemText = item.textContent.toLowerCase();

		if (itemText.includes(searchTerm)) {
			item.parentElement.style.display = "block";
		} else {
			item.parentElement.style.display = "none";
		}
	});
});

document.getElementById("exportButton").addEventListener("click", function() {
	var link = document.createElement("a");
	link.download = "project.json";
	link.href = "data/project.json";

	document.body.appendChild(link);
	link.click();
	document.body.removeChild(link);
});
