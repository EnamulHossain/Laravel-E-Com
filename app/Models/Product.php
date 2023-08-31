<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'subcategory_id',
        'childcategory_id',
        'brand_id',
        'pickup_points_id',
        'name',
        'slug',
        'code',
        'unit',
        'tags',
        'video',
        'color',
        'size',
        'purchase_price',
        'sell_price',
        'discount_price',
        'quantity',
        'stock',
        'description',
        'thumbnail',
        'images',
        'feature',
        'today_deal',
        'status',
        'sku',
        'flash_deal_id',
        'cash_on_delivery',
        'warehouse',
        'admin_id',
    ];

    protected $casts = [
        'tags' => 'array',
        'feature' => 'boolean',
        'today_deal' => 'boolean',
        'status' => 'boolean',
        'cash_on_delivery' => 'boolean',
    ];


    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class, 'subcategory_id');
    }

    public function childcategory()
    {
        return $this->belongsTo(Childcategory::class, 'childcategory_id');
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }

    public function pickupPoint()
    {
        return $this->belongsTo(PickupPoint::class, 'pickup_points_id');
    }

    public function flashDeal()
    {
        return $this->belongsTo(FlashDeal::class, 'flash_deal_id');
    }

    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }
}
