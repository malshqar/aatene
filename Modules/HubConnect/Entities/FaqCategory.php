<?php

namespace Modules\HubConnect\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FaqCategory extends Model
{
    use HasFactory;

    protected $table = 'faq_categories';

    protected $fillable = ['name'];

    public function faqs()
    {
        return $this->hasMany(Faqs::class);
    }
    
    protected static function newFactory()
    {
        return \Modules\HubConnect\Database\factories\FaqCategoryFactory::new();
    }
}
