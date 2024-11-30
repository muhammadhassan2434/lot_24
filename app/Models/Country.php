<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'iso_code', 'dail_code', 'currency', 'currency_symbol', 'time_zone', 'region', 'status',
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
