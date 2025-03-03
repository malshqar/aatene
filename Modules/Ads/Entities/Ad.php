<?php

namespace Modules\Ads\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Ads\Traits\HasScopes;
use Modules\Photo\Traits\HasPhoto;

class Ad extends Model
{
    use HasFactory, HasPhoto, HasScopes;

    protected $fillable = ['url', 'start_at', 'end_at', 'name', 'priority'];

    protected $casts = [
        'start_at' => 'date',
        'end_at' => 'date',
    ];

    protected static function newFactory()
    {
        return \Modules\Ads\Database\factories\AdFactory::new();
    }
}
