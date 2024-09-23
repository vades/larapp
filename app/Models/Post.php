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

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'post_tag');
    }

    public function scopePublishedByType(Builder $query, string $postType = 'post'): void
    {
        $query->where('post_status', 'published')
            ->where('post_type', $postType);
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
