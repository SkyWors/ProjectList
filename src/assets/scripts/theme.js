const themeButton = document.getElementById("theme_button");
const html = document.documentElement;
const themeList = ["light", "dark", "system"];
const themeIcon = ["ri-sun-line", "ri-moon-line", "ri-progress-4-line"];
const currentTheme = localStorage.getItem("theme") || "light";

html.setAttribute("data-theme", currentTheme);

if (isElementExist(themeButton)) {
	updateThemeButton(themeList.indexOf(currentTheme));

	themeButton.addEventListener("click", () => {
		const themeIndex = (themeList.indexOf(html.getAttribute("data-theme")) + 1) % themeList.length;
		const nextTheme = themeList[themeIndex];

		html.setAttribute("data-theme", nextTheme);
		localStorage.setItem("theme", nextTheme);

		updateThemeButton(themeIndex)
	});

	async function updateThemeButton(themeIndex) {
		const iconElement = themeButton.querySelector('i');
		if (iconElement) {
			iconElement.className = themeIcon[themeIndex];
			iconElement.title = await translate("MAIN_THEME_" + themeList[(themeIndex + 1) % themeList.length].toUpperCase());
		}
	}
}
