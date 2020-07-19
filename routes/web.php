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

Route::get('/', function () {
    return view('welcome');
});


Route::get('/users', 'UsersController@index');
Route::post('/users', 'UsersController@create');

Auth::routes();


Route::get('/admin/{any?}', function () {
    return Auth::check() ? view('admin') : redirect('login/');
})->where('any', '.*');



Route::group([
    'prefix'     => '/api',
    'namespace'  => '\App\Http\Controllers\Admin',
    'middleware' => 'auth'
], function () {

	Route::resource('movies', 'MovieController');

});