<?php

namespace App\Http\Controllers\Web\Blog;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\View\View;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $contents = File::get(storage_path('app/data/blog-posts.json'));
        $posts = json_decode(json: $contents);
        $page =  (object)[
            'title' => 'Blog List title',
            'subtitle' => 'Blog List subtitle',
            'metaTitle' => 'Blog List - Page Meta Title',
            'keywords' => 'Blog, List, ,Page, keywords',
            'metaDescription' => 'Blog List - Page meta description',
        ];

        return view('web.features.blog.blog-list',[
            'posts' => $posts ,'page' => $page] );
    }

    function arrayToObject($array) {
        if (is_array($array)) {
            return (object) array_map(__FUNCTION__, $array);
        } else {
            return $array;
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }
}
