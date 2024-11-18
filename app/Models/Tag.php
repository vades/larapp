<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id',
        'tag_type',
        'is_published',
        'views_count',
        'lang',
        'name',
    ];

    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }

    public function scopePublishedByType(Builder $query, string $tagType = 'post'): void
    {
        $query->where('is_published', 1)
              ->where('tag_type', $tagType)
        ;
    }
}
