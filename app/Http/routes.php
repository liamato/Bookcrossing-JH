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

/**
 * :-------------------------------------------------------------------:
 * : Admin Routes                                                      :
 * :-------------------------------------------------------------------:
 *
 *  /                                   -> Select School
 *      {school}/                       -> PerSchool
 *          admin/                      -> School Admin
 *              book/                   -> Show Books
 *                  add                 -> Add Book
 *                  edit/{id}           -> Edit Book by id
 *                  remove/{id}         -> Remove Book by id
 *                  verify/{id}         -> Verify Book by id
 *                  liberate/{id}       -> Liberate Book by id
 *                  capture/{id}        -> Capture Book by id
 *              category/               -> Show Categories
 *                  add                 -> Add Category
 *                  edit/{id|slug}      -> Edit Category by id or slug
 *                  remove/{id|slug}    -> Remove Category by id or slug
 *                  move                -> Move Posts between Categories
 *              post/                   -> Show Posts
 *                  add                 -> Add Post
 *                  edit/{id}           -> Edit Post
 *                  verify/{id}         -> Verify Post
 *                  remove/{id}         -> Remove Post
 *              new/                    -> Show News
 *                  add                 -> Add New
 *                  edit/{id}           -> Edit New
 *                  remove/{id}         -> Remove New
 *              school/                 -> Descrive School
 *                  edit                -> Edit School
 *              user/                   -> Show Users
 *                  add                 -> Add User
 *                  edit/{id}           -> Edit User by id
 *                  remove/{id}         -> Remove User by id
 *              profile/                -> Show self User
 *                  edit                -> Edit self User
 *                  remove              -> Remove self User
 *              video/                  -> Show Videos
 *                  add                 -> Add Video
 *                  edit/{id}           -> Edit Video
 *                  verify/{id}         -> Verify Video
 *                  remove/{id}         -> Remove Video
 *                  move                -> Move Videos between BookTrailer and Booktube
 *      admin/                          -> Show SuperAdmins
 *          add                         -> Add SuperAdmin
 *          edit/{id}                   -> Edit SuperAdmin by id
 *          remove/{id}                 -> Remove SuperAdmin by id
 *          school/                     -> Show Schools
 *              add                     -> Add School
 *              {id|slug}/edit          -> Edit School by id or slug
 *              {id|slug}/remove        -> Remove School by id or slug
 *              {id|slug}/users/        -> Show Users by id or slug
 *                  add                 -> Add User
 *                  edit/{id}           -> Edit User by id
 *                  remove/{id}         -> Remove User by id
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
