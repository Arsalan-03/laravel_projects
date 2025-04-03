<?php

namespace App\Http\Services;

use App\Models\Product;
use App\Models\Review;
use App\Models\UserProduct;
use Illuminate\Support\Facades\Auth;

class ProductService
{
    public function addProduct($request): bool
    {
        $validatedData = $request->validated();
        $user = Auth::user();

        $cartItem = UserProduct::query()->where('product_id', $validatedData['product_id'])->first();

        if ($cartItem) {
            $cartItem->amount = $cartItem->amount + 1;
            $cartItem->save();
        } else {
            UserProduct::query()->create([
                'user_id' => $user->getAuthIdentifier(),
                'product_id' => $validatedData['product_id'],
                'amount' => $validatedData['amount'],
            ]);
        }
        return true;
    }

    public function deleteToCart($request): bool
    {
        $validatedData = $request->validated();

        $cartItem = UserProduct::query()->where('product_id', $validatedData['product_id'])->first();

        if ($cartItem) {
            $cartItem->amount = $cartItem->amount - 1;
            $cartItem->save();
        }

        return true;
    }
}

