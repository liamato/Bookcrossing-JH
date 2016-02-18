<?php

/*
|--------------------------------------------------------------------------
| Api Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an api.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::group(['prefix' => '/api', 'middleware' => 'options'], function(){

	// @GET

	Route::get('/book{options}', [
		'uses' => 'ApiBookController@index',
		'as' => 'api.book.index'
	]);

	Route::get('/book{options}/{book}', [
		'uses' => 'ApiBookController@show',
		'as' => 'api.book.show'
	]);

	Route::resource('/book', 'ApiBookController', ['except' => ['create', 'edit']]);



	Route::get('/category{options}', [
		'uses' => 'ApiCategoryController@index',
		'as' => 'api.catrgory.index'
	]);

	Route::get('/category{options}/{category}', [
		'uses' => 'ApiCategoryController@show',
		'as' => 'api.catrgory.show'
	]);
	
	Route::resource('/category', 'ApiCategoryController', ['except' => ['create', 'edit']]);



	Route::get('/post{options}', [
		'uses' => 'ApiPostController@index',
		'as' => 'api.post.index'
	]);

	Route::get('/post{options}/{post}', [
		'uses' => 'ApiPostController@show',
		'as' => 'api.post.show'
	]);

	Route::resource('/post', 'ApiPostController', ['except' => ['create', 'edit']]);



	Route::get('/news{options}', [
		'uses' => 'ApiReportController@index',
		'as' => 'api.news.index'
	]);

	Route::get('/news{options}/{news}', [
		'uses' => 'ApiReportController@show',
		'as' => 'api.news.show'
	]);

	Route::resource('/news', 'ApiReportController', ['except' => ['create', 'edit']]);



	Route::get('/school{options}', [
		'uses' => 'ApiSchoolController@index',
		'as' => 'api.school.index'
	]);

	Route::get('/school{options}/{school}', [
		'uses' => 'ApiSchoolController@show',
		'as' => 'api.school.show'
	]);

	Route::resource('/school', 'ApiSchoolController', ['except' => ['create', 'edit']]);

	Route::group(['prefix' => '/school/{school}', 'middleware' => 'school'], function () {

		Route::get('/book{options}', [
			'uses' => 'ApiBookController@index',
			'as' => 'api.book.index'
		]);

		Route::get('/book{options}/{book}', [
			'uses' => 'ApiBookController@show',
			'as' => 'api.book.show'
		]);

		Route::resource('/book', 'ApiBookController', ['except' => ['create', 'edit']]);



		Route::get('/category{options}', [
			'uses' => 'ApiCategoryController@index',
			'as' => 'api.catrgory.index'
		]);

		Route::get('/category{options}/{category}', [
			'uses' => 'ApiCategoryController@show',
			'as' => 'api.catrgory.show'
		]);
		
		Route::resource('/category', 'ApiCategoryController', ['except' => ['create', 'edit']]);



		Route::get('/post{options}', [
			'uses' => 'ApiPostController@index',
			'as' => 'api.post.index'
		]);

		Route::get('/post{options}/{post}', [
			'uses' => 'ApiPostController@show',
			'as' => 'api.post.show'
		]);

		Route::resource('/post', 'ApiPostController', ['except' => ['create', 'edit']]);


		Route::get('/news{options}', [
			'uses' => 'ApiReportController@index',
			'as' => 'api.news.index'
		]);

		Route::get('/news{options}/{news}', [
			'uses' => 'ApiReportController@show',
			'as' => 'api.news.show'
		]);

		Route::resource('/news', 'ApiReportController', ['except' => ['create', 'edit']]);

		Route::get('/user{options}', [
			'uses' => 'ApiUserController@index',
			'as' => 'api.user.index'
		]);

		Route::get('/user{options}/{user}', [
			'uses' => 'ApiUserController@show',
			'as' => 'api.user.show'
		]);

		Route::resource('/user', 'ApiUserController', ['except' => ['create', 'edit']]);



		Route::get('/video{options}', [
			'uses' => 'ApiVideoController@index',
			'as' => 'api.video.index'
		]);

		Route::get('/video{options}/{video}', [
			'uses' => 'ApiVideoController@show',
			'as' => 'api.video.show'
		]);

		Route::resource('/video', 'ApiVideoController', ['except' => ['create', 'edit']]);

	});



	Route::get('/user{options}', [
		'uses' => 'ApiUserController@index',
		'as' => 'api.user.index'
	]);

	Route::get('/user{options}/{user}', [
		'uses' => 'ApiUserController@show',
		'as' => 'api.user.show'
	]);

	Route::resource('/user', 'ApiUserController', ['except' => ['create', 'edit']]);



	Route::get('/video{options}', [
		'uses' => 'ApiVideoController@index',
		'as' => 'api.video.index'
	]);

	Route::get('/video{options}/{video}', [
		'uses' => 'ApiVideoController@show',
		'as' => 'api.video.show'
	]);

	Route::resource('/video', 'ApiVideoController', ['except' => ['create', 'edit']]);
});