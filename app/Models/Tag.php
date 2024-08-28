<?php

namespace App\Models;

use Illuminate\Support\Facades\File;

class Tag
{

    private static function fetchBlogTags(): string
    {
        return File::get(storage_path('app/data/blog-tags.json'));
    }

    public static function allBlogTags(): array
    {
        return json_decode(self::fetchBlogTags());
    }

}
