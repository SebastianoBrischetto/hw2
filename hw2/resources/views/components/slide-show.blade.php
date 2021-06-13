@foreach($slideImages as $images)
	<div class="slide_element fade_in">
		<img src="{{$images[$imageKey]}}">
	</div>
@endforeach
<div class="slide_shortcuts">
@foreach($slideImages as $images)
	<div data-slide_index="{{$loop->index}}" class="shortcut"></div>
@endforeach
</div>
@if($arrows)
	<img class="precedent round_button" src="{{url('images/buttons/arrow.png')}}">
	<img class="next round_button right" src="{{url('images/buttons/arrow.png')}}">
@endif