@extends('Layouts.Default_Layout')

@section('head')
<link rel="stylesheet" href="{{url('CSS/Homepage_Style.css')}}">
<script src="{{url('JS/Homepage_Script.js')}}" defer="true"></script>
@endsection

@section('page_info')
<div id="page_info">
	<span>
		<h1>OFFERTE DI RIAPERTURA</h1>
		<p>Abbonamenti per ogni tua esigenza a un prezzo imperdibile!</p>
	</span>
	<a class="buttons" href="{{route('Courses')}}">SCOPRI DI PIÙ</a>
</div>
@endsection

@section('content')
<main>
	<section>
		<span>
			<h2>Triskelion Fitness</h2>
			<p>{{$locations->count()}} sedi, attrezzature di ultima generazione, trainer qualificati e ambienti pensati 
			per soddisfare le esigenze di tutti, da più di diec’anni lavoriamo ogni giorno con
			passione e dedizione nel mondo del benessere e dello sport. La nostra avventura è iniziata
			nel 2011 con un solo obiettivo: regalare ai siciliani un luogo dove prendersi cura del proprio corpo.</p>
		</span>
		<div class="list">
			<span>
				<h2>I nostri Corsi</h2>
				<p>Esperienza, innovazione, qualità: tutti i nostri corsi sono pensati per regalarti un’esperienza coinvolgente e risultati concreti.</p>
			</span>
			<div class="list_row">
				<x-element-with-overlay 
					:image="url('images/courses/weightlifting.png')" 
					name="Fitness" 
					behavior="arrow"
					:behavior-var="route('CoursesOfType').'/fitness'"
				/>
				<x-element-with-overlay 
					:image="url('images/courses/swimming.png')" 
					name="Nuoto" 
					behavior="arrow"
					:behavior-var="route('CoursesOfType').'/swimming'"
				/>
				<x-element-with-overlay 
					:image="url('images/courses/yoga.png')" 
					name="Benessere" 
					behavior="arrow"
					:behavior-var="route('CoursesOfType').'/wellness'"
				/>
				<x-element-with-overlay 
					:image="url('images/courses/martialArts.png')" 
					name="Arti Marziali" 
					behavior="arrow"
					:behavior-var="route('CoursesOfType').'/martial_arts'"
				/>
			</div>
		</div>			
		<div class="content_block border_top">
			<div class="content_block_fill">
				<span>
					<h2>I Trainer</h2>
					<p>Scegliamo i migliori trainer per la tua forma fisica perché il nostro obiettivo è rendere il tuo allenamento irresistibile.</p>
				</span>
				<a href="{{route('Trainers')}}" class="buttons">SCOPRI I TRAINER</a>
			</div>
			<div class="content_block_right slide_show">
				<x-slide-show 
					:slide-images="$locations" 
					image-key='trainers_image'
				/>
			</div>
		</div>			
		<div class="content_block border_top">
			<div class="content_block_left slide_show">
				<x-slide-show 
					:slide-images="$locations" 
					image-key='location_image'
				/>
			</div>
			<div class="content_block_fill">
				<span>
					<h2>Sedi</h2>
					<p>Diverse sedi sparse sul territorio catanese, cosi da essere sempre a un passo da casa tua.</p>
				</span>
				<a href="{{route('Locations')}}" class="buttons">TROVA LE SEDI</a>
			</div>
		</div>			
	</section>
</main>
@endsection