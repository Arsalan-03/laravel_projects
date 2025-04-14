<?php

namespace App\Http\Controllers;

use App\Mail\TestMail;
use Illuminate\Support\Facades\Mail;
class TestMailController
{
    public function send()
    {
        $name = ['Arsalan'];

        Mail::to('buryatsambist03@gmail.com')->send(new TestMail());

        echo 'Письмо успешно отправлено на почту';
    }

    public function receive()
    {

    }
}
