<?php

namespace Modules\HubConnect\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\HubConnect\Traits\FaqsHasScopes;

class Faqs extends Model
{
    use HasFactory, FaqsHasScopes;

    protected $table = 'faqs';
    protected $fillable = ['question','answer','category_id'];

    public function category()
    {
        return $this->belongsTo(FaqCategory::class);
    }
    
    protected static function newFactory()
    {
        return \Modules\HubConnect\Database\factories\FaqsFactory::new();
    }
}
