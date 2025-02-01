<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Subscription extends Model
{
    use HasFactory;

    protected $fillable = [
        'plan_name',
        'Actual_Price',
        'Discount_Price',
        'plan_duration',
        'status'
    ];
    public function accounts()
    {
        return $this->hasMany(Account::class, 'subscription_id');
    }
    public function coupons()
{
    return $this->hasMany(Coupon::class);
}
}
