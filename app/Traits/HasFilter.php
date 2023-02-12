<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait HasFilter
{
    protected function scopeFilter(Builder $builder, array $params = [])
    {
        foreach ($params as $key => $value) {
            $builder->where($key, 'like', "%$value%");
        }

        return $builder;
    }
}
