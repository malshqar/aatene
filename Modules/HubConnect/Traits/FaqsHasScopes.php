<?php

namespace Modules\HubConnect\Traits;

use Illuminate\Database\Eloquent\Builder;


trait FaqsHasScopes
{
    public function ScopeFilters(Builder $builder, $filters)
    {
        $params = array_merge([
            'search' => null,
            'orderBy' => 'desc',
        ], $filters);
        $builder->when($params['search'], function ($builder, $value) {
            $builder->where('question', 'like', "%" . $value . "%");
            $builder->where('answer', 'like', "%" . $value . "%");
            $builder->orWhereHas('category', function ($q) use ($value) {
                $q->where('name', 'like', "%" . $value . "%"); 
            });
        });
        $builder->when($params['orderBy'], function ($builder, $value) {
            $builder->orderBy('id', $value);
        });
    }

}