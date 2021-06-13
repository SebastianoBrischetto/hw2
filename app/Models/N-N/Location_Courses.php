<?php
class location_courses extends defaultModel {
	protected $table = 'location_courses';
	protected $primaryKey = 'id';
	protected $fillable = ['location_id', 'course_id'];
}
?>
