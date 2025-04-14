<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Http\Requests\ProductRequest;
use App\Http\Services\CartService;
use App\Http\Services\OrderService;
use App\Http\Services\ProductService;
use App\Models\Order;
use App\Models\OrderProduct;
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

    public function myOrders()
    {
        $userId = Auth::id();
        $orders = Order::query()->where('user_id', $userId)->get();
        return view('userProduct.myOrders', compact('orders'));
    }

    public function userOrders()
    {
        $userId = Auth::id();
        $orderId = $_GET['id'];
        $user = Order::query()->where('user_id', $userId)->get();
        $userOrders = OrderProduct::query()->where('order_id', $orderId)->with('product')->get();

        return view('userProduct.userOrders', compact( 'user', 'userOrders'));
    }
}
