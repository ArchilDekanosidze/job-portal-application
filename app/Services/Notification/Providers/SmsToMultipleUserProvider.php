<?php
namespace App\Services\Notification\Providers;

use App\Services\Notification\Exceptions\SomeUsersDoNotHaveNumber;
use App\Services\Notification\Providers\Contracts\Provider;
use App\Services\Notification\Providers\SmsProviders\Contracts\SmsSender;

class SmsToMultipleUserProvider implements Provider
{
    private $multipleUser;
    private $data;
    private $phone_number_column_name = 'phone';
    private $phone_numbers;

    public function __construct($multipleUser, array $data)
    {
        $this->multipleUser = $multipleUser;
        $this->data = $data;
        $this->phone_numbers = array();
    }

    public function send()
    {
        $this->havePhoneNumber();
        $this->CreateArrayNumber();
        $smsProvider = new SmsSender($this->phone_numbers, $this->data);
        $result = $smsProvider->send();
        return $result;

    }

    private function havePhoneNumber()
    {
        foreach ($this->multipleUser as $user) {
            if (is_null($user->{$this->phone_number_column_name})) {
                throw new SomeUsersDoNotHaveNumber();
            }
        }
    }

    private function CreateArrayNumber()
    {
        foreach ($this->multipleUser as $user) {
            $mobile = $user->{$this->phone_number_column_name};
            array_push($this->phone_numbers, $mobile);
        }
    }

}
