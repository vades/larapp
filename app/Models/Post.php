<?php

namespace App\Models;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\File;

class Post
{
    private static function fetchBlogPosts(): string
    {
        return File::get(storage_path('app/data/blog-posts.json'));
    }
    public static function allBlogPosts(): array
    {
        return json_decode(self::fetchBlogPosts());
    }

    public static function findBlogPost(string $slug): array|null
    {
        $posts = json_decode(json: self::fetchBlogPosts(), associative: true);
        return Arr::first( $posts, fn($item) => $item['slug'] == $slug);
    }

    private static function fetchPlacePosts(): string
    {
        return File::get(storage_path('app/data/place-posts.json'));
    }
    public static function allPlacePosts(): array
    {
        return json_decode(self::fetchPlacePosts());
    }

    public static function findPlacePost(string $slug): array|null
    {
        $posts = json_decode(json: self::fetchPlacePosts(), associative: true);
        return Arr::first( $posts, fn($item) => $item['slug'] == $slug);
    }
}
