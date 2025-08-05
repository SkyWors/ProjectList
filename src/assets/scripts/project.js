const link = document.querySelectorAll(".content > .link")

link.forEach((action) => {
	Array.from(action.children).forEach((element) => {
		if (element.dataset.color != undefined) {
			element.style.backgroundColor = element.dataset.color;
		}
	});
});
