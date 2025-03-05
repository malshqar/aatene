<?php

namespace Modules\HubConnect\Traits;

use Illuminate\Database\Eloquent\Builder;


trait BlogHasScopes
{
    public function ScopeFilters(Builder $builder, $filters)
    {
        $params = array_merge([
            'search' => null,
            'orderBy'=>'desc',
        ], $filters);
        $builder->when($params['search'], function ($builder, $value) {
            $builder->where('title', 'like', "%".$value."%");
            $builder->where('content', 'like', "%".$value."%");
            $builder->where('writer', 'like', "%".$value."%");
        });
        $builder->when($params['orderBy'], function ($builder, $value) {
            $builder->orderBy('id',$value);
        });
    }

}