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

Route::get('/{school?}/{b?}/{c?}/{d?}/{e?}', function () {
    return view('test.react', ['schools' => \App\School::all(), 'translations' => collect(['ca' => Lang::get('frontend', [], 'ca'), 'es' => Lang::get('frontend', [], 'es'), 'en' => Lang::get('frontend', [], 'en') ])]);
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
