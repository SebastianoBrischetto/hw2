<div class="list_element" @if($id) data-id="{{$id}}" @endif>
	<img class="list_element_background" src="{{$image}}"></img>
	<div class="transition_overlay">
		<h3>{{$name}}</h3>
		<p class="description">{{$description}}</p>
		@switch($behavior)
			@case('arrow')
				<a href="{{$behaviorVar}}">
					<img class="round_button right" src="{{url('images/buttons/arrow.png')}}">
				</a>
				@break

			@case('remove')
				<img class="round_button" src="{{url('images/buttons/remove.png')}}">
				@break

			@case('add')
				<img class="round_button" src="{{url('images/buttons/add.png')}}">
				@break

			@default

		@endswitch
		<p class="note">{!! $note !!}</p>
	</div>
</div>