<?php

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
Route::get('/', 'App\Http\Controllers\BlogController@index')->name('welcome');
Route::get('/register', 'App\Http\Controllers\BlogController@register')->name('register');
Route::post('/register/save', 'App\Http\Controllers\BlogController@registerSave')->name('register.save');
Route::get('/login', 'App\Http\Controllers\BlogController@login')->name('login');

Route::prefix('blog')->namespace('App\Http\Controllers')->name('blog.')->group(function () {

    Route::get('/show/{slug}-{id}', 'BlogController@show')
    ->where(['id'=>'[0-9]+', 'slug'=>'[a-z0-9-]+'])
    ->name('show');

    Route::get('/categories', 'BlogController@categories')->name('categories');

    Route::get('/categories/show/{id}', 'BlogController@showCategory')->name('show.category');
});
// Mise en place des routes pour l'administration du site
Route::prefix('admin')->namespace('App\Http\Controllers')->name('admin.')->group(function () {
    Route::get('/posts', 'PostController@index')->name('post.index');
    Route::get('/posts/create', 'PostController@create')->name('post.create');
    Route::post('/posts/store', 'PostController@store')->name('post.store');
    Route::get('/posts/edit/{id}', 'PostController@edit')->name('post.edit');
    Route::get('/posts/view/{id}', 'PostController@view')->name('post.view');
    Route::put('/posts/update/{id}', 'PostController@update')->name('post.update');
    Route::delete('/posts/delete/{id}', 'PostController@delete')->name('post.delete');   
});

Route::prefix('admin')->name('admin.')->group(function(){

    //Get Categories datas
    Route::get('/categories', 'App\Http\Controllers\CategoryController@index')->name('category.index');

    //Show Category by Id
    Route::get('/categories/show/{id}', 'App\Http\Controllers\CategoryController@show')->name('category.show');

    //Get Categories by Id
    Route::get('/categories/create', 'App\Http\Controllers\CategoryController@create')->name('category.create');

    //Edit Category by Id
    Route::get('/categories/edit/{id}', 'App\Http\Controllers\CategoryController@edit')->name('category.edit');

    //Save new Category
    Route::post('/categories/store', 'App\Http\Controllers\CategoryController@store')->name('category.store');

    //Update One Category
    Route::put('/categories/update/{category}', 'App\Http\Controllers\CategoryController@update')->name('category.update');

    //Update One Category Speedly
    Route::put('/categories/speed/{category}', 'App\Http\Controllers\CategoryController@updateSpeed')->name('category.update.speed');

    //Delete Category
    Route::delete('/categories/delete/{category}', 'App\Http\Controllers\CategoryController@delete')->name('category.delete');

});
Route::prefix('admin')->name('admin.')->group(function(){

    //Get Users datas
    Route::get('/users', 'App\Http\Controllers\UserController@index')->name('user.index');

    //Show User by Id
    Route::get('/users/show/{id}', 'App\Http\Controllers\UserController@show')->name('user.show');

    //Get Users by Id
    Route::get('/users/create', 'App\Http\Controllers\UserController@create')->name('user.create');

    //Edit User by Id
    Route::get('/users/edit/{id}', 'App\Http\Controllers\UserController@edit')->name('user.edit');

    //Save new User
    Route::post('/users/store', 'App\Http\Controllers\UserController@store')->name('user.store');

    //Update One User
    Route::put('/users/update/{user}', 'App\Http\Controllers\UserController@update')->name('user.update');

    //Update One User Speedly
    Route::put('/users/speed/{user}', 'App\Http\Controllers\UserController@updateSpeed')->name('user.update.speed');

    //Delete User
    Route::delete('/users/delete/{user}', 'App\Http\Controllers\UserController@delete')->name('user.delete');

});