<?php

namespace App\Models;

use App\Models\Scopes\ProjectScope;
use Illuminate\Database\Eloquent\Attributes\ScopedBy;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[ScopedBy(ProjectScope::class)]
class Post extends Model
{
    use HasFactory;

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

    public function scopePublishedByType(Builder $query, string $postType = 'post'): void
    {
        $query->where('post_status', 'published')
              ->where('post_type', $postType)
        ;
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

    public function scopeIsFeatured(Builder $query): void
    {
        $query->where('is_featured', 1);
    }

    public function scopeNotFeatured(Builder $query): void
    {
        $query->where('is_featured', 0);
    }
}
