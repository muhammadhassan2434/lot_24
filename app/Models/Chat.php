<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
 // In Chat model
protected $fillable = ['buyer_id', 'seller_id', 'message'];
}
