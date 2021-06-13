<div class="list_element" data-subscription_id="{{$subscriptionId}}">
	<div class="list_element_image">
		@if($courseTypes)
			@foreach($courseTypes as $type)
				@switch($type)
					@case('fitness')
						<img src="{{url('Images/Icons/Fitness.png')}}">
						@break

					@case('swimming')
						<img src="{{url('Images/Icons/Swimming.png')}}">
						@break

					@case('wellness')
						<img src="{{url('Images/Icons/Wellness.png')}}">
						@break

					@case('martial_arts')
						<img src="{{url('Images/Icons/Martial_Arts.png')}}">
						@break

				@endswitch
			@endforeach
		@endif
	</div>
	<div class="list_element_description">
		<span>
			<h4>{{$subscriptionName}}</h4>
				@if($coursesInfo)
					@foreach($coursesInfo as $course)
						<em class="course" data-course_id="{{$course['course_id']}}">
							@if($loop->last) 
								{{$course['name']}} 
							@else 
								{{$course['name']}} |
							@endif
						</em>
					@endforeach
				@endif
		</span>
	</div>
	<div class="list_element_info">
		<p class="{{$info}}">{{$infoData}}</p>
	</div>
	@if($addable)
		<div class="list_element_action">
			<img class="round_button" src="{{url('Images/Buttons/Add.png')}}"/>
		</div>
	@endif
</div>