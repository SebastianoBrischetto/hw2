@extends('Layouts.Default_Layout')
@section('head')
<link rel="stylesheet" href="{{url('CSS/Course_Style.css')}}">
<meta name="fetch_url" content="{{ route('Courses') }}">
<meta name="id" content="{{$course['course_id']}}">
<script src="{{url('JS/Course_Script.js')}}" defer="true"></script>
@endsection

@section('content')
<section class="slide_show">
	<div class="slide_element">
		<img src="{{$course['image']}}">
	</div>
	@isset($is_favorite)
		@if($is_favorite)
			<img class="round_button" id="favorite_button" data-favorite=1 src="{{url('images/Buttons/Favorite_on.png')}}">
		@else
			<img class="round_button" id="favorite_button" data-favorite=0 src="{{url('images/Buttons/Favorite_off.png')}}">
		@endif
	@endisset
</section>
<main>
	<section>
		<section class="content_block">
			<div class="content_block_fill">
				<span>
					<p>{{$course['description']}}</p>
				</span>
			</div>
			<div class="content_block_right">
				<div id="duration">
					<h3>Durata</h3>
					<img src={{url('images/icons/Timer.png')}}>
					{{$course['duration']}}'
				</div>
				<div id="intensity">
					<h3>Intensità</h3>
					@switch($course['intensity'])
						@case(1)
							<img src={{url('images/icons/Low_Diff.png')}}>
							Bassa
							@break
							
						@case(2)
							<img src={{url('images/icons/Medium_Diff.png')}}>
							Media
							@break
							
						@default
							<img src={{url('images/icons/High_Diff.png')}}>
							Alta

					@endswitch
				</div>
				<div id="type">
					<h3>Tipo</h3>
					@switch($course['type'])
						@case('fitness')
							<img src="{{url('Images/Icons/Fitness.png')}}"/>
							Fitness
							@break

						@case('swimming')
							<img src="{{url('Images/Icons/Swimming.png')}}"/>
							Nuoto
							@break

						@case('wellness')
							<img src="{{url('Images/Icons/Wellness.png')}}"/>
							Benessere
							@break

						@case('martial_arts')
							<img src="{{url('Images/Icons/Martial_Arts.png')}}"/>
							Arti Marziali
							@break
					@endswitch
				</div>
			</div>
		</section>
		<div id="links">
			<a class="buttons" href="{{route('Subscriptions')}}">Abbonamenti</a>
			<a class="buttons white" href="{{route('Locations').'/withCourses/'.$course['course_id']}}">Scopri le sede più vicina</a>
		</div>
		@isset($sameTypeCourses)
			<section class="list border_top">
				<h2>Corsi simili</h2>
				<div class="list_row">
					@foreach($sameTypeCourses as $course)
						<x-element-with-overlay 
							:image="$course['image']" 
							:name="$course['name']" 
							behavior='arrow'
							:behavior-var="route('Courses').'/'.$course['course_id']"
							:description="$course['description']"
							truncate=true
						/>
					@endforeach
				</div>
			</section>
		@endisset
	</section>
</main>
@endsection