<?php

namespace Modules\Photo\Entities;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Photo\Observers\PhotoObserver;

#[ObservedBy([PhotoObserver::class])]
class Photo extends Model
{
    use HasFactory,Sluggable;
    
        /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }


    protected $fillable = ['src', 'type', 'slug'];
    public function photoable()
    {
        return $this->morphTo();
    }

}
