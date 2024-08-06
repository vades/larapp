<?php

namespace App\Http\Controllers\Web\Place;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;

class PlaceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(){
        return view('components.web.features.place.list.place-list', [
            'page' => (object)[
                'title' => 'Place List title',
                'subtitle' => 'Place List subtitle',
                'metaTitle' => 'Place List - Page Meta Title',
                'keywords' => 'Place, List, ,Page, keywords',
                'metaDescription' => 'Place List - Page meta description',
            ]
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id){
        return view('components.web.features.place.item.place-item', [
            'page' => (object)[
                'title' => 'Place Item title',
                'subtitle' => 'Place Item subtitle',
                'metaTitle' => 'Place Item - Page Meta Title',
                'keywords' => 'Place, Item, Page, keywords',
                'metaDescription' => 'Place Item - Page meta description',
            ]
        ]);
    }

    public function category(){
        return view('components.web.features.place.list.place-list-category', [
            'page' => (object)[
                'title' => 'Place Category title',
                'subtitle' => 'Place Category subtitle',
                'metaTitle' => 'Place Category - Page Meta Title',
                'keywords' => 'Place, Category, Page, keywords',
                'metaDescription' => 'Place Category - Page meta description',
            ]
        ]);
    }
}
