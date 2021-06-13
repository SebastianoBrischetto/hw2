@extends('Layouts.Default_Layout')

@section('head')
<script src="{{url('JS/Courses_Script.js')}}" defer="true"></script>
<meta name="fetch_url" content="{{ route('Courses') }}">
@endsection

@section('content')
<main>
	<section id="Courses">
		<div class="search_row">
			<h2>I nostri corsi</h2>
			<input type='text' name='searchbar' placeholder="Cerca corso">
		</div>
		<div class="list border_top @isset($favorites) @else hidden @endisset" id="favorites">
			<h2>Corsi preferiti</h2>
			<div class="list_row">
				@isset($favorites)
					@foreach($favorites as $course)
						<x-element-with-overlay 
							:image="$course['image']" 
							:name="$course['name']" 
							behavior='remove'
							:description="$course['description']"
							:id="$course['course_id']"
							note='Rimuovi dai corsi preferiti'
							truncate=true
						/>
					@endforeach
				@endisset
			</div>
		</div>
		<div class="list border_top @isset($fitness) @else hidden @endisset" id="fitness">
			<h2>Corsi di Fitness</h2>
			<div class="list_row">
				@isset($fitness)
					@foreach($fitness as $course)
						<x-element-with-overlay 
							:image="$course['image']" 
							:name="$course['name']" 
							behavior='add'
							:description="$course['description']"
							:id="$course['course_id']"
							note='Aggiungi ai corsi preferiti'
							truncate=true
						/>
					@endforeach
				@endisset
			</div>
		</div>
		<div class="list border_top @isset($swimming) @else hidden @endisset" id="swimming">
			<h2>Corsi di Nuoto</h2>
			<div class="list_row">
				@isset($swimming)
					@foreach($swimming as $course)
						<x-element-with-overlay 
							:image="$course['image']" 
							:name="$course['name']" 
							behavior='add'
							:description="$course['description']"
							:id="$course['course_id']"
							note='Aggiungi ai corsi preferiti'
							truncate=true
						/>
					@endforeach	
				@endisset
			</div>
		</div>
		<div class="list border_top @isset($wellness) @else hidden @endisset" id="wellness">
			<h2>Corsi di Benessere</h2>
			<div class="list_row">
				@isset($wellness)
					@foreach($wellness as $course)
						<x-element-with-overlay 
							:image="$course['image']" 
							:name="$course['name']" 
							behavior='add'
							:description="$course['description']"
							:id="$course['course_id']"
							note='Aggiungi ai corsi preferiti'
							truncate=true
						/>
					@endforeach
				@endisset
			</div>
		</div>
		<div class="list border_top @isset($martial_arts) @else hidden @endisset" id="martial_arts">
			<h2>Corsi di Artimarziali</h2>
			<div class="list_row">
				@isset($martial_arts)
					@foreach($martial_arts as $course)
						<x-element-with-overlay 
							:image="$course['image']" 
							:name="$course['name']" 
							behavior='add'
							:description="$course['description']"
							:id="$course['course_id']"
							note='Aggiungi ai corsi preferiti'
							truncate=true
						/>
					@endforeach
				@endisset
			</div>
		</div>
	</section>
</main>
@endsection