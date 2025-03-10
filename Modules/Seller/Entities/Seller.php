<?php

namespace Modules\Seller\Entities;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Modules\HubConnect\Entities\Topic;
use Modules\Photo\Traits\HasPhoto;
use Modules\Seller\Traits\HasScopes;
use Modules\Store\Entities\Store;

class Seller extends User implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, HasPhoto, HasScopes;

    protected $fillable = [
        'name',
        'email',
        'password',
        'last_active_at',
        'phone_number',
        'ban_at',
        'ban_reason',
        'status',
        'gold_coins',
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
        'status',
        'gold_coins',
        "two_factor_secret",
        "two_factor_recovery_codes",
        "two_factor_confirmed_at"
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

    protected static function newFactory()
    {
        return \Modules\Seller\Database\factories\SellerFactory::new();
    }

    public function getSellerStatusAttribute()
    {
        return $this->status == 'active' ? 'حساب فعال' : 'حساب معطل';
    }

    public function store()
    {
        return $this->hasOne(Store::class);
    }
    public function topics()
    {
        return $this->morphMany(Topic::class, 'userable');
    }
}
