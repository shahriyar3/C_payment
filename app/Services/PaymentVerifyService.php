<?php

namespace App\Services;

class PaymentVerifyService
{
    public function handle($token)
    {
        try {
            $client = new \GuzzleHttp\Client();
            $response = $client->get(
                'https://panel.kenzopayment.com/api/shops/payments/' . request('payId') . '/verify',
                [
                    'headers' => [
                        'Authorization' => 'Bearer ' . $token,
                        'Content-Type' => 'application/json',
                        'Accept' => 'application/json',
                    ],
                ]
            );
            if ($response->getStatusCode() != 200 or $response->getStatusCode() != 201) {
                return false;
            }

            $body = $response->getBody();
            $result = json_decode((string)$body);
            return $result->data;

        } catch (\Throwable $exception) {
            return false;
        }
    }
}
