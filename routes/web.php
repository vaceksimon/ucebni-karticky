<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!rostředky pro správu sít
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test', function () {
    return view('test');
})->name('test');

Route::get('mygroups', [\App\Http\Controllers\Groups\GroupController::class, 'show' ])->name('mygroups');
Route::post('mygroups/clickEdit', [\App\Http\Controllers\Groups\GroupController::class, 'clickEdit' ])->name('mygroups.clickEdit');
Route::post('mygroups/clickShow', [\App\Http\Controllers\Groups\GroupController::class, 'clickShow' ])->name('mygroups.clickShow');

Route::get('create-group', function () {
    return view('create-group');
})->name('create-group');

Route::get('/myexercises', function () {
    return view('exercises.myexercises');
})->name('myexercises');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/dbconn', function(){
   return view('dbconn');
});
