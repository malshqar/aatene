<?php

namespace Modules\HubConnect\Entities;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\HubConnect\Traits\TopicHasScopes;
use function PHPUnit\Framework\returnArgument;

class Topic extends Model
{
    use HasFactory, Sluggable, TopicHasScopes;

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
    protected $fillable = ['title', 'slug', 'content'];


    public function userable()
    {
        return $this->morphTo();
    }


    protected static function newFactory()
    {
        return \Modules\HubConnect\Database\factories\TopicFactory::new();
    }
}
