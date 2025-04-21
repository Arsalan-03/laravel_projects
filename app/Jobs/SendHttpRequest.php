<?php

namespace App\Jobs;

use App\DTO\YougileTaskDto;
use App\Http\Services\Clients\YougileClient;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendHttpRequest implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public YougileTaskDto $dto;

    /**
     * Create a new job instance.
     */
    public function __construct(YougileTaskDto $dto)
    {
        $this->dto = $dto;
    }

    /**
     * Execute the job.
     */
    public function handle(YougileClient $client): void
    {
        // Пробуем отправить 3 раза с интервалом
        retry(3, function () use ($client) {
            $client->createTask($this->dto);
        }, 100); // 100 мс между попытками
    }
}
