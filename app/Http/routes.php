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
	'uses' => '',
	'as' => 'home',
]);


/*  --PerSchool routes--  */
Route::group(['as' => 'school_', 'prefix' => '{school}'], function(){

	Route::get('/', [
		'uses' => '',
		'as' => 'home',
	]);

	Route::get('/news', [
		'uses' => '',
		'as' => 'news',
	]);

	Route::get('/list', [
		'uses' => '',
		'as' => 'list',
	]);

	Route::get('/liberate', [
		'uses' => '',
		'as' => 'liberate',
	]);

	Route::get('/register', [
		'uses' => '',
		'as' => 'register',
	]);

	Route::get('/forum', [
		'uses' => '',
		'as' => 'forum',
	]);

	Route::get('/trailer', [
		'uses' => '',
		'as' => 'trailer',
	]);

	Route::get('/tube', [
		'uses' => '',
		'as' => 'tube',
	]);

	/*  --Admin routes--  */
	Route::group(['as' => '', 'middleware' => 'admin', 'prefix' => 'admin'], function(){
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

		Route::get('/remove', [
			'uses' => '',
			'as' => 'remove/{id?}',
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
