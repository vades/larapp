<?php

namespace App\Data;

use App\Enums\ContentType;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;


class CategoryData extends Data
{
    public function __construct(
        public string $uuid,
        public int $project_id,
        public int $parent_id,
        public bool $is_published,
        public ContentType $category_type,
        public int $position,
        public int $views_count,
        public string|Optional $slug,
        public string $lang,
        public string $title,
        public string|Optional $description,
        public string|Optional $image_url,
        public array|Optional $options,
    ) {}
}
