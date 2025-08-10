const main = document.querySelector("main");
const footer = document.querySelector("footer");
const drawer = document.querySelector(".action_drawer");
const drophover = document.querySelectorAll("#drawer_drophover");
const state = document.querySelector(".drawer_state");
const filters = document.querySelector(".filters");

const drawerWidth = "260px";
const collapsedDrawerWidth = "60px";

setDrawerState(drawerState);

drophover.forEach((element) => {
	element.addEventListener("click", () => {
		let icon = element.querySelector("i");
		let dropdown = element.nextElementSibling;

		if (dropdown.style.display === "flex") {
			icon.className = "ri-arrow-down-s-line";
			dropdown.style.display = "none";
			filters.style.overflowY = "hidden";
			return;
		} else {
			icon.className = "ri-arrow-up-s-line";
			dropdown.style.display = "flex";
			filters.style.overflowY = "scroll";
			return;
		}
	});
});

state.addEventListener("click", () => {
	let icon = state.querySelector("i");
	if (icon.className == "ri-arrow-right-s-line") {
		setDrawerState(true);
		localStorage.setItem("drawer", true);
	} else {
		setDrawerState(false);
		localStorage.setItem("drawer", false);
	}
});

function setDrawerState(drawerState) {
	if (drawerState) {
		drawer.classList.remove("collapsed");
		main.style.marginLeft = drawerWidth;
		footer.style.marginLeft = drawerWidth;
		state.querySelector("i").className = "ri-arrow-left-s-line";
	} else {
		drawer.classList.add("collapsed");
		main.style.marginLeft = collapsedDrawerWidth;
		footer.style.marginLeft = collapsedDrawerWidth;
		state.querySelector("i").className = "ri-arrow-right-s-line";
	}
}
