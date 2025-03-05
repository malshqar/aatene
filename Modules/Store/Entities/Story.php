<?php

namespace Modules\Store\Entities;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Modules\Photo\Traits\HasPhoto;
use Spatie\Tags\HasTags;

class Story extends Model
{
    use HasFactory, HasPhoto, Sluggable;

    
    protected $casts = [
        'views' => 'array',
        'reactions' => 'array'
    ];

    protected $hidden = [
        'views',
    ];
    protected $appends = [
        'seen',
        'views_count'
    ];

    protected $fillable = [
        'title',
        'caption',
        'content',
        'store_id',
        'views',
        'status',
        'expiration',
        'reactions',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($story) {
            $story->expiration = Carbon::now()->addDay();
        });
    }
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

    public function store()
    {
        return $this->belongsTo(Store::class);
    }


    public function getSeenAttribute()
    {
        $userId = Auth::id();
        $views = $this->views ?? [];
        if (in_array($userId, $views)) {
            return true;
        }
        return false;
    }
    public function getViewsCountAttribute()
    {
        return count($this->views ?? []);

    }

    protected static function newFactory()
    {
        return \Modules\Store\Database\factories\StoryFactory::new();
    }



}
