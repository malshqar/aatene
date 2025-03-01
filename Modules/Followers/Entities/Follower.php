<?php

namespace Modules\Followers\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Follower extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','store_id'];
    
    protected static function newFactory()
    {
        return \Modules\Followers\Database\factories\FollowerFactory::new();
    }
}
