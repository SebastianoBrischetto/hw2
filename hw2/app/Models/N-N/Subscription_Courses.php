<?php
class subscription_courses extends defaultModel {
	protected $table = 'subscription_courses';
	protected $primaryKey = 'id';
	protected $fillable = ['subscription_id', 'course_id'];
}
?>
