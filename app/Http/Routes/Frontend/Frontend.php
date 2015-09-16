<?php

/**
 * Frontend Controllers
 */

/**
 * Default Framework routes
 */
Route::group(['domain' => config('stack.domain')], function()
{
	Route::get('/', ['as' => 'home', 'uses' => 'FrontendController@index']);
	Route::get('macros', 'FrontendController@macros');
});

/**
 * Routes for Stack Apps
 */
Route::group(['domain' => '{slug}.social.dev'], function($slug)
{
	Route::get('/', 'StackController@show');
	Route::get('member/{referral_token}', 'StackController@member')->where(['slug' => '[a-z-0-9-]+', 'referral_token' => '[a-zA-Z0-9]+']);

	//App views
	Route::get('stack/{slug}', 'StackController@show')->where(['slug' => '[a-z-0-9-]+']);
	Route::get('stack/{slug}/member/{referral_token}', 'StackController@member')->where(['slug' => '[a-z-0-9-]+', 'referral_token' => '[a-zA-Z0-9]+']);

	//Referral Redirects
	Route::get('referral/{referral_token}', 'StackController@show')->where(['slug' => '[a-z-0-9-]+', 'referral_token' => '[a-zA-Z0-9]+']);
	Route::get('stack/{slug}/referral/{referral_token}', 'StackController@show')->where(['slug' => '[a-z-0-9-]+', 'referral_token' => '[a-zA-Z0-9]+']);

	//Facebook Redirects
	Route::get('auth/facebook', 'StackController@facebookAuth');
	Route::get('stack/{slug}/auth/facebook', 'StackController@facebookAuth');
	Route::post('auth/facebook', 'StackController@facebookAuth');
	Route::post('stack/{slug}/auth/facebook', 'StackController@facebookAuth');

	//Email Redirects
	Route::post('auth/email', 'StackController@emailAuth');
	Route::post('stack/{slug}/auth/email', 'StackController@emailAuth');

	//Collect Shares
	Route::get('collect/share/facebook', 'StackController@facebookCollectShare');
	Route::get('collect/share/twitter', 'StackController@twitterCollectShare');
});


/**
 * These frontend controllers require the user to be logged in
 */
Route::group(['middleware' => 'auth'], function ()
{
	Route::get('dashboard', ['as' => 'frontend.dashboard', 'uses' => 'DashboardController@index']);
	Route::resource('profile', 'ProfileController', ['only' => ['edit', 'update']]);
});