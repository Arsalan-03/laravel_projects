<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Http\Services\ProductService;
use App\Models\UserProduct;
use Illuminate\Support\Facades\Auth;

class CartController
{
    private ProductService  $productService;

    public function __construct()
    {
        $this->productService = new ProductService();
    }

    public function cart()
    {
        $userId = Auth::id();
        $cartProducts = UserProduct::query()->where('user_id', $userId)->with('product')->get();

        return view('product.cart', compact('cartProducts'));
    }

    public function addToCart(ProductRequest $request)
    {
      $this->productService->addProduct($request);
      return redirect()->route('cart');
    }

    public function deleteToCart(ProductRequest $request)
    {
        $this->productService->deleteToCart($request);
        return redirect()->route('cart');
    }
}
