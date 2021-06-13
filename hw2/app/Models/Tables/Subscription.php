<?php
class subscription extends defaultModel {
	protected $table = 'subscription';
	protected $primaryKey = 'subscription_id';
	protected $fillable  = ['name', 'cost'];
	//Utenti che hanno sottoscritto l'abbonamento
	public function subscriptionUser() {
		return $this->belongsToMany('user', 'user_subscriptions_active', 'subscription_id', 'user_id');
	}
	//Corsi compresi dall'abbonamento
	public function subscriptionCourses() {
		return $this->belongsToMany('course', 'subscription_courses', 'subscription_id', 'course_id');
	}
}
?>
