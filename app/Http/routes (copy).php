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

Route::get('/', [
	'uses' => 'GuestViewsController@schools',
	'as' => 'home',
]);


/*  --PerSchool routes--  */
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

	Route::get('/login', [
		// return redirect()->intended();
		'middleware' => 'guest',
		'uses' => '',
		'as' => 'login',
	]);

	/*  --Admin routes--  */
	Route::group(['as' => 'admin_', 'middleware' => 'admin', 'prefix' => 'admin'], function(){
		Route::get('/', [
			'uses' => '',
			'as' => 'home',
		]);

		Route::get('/add', [
			'uses' => '',
			'as' => 'add',
		]);

		Route::get('/edit/{id?}', [
			'uses' => '',
			'as' => 'edit',
		]);

		Route::get('/remove/{id?}', [
			'uses' => '',
			'as' => 'remove',
		]);

		/*  --Admin profile routes--  */
		Route::group(['as' => 'profile_', 'prefix' => 'profile'], function(){
			Route::get('/', [
				'uses' => '',
				'as' => 'home',
			]);
		});

		/*  --Admin news routes--  */
		Route::group(['as' => 'news_', 'prefix' => 'news'], function(){
			Route::get('/', [
				'uses' => '',
				'as' => 'home',
			]);

			Route::get('/add', [
				'uses' => '',
				'as' => 'add',
			]);

			Route::get('/edit/{id?}', [
				'uses' => '',
				'as' => 'edit',
			]);

			Route::get('/remove/{id?}', [
				'uses' => '',
				'as' => 'remove',
			]);
		});

		/*  --Admin forum routes--  */
		Route::group(['as' => 'forum_', 'prefix' => 'forum'], function(){
			Route::get('/', [
				'uses' => '',
				'as' => 'home',
			]);

			Route::get('/add', [
				'uses' => '',
				'as' => 'add',
			]);

			Route::get('/edit/{id?}', [
				'uses' => '',
				'as' => 'edit',
			]);

			Route::get('/remove/{id?}', [
				'uses' => '',
				'as' => 'remove',
			]);
		});

		Route::get('/trailer', [
			'uses' => '',
			'as' => 'trailer',
		]);

		Route::get('/tube', [
			'uses' => '',
			'as' => 'tube',
		]);
	});

});


Route::get('/login', [
	// return redirect()->intended();
	'middleware' => 'guest',
	'uses' => '',
	'as' => 'login',
]);

/*  --SuperAdmin routes--  */
Route::group(['as' => 'admin_', 'middleware' => 'superadmin', 'prefix' => 'admin'], function(){

	Route::get('/', [
		'uses' => '',
		'as' => 'home',
	]);

	Route::get('/add', [
		'uses' => '',
		'as' => 'add',
	]);

	Route::get('/edit/{id?}', [
		'uses' => '',
		'as' => 'edit',
	]);

	Route::get('/remove/{id?}', [
		'uses' => '',
		'as' => 'remove',
	]);

	/*  --SuperAdmin profile routes--  */
	Route::group(['as' => 'profile_', 'prefix' => 'profile'], function(){
		Route::get('/', [
			'uses' => '',
			'as' => 'home',
		]);
	});

	/*  --SuperAdmin school routes--  */
	Route::group(['as' => 'school_', 'prefix' => 'school'], function(){
		Route::get('/', [
			'uses' => '',
			'as' => 'home',
		]);

		Route::get('/add', [
			'uses' => '',
			'as' => 'add',
		]);

		Route::get('/edit/{id?}', [
			'uses' => '',
			'as' => 'edit',
		]);

		Route::get('/remove/{id?}', [
			'uses' => '',
			'as' => 'remove',
		]);
	});
});
