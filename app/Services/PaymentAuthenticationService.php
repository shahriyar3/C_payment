<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;

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
            Log::log('authentication failed -------------------       ' . env('ACCESS_KEY'));
            Log::log('authentication failed -------------------       ' . env('SECRET_KEY'));
            return false;
        }
    }
}
