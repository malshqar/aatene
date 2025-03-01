<?php

namespace Modules\Seller\Traits;

use Illuminate\Database\Eloquent\Builder;


trait HasScopes
{
    public function ScopeFilters(Builder $builder, $filters)
    {
        $params = array_merge([
            'search' => null,
            'status' => null,
            'orderBy'=>'desc',
        ], $filters);
        $builder->when($params['search'], function ($builder, $value) {
            $builder->where('name', 'like', "%".$value."%")
                ->orWhere('email', 'like', "%".$value."%")
                ->orWhere('phone_number', 'like', "%".$value."%");
        });
        $builder->when($params['status'], function ($builder, $value) {
            $builder->where('status', '=', $value);
        });
        $builder->when($params['orderBy'], function ($builder, $value) {
            $builder->orderBy('id',$value);
        });
    }

    public function ScopeActiveSellers(Builder $builder)
    {
        $builder->where('status', '=', 'active');
    }

    public function ScopeInactiveSellers(Builder $builder)
    {
        $builder->where('status', '=', 'inactive');
    }

    public function ScopeBlockedSellers(Builder $builder)
    {
        $builder->whereNotNull('ban_at');
    }
}