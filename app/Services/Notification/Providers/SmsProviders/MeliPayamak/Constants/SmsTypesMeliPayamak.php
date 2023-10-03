<?php
namespace App\Services\Notification\Providers\SmsProviders\MeliPayamak\Constants;

use App\Services\Notification\Providers\SmsProviders\Contracts\SmsTypes;

class SmsTypesMeliPayamak implements SmsTypes
{
    public static function toPatternCode($type)
    {
        try {
            return [
                self::VERIFICATION_CODE => '164887',
                self::VERIFICATION_CODE_NAME => '164904',
            ][$type];
        } catch (\Throwable $th) {
            throw new \InvalidArgumentException('Patern Type  does not exist');
        }
    }
}
