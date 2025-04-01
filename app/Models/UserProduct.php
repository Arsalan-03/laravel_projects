<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;

class UserProduct extends \Illuminate\Foundation\Auth\User
{
    use Notifiable;

    protected $fillable = [
        'user_id',
        'product_id',
        'amount'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
