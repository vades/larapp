<?php
use App\Livewire\Web\Features\Home\Home;
use App\Livewire\Web\Features\Page\PageItem;
use App\Livewire\Web\Features\Blog\BlogList;
use App\Livewire\Web\Features\Blog\BlogItem;
use App\Livewire\Web\Features\Blog\BlogCategoryList;
use App\Livewire\Web\Features\Blog\BlogTagList;
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
Route::get('/', Home::class)->name('home');

/**
 * Pages
 */
Route::get('/page/{pageId}', PageItem::class)->name('pageItem');

/**
 * Blog
 */
Route::get('/blog', BlogList::class)->name('blogList');
Route::get('/blog/categories', BlogCategoryList::class)->name('blogCategoryList');
Route::get('/blog/tags', BlogTagList::class)->name('blogTagList');
Route::get('/blog/{postId}', BlogItem::class)->name('blogItem');

/**
 * Places
 */
Route::get('/places', PlaceList::class)->name('placeList');
Route::get('/places/categories', PlaceCategoryList::class)->name('placeCategoryList');
Route::get('/places/{placeId}', PlaceItem::class)->name('placeItem');

/**
 * Albums
 */
Route::get('/albums', AlbumList::class)->name('albumList');
Route::get('/albums/{albumId}', AlbumEventList::class)->name('albumEventList');
Route::get('/albums/{albumId}/{eventId}', AlbumGallery::class)->name('albumGallery');
