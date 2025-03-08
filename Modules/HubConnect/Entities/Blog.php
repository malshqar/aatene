<?php

namespace Modules\HubConnect\Entities;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Admin\Entities\Admin;
use Modules\HubConnect\Traits\BlogHasScopes;
use Modules\Photo\Traits\HasPhoto;
use Spatie\Tags\HasTags;

class Blog extends Model
{
    use HasFactory, BlogHasScopes, HasPhoto, Sluggable, HasTags;

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
        'writer',
        'content',
        'is_published',
        'admin_id',
    ];

    protected static function newFactory()
    {
        return \Modules\HubConnect\Database\factories\BlogFactory::new();
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }
    public function getStatusAttribute()
    {
        return $this->attributes['is_published'] ? __("تم النشر") : __("مؤرشف");
    }
}
