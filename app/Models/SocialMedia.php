<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SocialMedia extends Model
{
    protected $table = 'socialmedias';
    protected $fillable = ['title', 'link'];
}
