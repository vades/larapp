<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Album;
use App\Models\Category;
use App\Models\Post;
use Illuminate\View\View;

class PlaceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View{
        $places = Post::publishedByType('place')->orderBy('created_at','desc')
                      ->paginate(20);
        $page = (object)[
            'title' => 'Place List title',
            'subtitle' => 'Place List subtitle',
            'metaTitle' => 'Place List - Page Meta Title',
            'keywords' => 'Place, List, ,Page, keywords',
            'metaDescription' => 'Place List - Page meta description',
        ];
        return view('components.web.features.place.place-list', [
            'page' => $page,
            'places' => $places
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): View {
        $place = Post::publishedByType('place')->where('slug', $id)->firstOrFail();
        //dd($place->previousPublishedByType('place')->id);

        $nextPlace = $place->nextPublishedByType('place');

        $previousPlace = $place->previousPublishedByType('place');

        $images = Album::allPhotos();
        $places = Post::publishedByType('place')->orderBy('created_at', 'desc')->take(6)->get();
        $page = (object)[
            'title' => $place['title'],
            'subtitle' => $place['subTitle'],
            'metaTitle' => $place['metaTitle'],
            'keywords' => $place['keywords'] ?? null,
            'metaDescription' => $place['metaDescription'],
        ];

        return view('components.web.features.place.place-item', [
            'page' => $page,
            'place' => (object)$place,
            'images' => $images,
            'highlights' => $places,
            'related' => $places,
            'nextPlace' => $nextPlace ? route('placeItem',  ['placeId'=>$nextPlace->slug]) : null,
            'previousPlace' => $previousPlace ? route('placeItem',  ['placeId'=>$previousPlace->slug]) : null
        ]);
    }
    public function _(string $id): View{
        $place = Post::publishedByType('place')->where('slug', $id)->firstOrFail();
        $images = Album::allPhotos();
        $places = Post::publishedByType('place')->orderBy('created_at','desc')->take(6)->get();
        $page = (object)[
            'title' => $place['title'],
            'subtitle' => $place['subTitle'],
            'metaTitle' => $place['metaTitle'],
            'keywords' => $place['keywords'] ?? null,
            'metaDescription' => $place['metaDescription'],
        ];
        return view('components.web.features.place.place-item', [
            'page' => $page,
            'place' =>  (object)$place,
            'images' => $images,
            'highlights' => $places,
            'related' => $places]
        );
    }

    public function category(): View{
        $categories = Category::publishedByType('place')->withCount('posts')->where('posts_count','>',0)->get();
        $page = (object)[
            'title' => 'Place Category title',
            'subtitle' => 'Place Category subtitle',
            'metaTitle' => 'Place Category - Page Meta Title',
            'keywords' => 'Place, Category, Page, keywords',
            'metaDescription' => 'Place Category - Page meta description',
        ];
        return view('components.web.features.place.place-list-category', [
            'page' => $page,'categories' => $categories]);
    }
}
