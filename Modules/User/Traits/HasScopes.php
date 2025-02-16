<?php

namespace Modules\User\Traits;

use Illuminate\Database\Eloquent\Builder;


trait HasScopes
{
    public function ScopeFilters(Builder $builder, $filters)
    {
        $params = array_merge([
            'search' => null,
            'status' => null
        ], $filters);
        $builder->when($params['search'], function ($builder, $value) {
            $builder->where('name', 'like', "%$value%")
                ->orWhere('email', 'like', "%$value%")
                ->orWhere('phone_number', 'like', "%$value%");
        });
        $builder->when($params['status'], function ($builder, $value) {
            $builder->where('status', '=', $value);
        });
    }

    public function ScopeActiveUseres(Builder $builder)
    {
        $builder->where('status', '=', 'active');
    }

    public function ScopeInactiveUseres(Builder $builder)
    {
        $builder->where('status', '=', 'inactive');
    }

    public function ScopeBlockedUsers(Builder $builder)
    {
        $builder->whereNotNull('ban_at');
    }
}