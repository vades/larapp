<?php

namespace App\Models;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\File;

class Category
{
    private static function fetchBlogCategories(): string
    {
        return File::get(storage_path('app/data/blog-categories.json'));
    }

    private static function fetchPlaceCategories(): string
    {
        return File::get(storage_path('app/data/place-categories.json'));
    }
    public static function allBlogCategories(): array
    {
        return json_decode(self::fetchBlogCategories());
    }

    public static function findBlogCategory(string $slug): object
    {
        $categories = json_decode(json: self::fetchBlogCategories(),associative: true);
        return Arr::first( $categories, fn($item) => $item['slug'] == $slug);
    }

    public static function allPlaceCategories(): array
    {
        return json_decode(self::fetchPlaceCategories());
    }

    public static function findPlaceCategory(string $slug): object
    {
        $categories = json_decode(json: self::fetchPlaceCategories(),associative: true);
        return Arr::first( $categories, fn($item) => $item['slug'] == $slug);
    }
}
