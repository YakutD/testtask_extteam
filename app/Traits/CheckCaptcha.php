<?php

namespace App\Traits;

use Illuminate\Support\Facades\Config;

trait CheckCaptcha {
    function reCaptcha($token){
        $secret = Config::get('constants.captcha');

        $url = 'https://www.google.com/recaptcha/api/siteverify';
        $data = [
          'secret' => $secret,
          'response' => $token
        ];
        $options = [
          'http' => [
            'method' => 'POST',
            'header' => "Content-Type: application/x-www-form-urlencoded",
            'content' => http_build_query($data)
          ]
        ];
        $context  = stream_context_create($options);
        $verify = file_get_contents($url, false, $context);
        $captcha_success=json_decode($verify);
        if (!$captcha_success->success) {
            return false;
        } else {
            return true;
        }
    }
}