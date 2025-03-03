<?php

namespace Modules\Ads\Traits;

use Illuminate\Database\Eloquent\Builder;


trait HasScopes
{
    public function ScopeFilters(Builder $builder, $filters)
    {
        $params = array_merge([
            'search' => null,
            'orderBy'=>'desc',
        ], $filters);
        $builder->when($params['search'], function ($builder, $value) {
            $builder->where('name', 'like', "%".$value."%");
        });
        $builder->when($params['orderBy'], function ($builder, $value) {
            $builder->orderBy('id',$value);
        });
    }

}