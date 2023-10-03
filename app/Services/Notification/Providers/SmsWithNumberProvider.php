<?php
namespace App\Services\Notification\Providers;

use App\Services\Notification\Providers\Contracts\Provider;
use App\Services\Notification\Providers\SmsProviders\Contracts\SmsSender;

class SmsWithNumberProvider implements Provider
{
    private $phone_numbers;
    private $data;

    public function __construct($phone_numbers, array $data)
    {
        $this->phone_numbers = $phone_numbers;
        $this->data = $data;
    }

    public function send()
    {
        $smsProvider = new SmsSender($this->phone_numbers, $this->data);
        $result = $smsProvider->send();
        return $result;
    }

}
