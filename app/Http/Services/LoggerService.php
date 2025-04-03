<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\Log;

class LoggerService
{
    public function errors($exception)
    {
        $errorMessage = sprintf(
            "[%s] Ошибка: %s в %s на строке %d. Код: %d\n",
            date('Y-m-d H:i:s'), // Дата и время
            $exception->getMessage(), // Сообщение об ошибке
            $exception->getFile(), // Файл, где произошла ошибка
            $exception->getLine(), // Строка, где произошла ошибка
            $exception->getCode() // Код ошибки
        );

        Log::error($errorMessage);
    }
}
