passwordButton = document.querySelectorAll("#showPassword");
passwordButton.forEach(element => {
	element.addEventListener("click", (event) => {
		let input = event.target.parentElement.children[0];

		if (input.type == "password") {
			input.type = "text";
			event.target.className = "ri-eye-line showPassword";
		} else {
			input.type = "password";
			event.target.className = "ri-eye-off-line showPassword";
		}
	})
})

if (register == true) {
	document.getElementById("register").style.display = "block";
	document.getElementById("login").style.display = "none";
}

document.getElementById("toLogin").addEventListener("click", () => {
	document.getElementById("register").style.display = "none";
	document.getElementById("login").style.display = "block";
})

document.getElementById("toRegister").addEventListener("click", () => {
	document.getElementById("register").style.display = "block";
	document.getElementById("login").style.display = "none";
})
