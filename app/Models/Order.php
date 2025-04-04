<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Order extends Model
{
    use Notifiable;

    protected $fillable = [
        'user_id',
        'email',
        'phone',
        'name',
        'address',
        'city',
        'country',
        'postcode'
    ];
}
