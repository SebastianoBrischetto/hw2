<?php
class user extends defaultModel {
	protected $table = 'user';
	protected $primaryKey = 'user_id';
	protected $fillable = ['email', 'password', 'name', 'surname', 'birth_date'];
	protected $hidden = ['password'];
	//Corsi preferiti dall'utente
	public function userCourses() {
		return $this->belongsToMany('course', 'user_courses', 'user_id', 'course_id');
	}
	//Abbonamenti sottoscritti dall'utente
	public function activeSubscriptions() {
		return $this->belongsToMany('subscription', 'user_subscriptions_active', 'user_id', 'subscription_id')->withPivot(['duration_months', 'start_date']);
	}
}
?>
