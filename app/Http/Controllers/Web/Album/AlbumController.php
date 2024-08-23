<?php

namespace App\Http\Controllers\Web\Album;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Album;
use Illuminate\View\View;

class AlbumController extends Controller
{
    public function index(): View
    {
        $albums = Album::allAlbums();
        $page =  (object)[
            'title' => 'Album List title',
            'subtitle' => 'Album List subtitle',
            'metaTitle' => 'Album List - Page Meta Title',
            'keywords' => 'Album, List, ,Page, keywords',
            'metaDescription' => 'Album List - Page meta description',
        ];

        return view('components.web.features.album.list.album-list',[
            'albums' => $albums ,'page' => $page] );
    }

    public function event(string $id): View
    {
        $events = Album::allEvents();
        $page = (object)[
            'title' => 'Event List title',
            'subtitle' => 'Event List subtitle',
            'metaTitle' => 'Event List - Page Meta Title',
            'keywords' => 'Event, List, ,Page, keywords',
            'metaDescription' => 'Event List - Page meta description',
        ];
        return view('components.web.features.album.event.event-list',  [
            'events' => $events,
            'page' => $page
        ]);
    }

    public function gallery(): View
    {
        $images = Album::allPhotos();
        $page = (object)[
            'title' => 'Album Gallery title',
            'subtitle' => 'Album Gallery subtitle',
            'metaTitle' => 'Album Gallery - Page Meta Title',
            'keywords' => 'Album, Gallery, Page, keywords',
            'metaDescription' => 'Album Gallery - Page meta description',
        ];
        return view('components.web.features.album.gallery.gallery-list', [
            'images' => $images,
            'page' => $page
        ]);
    }
}
