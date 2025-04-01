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
        if(Auth::check()) {
            $userId = Auth::id();
            $cartProducts = UserProduct::query()->where('user_id', $userId)->with('product')->get();

            return view('product.cart', compact('cartProducts'));
        } else {
            return redirect()->route('signIn');
        }
    }

    public function addToCart(ProductRequest $request)
    {
      if ($this->productService->addProduct($request) === true) {
          return redirect()->route('cart');
      } else {
          return redirect()->route('signIn');
      }
    }

    public function deleteToCart(ProductRequest $request)
    {
        if ($this->productService->deleteToCart($request) === true) {
            return redirect()->route('cart');
        } else {
            return redirect()->route('signIn');
        }
    }
}
