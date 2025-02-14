<?php

namespace Modules\User\Entities;


// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Modules\Photo\Traits\HasPhoto;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasPhoto;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'last_active_at',
        'phone_number',
        'blocked_at',
        'block_reason',
        'status'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

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
}

