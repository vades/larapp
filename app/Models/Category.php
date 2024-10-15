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

    protected $fillable = [
        'uuid',
        'project_id',
        'parent_id',
        'is_published',
        'category_type',
        'position',
        'views_count',
        'slug',
        'lang',
        'title',
        'description',
        'image_url',
        'options',
    ];

    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }

  public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
                          ->generateSlugsFrom('title')
                          ->saveSlugsTo('slug')
            ->doNotGenerateSlugsOnUpdate();
    }

    public function scopePublishedByType(Builder $query, string $categoryType = 'post'): void
    {
        $query->where('is_published', 1)
              ->where('category_type', $categoryType);
    }
}
