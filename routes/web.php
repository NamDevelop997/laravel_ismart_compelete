<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes(['verify' => true]);

// bắt buộc người dùng phải xác nhận email khi đăng kí thì mới vào được trang home
Route::get('/', 'HomeController@index')->name('home');// ->middleware(['verified']);

Route::get('/product', 'ProductController@index')->name('product');
Route::get('/post', 'PostController@index')->name('post');
Route::get('/contact', 'ContactController@index')->name('contact');


// Route::get('/dashboard', 'AdmintratorController@show')->name('dashboard')->middleware('auth', 'checkRole');
// Route::get('/dashboard/user/list', 'UserController@show')->name('users.list')->middleware('auth', 'checkRole');

// Route::get('/dashboard/user/add', 'UserController@add')->name('users.add')->middleware('auth', 'checkRole');
// Route::post('/dashboard/user/store', 'UserController@store')->name('users.store')->middleware('auth', 'checkRole');


Route::middleware(['auth', 'checkRole'])->group(function () {
    Route::prefix('dashboard')->group(function () {
        Route::get('/', 'AdmintratorController@show')->name('dashboard');

        // route users manager 
        Route::get('user/list', 'UserController@show')->name('users.list');
        Route::get('user/add', 'UserController@add')->name('users.add');
        Route::post('user/store', 'UserController@store')->name('users.store');

        Route::get('user/edit/{id}', 'UserController@edit')->name('user.edit');
        Route::post('user/update/{id}', 'UserController@update')->name('user.update');

        Route::get('user/delete/{id}', 'UserController@delete')->name('user.delete');
        Route::get('user/action', 'UserController@action')->name('users.action');
        // end route users manager 

        // route products manager
        Route::get('product/list', 'ProductController@show')->name('products.list');
        Route::get('product/add', 'ProductController@add')->name('products.add');
        Route::post('product/store', 'ProductController@store')->name('products.store');

        Route::get('product/edit/{id}', 'ProductController@edit')->name('product.edit');
        Route::post('product/update/{id}', 'ProductController@update')->name('product.update');

        Route::get('product/delete/{id}', 'ProductController@delete')->name('product.delete');
        Route::get('product/action', 'ProductController@action')->name('product.action');
        // end route product manager 


        // route posts manager
        Route::get('post/list', 'PostController@show')->name('posts.list');
        Route::get('post/add', 'PostController@create')->name('posts.add');
        Route::post('post/store', 'PostController@store')->name('posts.store');

        Route::get('post/edit/{id}', 'PostController@edit')->name('posts.edit');
        Route::post('post/update/{id}', 'PostController@update')->name('posts.update');

        Route::get('post/delete/{id}', 'PostController@destroy')->name('post.delete');
        Route::get('post/action', 'PostController@action')->name('post.action');
        // end route posts manager 
    });
});

// Route::get('/', 'guestController@product');
Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});
