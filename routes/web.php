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



Route::middleware(['auth'])->prefix('admin')->namespace('Admin')->group(function(){
    Route::get('/', 'AdminController@index')->name('admin');

    foreach(array('article', 'tag', 'category', 'user', 'role', 'permission') as $path){
        Route::resource($path, ucfirst($path).'Controller', ['except' => ['index'], 'as' => 'admin']);
        Route::get(str_plural($path).'/{from}/{amount}', ucfirst($path).'Controller@list')->name('admin.'.str_plural($path).'.list');
    }
});



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


foreach(array('github', 'facebook', 'google') as $provider) {
    Route::namespace('Auth')->prefix('auth')->group(function() use ($provider){
        Route::get($provider, 'SocialiteLoginController@redirectTo'.ucfirst($provider).'Auth')
            ->name('auth.'.$provider);
        Route::get($provider.'/callback', 'SocialiteLoginController@handle'.ucfirst($provider).'Callback')
            ->name('auth.'.$provider.'.callback');
    });
}
