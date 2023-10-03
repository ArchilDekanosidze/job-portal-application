<?php
namespace App\Services\Notification\Providers;

use App\Models\User;
use App\Services\Notification\Exceptions\UserDoesNotHaveNumber;
use App\Services\Notification\Providers\Contracts\Provider;
use App\Services\Notification\Providers\SmsProviders\Contracts\SmsSender;

class SmsProvider implements Provider
{
    private $user;
    private $data;
    private $phone_number_column_name = 'phone';

    public function __construct(User $user, array $data)
    {
        $this->user = $user;
        $this->data = $data;
    }

    public function send()
    {
        $this->havePhoneNumber();
        $mobile = $this->user->{$this->phone_number_column_name};
        $smsProvider = new SmsSender($mobile, $this->data);
        $result = $smsProvider->send();
        return $result;
    }

    private function havePhoneNumber()
    {
        if (is_null($this->user->{$this->phone_number_column_name})) {
            throw new UserDoesNotHaveNumber();
        }
    }

}
