//Constanti globali
const FETCH_URL = document.querySelector('meta[name="fetch_url"]').content;
const SEARCH_BAR = document.querySelector('input[name="search_bar"]');
const LOADER = document.querySelector('#loader');

/*----------------------------------------------
			Ricerca degli esercizi					
------------------------------------------------*/

//Ricerca in base al tipo
function search() {
	const TYPE = document.querySelector('select[name="type"]');
	if(TYPE.value == 0) {
		showMessage('Selezionare un tipo di esercizio', 'error', 2000);
	} else { 
		LOADER.classList.remove('hidden');
		fetch(FETCH_URL + '/' + TYPE.value).then(onResponse).then(onJson);
	}
}

//Ricezione della risposta
function onResponse(response) {	return response.json(); }

//Alla ricevuta del json
function onJson(json) {
	const LIBRARY = document.querySelector('#exercise_library');
	LIBRARY.innerHTML = '';

	for(let result of json.results) {
		if(result.name.toLowerCase().includes(SEARCH_BAR.value.toLowerCase())) {
			const NAME = document.createElement('h3');
			NAME.textContent = result.name;

			const DETAILS = document.createElement('div');
			DETAILS.classList.add('details', 'hidden');
			DETAILS.innerHTML = result.description;

			const ELEMENT = document.createElement('div');
			ELEMENT.classList.add('list_element');
			ELEMENT.addEventListener('click',detailsToggle);
			ELEMENT.appendChild(NAME);
			ELEMENT.appendChild(DETAILS);
			LIBRARY.appendChild(ELEMENT);
		}
	}
	LOADER.classList.add('hidden');
	if(!LIBRARY.querySelectorAll('.list_element').length) {
		showMessage('Non sono stati trovati esercizi pertinenti', 'error', 1000);
	}
}
/*----------------------------------------------
					Undefined					
------------------------------------------------*/

//Mostra o Nasconde la descrizione
function detailsToggle() {
	const DETAILS = event.currentTarget.querySelector('.details');
	(DETAILS.classList.contains('hidden')) ? DETAILS.classList.remove('hidden') : DETAILS.classList.add('hidden');
}

//Aggiunta di eventListener alla pagina
document.querySelector('#search').addEventListener('click',search);
