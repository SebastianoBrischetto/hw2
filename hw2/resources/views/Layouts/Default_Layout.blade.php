<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Triscele Fitness - {{$page_name}}</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="icon" type="image/png" href="{{url('images/icons/favicon.png')}}">
		<link rel="stylesheet" href="{{url('css/Default_Style.css')}}">
		<script src="{{url('js/Default_Script.js')}}" defer="true"></script>
		@yield('head')
	</head>
	<body>
		@section('header')
		<header>
			<nav>
				<div id="nav_logo">
					<a class="logo" href="{{route('Homepage')}}"><img class="logo" src="{{url('Images/icons/logo.png')}}"/></a>
				</div>
				<div class="dropdown" id="menu">
					<div id="menu_button">
						<div class='white_line'></div>
						<div class='white_line'></div>
						<div class='white_line'></div>
					</div>
					<div class="dropdown_content">
						<a href="{{route('Homepage')}}">Home</a>
						<a href="{{route('Courses')}}">Corsi</a>
							<a class="child_link" href="{{route('Courses').'/Type/fitness'}}">&#10095; Fitness</a>
							<a class="child_link" href="{{route('Courses').'/Type/swimming'}}">&#10095; Nuoto</a>
							<a class="child_link" href="{{route('Courses').'/Type/wellness'}}">&#10095; Benessere</a>
							<a class="child_link" href="{{route('Courses').'/Type/martial_arts'}}">&#10095; Arti Marziali</a>
						<a href="{{route('Locations')}}">Sedi</a>
							@foreach($locations as $location)
								<a class="child_link" href="{{route('Locations').'/'.$location['location_id']}}">&#10095; {{$location['address']}}</a>
							@endforeach
						<a href="{{route('Trainers')}}">Trainers</a>
							@foreach($locations as $location)
								<a class="child_link" href="{{route('Trainers').'/'.$location['location_id']}}">&#10095; Trainers di {{$location['address']}}</a>
							@endforeach
						@if($user_id)
							<a href="{{route('Subscriptions')}}">Abbonamenti</a>
							<a href="{{route('Exercises')}}">Libreria Esercizi</a>
						@endif
						@if($is_admin)
							<a href="{{route('Content')}}">Gestione Contenuti</a>
						@endif
						@if($user_id)
							<a href="{{route('Logout')}}">Log Out</a>
						@else
							<a href="{{route('Access')}}">Log In</a>
						@endif
					</div>
				</div>
				<div id="nav_links">
					<a class="nav_links_buttons" href="{{route('Homepage')}}">Home</a>
					<div class="dropdown">
						<a class= "dropdown_title nav_links_buttons" href="{{route('Courses')}}">Corsi</a>
						<div class="dropdown_content">
							<a href="{{route('Courses').'/Type/fitness'}}">Fitness</a>
							<a href="{{route('Courses').'/Type/swimming'}}">Nuoto</a>
							<a href="{{route('Courses').'/Type/wellness'}}">Benessere</a>
							<a href="{{route('Courses').'/Type/martial_arts'}}">Arti Marziali</a>
						</div>
					</div>
					<div class="dropdown">
						<a class="dropdown_title nav_links_buttons" href="{{route('Locations')}}">Sedi</a>
						<div class="dropdown_content">
						@foreach($locations as $location)
							<a href="{{route('Locations').'/'.$location['location_id']}}">{{$location['address']}}</a>
						@endforeach
						</div>
					</div>
					<div class="dropdown">
						<a class="dropdown_title nav_links_buttons" href="{{route('Trainers')}}">Trainers</a>
						<div class="dropdown_content">
						@foreach($locations as $location)
							<a href="{{route('Trainers').'/'.$location['location_id']}}">Trainers di {{$location['address']}}</a>
						@endforeach
						</div>
					</div>
					@if($user_id)
						<a class="nav_links_buttons" href="{{route('Subscriptions')}}">Abbonamenti</a>
						<a class="nav_links_buttons" href="{{route('Exercises')}}">Libreria Esercizi</a>
					@endif
					@if($is_admin)
						<a class="nav_links_buttons" href="{{route('Content')}}">Gestione Contenuti</a>
					@endif
				</div>
				<div id="nav_buttons">
					@if($user_id)
						<a class="buttons" href="{{route('Logout')}}">Log Out</a>
					@else
						<a class="buttons" href="{{route('Access')}}">Log In</a>
					@endif
				</div>
			</nav>
			@section('page_info')
				<div id="page_info">
					<h1>{{$page_name}}</h1>
				</div>
			@show
		</header>
		@show

		@yield('content')

		@section('footer')
			<footer @yield('footer_classes')>
				<div id="footer_info">
					<img class="logo" src="{{url('Images/icons/logo.png')}}"/>
					<div id="footer_social_media">
						<h2>SEGUICI SU</h2>
						<img class="round_button" src="{{url('images/buttons/fb.png')}}"/>
						<img class="round_button" src="{{url('images/buttons/twitter.png')}}"/>
						<img class="round_button" src="{{url('images/buttons/instagram.png')}}"/>			
					</div>
				</div>
				<em>Designed by Sebastiano Brischetto O46001573</em>
			</footer>
		@show
	</body>
</html>