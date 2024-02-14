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
        return view('app');
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
}
