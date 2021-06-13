<?php
use Illuminate\Support\Facades\Route;
//Access Routes
Route::get('Access','Access_Controller@loadAccess')->name('Access');
Route::post('Access/Login','Access_Controller@Login')->name('Login');
Route::get('Access/checkEmail/{email?}','Access_Controller@checkEmail')->name('checkEmail');
Route::post('Access/Signup','Access_Controller@Signup')->name('Signup');
Route::get('Access/Logout','Access_Controller@Logout')->name('Logout');
//Homepage Routes
Route::get('Homepage','Homepage_Controller@loadHomepage')->name('Homepage');
//Courses Routes
Route::get('Courses','Courses_Controller@loadCourses')->name('Courses');
Route::get('Courses/{course_id?}','Courses_Controller@loadCourse')->name('Course');
Route::get('Courses/Type/{course_type?}','Courses_Controller@loadCoursesOfType')->name('CoursesOfType');
Route::get('Courses/{operation}/{course_id}','Courses_Controller@updateFavorites')->name('UpdateFavorites');
//Locations Routes
Route::get('Locations','Locations_Controller@loadLocations')->name('Locations');
Route::get('Locations/{location_id?}','Locations_Controller@loadLocation')->name('Location');
Route::get('Locations/withCourses/{course_id?}','Locations_Controller@loadLocationWithCourses')->name('LocationWithCourses');
Route::get('Locations/getLatLng/{address}','Locations_Controller@getLatLng')->name('getLatLng');
//Trainers Routes
Route::get('Trainers','Trainers_Controller@loadTrainersLocations')->name('Trainers');
Route::get('Trainers/{location_id}','Trainers_Controller@loadTrainersLocation')->name('locationTrainers');
//Subscriptions Routes
Route::get('Subscriptions','Subscriptions_Controller@loadSubscriptions')->name('Subscriptions');
Route::post('Subscriptions/Payment','Subscriptions_Controller@subscriptionPayment')->name('subscriptionPayment');
//Exercises Routes
Route::get('Exercises','Exercises_Controller@loadExercises')->name('Exercises');
Route::get('Exercises/{type}','Exercises_Controller@getExercises')->name('getExercises');
//Content Routes
Route::get('Content','Content_Controller@loadContent')->name('Content');
Route::get('Content/getForm/{table}','Content_Controller@contentForm_mysql')->name('contentForm');
Route::get('Content/getKey/{table}','Content_Controller@tableKey')->name('contentKey');
Route::get('Content/getData/{table}/{key}/{value}','Content_Controller@tableData')->name('contentData');
Route::post('Content/manageContent','Content_Controller@manageContent')->name('manageContent');