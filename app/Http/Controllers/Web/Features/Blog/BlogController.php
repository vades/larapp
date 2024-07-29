<?php

namespace App\Http\Controllers\Web\Features\Blog;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {

        $page =  (object)[
            'title' => 'Blog List title',
            'subtitle' => 'Blog List subtitle',
            'metaTitle' => 'Blog List - Page Meta Title',
            'keywords' => 'Blog, List, ,Page, keywords',
            'metaDescription' => 'Blog List - Page meta description',
        ];
        $posts = (object)[];
        return view('components.web.features.blog.blog-list',[
            'posts' => $posts,'page' => $page] );
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }
}
