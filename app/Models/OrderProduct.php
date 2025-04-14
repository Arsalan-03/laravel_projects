<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class OrderProduct extends \Illuminate\Foundation\Auth\User
{
    use Notifiable;

    protected $fillable = [
        'order_id', 'product_id', 'amount'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
