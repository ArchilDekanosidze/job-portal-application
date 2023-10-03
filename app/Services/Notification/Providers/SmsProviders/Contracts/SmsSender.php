<?php
namespace App\Services\Notification\Providers\SmsProviders\Contracts;

use App\Services\Notification\Providers\SmsProviders\MeliPayamak\MeliPayamak;

class SmsSender extends MeliPayamak
{
    const SENT_Failed = 'failed';
    const SENT_SUCCESS = 'success';
}
