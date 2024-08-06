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

    public function event(string $id)
    {
        return view('components.web.features.album.event.event-list', [
            'page' => (object)[
                'title' => 'Event Item title',
                'subtitle' => 'Event Item subtitle',
                'metaTitle' => 'Event Item - Page Meta Title',
                'keywords' => 'Event, Item, Page, keywords',
                'metaDescription' => 'Album Item - Page meta description',
            ]
        ]);
    }

    public function gallery()
    {
        return view('components.web.features.album.gallery.gallery-list', [
            'page' => (object)[
                'title' => 'Album Gallery title',
                'subtitle' => 'Album Gallery subtitle',
                'metaTitle' => 'Album Gallery - Page Meta Title',
                'keywords' => 'Album, Gallery, Page, keywords',
                'metaDescription' => 'Album Gallery - Page meta description',
            ]
        ]);
    }
}
