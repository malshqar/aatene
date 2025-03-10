<?php

namespace Modules\User\Entities;


use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Modules\HubConnect\Entities\Topic;
use Modules\Photo\Traits\HasPhoto;
use Modules\Store\Entities\Store;
use Modules\User\Traits\HasScopes;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, HasPhoto,HasScopes;

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
        'ban_at',
        'ban_reason',
        'status',
        "two_factor_secret",
        "two_factor_recovery_codes",
        "two_factor_confirmed_at",
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'ban_at',
        'ban_reason',
        "two_factor_secret",
        "two_factor_recovery_codes",
        "two_factor_confirmed_at",
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'ban_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function getUserStatusAttribute()
    {
        return $this->status == 'active' ? 'حساب فعال' : 'حساب معطل';
    }

    public function followers()
    {
        return $this->belongsToMany(Store::class, 'followers', 'user_id', 'store_id');
    }
    
    public function topics()
    {
        return $this->morphMany(Topic::class, 'userable');
    }
}

