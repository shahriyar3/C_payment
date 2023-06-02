<?php

namespace App\Services;

class PaymentAuthenticationService
{
    public function handle()
    {
        try {
            $client = new \GuzzleHttp\Client();
            $response = $client->post(
                config('payment.gateway_url') . 'api/auth/login',
                [
                    'headers' => [
                        'Content-Type' => 'application/json',
                        'Accept' => 'application/json',
                    ],
                    'json' => [
                        'access_key' => env('ACCESS_KEY'),
                        'secret_key' => env('SECRET_KEY'),
                    ],
                ]
            );
            $body = $response->getBody();
            $result = json_decode((string) $body);
            if ($result->status == 'Success') {
                return $result->data->token;
            }
            return false;
        } catch (\Throwable $exception) {
            return false;
        }
    }
}
