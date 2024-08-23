<?php

namespace App\Http\Controllers\Web\Blog;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\View\View;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $posts = Post::allBlogPosts();
        $page = (object)[
            'title' => 'Blog List title',
            'subtitle' => 'Blog List subtitle',
            'metaTitle' => 'Blog List - Page Meta Title',
            'keywords' => 'Blog, List, ,Page, keywords',
            'metaDescription' => 'Blog List - Page meta description',
        ];

        return view(
            'components.web.features.blog.blog-list',
            [
                'posts' => $posts,
                'page' => $page
            ]
        );
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id): View
    {
        $post = Post::findBlogPost($id);
        $page = (object)[
            'title' => $post['title'],
            'subtitle' => $post['subTitle'],
            'metaTitle' => $post['metaTitle'],
            'keywords' => $post['keywords'] ?? null,
            'metaDescription' => $post['metaDescription'],
        ];
        return view('components.web.features.blog.blog-item', [
            'post' =>  (object)$post,
            'page' => $page
        ]);
    }

    public function category()
    {
        $categories = Category::allBlogCategories();
        $page = (object)[
            'title' => 'Blog Category title',
            'subtitle' => 'Blog Category subtitle',
            'metaTitle' => 'Blog Category - Page Meta Title',
            'keywords' => 'Blog, Category, Page, keywords',
            'metaDescription' => 'Blog Category - Page meta description',
        ];

        return view('components.web.features.blog.blog-list-category',  [
            'categories' => $categories,
            'page' => $page

        ]);
    }

    public function tag()
    {
        $tags = Tag::allBlogTags();
        $page = (object)[
            'title' => 'Blog Tag title',
            'subtitle' => 'Blog Tag subtitle',
            'metaTitle' => 'Blog Tag - Page Meta Title',
            'keywords' => 'Blog, Tag, Page, keywords',
            'metaDescription' => 'Blog Tag - Page meta description',
        ];
        return view('components.web.features.blog.blog-list-tag', [
            'page' => $page,
            'tags' => $tags
        ]);
    }
}
