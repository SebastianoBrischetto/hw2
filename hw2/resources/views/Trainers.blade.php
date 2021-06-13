@extends('Layouts.Default_Layout')

@section('head')
<script src="{{url('JS/Load_Overlays_Script.js')}}" defer="true"></script>
@endsection

@section('content')
<section class="slide_show">
	<div class="slide_element">
		<img src="{{$image}}">
	</div>
</section>
<main>
	<section>
		<span>
		<h2>I Trainers</h2>
		<p>Professionali, competenti, attenti, aggiornati e soprattutto dotati di grande passione per lo sport e il benessere del corpo.</p>
		</span>
		<div class="list border_top" id="locations">
			<div class="list_row">
				@foreach($trainers as $trainer)
					<x-element_with_overlay 
						:image="$trainer['image']" 
						:name="$trainer['name'].' '.$trainer['surname']" 
						:description="$trainer['description']"
					/>
				@endforeach
			</div>
		</div>
	</section>
</main>
@endsection