<?php
return [
    'authkey' => env('VODAPAY_AUTHKEY', 'Bt251gR0ktYGx2J'),
    'privatekey' => env('VODAPAY_PRIVATEKEY', '1hdFmZZCShj2dV8Ry2PKktV6jbD2rr'),
    'base_url' => env('VODAPAY_BASE_URL', 'https://vodapay.info/c2c/pool/ipg'),
    'callback_url' => env('VODAPAY_CALLBACK_URL', ''),
    'cancel_url' => env('VODAPAY_CANCEL_URL', ''),
];
