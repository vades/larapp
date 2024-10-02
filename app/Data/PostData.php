<?php

namespace App\Data;

use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;

class PostData extends Data
{
    public function __construct(
        public int $parent_id = 0,
        public int $project_id = 1,
        public int $user_id = 1,
        public bool $is_featured = false,
        public string $post_type = 'post',
        public string $post_status = 'draft',
        public int $position = 0,
        public int $views_count = 0,
        public string $slug,
        public string $lang = 'en',
        public string $title,
        public string|Optional $subtitle,
        public string|Optional $description = '',
        public string|Optional $content,
        public string|Optional $image_url = '',
        public array|Optional $options = [],
    ) {}
}
