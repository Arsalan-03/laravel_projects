<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Http\Services\ProductService;
use App\Models\Product;

class ProductController
{
    private ProductService $productService;

    public function __construct()
    {
        $this->productService = new ProductService();
    }
    public function catalog()
    {
        $products = Product::all();
        return view('product.catalog', compact('products'));
    }

    public function addProduct(ProductRequest $request)
    {
        $this->productService->addProduct($request);
        return redirect()->route('catalog');
    }
}
