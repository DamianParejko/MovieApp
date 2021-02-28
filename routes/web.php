<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LikePostController;
use App\Http\Controllers\LikeCommentController;

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

Route::get('/home', [HomeController::class, 'index'])->name('movie.index');

Route::prefix('/profile')-> group(function() {
    Route::get('/{user}', [ProfileController::class, 'show'])->name('profile');
    Route::post('/{user}', [ProfileController::class, 'store'])->name('profile.store');
    Route::put('/{user}', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/{user}', [ProfileController::class, 'destroy'])->name('profile.delete');
});
 
Route::get('/markAsRead', function(){
    auth()->user()->unreadNotifications->markAsRead();
    return redirect()->route('index');
});

Route::get('/', [MovieController::class, 'index'])->name('movie.index');
Route::get('/movie/{movie}', [MovieController::class, 'show'])->name('movie.show');

Route::prefix('rating')->group(function(){
    Route::post('/{movie}', [MovieController::class, 'selectRating'])->name('rating.select');
    Route::delete('/{rating}', [MovieController::class, 'deleteRating'])->name('rating.delete');
});

Route::prefix('/post')-> group(function(){
    Route::get('/{post}', [PostController::class, 'show'])->name('post.show');
    Route::post('/{movie}', [PostController::class, 'store'])->name('post.store');
    Route::get('/{post}/edit', [PostController::class, 'edit'])->name('post.edit');
    Route::put('/{post}', [PostController::class, 'update'])->name('post.update');
    Route::delete('/{post}', [PostController::class, 'destroy'])->name('post.delete');    
});

Route::prefix('/postlike')-> group(function(){
    Route::get('/like/{post}', [LikePostController::class, 'like'])->name('post.like');
    Route::get('/dislike/{post}', [LikePostController::class, 'dislike'])->name('post.dislike');
    Route::delete('/{post}', [LikePostController::class, 'destroy'])->name('post.like.delete');    
});

Route::prefix('/comment') ->group(function(){
    Route::post('/{post}', [CommentController::class, 'store'])->name('comment.store');
    Route::get('/{comment}', [CommentController::class, 'edit'])->name('comment.edit');
    Route::put('/{comment}', [CommentController::class, 'update'])->name('comment.update');
    Route::delete('/{comment}', [CommentController::class, 'destroy'])->name('comment.delete');
});

Route::prefix('/commentlike') ->group(function(){
    Route::get('/like/{comment}', [LikeCommentController::class, 'like'])->name('comment.like');
    Route::get('/dislike/{comment}', [LikeCommentController::class, 'dislike'])->name('comment.dislike');
    Route::delete('/{comment}', [LikeCommentController::class, 'destroy'])->name('comment.like.delete');
});