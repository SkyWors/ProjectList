document.getElementById("addFormButton").addEventListener("click", () => {
	document.getElementById("addForm").style.display = "flex";
	document.getElementById("listContainer").style.display = "none";
	document.getElementById("top").style.display = "none";
})

document.getElementById("closeFormButton").addEventListener("click", () => {
	document.getElementById("addForm").style.display = "none";
	document.getElementById("listContainer").style.display = "flex";
	document.getElementById("top").style.display = "flex";
})

var filter = document.querySelectorAll('#filter');
filter.forEach(function (element) {
	element.addEventListener("click", () => {
		let badge = element.textContent.toString();
		let url = new URL(window.location.href);
		let params = url.searchParams;

		if (params.has("filter")) {
			let actual = params.get("filter");
			if (actual.includes(badge)) {
				actual = actual.replace(badge, "");
				console.log(actual);
			} else {
				actual = actual + "," + badge;
			}
			while(actual.slice(-1) == ",") {
				actual = actual.slice(0, -1);
			}
			if (actual != "") {
				params.set("filter", actual);
			} else {
				params.delete("filter");
			}
		} else {
			params.append("filter", badge);
		}

		window.location.href = url;
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
