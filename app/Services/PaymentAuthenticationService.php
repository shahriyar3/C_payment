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
                        'access_key' => config('payment.access_key'),
                        'secret_key' => config('payment.secret_key'),
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
            Log::alert('authentication failed -------------------       ' . config('payment.access_key'));
            Log::alert('authentication failed -------------------       ' . config('payment.secret_key'));
            return false;
        }
    }
}
