<?php

namespace Modules\Store\Traits;

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
                ->orWhere('description', 'like', "%".$value."%")
                ->orWhere('location', 'like', "%".$value."%");
        });
        if(in_array($params['status'],['active','inactive'])){
            $builder->when($params['status'], function ($builder, $value) {
                $builder->where('status', '=', $value)->where('is_accepted',1);
            });
        }
        $builder->when(($params['status'] && $params['status'] == "pending"), function ($builder, $value) {
            $builder->where('is_accepted', '=', 0);
        });
        $builder->when($params['orderBy'], function ($builder, $value) {
            $builder->orderBy('id',$value);
        });
    }

    public function ScopeActive(Builder $builder)
    {
        $builder->where('status', '=', 'active');
    }

    public function ScopeInactive(Builder $builder)
    {
        $builder->where('status', '=', 'inactive');
    }
    public function ScopePending(Builder $builder)
    {
        $builder->where('is_accepted', '=', false);
    }

    public function ScopeAccepted(Builder $builder)
    {
        $builder->where('is_accepted', '=', true);
    }

}