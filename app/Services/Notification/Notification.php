<?php
namespace App\Services\Notification;

use App\Services\Notification\Providers\Contracts\Provider;

/**
 * @method sendSms(User $user, String $text)
 * @method sendEmail(User $user, Mailable $mailable)
 */

class Notification
{
    public function __call($method, $arguments)
    {
        $providerPath = __NAMESPACE__ . "\Providers\\" . substr($method, 4) . 'Provider';
        if (!\class_exists($providerPath)) {
            throw new \Exception("Class does not exist");
        }
        $providerInstance = new $providerPath(...$arguments);
        if (!is_subclass_of($providerInstance, Provider::class)) {
            throw new \Exception("Class must Implements Provider");
        }
        return $providerInstance->send();
    }
}
