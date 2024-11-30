<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    // Specify the table name


    protected $fillable=['name','slug','image','status'];

    public function subcategories()
    {
        return $this->hasMany(Subcategory::class,'category_id', 'id');
    }

    public function products()
{
    return $this->hasMany(Product::class);
}
}
