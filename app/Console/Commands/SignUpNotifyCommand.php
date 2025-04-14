<?php

namespace App\Console\Commands;

use App\Http\Services\RabbitmqService;
use App\Mail\TestMail;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use PhpAmqpLib\Connection\AMQPStreamConnection;

class SignUpNotifyCommand extends Command
{
    private RabbitmqService $rabbitmqService;

    public function __construct(RabbitmqService $rabbitmqService)
    {
        parent::__construct();
        $this->rabbitmqService = $rabbitmqService;
    }
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:sign-up-notify-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $callback = function ($msg) {
            $data = $msg->body;
            $data = json_decode($data, true);
            $user = User::query()->find($data['user_id']);
            Mail::to($user->email)->send(new TestMail());
        };

        echo 'wait..';

        $this->rabbitmqService->consume('sign-up_email', $callback);
    }
}
