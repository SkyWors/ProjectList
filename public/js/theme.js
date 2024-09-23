function calculateSettingAsThemeString({localStorageTheme, systemSettingDark}) {
	if (localStorageTheme !== null) {
		return localStorageTheme;
	}

	if (systemSettingDark.matches) {
		return "dark";
	}

	return "light";
}

function updateButton({isDark}) {
	const text = isDark ? "Light theme" : "Dark theme";
	const icon = isDark ? "ri-sun-line" : "ri-moon-line";

	let button = document.getElementById("themeButton");

	button.title = text;
	button.children[0].className = icon;
}

function updateThemeOnHtmlEl({theme}) {
	document.querySelector("html").setAttribute("data-theme", theme);
}

const button = document.getElementById("themeButton");
const localStorageTheme = localStorage.getItem("theme");
const systemSettingDark = window.matchMedia("(prefers-color-scheme: dark)");

let currentThemeSetting = calculateSettingAsThemeString({localStorageTheme, systemSettingDark});

updateButton({isDark: currentThemeSetting === "dark"});
updateThemeOnHtmlEl({theme: currentThemeSetting});

button.addEventListener("click", () => {
	const newTheme = currentThemeSetting === "dark" ? "light" : "dark";

	localStorage.setItem("theme", newTheme);
	updateButton({isDark: newTheme === "dark"});
	updateThemeOnHtmlEl({theme: newTheme});

	currentThemeSetting = newTheme;
});
