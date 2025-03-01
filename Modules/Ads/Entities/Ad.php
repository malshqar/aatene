<?php

namespace Modules\Ads\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Photo\Traits\HasPhoto;

class Ad extends Model
{
    use HasFactory ,HasPhoto;

    protected $fillable = ['url','start_at','end_at'];
    
    protected static function newFactory()
    {
        return \Modules\Ads\Database\factories\AdFactory::new();
    }
}
