<?php

use App\Http\Controllers\ImageUploadController;
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


Route::get('flashcard/{id}', [\App\Http\Controllers\Flashcards\FlashcardController::class, 'show'])->name('flashcard.show');
Route::post('flashcard', [\App\Http\Controllers\Flashcards\FlashcardController::class, 'getCards'])->name('flashcard.get-cards');

Route::get('flashcardPractise/{id}', [\App\Http\Controllers\Flashcards\FlashcardPractiseController::class, 'show'])->name('flashcardPractise.show');

Route::post('attempt', [\App\Http\Controllers\Attempts\AttemptController::class, 'saveAttempt'])->name('attempt.save-attempt');

Route::get('myexercises', [\App\Http\Controllers\Exercises\ExerciseController::class, 'show'])->name('myexercises');
Route::post('/myexercises/share', [App\Http\Controllers\Exercises\ExerciseController::class, 'share'])->name('myexercises.share');
Route::post('/myexercises/store-share', [App\Http\Controllers\Exercises\ExerciseController::class, 'storeShare'])->name('myexercises.store-share');
Route::post('/myexercises/delete-share', [App\Http\Controllers\Exercises\ExerciseController::class, 'deleteShare'])->name('myexercises.delete-share');

Route::get('/create-group', [App\Http\Controllers\CreateGroupController::class, 'index'])->name('create-group');
Route::post('/create-group/search', [App\Http\Controllers\CreateGroupController::class, 'search'])->name('create-group.search');
Route::post('create-group', [App\Http\Controllers\CreateGroupController::class, 'store'])->name('create-group.store');

Route::get('/edit-group', [\App\Http\Controllers\Groups\EditGroupController::class, 'index'])->name('edit-group');
Route::post('/edit-group/search', [\App\Http\Controllers\Groups\EditGroupController::class, 'search'])->name('edit-group.search');
Route::post('/edit-group/remove-member', [\App\Http\Controllers\Groups\EditGroupController::class, 'removeMember'])->name('edit-group.remove-member');
Route::post('/edit-group/add-member', [\App\Http\Controllers\Groups\EditGroupController::class, 'addMember'])->name('edit-group.add-member');


Route::get('/show-group', [App\Http\Controllers\Groups\ShowGroupController::class, 'index'])->name('show-group');

Route::post('edit-group', [\App\Http\Controllers\Groups\EditGroupController::class, 'store'])->name('edit-group.store');

Route::get('/group-administration', [App\Http\Controllers\Administration\GroupAdministrationController::class, 'index'])->name('group-administration');
Route::post('/group-administration/search', [App\Http\Controllers\Administration\GroupAdministrationController::class, 'search'])->name('group-administration.search');
Route::post('/group-administration/remove-group', [App\Http\Controllers\Administration\GroupAdministrationController::class, 'removeGroup'])->name('group-administration.remove-group');
Route::get('/group-administration/redirect-to-group', [App\Http\Controllers\Administration\GroupAdministrationController::class, 'redirectToGroup'])->name('group-administration.redirect-to-group');

Route::get('/user-administration', [App\Http\Controllers\Administration\UserAdministrationController::class, 'index'])->name('user-administration');
Route::post('/user-administration/search', [App\Http\Controllers\Administration\UserAdministrationController::class, 'search'])->name('user-administration.search');
Route::post('/user-administration/remove-user', [App\Http\Controllers\Administration\UserAdministrationController::class, 'removeUser'])->name('user-administration.remove-user');

Route::get('image-upload', [ ImageUploadController::class, 'imageUpload' ])->name('image.upload');
Route::post('image-upload', [ ImageUploadController::class, 'imageUploadPost' ])->name('image.upload.post');


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/dbconn', function () {
    return view('dbconn');
});
