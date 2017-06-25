<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('article', 'ArticleController@index');



Route::middleware(['auth'])->prefix('admin')->group(function(){
    Route::get('/', 'Admin\AdminController@index')->name('admin');

    Route::resource('article', 'Admin\ArticleController')->except('index');
    Route::resource('tag', 'Admin\TagController');
    Route::resource('category', 'Admin\CategoryController');
    Route::resource('user', 'Admin\UserController');
    Route::resource('role', 'Admin\RoleController');
    Route::resource('permission', 'Admin\PermissionController');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


foreach(array('github', 'facebook', 'google') as $provider) {
    Route::get('auth/'.$provider, 'Auth\SocialiteLoginController@redirectTo'.ucfirst($provider).'Auth')
        ->name($provider.'.auth');
    Route::get('auth/'.$provider.'/callback', 'Auth\SocialiteLoginController@handle'.ucfirst($provider).'Callback')
        ->name($provider.'.auth.callback');
}
