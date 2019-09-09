const mq = window.matchMedia("(max-width: 770px)");

if (mq.matches) {
	const mainNav = document.getElementById("main-nav");
	const submenu1 = document.querySelectorAll(".sub-menu-1");
	const menuIcon = document.getElementById("menu-icon");
	const hasSubmenu= document.querySelectorAll(".has-submenu");

	menuIcon.addEventListener('click', function(){
		if (mainNav.style.display != "block"){
			mainNav.style.display = "block";
			this.innerHTML = "<img src=\"logo.png\" id=\"toplogo\">X";
		} else{
			mainNav.style.display = "none";
			this.innerHTML = "<img src=\"logo.png\" id=\"toplogo\">MENU";
		}
	});
}