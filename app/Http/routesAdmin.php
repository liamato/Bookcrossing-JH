<?php

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
 *              news/                   -> Show News
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
 *              {id|slug}               -> Dump School
 *              add                     -> Add School
 *              {id|slug}/edit          -> Edit School by id or slug
 *              {id|slug}/remove        -> Remove School by id or slug
 *              {id|slug}/users/        -> Show Users by id or slug
 *                  add                 -> Add User
 *                  edit/{id}           -> Edit User by id
 *                  remove/{id}         -> Remove User by id
 *      loguin                          -> Loguin user
 *      logout                          -> Logout user
 */

Route::group(['namespace' => 'Admin', 'middleware' => ['school', 'auth']], function() {

    Route::group(['prefix' => '{school}/admin', 'as' => 'Admin.'], function() {
        Route::get('/', [
            'uses' => 'Admin@index',
            'as' => 'index'
        ]);

        Route::group(['prefix' => 'book', 'as' => 'book.'], function() {
            Route::get('/', [
                'uses' => 'AdminBook@index',
                'as' => 'index'
            ]);

            /*Route::get('add', [
                'uses' => 'AdminBook@add',
                'as' => 'add'
            ]);*/

            Route::post('add', [
                'uses' => 'AdminBook@store',
                'as' => 'add'
            ]);

            Route::group(['prefix' => '{book}'], function() {
                /*Route::get('/', [
                    'uses' => 'AdminBook@dump',
                    'as' => 'dump'
                ]);*/

                Route::get('edit', [
                    'uses' => 'AdminBook@edit',
                    'as' => 'edit'
                ]);

                Route::put('edit', [
                    'uses' => 'AdminBook@update',
                    'as' => 'edit'
                ]);

                Route::delete('remove', [
                    'uses' => 'AdminBook@remove',
                    'as' => 'remove'
                ]);

                Route::put('verify', [
                    'uses' => 'AdminBook@verify',
                    'as' => 'verify'
                ]);

                Route::put('liberate', [
                    'uses' => 'AdminBook@liberate',
                    'as' => 'liberate'
                ]);

                Route::put('capture', [
                    'uses' => 'AdminBook@capture',
                    'as' => 'capture'
                ]);
            });
        });

        Route::group(['prefix' => 'category', 'as' => 'category.'], function() {
            Route::get('/', [
                'uses' => 'AdminCategory@index',
                'as' => 'index'
            ]);

            /*Route::get('add', [
                'uses' => 'AdminCategory@add',
                'as' => 'add'
            ]);*/

            Route::post('add', [
                'uses' => 'AdminCategory@store',
                'as' => 'add'
            ]);

            Route::get('move', [
                'uses' => 'AdminCategory@move',
                'as' => 'move'
            ]);

            Route::put('move', [
                'uses' => 'AdminCategory@change',
                'as' => 'move'
            ]);

            Route::group(['prefix' => '{category}'], function() {
                /*Route::get('/', [
                    'uses' => 'AdminCategory@dump',
                    'as' => 'dump'
                ]);*/

                Route::get('edit', [
                    'uses' => 'AdminCategory@edit',
                    'as' => 'edit'
                ]);

                Route::put('edit', [
                    'uses' => 'AdminCategory@update',
                    'as' => 'edit'
                ]);

                Route::delete('remove', [
                    'uses' => 'AdminCategory@remove',
                    'as' => 'remove'
                ]);
            });
        });

        Route::group(['prefix' => 'post', 'as' => 'post.'], function() {
            Route::get('/', [
                'uses' => 'AdminPost@index',
                'as' => 'index'
            ]);

            /*Route::get('add', [
                'uses' => 'AdminPost@add',
                'as' => 'add'
            ]);*/

            Route::post('add', [
                'uses' => 'AdminPost@store',
                'as' => 'add'
            ]);

            Route::group(['prefix' => '{post}'], function() {
                /*Route::get('/', [
                    'uses' => 'AdminPost@dump',
                    'as' => 'dump'
                ]);*/

                Route::get('edit', [
                    'uses' => 'AdminPost@edit',
                    'as' => 'edit'
                ]);

                Route::put('edit', [
                    'uses' => 'AdminPost@update',
                    'as' => 'edit'
                ]);

                Route::delete('remove', [
                    'uses' => 'AdminPost@remove',
                    'as' => 'remove'
                ]);

                Route::put('verify', [
                    'uses' => 'AdminPost@verify',
                    'as' => 'verify'
                ]);
            });
        });

        Route::group(['prefix' => 'news', 'as' => 'news.'], function() {
            Route::get('/', [
                'uses' => 'AdminReport@index',
                'as' => 'index'
            ]);

            /*Route::get('add', [
                'uses' => 'AdminReport@add',
                'as' => 'add'
            ]);*/

            Route::post('add', [
                'uses' => 'AdminReport@store',
                'as' => 'add'
            ]);

            Route::group(['prefix' => '{news}'], function() {
                /*Route::get('/', [
                    'uses' => 'AdminReport@dump',
                    'as' => 'dump'
                ]);*/

                Route::get('edit', [
                    'uses' => 'AdminReport@edit',
                    'as' => 'edit'
                ]);

                Route::put('edit', [
                    'uses' => 'AdminReport@update',
                    'as' => 'edit'
                ]);

                Route::delete('remove', [
                    'uses' => 'AdminReport@remove',
                    'as' => 'remove'
                ]);
            });
        });

        Route::group(['prefix' => 'school', 'as' => 'school.'], function() {
            /*Route::get('/', [
                'uses' => 'AdminSchool@index',
                'as' => 'index'
            ]);*/

            Route::get('edit', [
                'uses' => 'AdminSchool@edit',
                'as' => 'edit'
            ]);

            Route::put('edit', [
                'uses' => 'AdminSchool@update',
                'as' => 'edit'
            ]);
        });

        Route::group(['prefix' => 'user', 'as' => 'user.'], function() {
            Route::get('/', [
                'uses' => 'AdminUser@index',
                'as' => 'index'
            ]);

            /*Route::get('add', [
                'uses' => 'AdminUser@add',
                'as' => 'add'
            ]);*/

            Route::post('add', [
                'uses' => 'AdminUser@store',
                'as' => 'add'
            ]);

            Route::group(['prefix' => '{user}'], function() {
                /*Route::get('/', [
                    'uses' => 'AdminUser@dump',
                    'as' => 'dump'
                ]);*/

                Route::get('edit', [
                    'uses' => 'AdminUser@edit',
                    'as' => 'edit'
                ]);

                Route::put('edit', [
                    'uses' => 'AdminUser@update',
                    'as' => 'edit'
                ]);

                Route::delete('remove', [
                    'uses' => 'AdminUser@remove',
                    'as' => 'remove'
                ]);
            });
        });

        Route::group(['prefix' => 'profile', 'as' => 'profile.'], function() {
            Route::get('/', [
                'uses' => 'AdminUser@index',
                'as' => 'index'
            ]);

            /*Route::get('edit', [
                'uses' => 'AdminUser@edit',
                'as' => 'edit'
            ]);*/

            Route::put('edit', [
                'uses' => 'AdminUser@update',
                'as' => 'edit'
            ]);

            Route::delete('remove', [
                'uses' => 'AdminUser@remove',
                'as' => 'remove'
            ]);
        });

        Route::group(['prefix' => 'video', 'as' => 'video.'], function() {
            Route::get('/', [
                'uses' => 'AdminVideo@index',
                'as' => 'index'
            ]);

            /*Route::get('add', [
                'uses' => 'AdminVideo@add',
                'as' => 'add'
            ]);*/

            Route::post('add', [
                'uses' => 'AdminVideo@store',
                'as' => 'add'
            ]);

            Route::get('move', [
                'uses' => 'AdminVideo@move',
                'as' => 'move'
            ]);

            Route::put('move', [
                'uses' => 'AdminVideo@change',
                'as' => 'move'
            ]);

            Route::group(['prefix' => '{video}'], function() {
                /*Route::get('/', [
                    'uses' => 'AdminVideo@dump',
                    'as' => 'dump'
                ]);*/

                Route::get('edit', [
                    'uses' => 'AdminVideo@edit',
                    'as' => 'edit'
                ]);

                Route::put('edit', [
                    'uses' => 'AdminVideo@update',
                    'as' => 'edit'
                ]);

                Route::delete('remove', [
                    'uses' => 'AdminVideo@remove',
                    'as' => 'remove'
                ]);

                Route::put('verify', [
                    'uses' => 'AdminVideo@verify',
                    'as' => 'verify'
                ]);
            });
        });
    });

    Route::group(['prefix' => '/admin', 'as' => 'SuperAdmin.', 'namespace' => 'SuperAdmin'], function() {
        Route::get('/', [
            'uses' => 'SuperAdmin@index',
            'as' => 'index'
        ]);

        /*Route::get('add', [
            'uses' => 'SuperAdmin@add',
            'as' => 'add'
        ]);*/

        Route::post('add', [
            'uses' => 'SuperAdmin@add',
            'as' => 'add'
        ]);

        Route::group(['prefix' => '{id}'], function() {
            /*Route::get('/', [
                'uses' => 'SuperAdmin@dump',
                'as' => 'dump'
            ]);*/

            Route::get('edit', [
                'uses' => 'SuperAdmin@edit',
                'as' => 'edit'
            ]);

            Route::put('edit', [
                'uses' => 'SuperAdmin@update',
                'as' => 'edit'
            ]);

            Route::delete('remove', [
                'uses' => 'SuperAdmin@remove',
                'as' => 'remove'
            ]);
        });

        Route::group(['prefix' => 'school', 'as' => 'school.'], function() {
            Route::get('/', [
                'uses' => 'SuperAdminSchool@index',
                'as' => 'index'
            ]);

            /*Route::get('add', [
                'uses' => 'SuperAdminSchool@add',
                'as' => 'add'
            ]);*/

            Route::post('add', [
                'uses' => 'SuperAdminSchool@store',
                'as' => 'add'
            ]);

            Route::group(['prefix' => '{school}'], function() {

                /*Route::get('/', [
                    'uses' => 'SuperAdminSchool@dump',
                    'as' => 'dump'
                ]);*/

                Route::get('edit', [
                    'uses' => 'SuperAdminSchool@edit',
                    'as' => 'edit'
                ]);

                Route::put('edit', [
                    'uses' => 'SuperAdminSchool@update',
                    'as' => 'edit'
                ]);

                Route::delete('remove', [
                    'uses' => 'SuperAdminSchool@remove',
                    'as' => 'remove'
                ]);

                Route::group(['prefix' => 'user', 'as' => 'user.'], function() {

                    Route::get('/', [
                        'uses' => 'SuperAdminUser@index',
                        'as' => 'index'
                    ]);

                    /*Route::get('add', [
                        'uses' => 'SuperAdminUser@add',
                        'as' => 'add'
                    ]);*/

                    Route::post('add', [
                        'uses' => 'SuperAdminUser@store',
                        'as' => 'add'
                    ]);

                    Route::group(['prefix' => '{user}'], function() {

                        /*Route::get('/', [
                            'uses' => 'SuperAdminUser@dump',
                            'as' => 'dump'
                        ]);*/

                        Route::get('edit', [
                            'uses' => 'SuperAdminUser@edit',
                            'as' => 'edit'
                        ]);

                        Route::put('edit', [
                            'uses' => 'SuperAdminUser@update',
                            'as' => 'edit'
                        ]);

                        Route::delete('remove', [
                            'uses' => 'SuperAdminUser@remove',
                            'as' => 'remove'
                        ]);
                    });
                });
            });
        });
    });
});



Route::get('login', [
    'uses' => 'Auth\AuthController@getLogin',
    'as' => 'login'
]);
Route::post('login', [
    'uses' => 'Auth\AuthController@postLogin',
    'as' => 'login'
]);
Route::get('logout', [
    'uses' => 'Auth\AuthController@getLogout',
    'as' => 'logout'
]);
