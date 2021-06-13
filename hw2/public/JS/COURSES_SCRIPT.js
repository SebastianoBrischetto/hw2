//Constanti globali
const FAVORITES_LIST = document.querySelector('#favorites .list_row');
const FITNESS_LIST = document.querySelector('#fitness .list_row');
const SWIMMING_LIST = document.querySelector('#swimming .list_row');
const WELLNESS_LIST = document.querySelector('#wellness .list_row');
const MARTIAL_ARTS_LIST = document.querySelector('#martial_arts .list_row');
const SEARCH_BAR = document.querySelector('input[name="searchbar"]');
const FETCH_URL = document.querySelector('meta[name="fetch_url"]').content;

/*----------------------------------------------
				Gestione Preferiti					
------------------------------------------------*/

//Crea un elemento con cloneNode
function createElement(element,action) {
	const NEW_ELEMENT = element.cloneNode(true);
	//NEW_ELEMENT.addEventListener('mouseenter', expandOverlay);
	//NEW_ELEMENT.addEventListener('mouseleave', shrinkOverlay);
	NEW_ELEMENT.querySelector('.transition_overlay').addEventListener('click',moreInfo);
	const NEW_BUTTON = NEW_ELEMENT.querySelector('.round_button');
	const NEW_NOTE = NEW_ELEMENT.querySelector('.note');
	switch (action) {
		case 'add':
			NEW_BUTTON.src = 'http://localhost/hw2/public/images/buttons/add.png';
			NEW_BUTTON.addEventListener('click', addToFavorites);
			NEW_NOTE.textContent = 'Aggiungi ai preferiti';
			break;

		case 'remove':
			NEW_BUTTON.src = 'http://localhost/hw2/public/images/buttons/remove.png';	
			NEW_BUTTON.addEventListener('click', removeFromFavorites);
			NEW_NOTE.textContent = 'Rimuovi dai preferiti';
			break;
	}
	
	return NEW_ELEMENT;
}

/*Creazione un elemento
function createElement(image, title, description, buttonFunction, id) {	
	const NEW_IMG = document.createElement('img');
	NEW_IMG.classList.add('list_element_background');
	NEW_IMG.src = image;
	
	const NEW_OVERLAY = document.createElement('div');
	NEW_OVERLAY.classList.add('transition_overlay');
	
	const NEW_TITLE = document.createElement('h3');
	NEW_TITLE.textContent = title;
	
	const NEW_DESCRIPTION = document.createElement('p');
	NEW_DESCRIPTION.classList.add('description', 'hidden');
	NEW_DESCRIPTION.textContent = description;
	
	const NEW_BUTTON = document.createElement('img');
	NEW_BUTTON.classList.add('round_button', 'hidden');
	const NEW_NOTE = document.createElement('p');
	NEW_NOTE.classList.add('note', 'hidden');
	switch (buttonFunction) {
		case 'add':
			NEW_BUTTON.src = 'images/buttons/add.png';
			NEW_BUTTON.addEventListener('click', addToFavorites);
			NEW_NOTE.textContent = 'Aggiungi ai preferiti';
			break;

		case 'remove':
			NEW_BUTTON.src = 'images/buttons/remove.png';	
			NEW_BUTTON.addEventListener('click', removeFromFavorites);
			NEW_NOTE.textContent = 'Rimuovi dai preferiti';
			break;
	}
	
	const NEW_ELEMENT = document.createElement('div');
	NEW_ELEMENT.classList.add('list_element');
	//NEW_ELEMENT.addEventListener('mouseenter', expandOverlay);
	//NEW_ELEMENT.addEventListener('mouseleave', shrinkOverlay);
	NEW_ELEMENT.dataset.id = id;
	NEW_ELEMENT.appendChild(NEW_IMG);
	NEW_ELEMENT.appendChild(NEW_OVERLAY);
	NEW_OVERLAY.appendChild(NEW_TITLE);
	NEW_OVERLAY.appendChild(NEW_DESCRIPTION);
	NEW_OVERLAY.appendChild(NEW_BUTTON);
	NEW_OVERLAY.appendChild(NEW_NOTE);
	return NEW_ELEMENT;
}*/

//Ritorna gli id dei corsi della lista
function getIds(list) {
	let ids=[];
	
	const ELEMENTS = list.querySelectorAll('.list_element');
	for(let element of ELEMENTS) {
		ids.push(element.dataset.id);
	}
	
	return ids;
}

//Inserimeno nei preferiti
function addToFavorites() {
	event.stopPropagation();
	const ELEMENT = event.currentTarget.parentNode.parentNode;
	
	const ID = ELEMENT.dataset.id;
	const FAVORITES_IDS = getIds(FAVORITES_LIST);
	if(FAVORITES_IDS.includes(ID)) {
		showMessage('Corso gia aggiunto', 'error', 1000);
	} else {
		fetch(FETCH_URL + '/add/' + ID).then(onResponse).then(function(json) {
			if(json.success) {
				//const IMAGE = ELEMENT.querySelector('img').src;
				//const TITLE = ELEMENT.querySelector('h3').textContent;
				//const DESCRIPTION = ELEMENT.querySelector('.description').textContent;
				//const NEW_ELEMENT = createElement(IMAGE, TITLE, DESCRIPTION, 'remove', ID);*/
				const NEW_ELEMENT = createElement(ELEMENT,'remove');
				FAVORITES_LIST.appendChild(NEW_ELEMENT);	
				showMessage(json.message, 'success', 1000);
				hideIfEmpty(FAVORITES_LIST);
			} else {
				showMessage(json.message, 'error', 1000);
			}
		});
	}
}

//Rimozione dai preferiti
function removeFromFavorites() {
	event.stopPropagation();
	const ELEMENT = event.currentTarget.parentNode.parentNode;
	const ID = ELEMENT.dataset.id;
	fetch(FETCH_URL + '/remove/' + ID).then(onResponse).then(function(json) {
		if(json.success){
			ELEMENT.remove();
			hideIfEmpty(FAVORITES_LIST);
		} else {
			showMessage(json.error, 'error', 1000);
		}
	});
}

//Ricezione della risposta
function onResponse(response) { return response.json(); }

/*----------------------------------------------
					Ricerca					
------------------------------------------------*/

//Ricerca su tutte le liste
function searchAll() {
	const TEXT = SEARCH_BAR.value.toLowerCase();
	search(FAVORITES_LIST, TEXT);
	search(FITNESS_LIST, TEXT);
	search(SWIMMING_LIST, TEXT);
	search(WELLNESS_LIST, TEXT);
	search(MARTIAL_ARTS_LIST, TEXT);
}

//Ricerca in una lista
function search(list, text) {
	const ELEMENTS = list.querySelectorAll('.list_element');
	for(let element of ELEMENTS) {
		(element.querySelector('h3').textContent.toLowerCase().includes(text)) ? element.classList.remove('hidden') : element.classList.add('hidden');
	}
}

//Nasconde la lista se vuota
function hideIfEmpty(list) {
	(list.querySelectorAll('.list_element').length) ? list.parentNode.classList.remove('hidden') : list.parentNode.classList.add('hidden');
}

/*----------------------------------------------
					Undefined					
------------------------------------------------*/
function moreInfo(){
	window.location.href = FETCH_URL + '/' + event.currentTarget.parentNode.dataset.id;
}
//Aggiunta di event listener agli elementi della lista
function addEvents(list, type) {
	let button;
	switch (type) {
		case 'add':
			button = addToFavorites;
			break;

		case 'remove': 
			button = removeFromFavorites;
			break;

	}

	const ELEMENTS = list.querySelectorAll('.list_element');
	for (let element of ELEMENTS) {
		//element.addEventListener('mouseenter', expandOverlay);
		//element.addEventListener('mouseleave', shrinkOverlay);
		element.querySelector('.transition_overlay').addEventListener('click',moreInfo);
		element.querySelector('.round_button').addEventListener('click', button);
	}
}

//Aggiunta di eventListeners alla pagina
SEARCH_BAR.addEventListener('keyup', searchAll);	
addEvents(FAVORITES_LIST,'remove');
addEvents(FITNESS_LIST,'add');
addEvents(SWIMMING_LIST,'add');
addEvents(WELLNESS_LIST,'add');
addEvents(MARTIAL_ARTS_LIST,'add');