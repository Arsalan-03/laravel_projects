<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Http\Requests\ProductRequest;
use App\Http\Services\CartService;
use App\Http\Services\OrderService;
use App\Http\Services\ProductService;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class OrderController
{
    private CartService $cartService;
    private OrderService $orderService;
    private ProductService $productService;

    public function __construct()
    {
        $this->cartService = new CartService();
        $this->orderService = new OrderService();
        $this->productService = new ProductService();
    }

    public function order()
    {
        $orderProducts = $this->cartService->getCart();
        return view('userProduct.order', compact('orderProducts'));
    }

    public function postOrder(OrderRequest $request)
    {
     $validatedData = $request->validated();
     $this->orderService->createOrder($validatedData);

     return redirect()->route('catalog');
    }

    public function addToOrder(ProductRequest $request)
    {
        $this->productService->addProduct($request);
        return redirect()->route('order');
    }

    public function deleteToOrder(ProductRequest $request)
    {
        $this->productService->deleteToCart($request);
        return redirect()->route('order');
    }

    public function myOrders(OrderRequest $request)
    {
        $orderId = $request->input('id');
        $userOrders = Order::query()->where('order_id', $orderId)->get();

        return view('userProduct.myOrders', compact('userOrders'));
    }
}
