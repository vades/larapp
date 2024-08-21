<?php

namespace App\Http\Controllers\Web\Place;

use App\Http\Controllers\Controller;
use App\Models\Album;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\View\View;

class PlaceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View{
        $places = Post::allPlacePosts();
        $page = (object)[
            'title' => 'Place List title',
            'subtitle' => 'Place List subtitle',
            'metaTitle' => 'Place List - Page Meta Title',
            'keywords' => 'Place, List, ,Page, keywords',
            'metaDescription' => 'Place List - Page meta description',
        ];
        return view('components.web.features.place.list.place-list', [
            'page' => $page,
            'places' => $places
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): View{
        $place = Post::findPlacePost($id);
        $images = Album::allPhotos();
        $places = Post::allPlacePosts();
        $page = (object)[
            'title' => $place['title'],
            'subtitle' => $place['subTitle'],
            'metaTitle' => $place['metaTitle'],
            'keywords' => $place['keywords'] ?? null,
            'metaDescription' => $place['metaDescription'],
        ];
        return view('components.web.features.place.item.place-item', [
            'page' => $page,
            'place' =>  (object)$place,
            'images' => $images,
            'highlights' => $places,
            'related' => $places]
        );
    }

    public function category(): View{
        $categories = Category::allPlaceCategories();
        $page = (object)[
            'title' => 'Place Category title',
            'subtitle' => 'Place Category subtitle',
            'metaTitle' => 'Place Category - Page Meta Title',
            'keywords' => 'Place, Category, Page, keywords',
            'metaDescription' => 'Place Category - Page meta description',
        ];
        return view('components.web.features.place.list.place-list-category', [
            'page' => $page,'categories' => $categories]);
    }
}
