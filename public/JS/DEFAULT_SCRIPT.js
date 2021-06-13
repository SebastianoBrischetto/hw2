/*----------------------------------------------
			Messaggi all'utente					
------------------------------------------------*/

//Mostra un messaggio al centro della pagina
function showMessage(message, type, duration) {
	if(document.querySelector('.message_window')) {
		document.querySelector('.message_window').remove();	
	}

	const MESSAGE_WINDOW = document.createElement('div');
	MESSAGE_WINDOW.classList.add('message_window');
	switch(type) {
		case 'error':
			MESSAGE_WINDOW.classList.add('error_message');
			break;

		case 'warning':
			MESSAGE_WINDOW.classList.add('warning_message');
			break;

		case 'success':
			MESSAGE_WINDOW.classList.add('success_message');
			break;

		default:
			MESSAGE_WINDOW.classList.add('info_message');
			
	}
	MESSAGE_WINDOW.innerHTML = message;
	document.querySelector('body').appendChild(MESSAGE_WINDOW);

	setTimeout(function() {
		MESSAGE_WINDOW.classList.add('fadeout');
		setTimeout(function(){ MESSAGE_WINDOW.remove(); },1000);
	},duration);
}

/*----------------------------------------------
			Comportamento overlay					
------------------------------------------------*/

/*Espande l'overlay
function expandOverlay() {
	const OVERLAY = event.currentTarget.querySelector('.transition_overlay');
	OVERLAY.classList.add('open');
	OVERLAY.querySelector('.description').classList.remove('hidden');
	if(OVERLAY.querySelector('.round_button')) {
		OVERLAY.querySelector('img').classList.remove('hidden');
	}
	OVERLAY.querySelector('.note').classList.remove('hidden');
}

//Riduce l'overlay
function shrinkOverlay(){
	const OVERLAY = event.currentTarget.querySelector('.transition_overlay');
	OVERLAY.classList.remove('open');
	OVERLAY.querySelector('.description').classList.add('hidden');
	if(OVERLAY.querySelector('.round_button')) {
		OVERLAY.querySelector('img').classList.add('hidden');
	}
	OVERLAY.querySelector('.note').classList.add('hidden');
}*/

/*----------------------------------------------
					Slide Show					
------------------------------------------------*/

//Aggiornamento slide
function updateSlides(index,slideShow) {
	const SLIDES = slideShow.querySelectorAll('.slide_element');
	const SHORTCUTS = slideShow.querySelectorAll('.shortcut');
	for(let slide of SLIDES) {
		slide.classList.add('hidden');
	}
	
	for(let shortcut of SHORTCUTS) {
		shortcut.classList.remove('active_shortcut');
	}
	
	if(index < 0) {
		index = SLIDES.length - 1;
	} else if(index > SLIDES.length - 1) {
		index = 0;
	}
	SLIDES[index].classList.replace('fade_out','fade_in');
	SLIDES[index].classList.remove('hidden');
	SHORTCUTS[index].classList.add('active_shortcut');
}

//Recupera la slide attuale
function getCurrentSlide(slideShow) {
	const SLIDES = slideShow.querySelectorAll('.slide_element');
	for(let i = 0; i < SLIDES.length; i++) {
		if(!SLIDES[i].classList.contains('hidden')) {
			SLIDES[i].classList.replace('fade_in','fade_out');
			return i;
		}
	}
}

function autoSlideShow(slideShow) {
	setTimeout(autoSlideShow, 10000, slideShow);
	const INDEX = getCurrentSlide(slideShow) + 1;
	updateSlidesWithDelay(INDEX,slideShow);
}

//Mostra la slide precedente
function precedent() {
	const SLIDE_SHOW = event.currentTarget.parentNode;
	const INDEX = getCurrentSlide(SLIDE_SHOW) - 1;
	updateSlidesWithDelay(INDEX,SLIDE_SHOW);
}

//Mostra la prossima slide
function next() {
	const SLIDE_SHOW = event.currentTarget.parentNode;
	const INDEX = getCurrentSlide(SLIDE_SHOW) + 1;
	updateSlidesWithDelay(INDEX,SLIDE_SHOW);
}
//Mostra la slide relativa alla scorciatoia premuta
function shortcutJump() {
	const SLIDE_SHOW = event.currentTarget.parentNode.parentNode;
	getCurrentSlide(SLIDE_SHOW);
	const INDEX = event.currentTarget.dataset.slide_index;
	updateSlidesWithDelay(INDEX,SLIDE_SHOW);
}

function updateSlidesWithDelay(index,slideShow) {
	setTimeout(updateSlides,250,index,slideShow);
}