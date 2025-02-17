<?php

namespace Modules\Admin\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Modules\Admin\Traits\HasScopes;
use Modules\Photo\Traits\HasPhoto;
use Spatie\Permission\Traits\HasRoles;


class Admin extends User
{
    use HasFactory, HasApiTokens,  HasRoles, HasPhoto, Notifiable, HasScopes;

    protected $fillable = [
        'name',
        'email',
        'password',
        'phone_number',
        'role_name',
        'status',
        'last_active_at',
    ];


    protected static function newFactory()
    {
        return \Modules\Admin\Database\factories\AdminFactory::new();
    }

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
        'role_name' => 'array',
    ];

    public function getAdminStatusAttribute()
    {
        return $this->status == 'active' ? 'حساب فعال' : 'حساب معطل';
    }

}
