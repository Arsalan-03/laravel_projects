<?php

namespace App\DTO;

class YougileTaskDto
{
    public int $orderId;
    public string $columnId;
    public string $description;
    public bool $archived;
    public bool $completed;

    public function __construct(int $orderId, string $description)
    {
        $this->orderId = $orderId;
        $this->description = $description;
        $this->columnId = "58220088-73a3-49b6-ab0b-fca8d258e059";
        $this->archived = false;
        $this->completed = false;
    }

    public function toArray(): array
    {
        return [
            'title' => 'заказ #' . $this->orderId,
            'columnId' => $this->columnId,
            'description' => $this->description,
            'archived' => $this->archived,
            'completed' => $this->completed,
        ];
    }
}

