<?php

namespace App\Services;

class PaymentCreateService
{
    public function handle($payment, $token)
    {
        try {
            $client = new \GuzzleHttp\Client();
            $response = $client->post(
                'https://panel.kenzopayment.com/api/shops/payments',
                [
                    'headers' => [
                        'Authorization' => 'Bearer ' . $token,
                        'Content-Type' => 'application/json',
                        'Accept' => 'application/json',
                    ],
                    'json' => [
                        'user_id' => (string)$payment->user_id,
                        'callback_url' => env('PAYMENT_CALLBACK_URL'),
                        'order_id' => $payment->payment_id,
                        'username' => $payment->user_name,
                        'amount' => $payment->amount,
                    ],
                ]
            );
            $body = $response->getBody();
            $result = json_decode((string)$body);
            if ($result->status == 'Success') {
                return $result->data;
            }
            return false;
        } catch (\Throwable $exception) {
            return false;
        }
    }
}
