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

Route::get('/language/{vi}', function ($locale) {
    if (in_array($locale, \Config::get('app.locales'))) {
        App::setLocale($locale);
        Session::put('locale', $locale);
    }
    return redirect('/home');
});
Route::get('/', function () {
    $aplication_name ="truong";
    return view('welcome',['aplication_name'=>$aplication_name ]);
});
Route::get('/test', 'ExportTemplate@index');
Route::post('/test/create', 'ExportTemplate@create');
Route::post('/test/repace', 'ExportTemplate@store');
Route::get('/test/delete/{key}', 'ExportTemplate@delete');

Route::get('/', function () {
    return view('layouts.app');
});


Route::prefix('admin')->group(function() {
    Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
    Route::get('/home', 'AdminController@index')->name('admin.home');
    Route::get('/reset-password', 'AdminController@index')->name('admin.password.request');
    Route::get('/register', 'Auth\RegisterController@showRegistrationForm')->name('admin.register');
    Route::get('/register', 'Auth\RegisterController@register')->name('admin.register.submit');
    Route::post('/logout', 'Auth\AdminLoginController@logout')->name('admin.logout');

});


Route::namespace('Admin')->group(function () {
    Route::prefix('admin')->group(function () {\
    //catelogries
        Route::get('/categories/', 'NewsCategories@getList');
        Route::get('/categories/find/{id}', 'NewsCategories@getFind');
        Route::get('/categories/create', 'NewsCategories@getCreate');
        Route::post('/categories/create', 'NewsCategories@postCreate');
        Route::get('/categories/update/{id}', 'NewsCategories@getUpdate');
        Route::put('/categories/update/{id}', 'NewsCategories@postUpdate');
        Route::get('/categories/allTrash', 'NewsCategories@getAllTrash');
        Route::get('/categories/trash/{id}', 'NewsCategories@getTrash');
        Route::get('/categories/recover/{id}', 'NewsCategories@getRecover');
        Route::get('/categories/delete/{id}', 'NewsCategories@getDelete');

        //resources
        Route::get('/resources/', 'Resources@getList');
        Route::get('/resources/find/{id}', 'Resources@getFind');
        Route::get('/resources/create', 'Resources@getCreate');
        Route::post('/resources/create', 'Resources@postCreate');
        Route::get('/resources/update/{id}', 'Resources@getUpdate');
        Route::put('/resources/update/{id}', 'Resources@postUpdate');
        Route::get('/resources/allTrash', 'Resources@getAllTrash');
        Route::get('/resources/trash/{id}', 'Resources@getTrash');
        Route::get('/resources/recover/{id}', 'Resources@getRecover');
        Route::get('/resources/delete/{id}', 'Resources@getDelete');
    });
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
