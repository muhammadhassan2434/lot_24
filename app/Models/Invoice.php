<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;
    protected $table = 'invoices';

    // Fields that can be mass-assigned
    protected $fillable = [
        'account_id',
        'company',
        'eu_tax_number',
        'street_unit',
        'postal_code',
        'city',
    ];

    /**
     * Relationship: An invoice belongs to an account.
     */
    public function account()
    {
        return $this->belongsTo(Account::class, 'account_id');
    }
}
