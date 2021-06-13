<?php

namespace App\Providers;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class NavBarServiceProvider extends ServiceProvider {
    public function register() {
    }

    public function boot() {
		View::composer('Layouts.Default_Layout', function ($view) {
			$locations = \location::all();
			$user_id = session('user_id');
			$is_admin = session('is_admin');
			$view->with('locations', $locations)->with('user_id',$user_id)->with('is_admin',$is_admin);
		});
    }
}
