<?php

namespace App\Models;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\File;

class Post
{
    public static function allPosts(): array
    {
        $contents = File::get(storage_path('app/data/blog-posts.json'));
        return json_decode(json: $contents);
    }

    public static function findPost(string $slug): array|null
    {
        $contents = File::get(storage_path('app/data/blog-posts.json'));
        $posts = json_decode(json: $contents,associative: true);
        return Arr::first( $posts, fn($item) => $item['slug'] == $slug);
    }
}
