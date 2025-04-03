<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Http\Services\CartService;
use App\Http\Services\ProductService;
use App\Models\UserProduct;
use Illuminate\Support\Facades\Auth;

class CartController
{
    private ProductService  $productService;
    private CartService $cartService;

    public function __construct()
    {
        $this->productService = new ProductService();
        $this->cartService = new CartService();
    }

    public function cart()
    {
        $cartProducts = $this->cartService->getCart();

        if (empty($cartProducts)) {
            return redirect()->route('catalog');
        }
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
