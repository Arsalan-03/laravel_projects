<?php

namespace App\Http\Services\Clients;

use App\DTO\YougileTaskDto;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Http;

class YougileClient
{
    private string $baseUrl;
    private string $apiKey;

    public function __construct()
    {
     $this->baseUrl = 'https://yougile.com/api-v2/';
     $this->apiKey = "REhsjeVSJIswZ+SNcMNY4OFIzwlA3wvIXvrVkuIlX4YmtERJG25Wjrp6Qg6AkwLC";
    }

    public function createTask(YougileTaskDto $dto): array
    {
        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->apiKey,
                'Content-Type' => 'application/json'
            ])->post($this->baseUrl . 'tasks', $dto->toArray())
                ->throw()
                ->json();

            if (!isset($response['id'])) {
                throw new \RuntimeException('YouGile: Некорректный ответ (нет ID задачи)');
            }

            return $response;
        } catch (RequestException $e) {
            throw new \RuntimeException("Ошибка HTTP-запроса в YouGile: {$e->getMessage()}", 500);
        }
    }

}
