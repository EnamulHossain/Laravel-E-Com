<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChildCategory extends Model
{
    use HasFactory;
    protected $table = 'child_categories';

    protected $fillable = [
        'category_id',
        'subcategory_id',
        'child_category_name',
        'child_category_slug',
    ];

    public function subcategory()
    {
        return $this->belongsTo(SubCategory::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

}
