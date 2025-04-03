<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Review extends Model
{
    use Notifiable;

    protected $fillable = [
        'user_id',
        'product_id',
        'rating',
        'author',
        'content'
    ];
}
