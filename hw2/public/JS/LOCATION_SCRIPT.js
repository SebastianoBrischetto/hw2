//Costanti globali per la mappa
const MAP_KEY = 'fWuD4P38hJTPB6mwWZjmArcc1bqe2XGw';
const MAP_CONTAINER = document.querySelector('#map');
const ADDRESS = document.querySelector('#full_address').textContent;
const FETCH_URL = document.querySelector('meta[name="fetch_url"]').content;

//Costanti globali per il slide show
const SLIDE_SHOWS = document.querySelectorAll('.slide_show');
const ALL_SHORTCUTS = document.querySelectorAll('.shortcut');
const PRECENDENT_BUTTONS = document.querySelectorAll('.precedent');
const NEXT_BUTTONS = document.querySelectorAll('.next');

/*----------------------------------------------
					Undefined					
------------------------------------------------*/

//Al caricamento della pagina carica la mappa
fetch(FETCH_URL + '/getLatLng/' + ADDRESS).then(onResponse).then(function (json){
	L.mapquest.key = MAP_KEY;
	const THIS_MAP = L.mapquest.map(MAP_CONTAINER, {
		center: [json.lat, json.lng],
		layers: L.mapquest.tileLayer('map'),
		zoom: 15
	});

	L.marker([json.lat, json.lng], {
		icon: L.mapquest.icons.marker(),
		draggable: false
	}).bindPopup('Ci trovi qui').addTo(THIS_MAP);
});

//Ricezione della risposta
function onResponse(response) {	return response.json(); }

//Aggiunta di EventListeners alla pagina

for(let shortcut of ALL_SHORTCUTS) {
	shortcut.addEventListener('click', shortcutJump);
}

for(let precedentButton of PRECENDENT_BUTTONS) {
	precedentButton.addEventListener('click',precedent);
}

for(let nextButton of NEXT_BUTTONS) {
	nextButton.addEventListener('click',next);
}

//Avvio dei slideshow
for(let slideShow of SLIDE_SHOWS){
	updateSlides(0,slideShow);
}
