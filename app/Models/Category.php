<?php

namespace App\Models;

use App\Models\Scopes\ProjectScope;
use Illuminate\Database\Eloquent\Attributes\ScopedBy;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
#[ScopedBy(ProjectScope::class)]
class Category extends Model
{
    use HasFactory;

    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }

    public function scopeGetBlog(Builder $query): void
    {
        $query->where('is_published', 1)
              ->where('category_type', 'post')
              ->orderBy('position')
              ->orderBy('title');
    }
    public function scopeGetPlace(Builder $query): void
    {
        $query->where('is_published', 1)
              ->where('category_type', 'place')
              ->orderBy('position')
              ->orderBy('title');
    }
}
