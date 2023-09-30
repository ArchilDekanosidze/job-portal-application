<?php
namespace App\Services\Notification\Providers;

use App\Models\User;
use App\Services\Notification\Exceptions\UserDoesNotHaveNumber;
use App\Services\Notification\Providers\Contracts\Provider;
use GuzzleHttp\Client;

class SmsProvider implements Provider
{
    private $user;
    private $text;
    public function __construct(User $user, String $text)
    {
        $this->user = $user;
        $this->text = $text;
    }

    public function send()
    {
        $this->havePhoneNumber();
        $mobile = $this->user->phone_number;
        $client = new Client();
        $input_data = array("verification-code" => $this->text);
        $url = $this->prepareUrlForSms($this->text, $mobile, $input_data);
        $response = $client->post($url, $input_data);
        return $response->getBody();
    }

    private function prepareUrlForSms(String $text, String $mobile, $input_data)
    {
        $username = config('services.sms.auth.uname');
        $password = config('services.sms.auth.pass');
        $from = config('services.sms.auth.from');
        $pattern_code = config('services.sms.patterns.verification');
        $to = array($mobile);
        $baseUri = config('services.sms.baseUri');
        $url = $baseUri . $username . "&password=" . urlencode($password) . "&from=$from&to=" . json_encode($to) . "&input_data=" . urlencode(json_encode($input_data)) . "&pattern_code=$pattern_code";
        return $url;
    }

    private function havePhoneNumber()
    {
        if (is_null($this->user->phone_number)) {
            throw new UserDoesNotHaveNumber();
        }
    }

}
