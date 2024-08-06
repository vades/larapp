<?php
use App\Http\Controllers\Web\Home\HomeItemController;
use App\Http\Controllers\Web\Page\PageItemController;
use App\Http\Controllers\Web\Blog\BlogController;
use App\Http\Controllers\Web\Place\PlaceController;
use App\Livewire\Web\Features\Place\PlaceList;
use App\Livewire\Web\Features\Place\PlaceItem;
use App\Livewire\Web\Features\Place\PlaceCategoryList;
use App\Livewire\Web\Features\Album\AlbumList;
use App\Livewire\Web\Features\Album\AlbumEventList;
use App\Livewire\Web\Features\Album\AlbumGallery;
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
Route::get('/albums', AlbumList::class)->name('albumList');
Route::get('/albums/{albumId}', AlbumEventList::class)->name('albumEventList');
Route::get('/albums/{albumId}/{eventId}', AlbumGallery::class)->name('albumGallery');
