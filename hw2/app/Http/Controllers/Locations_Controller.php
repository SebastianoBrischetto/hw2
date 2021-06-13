<?php
use Illuminate\Routing\Controller;

class Locations_Controller extends Controller {
	//Carica la pagina sedi
	public function loadLocations() {
		$view = view('All_Locations')->with('page_name', 'Sedi')->with('route',route('Locations'));
		
		$locations = location::all();
		if($locations->count()) {
			$view->with('locations', $locations)->with('image', 'location_image');
		}
		
		return $view;
	}
	
	//Carica la pagina con le sedi che offrono il corso
	public function loadLocationWithCourses($course_id) {
		$locations = course::find($course_id)->courseLocations;
		if($locations->count()) {
			return view('All_Locations')->with('page_name', 'Sedi')->with('locations', $locations)->with('image', 'location_image')->with('route',route('Locations'));
		} else {
			return redirect()->back();
		}
	}
	
	//Carica la pagina con la sede richiesta
	public function loadLocation($location_id) {
		
		$location = location::find($location_id);
		if(!$location) {
			return redirect('Locations');
		};
		$view = view('Location')->with('info', $location)->with('page_name', 'Sede di '.$location['address']);
		
		$images = ($location->Images()->exists()) ? $location->Images()->get('image') : array(['image'=>$location['location_image']]);
		$view->with('images', $images);
		
		$times = $location->Times()->get();
		if($times->count()) {
			$view->with('times', $times);
		}
		
		$courses = $location->locationCourses;
		if($courses->count()) {
			$view->with('courses', $courses);
		}
		
		return $view;
	}
	//Recupera Lat e Lng per la mappa
	public function getLatLng($address) {
		$json = Http::get('http://www.mapquestapi.com/geocoding/v1/address', [
			'thumMaps' => false,
			'key' => env('MAP_APIKEY'),
			'location' => $address
        ]);
		return $json['results'][0]['locations'][0]['latLng'];
	}
}
?>
