<?php

namespace App\Http\Services;

use App\Mail\TestMail;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

class RabbitmqService
{
    private AMQPStreamConnection $connection;

    public function __construct()
    {
        $this->connection = new AMQPStreamConnection('rabbitmq', 5672, 'admin', 'admin');
    }
    public function produce(array $data, string $queueName)
    {
        $connection = $this->connection;
        $channel = $connection->channel();

        $channel->queue_declare('hello', false, false, false, false);

        $user = User::query()->find($data['user_id']);
        Mail::to($user->email)->send(new TestMail());

        $user = json_encode($data);
        $msg = new AMQPMessage($user);
        $channel->basic_publish($msg, '', $queueName);
        $channel->close();
    }

    public function consume(string $queueName, callable $callback)
    {
        $connection = $this->connection;
        $channel = $connection->channel();

        $channel->queue_declare($queueName, false, false, false, false);

        $channel->basic_consume($queueName, '', false, true, false, false, $callback);

        try {
            $channel->consume();
        } catch (\Exception $exception) {
            echo $exception->getMessage();
        }

        $channel->close();
    }
}
