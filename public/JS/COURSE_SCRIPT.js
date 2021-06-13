//Constanti globali
const FETCH_URL = document.querySelector('meta[name="fetch_url"]').content;
const ID = document.querySelector('meta[name="id"]').content;

/*----------------------------------------------
				Gestione Preferiti					
------------------------------------------------*/
function toggleFavorites() {
	const IS_FAVORITE = event.currentTarget.dataset.favorite;
	if(IS_FAVORITE==1) {
		fetch(FETCH_URL + '/remove/' + ID).then(onResponse).then(onJson);
		event.currentTarget.src = '../images/Buttons/favorite_off.png';
		event.currentTarget.dataset.favorite = 0;
	} else {
		fetch(FETCH_URL + '/add/' + ID).then(onResponse).then(onJson);
		event.currentTarget.src = '../images/Buttons/favorite_on.png';
		event.currentTarget.dataset.favorite = 1;
	}
}

//Ricezione della risposta
function onResponse(response) { return response.json(); }

//Ricezione del json
function onJson(json) {
	if(json.success) {
		showMessage(json.message, 'success', 1000);
	} else {
		showMessage(json.message, 'error', 1000);
	}
}
/*----------------------------------------------
					Undefined					
------------------------------------------------*/

//Aggiunta di EventListener
if(document.querySelector('#favorite_button')){
	document.querySelector('#favorite_button').addEventListener('click',toggleFavorites);
}