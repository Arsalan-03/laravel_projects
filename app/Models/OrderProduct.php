<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class OrderProduct extends Model
{
    use Notifiable;

    protected $fillable = [
        'order_id', 'product_id', 'amount'
    ];
}
