<?php

namespace App\Http\Services;

use App\Models\Review;
use Illuminate\Support\Facades\Auth;

class ReviewService
{
    public function addReview($request)
    {
        $validatedDate = $request->validated();
        $userId = Auth::id();
        $productId = $request->input('product_id');

        Review::query()->create([
            'user_id' => $userId,
            'product_id' => $productId,
            'rating' => $validatedDate['rating'],
            'author' => $validatedDate['author'],
            'content' => $validatedDate['content'],
        ]);

        return true;
    }
}
