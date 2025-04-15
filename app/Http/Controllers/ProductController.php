<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Http\Requests\ReviewRequest;
use App\Http\Services\ProductService;
use App\Http\Services\ReviewService;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Request;

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

    public function index()
    {
        $products = Cache::remember('products_all', 3600, function () {
            return Product::all();
        });

        return view('products.index', compact('products'));
    }

    public function store(Request $request)
    {
        Product::create($request->all());
        Cache::forget('products_all');

        return redirect()->route('products.index')
            ->with('success', 'Продукт создан и кэш сброшен');
    }

    public function update(Request $request, Product $product)
    {
        $product->update($request->all());
        Cache::forget('products_all');

        return redirect()->route('products.index')
            ->with('success', 'Продукт обновлён и кэш сброшен');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        Cache::forget('products_all');

        return redirect()->route('products.index')
            ->with('success', 'Продукт удалён и кэш сброшен');
    }
}
