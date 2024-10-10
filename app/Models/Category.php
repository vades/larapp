<?php

namespace App\Models;

use App\Models\Scopes\ProjectScope;
use App\Traits\ModelTrait;
use Illuminate\Database\Eloquent\Attributes\ScopedBy;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

#[ScopedBy(ProjectScope::class)]
class Category extends Model
{
    use HasFactory, HasSlug, ModelTrait;

    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }

  public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
                          ->generateSlugsFrom('title')
                          ->saveSlugsTo('slug');
    }

    public function scopePublishedByType(Builder $query, string $categoryType = 'post'): void
    {
        $query->where('is_published', 1)
              ->where('category_type', $categoryType);
    }
}
