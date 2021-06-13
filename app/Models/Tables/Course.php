<?php
class course extends defaultModel {
	protected $table = 'course';
	protected $primaryKey = 'course_id';
	protected $fillable = ['name', 'type', 'description', 'image', 'duration', 'intensity'];
	//Utenti con il corso nei preferiti
	public function courseUsers() {
		return $this->belongsToMany('user', 'user_courses', 'course_id', 'user_id');
	}
	//Sedi che offrono il corso
	public function courseLocations() {
		return $this->belongsToMany('location', 'location_courses', 'course_id', 'location_id');
	}
	//Abbonamenti che offrono il corso
	public function courseSubscriptions() {
		return $this->belongsToMany('subscription', 'subscription_courses', 'course_id', 'subscription_id');
	}
}
?>
