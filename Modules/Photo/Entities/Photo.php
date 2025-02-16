<?php

namespace Modules\Photo\Entities;

use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Photo\Observers\PhotoObserver;

#[ObservedBy([PhotoObserver::class])]
class Photo extends Model
{
    use HasFactory;

    protected $fillable = ['src', 'type', 'slug'];
    public function photoable()
    {
        return $this->morphTo();
    }

}
