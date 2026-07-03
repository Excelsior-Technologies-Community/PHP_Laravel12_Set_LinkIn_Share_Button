<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Home Page
Route::get('/', function () {
    return redirect()->route('posts.index');
});

// Blog Routes
Route::controller(PostController::class)->group(function () {

    // Blog Listing + Search
    Route::get('/posts', 'index')->name('posts.index');

    // Single Post
    Route::get('/posts/{id}', 'show')->name('posts.show');

    // Like Post
    Route::post('/posts/{id}/like', 'like')->name('posts.like');

    // LinkedIn Share + Share Counter
    Route::get('/posts/{id}/share', 'share')->name('posts.share');

});