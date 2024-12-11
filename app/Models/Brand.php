<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;

    // Specify the table name


    protected $fillable=['image','name','slug','status'];

    public function products()
{
    return $this->hasMany(Product::class);
}


}
