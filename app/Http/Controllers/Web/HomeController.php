<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Album;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request): View
    {
        $placesFeatured = Post::isPublished()->isPlace()->isFeatured()->inRandomOrder()->orderBy('created_at','desc')
                                                                      ->take(6)->get();
        $places = Post::isPublished()->isPlace()->notFeatured()->inRandomOrder()->orderBy('created_at','desc')
                     ->take(6)->get();
        $posts = Post::isPublished()->isPost()->orderBy('created_at','desc')
                     ->take(6)->get();
        $images = Album::allPhotos();
        return view('components.web.features.home.home-item', [
            'placesFeatured' => $placesFeatured,
            'places' => $places,
            'posts' => $posts,
            'images' => $images
        ]);
    }
}