@extends('Layouts.Default_Layout')

@section('head')
<link rel="stylesheet" href="{{url('CSS/Library_Style.css')}}">
<script src="{{url('JS/Library_Script.js')}}" defer="true"></script>
<meta name="fetch_url" content="{{ route('Exercises') }}">
@endsection

@section('content')
<main>
	<section>
		<div class="search_row">
			<h2>Cerca un tipo di esercizio</h2>
			<div id="values">
				<input type='text' name='search_bar'>
				<select name='type'>
					<option value="0" selected disabled hidden>Tipo</option>
					<option value='8'>Braccia</option>
					<option value='9'>Gambe</option>
					<option value='10'>Addominali</option>
					<option value='11'>Petto</option>
					<option value='12'>Dorso</option>
					<option value='13'>Spalle</option>
					<option value='14'>Polpacci</option>
				</select>
				<a class="buttons" id='search'>Cerca</a>
			</div>
		</div>
		<div class="list border_top" id="exercise_library"></div>
	</section>
	<div id="loader" class="hidden"></div>
</main>	
@endsection