<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Account extends Authenticatable
{
    use HasFactory , HasApiTokens;
    protected $table = 'accounts';

    // Fields that can be mass-assigned
    protected $fillable = [
        'name',
        'surname',
        'email',
        'password',
        'phone_number',
        'country',
        'role',
        'subscription_id',
        'coupon_code',
    ];

    // Hide sensitive fields in JSON responses
    protected $hidden = [
        'password',
    ];

    /**
     * Relationship: An account may have one invoice.
     */
    public function invoice()
    {
        return $this->hasOne(Invoice::class, 'account_id');
    }
    public function subscription()
{
    return $this->belongsTo(Subscription::class, 'subscription_id');
}

public function messages() {
    return $this->hasMany(Message::class, 'sender_id');
}
public function coupon()
{
    return $this->belongsTo(Coupon::class);
}
}
