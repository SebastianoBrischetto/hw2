<?php
use Illuminate\Routing\Controller;

class Access_Controller extends Controller {
	//Carica la pagina di accesso se non è presente una sessione
	public function loadAccess() {
		return (session('user_id')) ? redirect('Homepage') : view('Access')->with('csrf_token', csrf_token())->with('page_name', 'Accesso');
	}
	//Login
	public function Login() {
		$request = request();
		$user = user::where('email', $request['log_email'])->first();
		if($user) {
			$check = Hash::check($request['log_password'],$user->password);
			if($check) {
				Session::put('user_id', $user->user_id);
				Session::put('is_admin', $user->admin);
				return redirect('Homepage');
			} else {
				return redirect('Access')->withInput()->with('error_login', 'Password errata');
			}
		} else {
			return redirect('Access')->withInput()->with('error_login', 'E-mail errata');
		}
	}
	//Signup
	public function Signup() {
		$request = request();
		$error_email = $this->checkEmail($request['email']);
		$error_psw = $this->checkPassword($request['password'], $request['c_password']);
		
		if($error_email['error'] === false && $error_psw['error'] === false) {
			$user = user::create([
				'email' => $request['email'],
				'password' => Hash::make($request['password']),
				'name' => $request['name'],
				'surname' => $request['surname'],
				'birth_date' => date('Y-m-d', strtotime($request['birth_date'])),
				'admin' => 0
			]);
			if ($user) {
				Session::put('user_id', $user->user_id);
				return redirect('Homepage');
			}
		}
		
		$redirect = redirect('Access')->withInput();
		if($error_email['error']) {
			$redirect->with('error_email',$error_email['message']);
		}
		if($error_psw['error']) {
			$redirect->with('error_psw',$error_psw['message']);
		}
		
		return $redirect;
	}
	//Controlla se ci sono errori nell'email (default false)
	public function checkEmail($email = false) {
		if(!$email) {
			$json = ['error' => true, 'message' => "Inserisci un' E-mail"];
		} else if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$json = (user::where('email',$email)->exists()) ? ['error' => true,'message' => 'E-mail già in uso'] : ['error' => false];
		} else {
			$json = ['error' => true, 'message' => 'E-mail non valida'];
		}
		return $json;
	}
	//Controlla se ci sono errori nella password
	public function checkPassword($password, $c_password) {
		if(strlen($password) < 8) {
			$json = ['error' => true, 'message' => 'Inserire una password di almeno 8 caratteri'];
		} else {
			$json = (strcmp($password, $c_password) != 0) ? ['error' => true, 'message' => 'Le password non coincidono'] : ['error' => false];
		}
		return $json;
	}
	//Logout
	public function Logout() {
		Session::flush();
		return redirect('Homepage');
	}
}
?>
