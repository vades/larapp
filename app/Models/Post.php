<?php

namespace App\Models;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\File;

class Post
{
    private static function fetchPosts(): string
    {
        return File::get(storage_path('app/data/blog-posts.json'));
    }
    public static function allPosts(): array
    {
        return json_decode(self::fetchPosts());
    }

    public static function findPost(string $slug): array|null
    {
        $posts = json_decode(json: self::fetchPosts(),associative: true);
        return Arr::first( $posts, fn($item) => $item['slug'] == $slug);
    }
}
