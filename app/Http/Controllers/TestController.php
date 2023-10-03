<?php

namespace App\Http\Controllers;

use App\Jobs\Notification\SendEmail;
use App\Jobs\Notification\SendSmsWithNumber;
use App\Mail\UserRegistered;
use App\Models\User;
use App\Services\Notification\Providers\SmsProviders\Contracts\SmsTypes;

class TestController extends Controller
{
    public function testEmail()
    {
        $user = User::find(1);
        $mailable = new UserRegistered();
        SendEmail::dispatch($user, $mailable);
    }

    public function testSms()
    {
        $data = [
            'type' => SmsTypes::VERIFICATION_CODE,
            'variables' => ['verificationCode' => '2'],
        ];
        SendSmsWithNumber::dispatchSync(['09120919921'], $data);return;
    }

}
