<?php
use Illuminate\Routing\Controller;

class Courses_Controller extends Controller {
	//Carica la pagina con tutti i corsi caricabili (se l'utente è loggato anche i corsi preferiti)
	public function loadCourses() {
		$view = view('All_Courses')->with('page_name', 'Tutti i Corsi');
		
		$user_id = session('user_id');
		if($user_id){
			$favorites = user::find($user_id)->userCourses;
			if($favorites->count()) {
				$view->with('favorites', $favorites);
			}
		}
		
		$fitness = course::where('type', 'fitness')->get();
		if($fitness->count()) {
			$view->with('fitness',$fitness);
		}

		$swimming = course::where('type', 'swimming')->get();
		if($swimming->count()) {
			$view->with('swimming', $swimming);
		}

		$wellness = course::where('type', 'wellness')->get();
		if($wellness->count()) {
			$view->with('wellness', $wellness);
		}

		$martial_arts = course::where('type', 'martial_arts')->get();
		if($martial_arts->count()) {
			$view->with('martial_arts', $martial_arts);
		}
		
		return $view;
	}
	
	//Carica i corsi del tipo richiesto e i preferiti
	public function loadCoursesOfType($courseType = false) {
		if($courseType) {
			switch ($courseType) {
				case 'fitness':
					$name = 'Fitness';
					break;
					
				case 'swimming':
					$name = 'Nuoto';
					break;
				
				case 'wellness':
					$name = 'Benessere';
					break;
				
				case 'martial_arts':
					$name = 'Arti Marziali';
					break;
				default:
					return redirect('Courses');
				
			}
			$view = view('All_Courses')->with('page_name', 'Corsi di '.$name);
			
			$user_id = session('user_id');
			if($user_id) {
				$favCourses = user::find($user_id)->userCourses()->where('type', $courseType)->get();
				if($favCourses->count()) {
					$view->with('favorites', $favCourses);
				}
			}
			
			$courses = course::where('type', $courseType)->get();
			return $view->with($courseType, $courses);
		} else {
			return redirect('Courses');
		}
	}
	
	//Carica il corso
	public function loadCourse($courseId = false) {
		if($courseId) {
			$course = course::find($courseId);
			if($course) {
				$view = view('Course')->with('page_name', $course['name'])->with('course', $course);
			} else {
				return redirect('Courses');
			}
			
			$sameTypeCourses = course::where('type',$course['type'])->where('course_id','<>',$courseId)->get();
			if($sameTypeCourses->count()) {
				$view->with('sameTypeCourses',$sameTypeCourses);
			}
			
			$user_id = session('user_id');
			if($user_id){
				$is_favorite = (user::find(session('user_id'))->userCourses->find($courseId)) ? true : false;
				$view->with('is_favorite',$is_favorite);
			}
			
			return $view;
		} else {
			return redirect('Courses');
		}
	}
	
	//Aggiunge/Rimuove il corso selezionato
	public function updateFavorites($operation, $course_id) {
		$user_id = session('user_id');
		
		if(!$user_id) {
			$json = ['success' => false, 'message' => 'Effettua il login per poter salvare i preferiti'];		
		} else {
			$favorites = user::find($user_id)->userCourses();
			switch($operation) {
				case 'add':
					try{
						$favorites->attach($course_id);
					} catch(\Illuminate\Database\QueryException $error) {
						return ($error->getCode() == 23000) ? ['success' => false, 'message' => 'Corso già presente nei preferiti'] : ['success' => false, 'message' => $error];
					}
					$json = ['success' => true, 'message' => 'Corso aggiunto ai preferiti con successo'];
					break;

				case 'remove':
					$favorites->detach($course_id);
					$json = ['success' => true, 'message' => 'Corso Rimosso dai preferiti con successo'];
					break;

				default:
					$json = ['success' => false, 'message' => 'operazione non prevista'];
			}
		}
		
		return $json;
	}
}
?>
