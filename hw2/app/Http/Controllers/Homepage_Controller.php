<?php
use Illuminate\Routing\Controller;

class Homepage_Controller extends Controller {
	//Carica la homepage
	public function loadHomepage() {
		$locations = location::all();
		return view('Homepage')->with('page_name', 'Homepage')->with('locations', $locations);
	}
}
?>
