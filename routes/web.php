<?php

use App\Http\Controllers\ImageUploadController;
use Illuminate\Support\Facades\Auth;
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
})->name('welcome');

Route::get('/profile/edit', [App\Http\Controllers\ProfileController::class, 'edit'])->name('profile.edit');
Route::post('/profile/store', [App\Http\Controllers\ProfileController::class, 'store'])->name('profile.store');
Route::post('/profile/delete', [App\Http\Controllers\ProfileController::class, 'delete'])->name('profile.delete');
Route::get('/profile/{id?}', [App\Http\Controllers\ProfileController::class, 'index'])->name('profile');

Route::get('mygroups', [\App\Http\Controllers\Groups\GroupController::class, 'show' ])->name('mygroups');
Route::post('mygroups/clickEdit', [\App\Http\Controllers\Groups\GroupController::class, 'clickEdit' ])->name('mygroups.clickEdit');
Route::post('mygroups/clickShow', [\App\Http\Controllers\Groups\GroupController::class, 'clickShow' ])->name('mygroups.clickShow');
Route::post('mygroups/get-assignments', [\App\Http\Controllers\Groups\ShowGroupController::class, 'getAssignments' ])->name('mygroups.get-assignments');
Route::post('mygroups/unassign-exercise', [\App\Http\Controllers\Groups\ShowGroupController::class, 'unassign' ])->name('mygroups.unassign-exercise');

Route::get('create-group', function () {
    return view('create-group');
})->name('create-group');

Route::get('/create-exercise', [\App\Http\Controllers\Exercises\CreateExerciseController::class, 'index'])->name('create-exercise');
Route::post('create-exercise', [\App\Http\Controllers\Exercises\CreateExerciseController::class, 'store'])->name('create-exercise.store');

Route::get('public-exercises', [\App\Http\Controllers\Exercises\PublicExerciseController::class, 'index'])->name('public-exercises');
Route::get('public-flashcard/{id}', [\App\Http\Controllers\Flashcards\PublicFlashcardController::class, 'show'])->name('public-flashcard.show');
Route::post('public-flashcard', [\App\Http\Controllers\Flashcards\PublicFlashcardController::class, 'getCards'])->name('public-flashcard.get-cards');
Route::get('public-flashcardPractise/{id}', [\App\Http\Controllers\Flashcards\PublicFlashcardPractiseController::class, 'show'])->name('public-flashcardPractise.show');


Route::get('flashcard/{id}', [\App\Http\Controllers\Flashcards\FlashcardController::class, 'show'])->name('flashcard.show');
Route::post('flashcard', [\App\Http\Controllers\Flashcards\FlashcardController::class, 'getCards'])->name('flashcard.get-cards');

Route::get('flashcardPractise/{id}', [\App\Http\Controllers\Flashcards\FlashcardPractiseController::class, 'show'])->name('flashcardPractise.show');

Route::post('attempt', [\App\Http\Controllers\Attempts\AttemptController::class, 'saveAttempt'])->name('attempt.save-attempt');

Route::get('myexercises', [\App\Http\Controllers\Exercises\ExerciseController::class, 'show'])->name('myexercises');

Route::post('/myexercises/search', [App\Http\Controllers\Exercises\ExerciseController::class, 'search'])->name('myexercises.search');
Route::post('/myexercises/store-assignment', [App\Http\Controllers\Exercises\ExerciseController::class, 'store_assignment'])->name('myexercises.store-assignment');
Route::post('/myexercises/search-stat', [App\Http\Controllers\Exercises\ExerciseController::class, 'searchGroupsForStat'])->name('myexercises.search-stat');
Route::get('/myexercises/show-stat', [App\Http\Controllers\Exercises\ExerciseController::class, 'searchGroupsForStat'])->name('myexercises.show-stat');
Route::get('myexercises/edit', [\App\Http\Controllers\Exercises\ExerciseController::class, 'edit'])->name('myexercises.edit');
Route::post('/myexercises/share', [App\Http\Controllers\Exercises\ExerciseController::class, 'share'])->name('myexercises.share');
Route::post('/myexercises/store-share', [App\Http\Controllers\Exercises\ExerciseController::class, 'storeShare'])->name('myexercises.store-share');
Route::post('/myexercises/delete-share', [App\Http\Controllers\Exercises\ExerciseController::class, 'deleteShare'])->name('myexercises.delete-share');
Route::post('/myexercises/user-statistics', [App\Http\Controllers\Exercises\ExerciseController::class, 'showUserStatistics'])->name('myexercises.user-statistics');

Route::get('/create-group', [\App\Http\Controllers\Groups\CreateGroupController::class, 'index'])->name('create-group');
Route::post('/create-group/search', [\App\Http\Controllers\Groups\CreateGroupController::class, 'search'])->name('create-group.search');
Route::post('create-group', [\App\Http\Controllers\Groups\CreateGroupController::class, 'store'])->name('create-group.store');

Route::get('/edit-group', [App\Http\Controllers\Groups\EditGroupController::class, 'index'])->name('edit-group');
Route::post('/edit-group/search', [App\Http\Controllers\Groups\EditGroupController::class, 'search'])->name('edit-group.search');
Route::post('/edit-group/search-member', [App\Http\Controllers\Groups\EditGroupController::class, 'searchMember'])->name('edit-group.search-member');
Route::post('/edit-group/remove-member', [App\Http\Controllers\Groups\EditGroupController::class, 'removeMember'])->name('edit-group.remove-member');
Route::post('/edit-group/add-member', [App\Http\Controllers\Groups\EditGroupController::class, 'addMember'])->name('edit-group.add-member');
Route::post('/edit-group/delete-group', [\App\Http\Controllers\Groups\EditGroupController::class, 'deleteGroup'])->name('edit-group.delete-group');
Route::post('/edit-group/store', [App\Http\Controllers\Groups\EditGroupController::class, 'store'])->name('edit-group.store');

Route::get('/edit-exercise', [App\Http\Controllers\Exercises\EditExerciseController::class, 'index'])->name('edit-exercise');
Route::post('/edit-exercise', [App\Http\Controllers\Exercises\EditExerciseController::class, 'store'])->name('edit-exercise.store');
Route::post('/edit-exercise/remove-flashcard', [App\Http\Controllers\Exercises\EditExerciseController::class, 'removeFlashcard'])->name('edit-exercise.remove-flashcard');
Route::post('/edit-exercise/add-flashcard', [App\Http\Controllers\Exercises\EditExerciseController::class, 'addFlashcard'])->name('edit-exercise.add-flashcard');
Route::post('/edit-exercise/delete-exercise', [App\Http\Controllers\Exercises\EditExerciseController::class, 'deleteExercise'])->name('edit-exercise.delete-exercise');
Route::post('/edit-exercise/edit-flashcard', [App\Http\Controllers\Exercises\EditExerciseController::class, 'editFlashcard'])->name('edit-exercise.edit-flashcard');
Route::post('/edit-exercise/searchFlashcards', [App\Http\Controllers\Exercises\EditExerciseController::class, 'searchFlashcards'])->name('edit-exercise.search-flashcards');

Route::get('/show-group', [App\Http\Controllers\Groups\ShowGroupController::class, 'index'])->name('show-group');

Route::get('/group-administration', [App\Http\Controllers\Administration\GroupAdministrationController::class, 'index'])->name('group-administration');
Route::post('/group-administration/search', [App\Http\Controllers\Administration\GroupAdministrationController::class, 'search'])->name('group-administration.search');
Route::post('/group-administration/remove-group', [App\Http\Controllers\Administration\GroupAdministrationController::class, 'removeGroup'])->name('group-administration.remove-group');
Route::get('/group-administration/redirect-to-group', [App\Http\Controllers\Administration\GroupAdministrationController::class, 'redirectToGroup'])->name('group-administration.redirect-to-group');

Route::get('/user-administration', [App\Http\Controllers\Administration\UserAdministrationController::class, 'index'])->name('user-administration');
Route::post('/user-administration/search', [App\Http\Controllers\Administration\UserAdministrationController::class, 'search'])->name('user-administration.search');
Route::post('/user-administration/remove-user', [App\Http\Controllers\Administration\UserAdministrationController::class, 'removeUser'])->name('user-administration.remove-user');

Route::get('/exercise-administration', [App\Http\Controllers\Administration\ExerciseAdministrationController::class, 'index'])->name('exercise-administration');
Route::post('/exercise-administration/search', [App\Http\Controllers\Administration\ExerciseAdministrationController::class, 'search'])->name('exercise-administration.search');
Route::post('/exercise-administration/remove-exercise', [App\Http\Controllers\Administration\ExerciseAdministrationController::class, 'removeExercise'])->name('exercise-administration.remove-exercise');
Route::get('/exercise-administration/redirect-to-exercise', [App\Http\Controllers\Administration\ExerciseAdministrationController::class, 'redirectToExercise'])->name('exercise-administration.redirect-to-exercise');

Route::get('/user-statistics', [App\Http\Controllers\Statistics\UserStatisticsController::class, 'index'])->name('user-statistics');
Route::get('/group-statistics', [App\Http\Controllers\Statistics\GroupStatisticsController::class, 'index'])->name('group-statistics');

Route::get('image-upload', [ ImageUploadController::class, 'imageUpload' ])->name('image.upload');
Route::post('image-upload', [ ImageUploadController::class, 'imageUploadPost' ])->name('image.upload.post');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
