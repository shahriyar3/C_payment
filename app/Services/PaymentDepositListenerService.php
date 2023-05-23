<?php

namespace App\Services;

class PaymentDepositListenerService
{
    public function handle($payment)
    {
        try {
            $client = new \GuzzleHttp\Client();

            $response = $client->post(
                env('SERVER_HOST_URL') . 'v1/deposit_api_listener',
                [
                    'headers' => [
                        'Content-Type' => 'application/json',
                        'Accept' => 'application/json',
                    ],
                    'json' => [
                        'token' => $this->trimToken($payment->token),
                        "amount" => $payment->amount,
                        "currency" => config("payment.currency"),
                        "comment" => "some_comment",
                        "payment_id" => $payment->payment_id,
                        "checksum" => $this->make_hash($payment)
                    ],
                ]
            );

            return $response;
        } catch (\Throwable $exception) {
            return $exception->getMessage();
        }
    }

    private function make_hash($payment)
    {
        $string = $this->trimToken($payment->token);
        $keys = "{$payment->payment_id}|{$payment->amount}|" . config("payment.currency") . "|some_comment|{$string}";
        $hash = hash_hmac('sha256', $keys, config('payment.ps_secret'));

        return $hash;
    }

    private function trimToken($token)
    {
        $my_string = trim(preg_replace('/\s\s+/', ' ', $token));
        $string = str_replace("\n", "", $my_string);
        $string = str_replace("\r", "", $string);
        $string = str_replace(" ", "", $string);
        return $string;
    }

}
