<?php

return [
    'currency' => env('PAYMENT_CURRENCY', 'IRT'),
    'ps_secret' => env('PS_SECRET', 'KEY5'),
    'return_url' => env('SERVER_HOST_URL', 'https://upcplay.com/'),
    'gateway_url' => env('GATEWAY_URL', 'https://panel.kenzopayment.com/'),
    'access_key' => env('ACCESS_KEY', 'e30fa252eec7d754c7bc8599e3fde4ab98ed0383'),
    'secret_key' => env('SECRET_KEY', '$2y$10$/UeCKAbreEFkC8gu19N91ex8h/ZS37JFdBKweTP4E.emFrCWq.LhW'),
    'callback_url' => env('PAYMENT_CALLBACK_URL', 'https://depositupc.com/payment/callback')
];
