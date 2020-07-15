<?php

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

Auth::routes();
Route::get('/', 'AppController@index')->name('home');

Route::group(['middleware' => ['auth']], function () {
    Route::resource('user', 'UserController')->only(['index', 'store', 'update', 'destroy']);
    Route::resource('client', 'ClientController')->only(['index', 'store', 'update', 'destroy']);
    Route::resource('service', 'ServiceController')->only(['index', 'store', 'update', 'destroy']);
    Route::resource('feature', 'FeatureController')->only(['index', 'store', 'update', 'destroy']);
    Route::post('upload', 'AttachmentController@upload');
});


Route::get('/admin', 'AppController@admin')->where('any', '.*');
