<?php

namespace App\Http\Controllers;

use App\Jobs\SendSignUpEmailJob;
use Illuminate\Http\Request;

class MailTestController extends Controller
{
    public function send(Request $request)
    {
        $email = $request->input('email', 'youremail@example.com');

        SendSignUpEmailJob::dispatch($email);

        return response()->json([
            'message' => 'Письмо отправлено в очередь!',
            'email' => $email,
        ]);
    }
}
