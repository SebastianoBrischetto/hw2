@extends('Layouts.Default_Layout')

@section('head')	
<link rel="stylesheet" href="{{url('css/Signup_Style.css')}}">
<script src="{{url('js/Signup_Script.js')}}" defer="true"></script>
<meta name="fetch_url" content="{{ route('Access') }}">
@endsection

@section('header')
<header class="white">
	<div id="page_info" class="white">
		<a class="logo" href="{{route('Homepage')}}"><img class="logo" src="{{url('Images/icons/logo.png')}}"/></a>
	</div>
</header>
@endsection

@section('content')
<main>
	<section>
		<form action="{{route('Login')}}" method='POST' id='Login'>
			<h1>Log In</h1>
			<input name='_token' type='hidden' value="{{$csrf_token}}">
			<label class='list_element'>
				E-mail
				<input type='text' name='log_email' value="{{old('log_email')}}">
				<p class='error'>{{session('error_login')}}</p>
			</label>
			<label class='list_element'>
				Password
				<input type='password' name='log_password'>
			</label>
			<div class='list_element'>
				<input class="buttons" type='submit' value='Accedi'>
			</div>
		</form>
		<form action="{{route('Signup')}}" method='POST' id='Signup'>
			<h1>Sign In</h1>
			<input name='_token' type='hidden' value="{{$csrf_token}}">
			<label class='list_element'>
				Nome
				<input type='text' name='name' value="{{old('name')}}">
				<p class='error' data-status=404></p>
			</label>
			<label class='list_element'>
				Cognome
				<input type='text' name='surname' value="{{old('surname')}}">
				<p class='error' data-status=404></p>
			</label>
			<label class='list_element'>
				Data di nascita
				<input type='date' name='birth_date' value="{{old('birth_date')}}">
				<p class='error' data-status=404></p>
			</label>
			<label class='list_element'>
				E-Mail
				<input type='text' name='email' value="{{old('email')}}">
				<p class='error' data-status=404>{{session('error_email')}}</p>
			</label>
			<label class='list_element'>
				Password
				<input type='password' name='password'>
				<p class='error' data-status=404>{{session('error_psw')}}</p>
			</label>
			<label class='list_element'>
				Conferma password
				<input type='password' name='c_password'>
				<p class='error' data-status=404></p>
			</label>
			<div class='list_element'>
				<input class="buttons" type='submit' value='Registrati'></input>
			</div>
		</form>
	</section>
</main>
@endsection

@section('footer_classes') class="white border_top" @endsection