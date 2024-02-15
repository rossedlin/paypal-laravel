<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Http;

class PayPalController extends Controller
{
    /**
     * @return View|Application|Factory|\Illuminate\Contracts\Foundation\Application
     */
    public function __invoke(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('checkout');
    }

    /**
     * @return string
     */
    private function getAccessToken(): string
    {
        $headers = [
            'Content-Type'  => 'application/x-www-form-urlencoded',
            'Authorization' => 'Basic ' . base64_encode(config('paypal.client_id') . ':' . config('paypal.client_secret'))
        ];

        $response = Http::withHeaders($headers)
                        ->withBody('grant_type=client_credentials')
                        ->post('https://api-m.sandbox.paypal.com/v1/oauth2/token');

        return json_decode($response->body())->access_token;
    }

    /**
     * @return string
     */
    public function create(): string
    {
        $headers = [
            'Content-Type'      => 'application/json',
            'Authorization'     => 'Bearer ' . $this->getAccessToken(),
            'PayPal-Request-Id' => uuid_create(),
        ];

        $body = [
            "intent"         => "CAPTURE",
            "purchase_units" => [
                [
                    "reference_id" => uuid_create(),
                    "amount"       => [
                        "currency_code" => "GBP",
                        "value"         => "10.00"
                    ]
                ]
            ]
        ];

        $response = Http::withHeaders($headers)
                        ->withBody(json_encode($body))
                        ->post('https://api-m.sandbox.paypal.com/v2/checkout/orders');

        return json_decode($response->body())->id;
    }

    /**
     * @return mixed
     */
    public function complete()
    {
        $headers = [
            'Content-Type'  => 'application/json',
            'Authorization' => 'Bearer ' . $this->getAccessToken(),
        ];

        $response = Http::withHeaders($headers)
                        ->post('https://api-m.sandbox.paypal.com/v2/checkout/orders/ORDER_ID/capture');

        return json_decode($response->body())->id;
    }
}
