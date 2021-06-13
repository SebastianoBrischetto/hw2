@extends('Layouts.Default_Layout')
@section('head')
<link rel="stylesheet" href="https://api.mqcdn.com/sdk/mapquest-js/v1.3.2/mapquest.css"/>
<link rel="stylesheet" href="{{url('CSS/Location_Style.css')}}">
<script src="https://api.mqcdn.com/sdk/mapquest-js/v1.3.2/mapquest.js" defer="true"></script>
<script src="{{url('JS/Location_Script.js')}}" defer="true"></script>
<meta name="fetch_url" content="{{ route('Locations') }}">
@endsection

@section('content')
<section class="slide_show">
	<x-slide-show 
		:slide-images="$images" 
		image-key='image'
		arrows=true;
	/>
</section>
<main>
	<section>
		<section class="content_block">
			<div class="content_block_fill">
				<span>
					<h2>La struttura</h2>
					<p>{{$info['description']}}</p>
				</span>
			</div>
			<div class="content_block_right">
				<div class="light_grey">
					@isset($courses)
						<h3>Corsi Disponibili</h3>
						@foreach($courses as $course)
							<a class="buttons" href="{{route('Courses')}}/{{$course['course_id']}}">{{$course['name']}}</a>
						@endforeach
					@endisset
					<a class="buttons white" href="{{route('Trainers')}}/{{$info['location_id']}}">Trainers</a>
				</div>
			</div>
		</section>
		<section class="content_block">
			<div class="content_block_fill" id="map"></div>
			<div class="content_block_right light_grey">
				<span>
					<h3>Dove Trovarci</h3>
					<p id="full_address">{{$info['address']}}&nbsp;-&nbsp;{{$info['city']}}</p>
					<h3>Contatti</h3>
					<p>📞&nbsp;{{$info['phone_number']}} | ✉&nbsp;{{$info['email']}}</p>
					<h3>Orari</h3>
					@isset($times)
						@foreach($times as $time)
							<p> {{$time['days']}}: {{$time['times']}}</p>
						@endforeach
					@else
						<p>Orari ancora da definire</p>
					@endisset
				</span>
			</div>
		</section>
	</section>
</main>
@endsection