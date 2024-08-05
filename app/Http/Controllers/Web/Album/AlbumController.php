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
        //
    }

    public function gallery()
    {
        //
    }
}
