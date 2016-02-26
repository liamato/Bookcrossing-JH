<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
/*
Route::group(['prefix' => 'api/v1'], function(){

	Route::get('/{a}/news', function($a) {
		$news = \App\Report::where('school_id', \App\School::bySlug($a)->id)->get();
		if (!$news instanceof \Illuminate\Support\Collection){
			$news = collect($news);
		}
		return $news;
	});

	Route::get('/{a}/books', function($a) {
		$news = \App\Book::where('school_id', \App\School::bySlug($a)->id)->get();
		if (!$news instanceof \Illuminate\Support\Collection){
			$news = collect($news);
		}
		return $news;
	});

	Route::get('/{a}/books/add', function($a) {
		$news = \App\Book::where('school_id', \App\School::bySlug($a)->id)->get();
		if (!$news instanceof \Illuminate\Support\Collection){
			$news = collect($news);
		}
		return $news;
	});

	Route::get('/{a}/posts', function($a) {
		$news = \App\Post::where('school_id', \App\School::bySlug($a)->id)->get();
		if (!$news instanceof \Illuminate\Support\Collection){
			$news = collect($news);
		}
		return $news;
	});

	Route::get('/school/', function () {
		return \App\School::all();
	});

	Route::get('/school/{a}', function ($a) {
		return \App\School::bySlug($a, ['books', 'categories', 'news', 'posts', 'videos']);
	});
});
*/

Route::get('login', 'Auth\AuthController@getLogin');
Route::post('login', 'Auth\AuthController@postLogin');
Route::get('logout', 'Auth\AuthController@getLogout');

Route::get('/{school?}/{b?}/{c?}/{d?}/{e?}', function () {
	return view('test.react', ['ola' => 'config = {ola: "ola"}']);
});

Route::get('/', [
	'uses' => 'GuestViewsController@schools',
	'as' => 'home',
]);

/*
Route::get('/', function () {
	return view('welcome');
});


Route::group(['as' => 'school_', 'middleware' => 'school', 'prefix' => '{school}'], function(){

	Route::get('/', [
		'uses' => 'GuestViewsController@home',
		'as' => 'home',
	]);

	Route::get('/news', [
		'uses' => 'GuestViewsController@news',
		'as' => 'news',
	]);

	Route::get('/list', [
		'uses' => 'GuestViewsController@listing',
		'as' => 'list',
	]);

	Route::get('/capture', [
		'uses' => 'GuestViewsController@capture',
		'as' => 'capture',
	]);

	Route::get('/liberate', [
		'uses' => 'GuestViewsController@liberate',
		'as' => 'liberate',
	]);

	Route::get('/register', [
		'uses' => 'GuestViewsController@register',
		'as' => 'register',
	]);

	Route::get('/forum/{category?}', [
		'uses' => 'GuestViewsController@forum',
		'as' => 'forum',
	]);

	Route::get('/trailer', [
		'uses' => 'GuestViewsController@trailer',
		'as' => 'trailer',
	]);

	Route::get('/tube', [
		'uses' => 'GuestViewsController@tube',
		'as' => 'tube',
	]);
});
*/
