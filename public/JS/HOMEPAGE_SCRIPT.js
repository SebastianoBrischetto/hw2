const SLIDE_SHOWS = document.querySelectorAll('.slide_show');
const ALL_SHORTCUTS = document.querySelectorAll('.shortcut');

for(let shortcut of ALL_SHORTCUTS) {
	shortcut.addEventListener('click', shortcutJump);
}

for(let slideShow of SLIDE_SHOWS) {
	updateSlides(slideShow.querySelectorAll('.slide_element').length - 1, slideShow);
	autoSlideShow(slideShow);
}