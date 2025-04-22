<?php

namespace App\Console\Commands;

use App\Models\Order;
use App\DTO\YougileTaskDto;
use App\Http\Services\Clients\YougileClient;
use Illuminate\Console\Command;

class CreateYougileTask extends Command
{
    protected $signature = 'yougile:create-tasks';
    protected $description = 'Создаёт задачи в Yougile для заказов, у которых отсутствует yougile_task_id';

    public function handle(YougileClient $client): int
    {
        $orders = Order::whereNull('yougile_task_id')->get();

        if ($orders->isEmpty()) { //проверяю, есть ли вообще заказы, у которых отсутствует yougile_task_id
            $this->info('Нет заказов без задачи в Yougile.');
            return self::SUCCESS;
        }

        foreach ($orders as $order) { //перебираю каждый заказ из списка
            try {
                $dto = new YougileTaskDto( //ля каждого заказа создаю новый DTO
                    orderId: $order->id,
                    description: $order->comment ?? 'Нет описания'
                );

                $task = $client->createTask($dto);

                if (!empty($task['id'])) {
                    $order->yougile_task_id = $task['id'];
                    $order->save();

                    $this->info("Задача для заказа #{$order->id} успешно создана.");
                } else {
                    $this->warn("Не удалось создать задачу для заказа #{$order->id}.");
                }

            } catch (\Throwable $e) {
                $this->error("Ошибка при создании задачи для заказа #{$order->id}: " . $e->getMessage());
            }
        }

        return self::SUCCESS;
    }
}

