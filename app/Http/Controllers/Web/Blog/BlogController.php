<?php

namespace App\Http\Controllers\Web\Blog;

use App\Http\Controllers\Controller;
use App\Models\Post;
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
        $posts = Post::allPosts();
        $page =  (object)[
            'title' => 'Blog List title',
            'subtitle' => 'Blog List subtitle',
            'metaTitle' => 'Blog List - Page Meta Title',
            'keywords' => 'Blog, List, ,Page, keywords',
            'metaDescription' => 'Blog List - Page meta description',
        ];

        return view('components.web.features.blog.list.blog-list',[
            'posts' => $posts ,'page' => $page] );
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('components.web.features.blog.item.blog-item', [
            'page' => (object)[
                'title' => 'Blog Item title',
                'subtitle' => 'Blog Item subtitle',
                'metaTitle' => 'Blog Item - Page Meta Title',
                'keywords' => 'Blog, Item, Page, keywords',
                'metaDescription' => 'Blog Item - Page meta description',
            ]
        ]);
    }

    public function category()
    {
        return view('components.web.features.blog.list.blog-list-category', [
            'page' => (object)[
                'title' => 'Blog Category title',
                'subtitle' => 'Blog Category subtitle',
                'metaTitle' => 'Blog Category - Page Meta Title',
                'keywords' => 'Blog, Category, Page, keywords',
                'metaDescription' => 'Blog Category - Page meta description',
            ]
        ]);
    }

    public function tag()
    {
        return view('components.web.features.blog.list.blog-list-tag', [
            'page' => (object)[
                'title' => 'Blog Tag title',
                'subtitle' => 'Blog Tag subtitle',
                'metaTitle' => 'Blog Tag - Page Meta Title',
                'keywords' => 'Blog, Tag, Page, keywords',
                'metaDescription' => 'Blog Tag - Page meta description',
            ]
        ]);
    }
}
