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

Route::get('/profile/edit', [App\Http\Controllers\ProfileController::class, 'edit'])->name('profile.edit');
Route::post('/profile/store', [App\Http\Controllers\ProfileController::class, 'store'])->name('profile.store');
Route::get('/profile/{id?}', [App\Http\Controllers\ProfileController::class, 'index'])->name('profile');

Route::get('/test', function () {
    return view('test');
})->name('test');

Route::get('mygroups', [\App\Http\Controllers\Groups\GroupController::class, 'show' ])->name('mygroups');
Route::post('mygroups/clickEdit', [\App\Http\Controllers\Groups\GroupController::class, 'clickEdit' ])->name('mygroups.clickEdit');
Route::post('mygroups/clickShow', [\App\Http\Controllers\Groups\GroupController::class, 'clickShow' ])->name('mygroups.clickShow');

Route::get('create-group', function () {
    return view('create-group');
})->name('create-group');

Route::get('myexercises', [\App\Http\Controllers\Exercises\ExerciseController::class, 'show'])->name('myexercises');

Route::get('/edit-group', [App\Http\Controllers\EditGroupController::class, 'index'])->name('edit-group');
Route::post('/edit-group/search', [App\Http\Controllers\EditGroupController::class, 'search'])->name('edit-group.search');
Route::post('/edit-group/remove-member', [App\Http\Controllers\EditGroupController::class, 'removeMember'])->name('edit-group.remove-member');
Route::post('/edit-group/add-member', [App\Http\Controllers\EditGroupController::class, 'addMember'])->name('edit-group.add-member');


Route::get('/show-group', [App\Http\Controllers\Groups\ShowGroupController::class, 'index'])->name('show-group');

Route::post('edit-group', [App\Http\Controllers\EditGroupController::class, 'store'])->name('edit-group.store');

Route::get('/exercise-administration', [App\Http\Controllers\Administration\ExerciseAdministrationController::class, 'index'])->name('exercise-administration');
//Route::post('/group-administration/search', [App\Http\Controllers\Administration\GroupAdministrationController::class, 'search'])->name('group-administration.search');
//Route::post('/group-administration/remove-group', [App\Http\Controllers\Administration\GroupAdministrationController::class, 'removeGroup'])->name('group-administration.remove-group');
//Route::get('/group-administration/redirect-to-group', [App\Http\Controllers\Administration\GroupAdministrationController::class, 'redirectToGroup'])->name('group-administration.redirect-to-group');

Route::get('image-upload', [ ImageUploadController::class, 'imageUpload' ])->name('image.upload');
Route::post('image-upload', [ ImageUploadController::class, 'imageUploadPost' ])->name('image.upload.post');


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/dbconn', function () {
    return view('dbconn');
});
