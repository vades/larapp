<?php

namespace App\Data;

use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;
use App\Enums\PostStatus;



class PostData extends Data
{
    public function __construct(
        public string $uuid,
        public int $parent_id,
        public int $project_id,
        public int $user_id,
        public bool $is_featured,
        public string $post_type,
        public PostStatus $post_status,
        public int $position,
        public int $views_count,
        public string $slug,
        public string $lang,
        public string $title,
        public string|Optional $subtitle,
        public string|Optional $description,
        public string|Optional $content,
        public string|Optional $image_url,
        public array|Optional $options,
    ) {}
}
