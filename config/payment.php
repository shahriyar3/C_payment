<?php

return [
    'currency' => env('PAYMENT_CURRENCY', 'IRT'),
    'ps_secret' => env('PS_SECRET', 'KEY5'),
    'return_url' => env('SERVER_HOST_URL', 'https://upcplay.com/'),
    'gateway_url' => env('GATEWAY_URL', 'https://panel.kenzopayment.com/'),
];
