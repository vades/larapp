<?php

namespace App\Models;

use App\Models\Scopes\ProjectScope;
use App\Traits\ModelTrait;
use Illuminate\Database\Eloquent\Attributes\ScopedBy;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

#[ScopedBy(ProjectScope::class)]
class Post extends Model
{
    use HasFactory, HasSlug, ModelTrait;

    protected $fillable = [
        'uuid',
        'parent_id',
        'project_id',
        'user_id',
        'is_featured',
        'post_type',
        'post_status',
        'position',
        'views_count',
        'lang',
        'title',
        'subtitle',
        'description',
        'content',
        'image_url',
        'options',
        ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_post');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
                          ->generateSlugsFrom('title')
                          ->saveSlugsTo('slug');
    }

    public function getAddressAttribute()
    {
        $options = json_decode($this->options, true);
        return $options['address'] ?? null;
    }

    public function getGoogleMapEmbedUrlAttribute()
    {
        $options = json_decode($this->options, true);
        return $options['googleMapEmbedUrl'] ?? null;
    }

    /*public function scopeFindByUuid(Builder $query, string $uuid): void
    {
        $query->where('uuid', $uuid);
    }*/

    public function scopePublishedByType(Builder $query, string $postType = 'post'): void
    {
        $query->where('post_status', 'published')
              ->where('post_type', $postType)
        ;
    }
    public function scopeIsFeatured(Builder $query): void
    {
        $query->where('is_featured', 1);
    }

    public function scopeNotFeatured(Builder $query): void
    {
        $query->where('is_featured', 0);
    }

public function scopeFilter(Builder $query, Request $request): void
{
    $query->when($request->filled('category'), function ($q) use ($request) {
        $q->whereHas('categories', function ($q) use ($request) {
            $q->where('slug', '=', $request->input('category'));
        });
    });
    $query->when($request->filled('tag'), function ($q) use ($request) {
        $q->whereHas('tags', function ($q) use ($request) {
            $q->where('name', '=', $request->input('tag'));
        });
    });
}

    public function nextPublishedByType(string $postType = 'post')
    {
        return $this->publishedByType($postType)
                    ->where('id', '>', $this->id)
                    ->orderBy('id')
                    ->first();
    }

    public function previousPublishedByType(string $postType = 'post')
    {
        return $this->publishedByType($postType)
                    ->where('id', '<', $this->id)
                    ->orderByDesc('id')
                    ->first();
    }
}
