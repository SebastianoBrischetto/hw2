<?php
use Illuminate\Routing\Controller;

class Exercises_Controller extends Controller {
	//Carica la libreria degli esercizi se è presente una sessione
	public function loadExercises() {
		return (session('user_id')) ? view('Exercises')->with('page_name', 'Libreria esercizi') : redirect('Access');
	}
	//Ritorna un json con gli esercizi
	public function getExercises($type) {
		return Http::get('https://wger.de/api/v2/exercise.json', [
			'limit' => 50,
			'language' => '2',
			'category' => $type
        ]);
	}
}
?>
