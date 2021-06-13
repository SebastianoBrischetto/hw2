<?php
use Illuminate\Routing\Controller;

class Trainers_Controller extends Controller {
	//Carica la pagina con le sedi dei trainers
	public function loadTrainersLocations() {
		$view = view('All_Locations')->with('page_name', 'Trainers');
		
		$locations = location::all();
		if($locations->count()) {
			foreach($locations as $location) {
				$location['address'] = 'Trainers di '.$location['address'];
			}
			$view->with('locations', $locations)->with('image', 'trainers_image')->with('route',route('Trainers'));
		}
		
		return $view;
	}
	//Carica i trainer di una determinata sede
	public function loadTrainersLocation($location) {
		$view = view('Trainers');
		
		$location = location::find($location);
		if($location) {
			$trainers = $location->Trainers;
			$view->with('page_name', 'Trainers di '.$location['address'])->with('image', $location['trainers_image'])->with('trainers', $trainers);
			return ($trainers->count()) ? $view : redirect('Trainers');
		} else {
			return redirect('Trainers');
		}
	}
}
?>
