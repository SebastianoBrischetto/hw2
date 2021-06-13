//Constanti globali
const LOGIN = document.querySelector('#Login');
const SIGNUP = document.querySelector('#Signup');
const FETCH_URL = document.querySelector('meta[name="fetch_url"]').content;
/*----------------------------------------------
				Controlli					
------------------------------------------------*/

//Controllo del login
function checkLogin() {
	const EMAIL = LOGIN.querySelector('input[name="log_email"]').value;
	const PASSWORD = LOGIN.querySelector('input[name="log_password"]').value;
	if(!EMAIL.length || !PASSWORD.length){
		LOGIN.querySelector('.error').textContent = 'Inserire entrambi i campi';
		event.preventDefault();
	}
}

//Controllo del SIGNUP
function checkSignup() {
	const INPUTS = SIGNUP.querySelectorAll('label');
	const PASSWORD = SIGNUP.querySelector('input[name="password"]');
	const PASSWORD_ERROR = PASSWORD.parentNode.querySelector('.error');
	const C_PASSWORD = SIGNUP.querySelector('input[name="c_password"]');
	let error;
	for(let input of INPUTS) {
		error = input.querySelector('.error');
		if(!input.querySelector('input').value.length) {
			error.dataset.status = 404;
			error.textContent = 'Inserire tutti i campi';
		} else if(error.dataset.status == 404) {
			error.dataset.status = 200;
			error.textContent = '';
		}
	}
	if(PASSWORD.value.length < 8) {
		PASSWORD_ERROR.dataset.status = 411;
		PASSWORD_ERROR.textContent = 'Inserire una password di almeno 8 caratteri';
	} else if(PASSWORD.value != C_PASSWORD.value) {
		PASSWORD_ERROR.dataset.status = 406;
		PASSWORD_ERROR.textContent = 'Le password non combaciano';
	}else{
		PASSWORD_ERROR.dataset.status = 200;
		PASSWORD_ERROR.textContent = '';
	}
}

//Controllo degli errori
function checkErrors() {
	checkSignup();
	const ERRORS = SIGNUP.querySelectorAll('.error');
	for(let status of ERRORS) {
		if(status.dataset.status != 200) {
			event.preventDefault();
		}
	}
}

//Controllo unicità Email
function Check_Email() {
	const EMAIL = SIGNUP.querySelector('input[name="email"]');
	const EMAIL_ERROR = EMAIL.parentNode.querySelector('.error');
	fetch(FETCH_URL + '/checkEmail/' + encodeURIComponent(EMAIL.value)).then(onResponse).then(function(json) {
		if(json.error){
			EMAIL_ERROR.dataset.status=403;
			EMAIL_ERROR.textContent=json.message;
		}else{
			EMAIL_ERROR.textContent='';
			EMAIL_ERROR.dataset.status=200;
		}
	});
}
//Ricezione della risposta
function onResponse(response) {	return response.json(); }

/*----------------------------------------------
					Undefined					
------------------------------------------------*/

//Aggiunta di EventListeners alla pagina
LOGIN.addEventListener('submit', checkLogin);
SIGNUP.addEventListener('submit', checkErrors);
SIGNUP.querySelector('input[name="email"]').addEventListener('keyup', Check_Email);