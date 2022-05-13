<?php

use UniSharp\LaravelFilemanager\Lfm;
use Illuminate\Support\Facades\Route;

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

Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    Lfm::routes();
});

Route::prefix('auth')->group(function () {
    Route::get('login', 'AuthController@login_form')->name('auth.login_form');
    Route::post('login', 'AuthController@do_login')->name('auth.do_login');
    Route::post('logout', 'AuthController@do_logout')->name('auth.do_logout');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', 'HomeController@index')->name('home.index');
    Route::prefix('users')->group(function () {
        Route::get('/', 'UserController@index')->name('users.index');
        Route::get('/create', 'UserController@create')->name('users.create');
        Route::get('/edit/{id}', 'UserController@edit')->name('users.edit');
        Route::post('/update/{id}', 'UserController@update')->name('users.update');
        Route::post('/store', 'UserController@store')->name('users.store');
        Route::post('/delete/{id}', 'UserController@delete')->name('users.delete');
    });

    Route::resource('news', 'NewsController');
    Route::resource('contents', 'ContentController');
    Route::resource('services', 'ServiceController');
    Route::resource('classifies', 'ClassifyController');
    Route::resource('inboxes', 'InboxController');
    Route::prefix('inboxes')->group(function () {
        Route::get('/{inbox}/dispose', 'InboxController@dispose')->name('inboxes.dispose');
        Route::get('/{inbox}/dispose/create', 'InboxController@dispose_create')->name('inboxes.dispose.create');
        Route::post('/{inbox}/dispose/create', 'InboxController@dispose_store')->name('inboxes.dispose.store');
        Route::get('/{inbox}/dispose/{dispose}/edit', 'InboxController@dispose_edit')->name('inboxes.dispose.edit');
        Route::post('/dispose/{dispose}/update', 'InboxController@dispose_update')->name('inboxes.dispose.update');
        Route::post('/dispose/{dispose}/destroy', 'InboxController@dispose_destroy')->name('inboxes.dispose.destroy');
    });
    Route::resource('outboxes', 'OutboxController');
    Route::prefix('e-filling')->group(function () {
        Route::get('/', 'EfillingController@index')->name('efilling.index');
        Route::post('/approval', 'EfillingController@approval')->name('efilling.approval');
    });
});