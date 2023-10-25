<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProfileController;



use Illuminate\Support\Facades\Session;

Route::get('lang/{lang}', function ($lang) {
    Session::put('locale', $lang);
    return redirect()->back();
})->name('lang.switch');


Route::get('/', [PostController::class, 'index'])->name('dashboard');

Route::resource('comments', CommentController::class)->only(['store']);

Route::resource('posts', PostController::class)->middleware('auth');

Route::resource('posts', PostController::class);

Route::prefix('profile')->middleware('auth')->group(function () {
    Route::get('/', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/', [ProfileController::class, 'update'])->name('profile.update');
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
