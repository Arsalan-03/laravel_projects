<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Http\Requests\ReviewRequest;
use App\Http\Services\ProductService;
use App\Http\Services\ReviewService;
use App\Models\Product;
use App\Models\Review;

class ProductController
{
    private ProductService $productService;
    private ReviewService $reviewService;

    public function __construct()
    {
        $this->productService = new ProductService();
        $this->reviewService = new ReviewService();
    }
    public function catalog()
    {
        $products = Product::all();
        return view('product.catalog', compact('products'));
    }

    public function getProduct(ProductRequest $request)
    {
        return $this->showProductWithReviews($request);
    }

    public function addReview(ReviewRequest $request)
    {
        $this->reviewService->addReview($request);
        return $this->showProductWithReviews($request);
    }

    public function addProduct(ProductRequest $request)
    {
        $this->productService->addProduct($request);
        return redirect()->route('catalog');
    }

    private function showProductWithReviews($request)
    {
        $productId = $request->input('product_id');
        $product = Product::query()->where('id', $productId)->first();
        $reviews = Review::query()->where('product_id', $productId)->get();

        return view('product.open', compact('product', 'reviews'));
    }

}
