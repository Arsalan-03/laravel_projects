<?php

namespace App\Http\Services;

use App\Jobs\SendHttpRequest;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\UserProduct;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
        DB::beginTransaction();
        $userId = Auth::id();

        try {
            $order = Order::create([
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

            $description = $this->generateDescription($order, $userProducts);

            UserProduct::where('user_id', $userId)->delete();

            $dto = new \App\DTO\YougileTaskDto($order->id, $description);
            SendHttpRequest::dispatch($dto);

            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            $this->loggerService->errors($exception);
            return response()->view('errors.505', [], 500);
        }

        return true;
    }

    private function generateDescription($order, $userProducts): string
    {
        $description = "Имя: {$order->name} <br>"
            . "Адрес: {$order->address} <br>"
            . "Телефон: {$order->phone} <br>"
            . "Список товаров: <br>";

        foreach ($userProducts as $userProduct) {
            $description .= "- Товар #{$userProduct->product_id}, количество: {$userProduct->amount} <br>";
        }

        return $description;
    }
}

