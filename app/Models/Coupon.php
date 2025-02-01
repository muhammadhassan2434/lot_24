<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $fillable=['code','discount','discount_type','influencer_id','expiry_date','status'];

    public function influencer()
    {
        return $this->belongsTo(Influencer::class, 'influencer_id', 'id');
    }
    public function subscription()
{
    return $this->belongsTo(Subscription::class);
}
}