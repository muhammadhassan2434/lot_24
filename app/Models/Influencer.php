<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Influencer extends Model
{
    protected $fillable=['name','email','designation'];


    public function coupons()
    {
        return $this->hasMany(Coupon::class,'coupon_id', 'id');
    }
}