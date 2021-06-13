@extends('Layouts.Default_Layout')

@section('head')
<link rel="stylesheet" href="{{url('CSS/Subscriptions_Style.css')}}">
<script src="{{url('JS/Subscriptions_Script.js')}}" defer="true"></script>
<meta name="fetch_url" content="{{ route('Subscriptions') }}">
<meta name="homepage" content="{{route('Homepage')}}">
<meta name="csrf_token" content="{{csrf_token()}}">
@endsection

@section('content')
<main>
	<section>
		<div class="list @isset($active_subscriptions) @else hidden @endisset" id="active_subscriptions">
			<h2>Abbonamenti Attivi</h2>
			<div class="list_element">
				<h4 class="list_element_description">Descrizione</h4>
				<h4 class="list_element_info">Scadenza</h4>
			</div>
			@isset($active_subscriptions)
				@foreach($active_subscriptions as $subscription)
					<x-row-element 
						:subscription-id="$subscription['subscription_id']" 
						:course-types="$subscription['course_types']" 
						:subscription-name="$subscription['name']"
						:courses-info="$subscription['courses_info']"
						info="date"
						:info-data="$subscription['date']"
					/>
				@endforeach
			@endisset
		</div>
	</section>
	<section class="hidden">
		<div id="cart">
			<h2>Carello Acquisti</h2>
			<div class="list">
				<div class="list_element">
					<h4 class="list_element_description">Descrizione</h4>
					<h4 class="list_element_info">Costo</h4>
					<h4 class="list_element_action"></h4>
				</div>
			</div>
			<div class="content_block">
				<div id="payment_info" class="content_block_left list light_grey">
					<div class="list_element">
						<h4 class="list_element_description">Durata:</h4>
						<div class="list_element_info">
							<img class="left round_button" src="{{url('Images/Buttons/Arrow.png')}}"/>
							<p id="duration">1</p>
							<img class="right round_button" src="{{url('Images/Buttons/Arrow.png')}}"/>
						</div>
					</div>
					<div class="list_element">
						<h4 class="list_element_description">Costo totale:</h4>
						<div class="list_element_info">
							<p id="total_cost">0.00€</p>
						</div>
					</div>
				</div>
				<div id="payment_buttons" class="content_block_fill">
					<a class="buttons white" id="Gpay"></a>
					<a class="buttons white" id="Paypal"></a>
					<a class="buttons" id="Credit_card">🔒&nbspAquista&nbspin&nbspsicurezza</a>
				</div>
			</div>
		</div>
		<div id="empty_cart" class="empty">
			<h2>Il tuo carello è vuoto</h2>
			<img class="logo" src="{{url('Images/Icons/Empty_Cart.png')}}"/>
		</div>
	</section>
	<section id="subscriptions">
		<section class="content_block">
			<section id="matching_subscriptions" class="content_block_fill">
				<div class="list @isset($matched_subscriptions) @else hidden @endisset">
					<h3>Abbonamenti consigliati in base ai preferiti</h3>
					<div class="list_element">
						<h4 class="list_element_description">Descrizione</h4>
						<h4 class="list_element_info">Costo</h4>
						<h4 class="list_element_action"></h4>
					</div>
					@isset($matched_subscriptions)
						@foreach($matched_subscriptions as $subscription)
							<x-row-element 
								:subscription-id="$subscription['subscription_id']" 
								:course-types="$subscription['course_types']" 
								:subscription-name="$subscription['name']"
								:courses-info="$subscription['courses_info']"
								info="cost"
								:info-data="$subscription['cost'].'€'"
								addable=true
							/>
						@endforeach
					@endisset
				</div>
				<div class="empty @isset($matched_subscriptions) hidden @endisset">
					<h2>A quanto pare non ci sono abbonamenti adatti alle tue esigenze... </h2>
					<a href="{{route('Courses')}}"><img src="{{url('Images/Icons/No_Favorites.png')}}"/></a>
				</div>
			</section>
			<section id="custom_subscriptions" class="light_grey @isset($similiar_subscriptions) @else hidden @endisset">
				<h3>Abbonamenti simili</h3>
				<div class="list">
					@isset($similiar_subscriptions)
						@foreach($similiar_subscriptions as $subscription)
							<x-row-element 
								:subscription-id="$subscription['subscription_id']" 
								:course-types="$subscription['course_types']" 
								:subscription-name="$subscription['name']"
								:courses-info="$subscription['courses_info']"
								info="cost"
								:info-data="$subscription['cost'].'€'"
								addable=true
							/>
						@endforeach
					@endisset
				</div>
			</section>
		</section>
		<section>
			<a class="buttons" id="show_all">Mostra tutti gli abbonamenti</a>
			<div class="list hidden" id="all_subscriptions">
				<h2>Abbonamenti</h2>
				<div class="list_element">
					<h4 class="list_element_description">Descrizione</h4>
					<h4 class="list_element_info">Costo</h4>
					<h4 class="list_element_action"></h4>
				</div>
				@isset($all_subscriptions)
					@foreach($all_subscriptions as $subscription)
						<x-row-element 
							:subscription-id="$subscription['subscription_id']" 
							:course-types="$subscription['course_types']" 
							:subscription-name="$subscription['name']"
							:courses-info="$subscription['courses_info']"
							info="cost"
							:info-data="$subscription['cost'].'€'"
							addable=true
						/>
					@endforeach
				@endisset
			</div>
		</section>
	</section>
</main>
@endsection



