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



	Route::group(['middleware' => 'auth'], function(){

		Route::get('/user{options}', [
			'uses' => 'ApiUserController@index',
			'as' => 'api.user.index'
		]);

		Route::get('/user{options}/{user}', [
			'uses' => 'ApiUserController@show',
			'as' => 'api.user.show'
		]);

		Route::resource('/user', 'ApiUserController', ['except' => ['create', 'edit']]);

	});


	Route::get('/video{options}', [
		'uses' => 'ApiVideoController@index',
		'as' => 'api.video.index'
	]);

	Route::get('/video{options}/{video}', [
		'uses' => 'ApiVideoController@show',
		'as' => 'api.video.show'
	]);

	Route::resource('/video', 'ApiVideoController', ['except' => ['create', 'edit']]);

/*
	Route::get('/book/{id?}', [
		'uses' => function($id=null) {
			if (!is_null($id)) {
				return \App\Book::findOrFail($id);
			}
			return \App\Book::all();
		},
		'as' => 'book'
	]);

	Route::get('/category/{id?}', [
		'uses' => function($id=null) {
			if (!is_null($id)) {
				return \App\Category::findOrFail($id);
			}
			return \App\Category::all();
		},
		'as' => 'category'
	]);

	Route::get('/post/{id?}', [
		'uses' => function($id=null) {
			if (!is_null($id)) {
				return \App\Post::findOrFail($id);
			}
			return \App\Post::all();
		},
		'as' => 'post'
	]);

	Route::get('/news/{id?}', [
		'uses' => function($id=null) {
			if (!is_null($id)) {
				return \App\Report::findOrFail($id);
			}
			return \App\Report::all();
		},
		'as' => 'news'
	]);

	Route::group(['prefix' => '/school', 'as' => 'school_'], function(){
		Route::get('/', [
			'uses' => function() {
				return \App\School::all();
			},
			'as' => 'home'
		]);

		Route::group(['prefix' => '/{scId}', 'as' => 'byId_'], function(){
			Route::get('/', [
				'uses' => function($scId) {
					return \App\School::findOrFail($scId);
				},
				'as' => 'home'
			]);

			Route::get('/book/{id?}', [
				'uses' => function($scId, $id=null) {
					if (!is_null($id)) {
						return \App\Book::bySchool($scId)->findOrFail($id);
					}
					return \App\Book::bySchool($scId)->get();
				},
				'as' => 'book'
			]);

			Route::get('/category/{id?}', [
				'uses' => function($scId, $id=null) {
					if (!is_null($id)) {
						return \App\Category::bySchool($scId)->findOrFail($id);
					}
					return \App\Category::bySchool($scId)->get();
				},
				'as' => 'category'
			]);

			Route::get('/category/{slug}', [
				'uses' => function($scId, $slug) {
					return \App\Category::bySlug($slug, $scId);
				},
				'as' => 'category'
			]);

			Route::get('/post/{id?}', [
				'uses' => function($scId, $id=null) {
					if (!is_null($id)) {
						return \App\Post::bySchool($scId)->findOrFail($id);
					}
					return \App\Post::bySchool($scId)->get();
				},
				'as' => 'post'
			]);

			Route::get('/news/{id?}', [
				'uses' => function($scId, $id=null) {
					if (!is_null($id)) {
						return \App\Report::bySchool($scId)->findOrFail($id);
					}
					return \App\Report::bySchool($scId)->get();
				},
				'as' => 'news'
			]);

			Route::group(['middleware' => 'auth'], function(){

				Route::get('/user/{id?}', [
					'uses' => function($scId, $id=null) {
						if (!is_null($id)) {
							return \App\User::bySchool($scId)->findOrFail($id);
						}
						return \App\User::bySchool($scId)->get();
					},
					'as' => 'user'
				]);

				Route::get('/user/{mail}', [
					'uses' => function($scId, $mail) {
						return \App\User::bySchool($scId)->byMail($mail);
					},
					'as' => 'user'
				]);
			});


			Route::get('/video/{id?}', [
				'uses' => function($scId, $id=null) {
					if (!is_null($id)) {
						return \App\Video::bySchool($scId)->findOrFail($id);
					}
					return \App\Video::bySchool($scId)->get();
				},
				'as' => 'video'
			]);

			Route::get('/video/{code}', [
				'uses' => function($scId, $code) {
					return \App\Video::bySchool($scId)->byCode($code);
				},
				'as' => 'video'
			]);
		});



		Route::group(['prefix' => '/{scSlug}', 'as' => 'bySlug_'], function(){
			Route::get('/', [
				'uses' => function($scSlug) {
					return \App\School::bySlug($scSlug);
				},
				'as' => 'home'
			]);

			Route::get('/book/{id?}', [
				'uses' => function($scSlug, $id=null) {
					if (!is_null($id)) {
						return \App\Book::bySchool($scSlug)->findOrFail($id);
					}
					return \App\Book::bySchool($scSlug)->get();
				},
				'as' => 'book'
			]);

			Route::get('/category/{id?}', [
				'uses' => function($scSlug, $id=null) {
					if (!is_null($id)) {
						return \App\Category::bySchool($scSlug)->findOrFail($id);
					}
					return \App\Category::bySchool($scSlug)->get();
				},
				'as' => 'category'
			]);

			Route::get('/category/{slug}', [
				'uses' => function($scSlug, $slug) {
					return \App\Category::bySlug($slug, $scSlug);
				},
				'as' => 'category'
			]);

			Route::get('/post/{id?}', [
				'uses' => function($scSlug, $id=null) {
					if (!is_null($id)) {
						return \App\Post::bySchool($scSlug)->findOrFail($id);
					}
					return \App\Post::bySchool($scSlug)->get();
				},
				'as' => 'post'
			]);

			Route::get('/news/{id?}', [
				'uses' => function($scSlug, $id=null) {
					if (!is_null($id)) {
						return \App\Report::bySchool($scSlug)->findOrFail($id);
					}
					return \App\Report::bySchool($scSlug)->get();
				},
				'as' => 'news'
			]);

			Route::group(['middleware' => 'auth'], function(){

				Route::get('/user/{id?}', [
					'uses' => function($scSlug, $id=null) {
						if (!is_null($id)) {
							return \App\User::bySchool($scSlug)->findOrFail($id);
						}
						return \App\User::bySchool($scSlug)->get();
					},
					'as' => 'user'

				]);

				Route::get('/user/{mail}', [
					'uses' => function($scSlug, $mail) {
						return \App\User::bySchool($scSlug)->byMail($mail);
					},
					'as' => 'user'

				]);

			});

			Route::get('/video/{id?}', [
				'uses' => function($scSlug, $id=null) {
					if (!is_null($id)) {
						return \App\Video::bySchool($scSlug)->findOrFail($id);
					}
					return \App\Video::bySchool($scSlug)->get();
				},
				'as' => 'video'
			]);

			Route::get('/video/{code}', [
				'uses' => function($scSlug, $code) {
					return \App\Video::bySchool($scSlug)->byCode($code);
				},
				'as' => 'video'
			]);

		});
	});

	Route::group(['middleware' => 'auth'], function(){
	
		Route::get('/user/{id?}', [
			'uses' => function($id=null) {
				if (!is_null($id)) {
					return \App\User::find($id);
				}
				return \App\User::all();
			},
			'as' => 'user'
		]);

		Route::get('/user/{mail}', [
			'uses' => function($mail) {
				return \App\User::byMail($mail);
			},
			'as' => 'user'
		]);
	});

	Route::get('/video/{id?}', [
		'uses' => function($id=null) {
			if (!is_null($id)) {
				return \App\Video::find($id);
			}
			return \App\Video::all();
		},
		'as' => 'video'
	]);

	Route::get('/video/{code}', [
		'uses' => function($code) {
			return \App\Video::byCode($code);
		},
		'as' => 'video'
	]);
*/

	// @POST
/*
	Route::post('/book', [
		'uses' => function($id=null) {
			if (!is_null($id)) {
				return \App\Book::findOrFail($id);
			}
			return \App\Book::all();
		},
		'as' => 'book'
	]);

	Route::post('/post', [
		'uses' => function($id=null) {
			if (!is_null($id)) {
				return \App\Post::findOrFail($id);
			}
			return \App\Post::all();
		},
		'as' => 'post'
	]);

	Route::post('/video', [
		'uses' => function($id=null) {
			if (!is_null($id)) {
				return \App\Video::find($id);
			}
			return \App\Video::all();
		},
		'as' => 'video'
	]);

	Route::group(['middleware' => 'auth'], function(){
		Route::post('/category', [
			'uses' => function($id=null) {
				if (!is_null($id)) {
					return \App\Category::findOrFail($id);
				}
				return \App\Category::all();
			},
			'as' => 'category'
		]);

		Route::post('/news', [
			'uses' => function($id=null) {
				if (!is_null($id)) {
					return \App\Report::findOrFail($id);
				}
				return \App\Report::all();
			},
			'as' => 'news'
		]);
		
		Route::post('/user', [
			'uses' => function($id=null) {
				if (!is_null($id)) {
					return \App\User::find($id);
				}
				return \App\User::all();
			},
			'as' => 'user'
		]);
	});

	Route::group(['prefix' => '/school', 'as' => 'school_'], function(){
		Route::post('/', [
			'middleware' => 'auth',
			'uses' => function() {
				return \App\School::all();
			},
			'as' => 'home'
		]);

		Route::group(['prefix' => '/{scId}', 'as' => 'byId_'], function(){
			Route::post('/book', [
				'uses' => function($scId) {
					if (!is_null($id)) {
						return \App\Book::bySchool($scId)->findOrFail($id);
					}
					return \App\Book::bySchool($scId)->get();
				},
				'as' => 'book'
			]);
			
			Route::post('/post', [
				'uses' => function($scId, $id=null) {
					if (!is_null($id)) {
						return \App\Post::bySchool($scId)->findOrFail($id);
					}
					return \App\Post::bySchool($scId)->get();
				},
				'as' => 'post'
			]);

			Route::post('/video', [
				'uses' => function($scId, $id=null) {
					if (!is_null($id)) {
						return \App\Video::bySchool($scId)->findOrFail($id);
					}
					return \App\Video::bySchool($scId)->get();
				},
				'as' => 'video'
			]);

			Route::group(['middleware' => 'auth'], function(){
				Route::post('/category', [
					'uses' => function($scId, $id=null) {
						if (!is_null($id)) {
							return \App\Category::bySchool($scId)->findOrFail($id);
						}
						return \App\Category::bySchool($scId)->get();
					},
					'as' => 'category'
				]);

				Route::post('/news', [
					'uses' => function($scId, $id=null) {
						if (!is_null($id)) {
							return \App\Report::bySchool($scId)->findOrFail($id);
						}
						return \App\Report::bySchool($scId)->get();
					},
					'as' => 'news'
				]);

				Route::post('/user', [
					'uses' => function($scId, $id=null) {
						if (!is_null($id)) {
							return \App\User::bySchool($scId)->findOrFail($id);
						}
						return \App\User::bySchool($scId)->get();
					},
					'as' => 'user'

				]);
			});
		});



		Route::group(['prefix' => '/{scSlug}', 'as' => 'bySlug_'], function(){
			Route::post('/book', [
				'uses' => function($scSlug, $id=null) {
					if (!is_null($id)) {
						return \App\Book::bySchool($scSlug)->findOrFail($id);
					}
					return \App\Book::bySchool($scSlug)->get();
				},
				'as' => 'book'
			]);

			Route::post('/post', [
				'uses' => function($scSlug, $id=null) {
					if (!is_null($id)) {
						return \App\Post::bySchool($scSlug)->findOrFail($id);
					}
					return \App\Post::bySchool($scSlug)->get();
				},
				'as' => 'post'
			]);

			Route::post('/video', [
				'uses' => function($scSlug, $id=null) {
					if (!is_null($id)) {
						return \App\Video::bySchool($scSlug)->findOrFail($id);
					}
					return \App\Video::bySchool($scSlug)->get();
				},
				'as' => 'video'
			]);

			Route::group(['middleware' => 'auth'], function(){
				Route::post('/category', [
					'uses' => function($scSlug, $id=null) {
						if (!is_null($id)) {
							return \App\Category::bySchool($scSlug)->findOrFail($id);
						}
						return \App\Category::bySchool($scSlug)->get();
					},
					'as' => 'category'
				]);

				Route::post('/news', [
					'uses' => function($scSlug, $id=null) {
						if (!is_null($id)) {
							return \App\Report::bySchool($scSlug)->findOrFail($id);
						}
						return \App\Report::bySchool($scSlug)->get();
					},
					'as' => 'news'
				]);

				Route::post('/user', [
					'uses' => function($scSlug, $id=null) {
						if (!is_null($id)) {
							return \App\User::bySchool($scSlug)->findOrFail($id);
						}
						return \App\User::bySchool($scSlug)->get();
					},
					'as' => 'user'
				]);
			});
		});
	});
*/

	// @PUT
/*
	Route::group(['middleware' => 'auth'], function(){

		Route::put('/book/{id?}', [
			'uses' => function($id=null) {
				if (!is_null($id)) {
					return \App\Book::findOrFail($id);
				}
				return \App\Book::all();
			},
			'as' => 'book'
		]);

		Route::put('/category/{id?}', [
			'uses' => function($id=null) {
				if (!is_null($id)) {
					return \App\Category::findOrFail($id);
				}
				return \App\Category::all();
			},
			'as' => 'category'
		]);

		Route::put('/post/{id?}', [
			'uses' => function($id=null) {
				if (!is_null($id)) {
					return \App\Post::findOrFail($id);
				}
				return \App\Post::all();
			},
			'as' => 'post'
		]);

		Route::put('/news/{id?}', [
			'uses' => function($id=null) {
				if (!is_null($id)) {
					return \App\Report::findOrFail($id);
				}
				return \App\Report::all();
			},
			'as' => 'news'
		]);

		Route::group(['prefix' => '/school', 'as' => 'school_'], function(){
			Route::put('/', [
				'uses' => function() {
					return \App\School::all();
				},
				'as' => 'home'
			]);

			Route::group(['prefix' => '/{scId}', 'as' => 'byId_'], function(){
				Route::put('/', [
					'uses' => function($scId) {
						return \App\School::findOrFail($scId);
					},
					'as' => 'home'
				]);

				Route::put('/book/{id?}', [
					'uses' => function($scId, $id=null) {
						if (!is_null($id)) {
							return \App\Book::bySchool($scId)->findOrFail($id);
						}
						return \App\Book::bySchool($scId)->get();
					},
					'as' => 'book'
				]);

				Route::put('/category/{id?}', [
					'uses' => function($scId, $id=null) {
						if (!is_null($id)) {
							return \App\Category::bySchool($scId)->findOrFail($id);
						}
						return \App\Category::bySchool($scId)->get();
					},
					'as' => 'category'
				]);

				Route::put('/category/{slug}', [
					'uses' => function($scId, $slug) {
						return \App\Category::bySlug($slug, $scId);
					},
					'as' => 'category'
				]);

				Route::put('/post/{id?}', [
					'uses' => function($scId, $id=null) {
						if (!is_null($id)) {
							return \App\Post::bySchool($scId)->findOrFail($id);
						}
						return \App\Post::bySchool($scId)->get();
					},
					'as' => 'post'
				]);

				Route::put('/news/{id?}', [
					'uses' => function($scId, $id=null) {
						if (!is_null($id)) {
							return \App\Report::bySchool($scId)->findOrFail($id);
						}
						return \App\Report::bySchool($scId)->get();
					},
					'as' => 'news'
				]);

				Route::put('/user/{id?}', [
					'uses' => function($scId, $id=null) {
						if (!is_null($id)) {
							return \App\User::bySchool($scId)->findOrFail($id);
						}
						return \App\User::bySchool($scId)->get();
					},
					'as' => 'user'
				]);

				Route::put('/user/{mail}', [
					'uses' => function($scId, $mail) {
						return \App\User::bySchool($scId)->byMail($mail);
					},
					'as' => 'user'
				]);


				Route::put('/video/{id?}', [
					'uses' => function($scId, $id=null) {
						if (!is_null($id)) {
							return \App\Video::bySchool($scId)->findOrFail($id);
						}
						return \App\Video::bySchool($scId)->get();
					},
					'as' => 'video'
				]);

				Route::put('/video/{code}', [
					'uses' => function($scId, $code) {
						return \App\Video::bySchool($scId)->byCode($code);
					},
					'as' => 'video'
				]);
			});



			Route::group(['prefix' => '/{scSlug}', 'as' => 'bySlug_'], function(){
				Route::put('/', [
					'uses' => function($scSlug) {
						return \App\School::bySlug($scSlug);
					},
					'as' => 'home'
				]);

				Route::put('/book/{id?}', [
					'uses' => function($scSlug, $id=null) {
						if (!is_null($id)) {
							return \App\Book::bySchool($scSlug)->findOrFail($id);
						}
						return \App\Book::bySchool($scSlug)->get();
					},
					'as' => 'book'
				]);

				Route::put('/category/{id?}', [
					'uses' => function($scSlug, $id=null) {
						if (!is_null($id)) {
							return \App\Category::bySchool($scSlug)->findOrFail($id);
						}
						return \App\Category::bySchool($scSlug)->get();
					},
					'as' => 'category'
				]);

				Route::put('/category/{slug}', [
					'uses' => function($scSlug, $slug) {
						return \App\Category::bySlug($slug, $scSlug);
					},
					'as' => 'category'
				]);

				Route::put('/post/{id?}', [
					'uses' => function($scSlug, $id=null) {
						if (!is_null($id)) {
							return \App\Post::bySchool($scSlug)->findOrFail($id);
						}
						return \App\Post::bySchool($scSlug)->get();
					},
					'as' => 'post'
				]);

				Route::put('/news/{id?}', [
					'uses' => function($scSlug, $id=null) {
						if (!is_null($id)) {
							return \App\Report::bySchool($scSlug)->findOrFail($id);
						}
						return \App\Report::bySchool($scSlug)->get();
					},
					'as' => 'news'
				]);

				Route::put('/user/{id?}', [
					'uses' => function($scSlug, $id=null) {
						if (!is_null($id)) {
							return \App\User::bySchool($scSlug)->findOrFail($id);
						}
						return \App\User::bySchool($scSlug)->get();
					},
					'as' => 'user'
				]);

				Route::put('/user/{mail}', [
					'uses' => function($scSlug, $mail) {
						return \App\User::bySchool($scSlug)->byMail($mail);
					},
					'as' => 'user'
				]);

				Route::put('/video/{id?}', [
					'uses' => function($scSlug, $id=null) {
						if (!is_null($id)) {
							return \App\Video::bySchool($scSlug)->findOrFail($id);
						}
						return \App\Video::bySchool($scSlug)->get();
					},
					'as' => 'video'
				]);

				Route::put('/video/{code}', [
					'uses' => function($scSlug, $code) {
						return \App\Video::bySchool($scSlug)->byCode($code);
					},
					'as' => 'video'
				]);
			});
		});

		
		Route::put('/user/{id?}', [
			'uses' => function($id=null) {
				if (!is_null($id)) {
					return \App\User::find($id);
				}
				return \App\User::all();
			},
			'as' => 'user'
		]);

		Route::put('/user/{mail}', [
			'uses' => function($mail) {
				return \App\User::byMail($mail);
			},
			'as' => 'user'
		]);


		Route::put('/video/{id?}', [
			'uses' => function($id=null) {
				if (!is_null($id)) {
					return \App\Video::find($id);
				}
				return \App\Video::all();
			},
			'as' => 'video'
		]);

		Route::put('/video/{code}', [
			'uses' => function($code) {
				return \App\Video::byCode($code);
			},
			'as' => 'video'
		]);
	});


	// @DELETE

	Route::group(['middleware' => 'auth'], function(){

		Route::delete('/book/{id}', [
			'uses' => function($id=null) {
				if (!is_null($id)) {
					return \App\Book::findOrFail($id);
				}
				return \App\Book::all();
			},
			'as' => 'book'
		]);

		Route::delete('/category/{id}', [
			'uses' => function($id=null) {
				if (!is_null($id)) {
					return \App\Category::findOrFail($id);
				}
				return \App\Category::all();
			},
			'as' => 'category'
		]);

		Route::delete('/post/{id}', [
			'uses' => function($id=null) {
				if (!is_null($id)) {
					return \App\Post::findOrFail($id);
				}
				return \App\Post::all();
			},
			'as' => 'post'
		]);

		Route::delete('/news/{id}', [
			'uses' => function($id=null) {
				if (!is_null($id)) {
					return \App\Report::findOrFail($id);
				}
				return \App\Report::all();
			},
			'as' => 'news'
		]);

		Route::group(['prefix' => '/school', 'as' => 'school_'], function(){
			Route::group(['prefix' => '/{scId}', 'as' => 'byId_'], function(){
				Route::delete('/', [
					'uses' => function($scId) {
						return \App\School::findOrFail($scId);
					},
					'as' => 'home'
				]);

				Route::delete('/book/{id}', [
					'uses' => function($scId, $id=null) {
						if (!is_null($id)) {
							return \App\Book::bySchool($scId)->findOrFail($id);
						}
						return \App\Book::bySchool($scId)->get();
					},
					'as' => 'book'
				]);

				Route::delete('/category/{id}', [
					'uses' => function($scId, $id=null) {
						if (!is_null($id)) {
							return \App\Category::bySchool($scId)->findOrFail($id);
						}
						return \App\Category::bySchool($scId)->get();
					},
					'as' => 'category'
				]);

				Route::delete('/category/{slug}', [
					'uses' => function($scId, $slug) {
						return \App\Category::bySlug($slug, $scId);
					},
					'as' => 'category'
				]);

				Route::delete('/post/{id}', [
					'uses' => function($scId, $id=null) {
						if (!is_null($id)) {
							return \App\Post::bySchool($scId)->findOrFail($id);
						}
						return \App\Post::bySchool($scId)->get();
					},
					'as' => 'post'
				]);

				Route::delete('/news/{id}', [
					'uses' => function($scId, $id=null) {
						if (!is_null($id)) {
							return \App\Report::bySchool($scId)->findOrFail($id);
						}
						return \App\Report::bySchool($scId)->get();
					},
					'as' => 'news'
				]);

				Route::delete('/user/{id}', [
					'uses' => function($scId, $id=null) {
						if (!is_null($id)) {
							return \App\User::bySchool($scId)->findOrFail($id);
						}
						return \App\User::bySchool($scId)->get();
					},
					'as' => 'user'
				]);

				Route::delete('/user/{mail}', [
					'uses' => function($scId, $mail) {
						return \App\User::bySchool($scId)->byMail($mail);
					},
					'as' => 'user'
				]);


				Route::delete('/video/{id}', [
					'uses' => function($scId, $id=null) {
						if (!is_null($id)) {
							return \App\Video::bySchool($scId)->findOrFail($id);
						}
						return \App\Video::bySchool($scId)->get();
					},
					'as' => 'video'
				]);

				Route::delete('/video/{code}', [
					'uses' => function($scId, $code) {
						return \App\Video::bySchool($scId)->byCode($code);
					},
					'as' => 'video'
				]);
			});



			Route::group(['prefix' => '/{scSlug}', 'as' => 'bySlug_'], function(){
				Route::delete('/', [
					'uses' => function($scSlug) {
						return \App\School::bySlug($scSlug);
					},
					'as' => 'home'
				]);

				Route::delete('/book/{id}', [
					'uses' => function($scSlug, $id=null) {
						if (!is_null($id)) {
							return \App\Book::bySchool($scSlug)->findOrFail($id);
						}
						return \App\Book::bySchool($scSlug)->get();
					},
					'as' => 'book'
				]);

				Route::delete('/category/{id}', [
					'uses' => function($scSlug, $id=null) {
						if (!is_null($id)) {
							return \App\Category::bySchool($scSlug)->findOrFail($id);
						}
						return \App\Category::bySchool($scSlug)->get();
					},
					'as' => 'category'
				]);

				Route::delete('/category/{slug}', [
					'uses' => function($scSlug, $slug) {
						return \App\Category::bySlug($slug, $scSlug);
					},
					'as' => 'category'
				]);

				Route::delete('/post/{id}', [
					'uses' => function($scSlug, $id=null) {
						if (!is_null($id)) {
							return \App\Post::bySchool($scSlug)->findOrFail($id);
						}
						return \App\Post::bySchool($scSlug)->get();
					},
					'as' => 'post'
				]);

				Route::delete('/news/{id}', [
					'uses' => function($scSlug, $id=null) {
						if (!is_null($id)) {
							return \App\Report::bySchool($scSlug)->findOrFail($id);
						}
						return \App\Report::bySchool($scSlug)->get();
					},
					'as' => 'news'
				]);

				Route::delete('/user/{id}', [
					'uses' => function($scSlug, $id=null) {
						if (!is_null($id)) {
							return \App\User::bySchool($scSlug)->findOrFail($id);
						}
						return \App\User::bySchool($scSlug)->get();
					},
					'as' => 'user'
				]);

				Route::delete('/user/{mail}', [
					'uses' => function($scSlug, $mail) {
						return \App\User::bySchool($scSlug)->byMail($mail);
					},
					'as' => 'user'
				]);

				Route::delete('/video/{id}', [
					'uses' => function($scSlug, $id=null) {
						if (!is_null($id)) {
							return \App\Video::bySchool($scSlug)->findOrFail($id);
						}
						return \App\Video::bySchool($scSlug)->get();
					},
					'as' => 'video'
				]);

				Route::delete('/video/{code}', [
					'uses' => function($scSlug, $code) {
						return \App\Video::bySchool($scSlug)->byCode($code);
					},
					'as' => 'video'
				]);
			});
		});

		
		Route::delete('/user/{id}', [
			'uses' => function($id=null) {
				if (!is_null($id)) {
					return \App\User::find($id);
				}
				return \App\User::all();
			},
			'as' => 'user'
		]);

		Route::delete('/user/{mail}', [
			'uses' => function($mail) {
				return \App\User::byMail($mail);
			},
			'as' => 'user'
		]);


		Route::delete('/video/{id}', [
			'uses' => function($id=null) {
				if (!is_null($id)) {
					return \App\Video::find($id);
				}
				return \App\Video::all();
			},
			'as' => 'video'
		]);

		Route::delete('/video/{code}', [
			'uses' => function($code) {
				return \App\Video::byCode($code);
			},
			'as' => 'video'
		]);
	});
*/
});