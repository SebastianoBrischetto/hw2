@extends('Layouts.Default_Layout')
@section('head')
<link rel="stylesheet" href="{{url('CSS/Manage_Content_Style.css')}}">
<script src="{{url('JS/Content_Script.js')}}" defer="true"></script>
<meta name="fetch_url" content="{{ route('Content') }}">
<meta name="csrf_token" content="{{csrf_token()}}">
@endsection

@section('content')
<main>
	<section>
		<div id="new_content">
			<h2>Aggiungi Contenuto</h2>
			<select name="new_content">
				<option value="none" selected disabled hidden>Seleziona cosa aggiungere</option>
				<option value="course">Nuovo corso</option>
				<option value="subscription">Nuovo abbonamento</option>
				<option value="subscription_courses">Nuovi corsi per un abbonamento</option>
				<option value="location">Nuova sede</option>
				<option value="location_images">Nuove immagini per una sede</option>
				<option value="location_courses">Nuovi corsi per una sede</option>
				<option value="location_times">Nuovi orari per una sede</option>
				<option value="trainer">Inserisci un nuovo trainer</option>
			</select>
		</div>
		<div id="existing_content">
			<h2>Modifica/Rimuovi Contenuto</h2>
			<select name="existing_content">
				<option value="none" selected disabled hidden>Seleziona cosa modificare</option>
				<option value="course">Modifica corsi</option>
				<option value="subscription">Modifica abbonamenti</option>
				<option value="subscription_courses">Modifica corsi assegnati ad un abbonamento</option>
				<option value="location">Modifica sedi</option>
				<option value="location_images">Modifica le immagini di una sede</option>
				<option value="location_courses">Modifica corsi assegnati ad una sede</option>
				<option value="location_times">Modifica orari di una sede</option>
				<option value="trainer">Modifica trainers</option>
			</select>
		</div>
	</section>
</main>
@endsection