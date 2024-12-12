<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'title',
        'description',
        'category_id',
        'regular_price',
        'sale_price',
        'wholesale_price',
        'badges',
        'minimal_order',
        'product_stock',
        'stock_status',
        'sku',
        'ean',
        'country_id',
        'tags',
        'payment_option',
        'delivery_option',
    ];

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }
    public function category()
{
    return $this->belongsTo(Category::class);
}

public function country()
{
    return $this->belongsTo(Country::class);
}
public function brand()
{
    return $this->belongsTo(Brand::class, 'brand_id');
}
public function subcategories()
{
    return $this->belongsTo(Subcategory::class);
}

public function seller(){
    return $this->belongsTo(Account::class,'seller_id');
}
}
