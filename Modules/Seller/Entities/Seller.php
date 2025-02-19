<?php

namespace Modules\Seller\Entities;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Modules\Photo\Traits\HasPhoto;
use Modules\Seller\Traits\HasScopes;

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
        'gold_coins'
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
    
}
