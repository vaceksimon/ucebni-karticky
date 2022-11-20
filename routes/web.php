<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ImageUploadController;

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

Route::get('/mygroups', function () {
    return view('groups.mygroups');
})->name('mygroups');

Route::get('/myexercises', function () {
    return view('exercises.myexercises');
})->name('myexercises');
/*
Route::get('/create-group', function () {
    return view('create-group.create-group');
})->name('create-group');
*/
//Route::get('/create-group', [App\Http\Controllers\CreateGroupController::class, 'index'])->name('create-group');

/* Search user in create group */
//Route::post('search/user/list', [App\Http\Controllers\CreateGroupController::class, 'searchUser'])->name('search/user/list');

Route::get('/create-group', [App\Http\Controllers\CreateGroupController::class, 'index'])->name('create-group');
Route::post('/create-group/search', [App\Http\Controllers\CreateGroupController::class, 'search'])->name('create-group.search');
//Route::get('/create-group/search', 'App\Http\Controllers\CreateGroupController@search');

//Route::get('/create-group', 'SearchController@index');
//Route::get('/users/simple', 'SearchController@simple')->name('simple_search');
//Route::get('/users/advance', 'SearchController@advance')->name('advance_search');

Route::get('image-upload', [ ImageUploadController::class, 'imageUpload' ])->name('image.upload');

Route::post('image-upload', [ ImageUploadController::class, 'imageUploadPost' ])->name('image.upload.post');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/dbconn', function(){
   return view('dbconn');
});
