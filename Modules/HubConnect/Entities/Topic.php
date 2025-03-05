<?php

namespace Modules\HubConnect\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Topic extends Model
{
    use HasFactory;

    protected $fillable = [];
    
    
    protected static function newFactory()
    {
        return \Modules\HubConnect\Database\factories\TopicFactory::new();
    }
}
