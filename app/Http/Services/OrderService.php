<?php

namespace App\Http\Services;

use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\UserProduct;
use Illuminate\Support\Facades\Auth;

class OrderService
{
    private CartService $cartService;
    private LoggerService $loggerService;

    public function __construct()
    {
        $this->cartService = new CartService();
        $this->loggerService = new LoggerService();
    }
    public function createOrder($validatedData)
    {
        $userId = Auth::id();
        try {
            Order::query()->create([
                'user_id' => $userId,
                'email' => $validatedData['email'],
                'phone' => $validatedData['phone'],
                'name' => $validatedData['name'],
                'address' => $validatedData['address'],
                'city' => $validatedData['city'],
                'country' => $validatedData['country'],
                'postcode' => $validatedData['postcode'],
            ]);

            $userProducts = $this->cartService->getCart();
            $orderId = Order::query()->latest()->first()->id;

            foreach ($userProducts as $userProduct) {
                OrderProduct::query()->create([
                    'order_id' => $orderId,
                    'product_id' => $userProduct::query()->where('product_id', $userProduct->product_id)->first()->id,
                    'amount' => $userProduct::query()->where('product_id', $userProduct->product_id)->first()->amount,
                ]);
            }

            UserProduct::query()->delete();
        } catch (\Exception $exception) {
            $this->loggerService->errors($exception);
            return response()->view('errors.505', [], 500);
        }
        return true;
    }
}
