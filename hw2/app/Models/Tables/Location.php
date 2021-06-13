<?php
class location extends defaultModel {
	protected $table = 'location';
	protected $primaryKey = 'location_id';
	protected $fillable = ['address', 'city', 'description', 'phone_number', 'email', 'location_image', 'trainers_image'];
	//Immagini associate alla sede
	public function Images() {
		return $this->hasMany('location_images', 'location_id');
	}
	//Orari associati alla sede
	public function Times() {
		return $this->hasMany('location_times', 'location_id');
	}
	//Corsi offerti dalla sede
	public function locationCourses() {
		return $this->belongsToMany('course', 'location_courses', 'location_id', 'course_id');
	}
	//Trainers che lavorano nella sede
	public function Trainers() {
		return $this->hasMany('trainer', 'location_id');
	}
}
?>
