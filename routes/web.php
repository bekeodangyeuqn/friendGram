<?php

use App\Mail\NewUserWelcomeMail;
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
Route::get('/mail', function () {
    return new NewUserWelcomeMail() ;
});
Route::post('/follow/{user}',[App\Http\Controllers\FollowsController::class, 'store']);

Route::get('/', [App\Http\Controllers\PostsController::class, 'index']);
Route::get('/p/create', [App\Http\Controllers\PostsController::class, 'create']);

Route::get('/users', [App\Http\Controllers\UsersController::class, 'index']);

Route::post('/p', [App\Http\Controllers\PostsController::class, 'store']);
Route::get('/p/{post}', [App\Http\Controllers\PostsController::class, 'show']);

Route::post('/c', [App\Http\Controllers\CommentsController::class, 'store']);

Route::get('/profile/{user}', [App\Http\Controllers\ProfilesController::class, 'index'])->name('show');
Route::get('/profile/{user}/edit', [App\Http\Controllers\ProfilesController::class, 'edit'])->name('edit');
Route::patch('/profile/{user}', [App\Http\Controllers\ProfilesController::class, 'update'])->name('update');

Route::get('/followings/{user}', [App\Http\Controllers\FollowingsController::class, 'index']);
Route::get('/followers/{profile}', [App\Http\Controllers\FollowersController::class, 'index']);



