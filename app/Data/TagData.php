<?php

namespace App\Data;

use App\Enums\ContentType;
use Spatie\LaravelData\Data;


class TagData extends Data
{
    public function __construct(
        public int $project_id,
        public bool $is_published,
        public ContentType $tag_type,
        public int $views_count,
        public string $lang,
        public string $name,
    ) {}
}
