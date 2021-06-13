//Constanti globali
const CART = document.querySelector('#cart').querySelector('.list');
const DURATION_ELEMENT = document.querySelector('#duration');
const EMPTY_CART = document.querySelector('#empty_cart');
const SUBSCRIPTIONS = document.querySelectorAll('#subscriptions .list_element');
const FETCH_URL = document.querySelector('meta[name="fetch_url"]').content;
const HOMEPAGE = document.querySelector('meta[name="homepage"]').content;
const CSRF_TOKEN = document.querySelector('meta[name="csrf_token"]').content;
/*----------------------------------------------
			Gestione Durata					
------------------------------------------------*/

//Riduce la durata
function reduceDuration() {
	const DURATION = parseInt(DURATION_ELEMENT.textContent);
	if(DURATION === 1) {
		showMessage('Durata minima 1 mese', 'info', 1000);
	} else {
		DURATION_ELEMENT.textContent = DURATION - 1;
		updateCost();
	}
}

//Aumenta la durata
function incraseDuration() {
	DURATION_ELEMENT.textContent = parseInt(DURATION_ELEMENT.textContent) + 1;
	updateCost();
}

/*----------------------------------------------
				Gestione Costo					
------------------------------------------------*/

//Recupera il costo parziale (non moltiplicato per la durata)
function getCost() {
	const costList = CART.querySelectorAll('.cost');
	
	let partialCost = 0;
	for(let cost of costList) {
		partialCost += parseFloat(cost.textContent);
	}
	return partialCost;
}

//Aggiorna il costo totale
function updateCost() {
	const PARTIAL_COST = getCost();
	const TOTAL_COST = document.querySelector('#total_cost');
	const DURATION = parseInt(DURATION_ELEMENT.textContent);
	TOTAL_COST.textContent = (PARTIAL_COST * DURATION).toFixed(2) + '€';
}

/*----------------------------------------------
			Gestione Carello					
------------------------------------------------*/

//Inserimento nel carello
function addToCart() {
	let errorMessage;
	const THIS_SUBSCRIPTION = event.currentTarget.parentNode.parentNode;	
	const COURSES = THIS_SUBSCRIPTION.querySelectorAll('.course');
	let coursesId = [];
	for (let course of COURSES) {
		coursesId.push(course.dataset.course_id);
	}
	
	const SUBSCRIPTION_ID = THIS_SUBSCRIPTION.dataset.subscription_id;
	const ACTIVE_SUBSCRIPTIONS = document.querySelector('#active_subscriptions');
	const ACTIVE_SUBSCRIPTIONS_IDS = getSubscriptionsIds(ACTIVE_SUBSCRIPTIONS);
	const ACTIVE_COURSES_IDS = getCoursesIds(ACTIVE_SUBSCRIPTIONS);
	if(coursesId.every(id => ACTIVE_COURSES_IDS.includes(id)) && !ACTIVE_SUBSCRIPTIONS_IDS.includes(SUBSCRIPTION_ID))
		errorMessage = 'Il tuo piano attuale già include tutti i corsi offerti da questo abbonamento';

	const CART_SUBSCRIPTIONS_IDS = getSubscriptionsIds(CART);
	const CART_COURSES_ID = getCoursesIds(CART);
	if(CART_SUBSCRIPTIONS_IDS.includes(SUBSCRIPTION_ID)) {
		errorMessage = 'Abbonamento già presente';
	} else if (coursesId.some(id => CART_COURSES_ID.includes(id))) {
		errorMessage = 'Uno o piu corsi già compresi negli abbonamenti scelti';
	}
	
	if(errorMessage) {
		showMessage(errorMessage, 'warning', 2000);
	} else {
		/*const IMAGES = THIS_SUBSCRIPTION.querySelector('.list_element_image').querySelectorAll('img');
		const NAME = THIS_SUBSCRIPTION.querySelector('.list_element_description').querySelector('h4').textContent;
		const COST = THIS_SUBSCRIPTION.querySelector('.list_element_info').querySelector('.cost').textContent;
		const NEW_ELEMENT = createElement(SUBSCRIPTION_ID, IMAGES, NAME, COURSES, COST, 'remove');*/
		const NEW_ELEMENT = createElement(THIS_SUBSCRIPTION,'remove');
		CART.appendChild(NEW_ELEMENT);
		updateCost();
		CART.parentNode.parentNode.classList.remove('hidden');
		CART.parentNode.classList.remove('hidden');
		EMPTY_CART.classList.add('hidden');
	}
}

//Rimozione dal carello
function removeFromCart() {
	event.currentTarget.parentNode.parentNode.remove();
	updateCost();
	
	const CART_SUBSCRIPTIONS_IDS = getSubscriptionsIds(CART);
	if(!CART_SUBSCRIPTIONS_IDS.length) {
		CART.parentNode.classList.add('hidden');
		EMPTY_CART.classList.remove('hidden');
	}
}


/*----------------------------------------------
				Recupero IDS					
------------------------------------------------*/

//Recupera gli id degli abbonamenti
function getSubscriptionsIds(list) {
	let SUBSCRIPTIONS_IDS = [];
	const SUBSCRIPTIONS = list.querySelectorAll('.list_element');
	for(let subscription of SUBSCRIPTIONS) {
		if(subscription.dataset.subscription_id) {
			SUBSCRIPTIONS_IDS.push(subscription.dataset.subscription_id);
		}
	}
	return SUBSCRIPTIONS_IDS;
}

//Recupera gli id dei corsi
function getCoursesIds(list) {
	let COURSES_IDS = [];
	const COURSES = list.querySelectorAll('.course');
	for(let course of COURSES) {
		COURSES_IDS.push(course.dataset.course_id);
	}
	return COURSES_IDS;
}

/*----------------------------------------------
				Undefined					
------------------------------------------------*/

//Crea un elemento con cloneNode
function createElement(element, action) {
	const NEW_ELEMENT = element.cloneNode(true);
	const NEW_ACTION = NEW_ELEMENT.querySelector('.round_button');
	switch(action) {
		case 'add':
			NEW_ACTION.src = 'http://localhost/hw2/public/images/buttons/add.png';
			NEW_ACTION.addEventListener('click',addToCart);
			break;
			
		case 'remove':
			NEW_ACTION.src = 'http://localhost/hw2/public/images/buttons/remove.png';
			NEW_ACTION.addEventListener('click',removeFromCart);
			break;
	}
	return NEW_ELEMENT;
}

/*Crea un elemento
function createElement(subscriptionId,images,name,courses,cost,buttonFunction) {

	const NEW_IMAGE_CONTAINER = document.createElement('div');
	NEW_IMAGE_CONTAINER.classList.add('list_element_image');
	for(let image of images) {
		let newImage = document.createElement('img');
		newImage.src = image.src;
		NEW_IMAGE_CONTAINER.appendChild(newImage);
	}
	
	const NEW_NAME = document.createElement('h4');
	NEW_NAME.textContent = name;
	
	const NEW_DESCRIPTION = document.createElement('span');
	NEW_DESCRIPTION.appendChild(NEW_NAME);
	for(let course of courses) {
		let NEW_COURSE = document.createElement('em');
		NEW_COURSE.classList.add('course');
		NEW_COURSE.dataset.course_id = course.dataset.course_id;
		NEW_COURSE.textContent = course.textContent;
		NEW_DESCRIPTION.appendChild(NEW_COURSE);
	}
	
	const NEW_DESCRIPTION_CONTAINER = document.createElement('div');
	NEW_DESCRIPTION_CONTAINER.classList.add('list_element_description');
	NEW_DESCRIPTION_CONTAINER.appendChild(NEW_DESCRIPTION);
	
	const NEW_INFO = document.createElement('p');
	NEW_INFO.classList.add('cost');
	NEW_INFO.textContent = cost;
	
	const NEW_INFO_CONTAINER = document.createElement('div');
	NEW_INFO_CONTAINER.classList.add('list_element_info');
	NEW_INFO_CONTAINER.appendChild(NEW_INFO);
	
	const NEW_ACTION = document.createElement('img');
	NEW_ACTION.classList.add('round_button');
	switch (buttonFunction) {
		case 'add':
			NEW_ACTION.src='http://localhost/hw2/public/images/buttons/add.png';
			NEW_ACTION.addEventListener('click',addToCart);
			break;
			
		case 'remove':
			NEW_ACTION.src='http://localhost/hw2/public/images/buttons/remove.png';
			NEW_ACTION.addEventListener('click',removeFromCart);
			break;
	}
	
	const NEW_ACTION_CONTAINER = document.createElement('div');
	NEW_ACTION_CONTAINER.classList.add('list_element_action');
	NEW_ACTION_CONTAINER.appendChild(NEW_ACTION);
	
	
	const NEW_ELEMENT = document.createElement('div');
	NEW_ELEMENT.classList.add('list_element');
	NEW_ELEMENT.dataset.subscription_id = subscriptionId;
	NEW_ELEMENT.appendChild(NEW_IMAGE_CONTAINER);
	NEW_ELEMENT.appendChild(NEW_DESCRIPTION_CONTAINER);
	NEW_ELEMENT.appendChild(NEW_INFO_CONTAINER);
	NEW_ELEMENT.appendChild(NEW_ACTION_CONTAINER);
	return NEW_ELEMENT;
}*/

//Effettua il pagamento
function payment() {
	const CART_SUBSCRIPTIONS_IDS = getSubscriptionsIds(CART);
	const DURATION = DURATION_ELEMENT.textContent;
	const FORM_DATA = new FormData();
	FORM_DATA.append('_token', CSRF_TOKEN);
	for (let subscriptionId of CART_SUBSCRIPTIONS_IDS) {
		FORM_DATA.append('subscription_id[]', subscriptionId);
	}
	FORM_DATA.append('duration', DURATION);
	FORM_DATA.append('payment_method', event.currentTarget.id);
	fetch(FETCH_URL + '/Payment', {
		method:'post',
		body:FORM_DATA
	}).then(onResponse).then(function (json) {
		if(json.success) {
			const BLOCK_INPUTS = document.createElement('div');
			BLOCK_INPUTS.classList.add('block_inputs');
			document.querySelector('body').appendChild(BLOCK_INPUTS);
			showMessage('Pagamento di ' + json.total_cost.toFixed(2) + '€ tramite ' + json.payment_method + ' effettuato<br>Verrai ora reindirizzato alla homepage', 'info', 3000);
			setTimeout(function(){ window.location.replace(HOMEPAGE); },3000);
		} else {
			showMessage('Pagamento fallito', 'error', 3000);
		}
	});
}

//Ricezione della risposta
function onResponse(response) {	return response.json(); }

//Mostra tutti gli abbonamenti
function showAllSubscriptions(){
	document.querySelector('#all_subscriptions').classList.remove('hidden');
	event.currentTarget.remove();
}

//Aggiunta di EventListeners alla pagina
document.querySelector('.left').addEventListener('click',reduceDuration);
document.querySelector('.right').addEventListener('click',incraseDuration);
for(let button of document.querySelectorAll('#payment_buttons .buttons')){
	button.addEventListener('click',payment);
}
for(let subscription of SUBSCRIPTIONS){
	if(subscription.querySelector('.round_button')) {
		subscription.querySelector('.round_button').addEventListener('click',addToCart);
	}
}
document.querySelector('#show_all').addEventListener('click',showAllSubscriptions);