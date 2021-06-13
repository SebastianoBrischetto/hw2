@extends('Layouts.Default_Layout')

@section('content')
<main>
	<section>
		<div class="list" id="locations">
			<div class="list_row">
				@isset($locations)
					@foreach($locations as $location)
						<x-element-with-overlay 
							:image="$location[$image]" 
							:name="$location['address']" 
							behavior='arrow' 
							:behavior-var="$route.'/'.$location['location_id']"
						/>
					@endforeach
				@endisset
			</div>
		</div>
	</section>
</main>
@endsection