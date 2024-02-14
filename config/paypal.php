<?php


return [
    'mode'          => env('PAYPAL_MODE', 'sandbox'),
    'client_id'     => env('PAYPAL_CLIENT_ID'),
    'client_secret' => env('PAYPAL_CLIENT_SECRET'),
    'currency'      => env('PAYPAL_CURRENCY', 'GBP'),
];
