<?php

use App\Http\Middleware\Authenticate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
/**
 * GET | POST | PUT | DELETE
 */
Route::get('/', 'App\Http\Controllers\BlogController@index')->name('welcome'); //->middleware('auth');
Route::get('/register', 'App\Http\Controllers\BlogController@register')->name('register')->middleware('guest');
Route::post('/register/save', 'App\Http\Controllers\BlogController@registerSave')->name('register.save');
Route::get('/login', 'App\Http\Controllers\BlogController@login')->name('login')->middleware('guest');
Route::post('/login/authenticate', 'App\Http\Controllers\BlogController@authenticate')->name('login.authenticate');
Route::delete('/logout', 'App\Http\Controllers\BlogController@logout')->name('logout');

Route::prefix('blog')->namespace('App\Http\Controllers')->name('blog.')->group(function () {

    Route::get('/show/{slug}-{id}', 'BlogController@show')
    ->where(['id'=>'[0-9]+', 'slug'=>'[a-z0-9-]+'])
    ->name('show');

    Route::get('/categories', 'BlogController@categories')->name('categories');

    Route::get('/categories/show/{id}', 'BlogController@showCategory')->name('show.category');
});

Route::prefix('admin')->name('admin.')->middleware('admin')->namespace('App\Http\Controllers')->group(function(){
    // Routes des postes
    Route::get('/posts', 'PostController@index')->name('post.index');
    Route::get('/posts/create', 'PostController@create')->name('post.create');
    Route::post('/posts/store', 'PostController@store')->name('post.store');
    Route::get('/posts/edit/{id}', 'PostController@edit')->name('post.edit');
    Route::get('/posts/view/{id}', 'PostController@view')->name('post.view');
    Route::put('/posts/update/{id}', 'PostController@update')->name('post.update');
    Route::delete('/posts/delete/{id}', 'PostController@delete')->name('post.delete'); 

    // Routes des catégories
    Route::get('/categories', 'CategoryController@index')->name('category.index');
    Route::get('/categories/show/{id}', 'CategoryController@show')->name('category.show');
    Route::get('/categories/create', 'CategoryController@create')->name('category.create');
    Route::get('/categories/edit/{id}', 'CategoryController@edit')->name('category.edit');
    Route::post('/categories/store', 'CategoryController@store')->name('category.store');
    Route::put('/categories/update/{category}', 'CategoryController@update')->name('category.update');
    Route::put('/categories/speed/{category}', 'CategoryController@updateSpeed')->name('category.update.speed');
    Route::delete('/categories/delete/{category}', 'CategoryController@delete')->name('category.delete');

    //Routes des utilisateurs
     Route::get('/users', 'UserController@index')->name('user.index');
     Route::get('/users/show/{id}', 'UserController@show')->name('user.show');
     Route::get('/users/create', 'UserController@create')->name('user.create');
     Route::get('/users/edit/{id}', 'UserController@edit')->name('user.edit');
     Route::post('/users/store', 'UserController@store')->name('user.store');
     Route::put('/users/update/{user}', 'UserController@update')->name('user.update');
     Route::put('/users/speed/{user}', 'UserController@updateSpeed')->name('user.update.speed');
     Route::delete('/users/delete/{user}', 'UserController@delete')->name('user.delete');

});

