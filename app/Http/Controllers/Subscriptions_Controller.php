<?php
use Illuminate\Routing\Controller;

class Subscriptions_Controller extends Controller {
	//Carica la pagina degli abbonamenti
	public function loadSubscriptions() {
		$user_id = session('user_id');
		if(!$user_id) {
			return redirect('Access');
		}
		
		$view = view('Subscriptions')->with('csrf_token', csrf_token())->with('page_name', 'Abbonamenti');
		
		$active_subscriptions = user::find($user_id)->activeSubscriptions;
		if($active_subscriptions->count()) {
			foreach($active_subscriptions as $subscription) {
				$subscription = $this->getSubscriptionCourses($subscription);
				$duration = '+'.$subscription['pivot']['duration_months'].' months';
				$endDate = date('d-m-Y', strtotime($duration, strtotime($subscription['pivot']['start_date'])));
				$subscription['date'] = $endDate;
			}
			$view->with('active_subscriptions', $active_subscriptions);
		}
		
		$all_subscriptions = subscription::all();
		if($all_subscriptions->count()) {
			foreach($all_subscriptions as $subscription) {
				$subscription = $this->getSubscriptionCourses($subscription);			
			}
			$view->with('all_subscriptions', $all_subscriptions);
		}	
		
		$fav_courses = user::find($user_id)->userCourses;
		if($fav_courses->count()) {
			foreach($fav_courses as $fav_course) {
				$fav_courses_id[] = $fav_course['course_id'];
			}
			$suggested_subscriptions = subscription_courses::whereIn('course_id', $fav_courses_id)->get()->groupBy('subscription_id');
			if($suggested_subscriptions->count()) {
				foreach($suggested_subscriptions as $subscription) {
					$subscription_data = subscription::find($subscription[0]['subscription_id']);
					$subscription_data = $this->getSubscriptionCourses($subscription_data);
					if(count($subscription) == count($fav_courses)) {
						$matched_subscriptions[] = $subscription_data;
						$view->with('matched_subscriptions',$matched_subscriptions);
					}else{
						$similiar_subscriptions[] = $subscription_data;
						$view->with('similiar_subscriptions', $similiar_subscriptions);
					}
				}
			}
		}
		
		return $view;
	}
	//Effettua il 'pagamento'
	public function subscriptionPayment() {
		$user_id = session('user_id');
		$active_subscriptions = user::find($user_id)->activeSubscriptions();
		$new_subscriptions = Request::all();
		$duration = $new_subscriptions['duration'];
		$subscription_cost = 0;
		foreach($new_subscriptions['subscription_id'] as $subscription_id) {
			$old_subscription = $active_subscriptions->get()->where('subscription_id', $subscription_id)->first();
			if($old_subscription) {
				$new_duration = $old_subscription['pivot']['duration_months'] + $duration;
				$active_subscriptions->updateExistingPivot($subscription_id, ['duration_months' => $new_duration]);
			} else {
				$active_subscriptions->attach($subscription_id, ['duration_months' => $duration, 'start_date' => date('Y-m-d')]);
			}
			$subscription_cost += subscription::find($subscription_id)['cost'];
		}
		return ['success' => true, 'payment_method' => $new_subscriptions['payment_method'], 'total_cost' => $subscription_cost * $duration];
	}
	//Recupera tutti i corsi associati all'abbonamento
	public function getSubscriptionCourses($subscription) {
		$courses_byType = subscription::find($subscription['subscription_id'])->subscriptionCourses->groupBy('type');
		if($courses_byType->count()) {
			foreach($courses_byType as $courses) {
				$course_types[] = $courses[0]['type'];
				foreach($courses as $course) {
					$courses_info[] = ['course_id' => $course['course_id'], 'name' => $course['name']];
				}
			}
			$subscription['course_types'] = $course_types;
			$subscription['courses_info'] = $courses_info;
		}
		
		return $subscription;
	}
}
?>
