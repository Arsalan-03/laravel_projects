<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Http\Services\ProductService;
use App\Models\Product;
use App\Models\UserProduct;
use Illuminate\Support\Facades\Auth;

class ProductController
{
    private ProductService $productService;

    public function __construct()
    {
        $this->productService = new ProductService();
    }
    public function catalog()
    {
        if (Auth::check()) {
            $products = Product::all();
            return view('product.catalog', compact('products'));
        } else {
            return redirect()->route('catalog');
        }
    }

    public function addProduct(ProductRequest $request)
    {
        if ($this->productService->addProduct($request) === true) {
            return redirect()->route('catalog');
        } else {
            return redirect()->route('signIn');
        }
    }
}
