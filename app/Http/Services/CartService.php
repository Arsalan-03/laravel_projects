<?php

namespace App\Http\Services;

use App\Models\UserProduct;
use Illuminate\Support\Facades\Auth;

class CartService
{
    public function getCart()
    {
        $userId = Auth::id();
        return UserProduct::query()->where('user_id', $userId)->with('product')->get();
    }
}
