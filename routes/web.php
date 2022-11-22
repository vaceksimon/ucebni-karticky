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

Route::get('/profile/{id?}', [App\Http\Controllers\ProfileController::class, 'index'])->name('profile');
Route::get('/profile/edit', [App\Http\Controllers\ProfileController::class, 'edit'])->name('profile.edit');

Route::get('/test', function () {
    return view('test');
})->name('test');

Route::get('/mygroups', function () {
    return view('groups.mygroups');
})->name('mygroups');

Route::get('/myexercises', function () {
    return view('exercises.myexercises');
})->name('myexercises');

Route::get('/create-group', function () {
    return view('create-group');
})->name('create-group');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/dbconn', function () {
    return view('dbconn');
});
