<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeItemController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request): View
    {
        $placesFeatured = Post::allPlaceFeaturedPosts();
        $places = Post::allPlacePosts();
        $posts = Post::allBlogPosts();
        return view('components.web.features.home.home-item', [
            'placesFeatured' => $placesFeatured,
            'places' => $places,
            'posts' => $posts
        ]);
    }
}
