<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait ModelTrait
{
    public function scopeFindByUuid(Builder $query, string $uuid): void
    {
        $query->where('uuid', $uuid);
    }
}