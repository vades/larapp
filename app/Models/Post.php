<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Scopes\ProjectScope;
use Illuminate\Database\Eloquent\Attributes\ScopedBy;
use Illuminate\Database\Eloquent\Builder;

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

    public function scopeIsPublished(Builder $query): void
    {
        $query->where('post_status', 'published');
    }
    public function scopeIsPlace(Builder $query): void
    {
        $query->where('post_type', 'place');
    }

    public function scopeIsPost(Builder $query): void
    {
        $query->where('post_type', 'post');
    }
    public function scopeIsPage(Builder $query): void
    {
        $query->where('post_type', 'page');
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
