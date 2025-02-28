<?php

namespace Modules\Store\Entities;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Photo\Traits\HasPhoto;
use Modules\Seller\Entities\Seller;
use Modules\Store\Traits\HasScopes;

class Store extends Model
{
    use HasFactory, Sluggable, HasPhoto, HasScopes;

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

    protected $fillable = [
        'name',
        'slug',
        'description',
        'location',
        'is_accepted',
        'ban_at',
        'block_reason',
        'status',
        'rating',
        'level',
        'seller_id',
    ];

    public function seller()
    {
        return $this->belongsTo(Seller::class);
    }
    protected static function newFactory()
    {
        return \Modules\Store\Database\factories\StoreFactory::new();
    }

    public function getStatusArAttribute()
    {
        return $this->is_accepted ? $this->status == "active" ? "مفتوح" : "في إجازة":"معطل";
    }
}
