<?php

namespace Modules\Store\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Photo\Traits\HasPhoto;
use Spatie\Tags\HasTags;

class Group extends Model
{
    use HasFactory,HasPhoto,HasTags;

    protected $fillable = ['name'];
    
    public $timestamps = false;
     
    public function stores()
    {
        return $this->belongsToMany(Store::class, 'store_group');
    }

    protected static function newFactory()
    {
        return \Modules\Store\Database\factories\GroupFactory::new();
    }
}
