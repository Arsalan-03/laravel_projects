<?php

namespace App\Jobs;

use App\DTO\YougileTaskDto;
use App\Http\Services\Clients\YougileClient;
use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendHttpRequest implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private YougileTaskDto $dto;
    private int $orderId;

    public function __construct(YougileTaskDto $dto, int $orderId)
    {
        $this->dto = $dto;
        $this->orderId = $orderId;
    }

    public function handle(): void
    {
        $client = new YougileClient();
        $response = $client->createTask($this->dto);

        if (!empty($response['id'])) {
            Order::where('id', $this->orderId)
                ->update(['yougile_task_id' => $response['id']]);
        }
    }
}

