<?php

namespace Modules\HubConnect\Entities;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Photo\Traits\HasPhoto;
use Spatie\Tags\HasTags;

class JobAds extends Model
{
    use HasFactory,Sluggable,HasPhoto,HasTags;
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


    protected $fillable = [
        'title',
        'slug',
        'description',
        'location',
        'salary',
        'company',
        'type',
        'place',
        'deadline',
    ];

    protected static function newFactory()
    {
        return \Modules\HubConnect\Database\factories\JobAdsFactory::new();
    }
}
