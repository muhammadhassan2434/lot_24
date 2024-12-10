<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class Account extends Model
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
}
