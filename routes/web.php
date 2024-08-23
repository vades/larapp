<?php
use App\Http\Controllers\Web\HomeItemController;
use App\Http\Controllers\Web\PageItemController;
use App\Http\Controllers\Web\BlogController;
use App\Http\Controllers\Web\PlaceController;
use App\Http\Controllers\Web\AlbumController;
use Illuminate\Support\Facades\Route;

/**
 * Home
 */
Route::get('/', HomeItemController::class)->name('home');

/**
 * Pages
 */
Route::get('/page/{pageId}', PageItemController::class)->name('pageItem');

/**
 * Blog
 */
Route::get('/blog', [BlogController::class, 'index'])->name('blogList');
Route::get('/blog/categories', [BlogController::class, 'category'])->name('blogCategoryList');
Route::get('/blog/tags', [BlogController::class, 'tag'])->name('blogTagList');
Route::get('/blog/{postId}', [BlogController::class, 'show'])->name('blogItem');

/**
 * Places
 */
Route::get('/places', [PlaceController::class,'index'])->name('placeList');
Route::get('/places/categories',  [PlaceController::class,'category'])->name('placeCategoryList');
Route::get('/places/{placeId}',  [PlaceController::class,'show'])->name('placeItem');

/**
 * Albums
 */
Route::get('/albums', [AlbumController::class,'index'])->name('albumList');
Route::get('/albums/{albumId}', [AlbumController::class,'event'])->name('albumEventList');
Route::get('/albums/{albumId}/{eventId}', [AlbumController::class,'gallery'])->name('albumGallery');
