//Constanti globali
const EXISTING_DIV = document.querySelector('#existing_content');
const NEW_CONTENT = document.querySelector('select[name="new_content"]');
const EXISTING_CONTENT = document.querySelector('select[name="existing_content"');
const FETCH_URL = document.querySelector('meta[name="fetch_url"]').content;
const CSRF_TOKEN = document.querySelector('meta[name="csrf_token"]').content;

/*----------------------------------------------
				Creazione elementi				
------------------------------------------------*/

//Creazione di un select
function createSelect(KEYS, name) {
	const SELECT = document.createElement('select');
	SELECT.name = name;
	
	const NULL_OPTION = document.createElement('option');
	NULL_OPTION.value = 0;
	NULL_OPTION.selected = true;
	NULL_OPTION.disabled = true;
	NULL_OPTION.hidden = true;
	NULL_OPTION.textContent = 'Seleziona un valore';
	SELECT.appendChild(NULL_OPTION);
	
	if(KEYS) {
		for(let key of KEYS) {
			const option = document.createElement('option');
			option.value = key;
			option.textContent = key;
			SELECT.appendChild(option);
		}
	}
	
	return SELECT;
}

//Creazione di un pulsante
function createButton(type) {
	const BUTTON = document.createElement('a');
	BUTTON.classList.add('buttons');
	switch (type) {
		case 'add':
			BUTTON.textContent = 'Aggiungi';
			BUTTON.dataset.table = NEW_CONTENT.value;
			BUTTON.dataset.request = 'add';		
			break;
			
		case 'update':
			BUTTON.textContent = 'Modifica';
			BUTTON.dataset.table = EXISTING_CONTENT.value;
			BUTTON.dataset.request = 'update';
			break;
			
		case 'remove':
			BUTTON.textContent = 'Rimuovi';
			BUTTON.dataset.table = EXISTING_CONTENT.value;
			BUTTON.dataset.request = 'remove';		
			break;

	}
	BUTTON.addEventListener('click',saveData);
	return BUTTON;
}

/*----------------------------------------------
					Fetches					
------------------------------------------------*/

//Recupera il form per l'inserimento dati
function getForm() {
	const TYPE = event.currentTarget;
	fetch(FETCH_URL + '/getForm/' + TYPE.value).then(onResponse).then(createForm).then(function(form) {
		TYPE.parentNode.appendChild(form);
		if(TYPE === EXISTING_CONTENT) {
			loadPrimaryKeys(TYPE);
		}
	});
}

//Recupera i dati della chiave primaria
function loadPrimaryKeys(type) {
	const TABLE = type.value;
	fetch(FETCH_URL + '/getKey/' + TABLE).then(onResponse).then(updateWithPK);
}

//Recupera tutti i dati del valore scelto
function loadContent() {
	const TABLE = EXISTING_CONTENT.value;
	const OPTION = event.currentTarget;
	fetch(FETCH_URL + '/getData/' + TABLE + '/' + OPTION.name + '/' + OPTION.value).then(onResponse).then(updateWithContent);
}

//Ricezione della risposta
function onResponse(response) {	return response.json(); }

/*----------------------------------------------
				Gestione Json					
------------------------------------------------*/

//Crea il form per l'inserimento dei dati
function createForm(json) {
	if(document.querySelector('.list')) {
		document.querySelector('.list').remove();
	}

	const LIST = document.createElement('div');
	LIST.classList.add('list');
	LIST.classList.add('light_grey');

	for(let input of json) {
		if(input.key == 'created_at' || input.key == 'updated_at') {
			continue;
		}
		
		const NEW_KEY = document.createElement('p');
		NEW_KEY.textContent = input.key;
		let NEW_VALUE;
		switch(input.type) {
			case 'AUTO_INCREMENT':
				NEW_VALUE = document.createElement('input');
				NEW_VALUE.value = input.value;
				NEW_VALUE.disabled = true;
				break;

			case 'TYPE':
				NEW_VALUE = createSelect(['fitness', 'swimming', 'wellness', 'martial_arts'], input.key);
				NEW_VALUE.classList.add('is_input');
				break;
				
			case 'LONG_TEXT':
				NEW_VALUE = document.createElement('textarea');
				NEW_VALUE.name = input.key;
				NEW_VALUE.classList.add('is_input');
				break;
				
			case 'IMAGE':
				NEW_VALUE = document.createElement('input');
				NEW_VALUE.name = input.key;
				NEW_VALUE.type = 'file';
				NEW_VALUE.accept = 'jpg, png, jpeg';
				NEW_VALUE.classList.add('is_input', 'is_file');
				break;
				
			case 'SELECT':
				NEW_VALUE = createSelect(input.value, input.key);
				NEW_VALUE.classList.add('is_input');
				break;
				
			default:
				NEW_VALUE = document.createElement('input');
				NEW_VALUE.name = input.key;
				NEW_VALUE.type = 'text';
				NEW_VALUE.classList.add('is_input');

		}

		const NEW_INPUT = document.createElement('div');
		NEW_INPUT.classList.add('list_element');
		NEW_INPUT.appendChild(NEW_KEY);
		NEW_INPUT.appendChild(NEW_VALUE);
		LIST.appendChild(NEW_INPUT);
	}
	
	const ADD_BUTTON = createButton('add');
	LIST.appendChild(ADD_BUTTON);
	return(LIST);
}

//Aggiorna il form con le chiave primarie 
function updateWithPK(json) {
	const PRIMARY_KEY = json['key'];
	let values = [];
	for(let value of json['value']) {
		values.push(value[PRIMARY_KEY]);
	}
	const SELECT = createSelect(values,PRIMARY_KEY);
	SELECT.classList.add('is_key');
	SELECT.addEventListener('change', loadContent);
	const KEYS = EXISTING_DIV.querySelectorAll('p');
	for(let key of KEYS) {
		if(key.textContent === PRIMARY_KEY) {
			key.parentNode.querySelector('input').remove();
			key.parentNode.appendChild(SELECT);
		}
	}

	EXISTING_DIV.querySelector('.buttons').remove();
	const UPDATE_BUTTON = createButton('update');
	SELECT.parentNode.parentNode.appendChild(UPDATE_BUTTON);
	const REMOVE_BUTTON = createButton('remove');
	SELECT.parentNode.parentNode.appendChild(REMOVE_BUTTON);
}

//Aggiorna il form con il contenuto
function updateWithContent(json) {
	const KEYS = Object.keys(json);
	let ELEMENT;
	for(let key of KEYS) {
		if(key === 'created_at' || key === 'updated_at') {
			continue;
		} else {
			ELEMENT = document.querySelector('[name="' + key + '"]');
			if(ELEMENT.type !== 'file') {
				ELEMENT.value = json[key];
			}
		}
	}
}

/*----------------------------------------------
					Undefined					
------------------------------------------------*/

//salvataggio dei dati nel db
function saveData(){
	const FORM_DATA = new FormData();
	const REQUEST = event.currentTarget.dataset.request;
	FORM_DATA.append('request',REQUEST);
	FORM_DATA.append('_token',CSRF_TOKEN);

	const TABLE = event.currentTarget.dataset.table;
	FORM_DATA.append('table',TABLE);

	if(REQUEST == 'add' || REQUEST == 'update') {
		const INPUTS = document.querySelectorAll('.is_input');
		for(let input of INPUTS) {
			if(input.classList.contains('is_file')) {
				if(input.files.length == 0) {
					continue;
				} else {
					FORM_DATA.append(input.name, input.files[0]);
				}
			}
			FORM_DATA.append('key[]',input.name);
			FORM_DATA.append('value[]',input.value);
		}
	}

	if(REQUEST == 'remove' || REQUEST == 'update') {
		const KEYS = document.querySelectorAll('.is_key');
		for(let key of KEYS) {
			FORM_DATA.append('p_key', key.name);
			FORM_DATA.append('pk_value', key.value);
		}
	}
	
	fetch(FETCH_URL + '/manageContent', {
		method: 'post',
		body: FORM_DATA
	}).then(onResponse).then(function(json) {
		json.success ? showMessage(json.message, 'success', 1000) : showMessage(json.message, 'error', 1000);
	});
}

//Aggiunta di EventListeners alla pagina
NEW_CONTENT.addEventListener('change',getForm);
EXISTING_CONTENT.addEventListener('change',getForm);