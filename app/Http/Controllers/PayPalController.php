<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Http;
use Exception;
use Throwable;

class PayPalController extends Controller
{
    /**
     * @return View|Application|Factory|\Illuminate\Contracts\Foundation\Application
     */
    public function __invoke(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('app');
    }

    private function getAuthAssertionValue($clientId, $sellerPayerId)
    {

        //        pre(config('paypal.mode'));
//        pre(config('paypal.client_secret'));
//        pre(config('paypal.currency'));
//
//        $response = Http::get('https://api.edlin.app/v1/hello-world');
//        pre($response->body());

        $jwt = getAuthAssertionValue(config('paypal.client_id'), "SELLER-PAYER-ID");

        pre($jwt);

        $header = [
            'alg' => "none"
        ];

        return base64_encode($header);

//            const encodedHeader = base64url(header);
//            const payload       = {
//            "iss": clientId,
//                "payer_id": sellerPayerId
//            };
//            const encodedPayload = base64url(payload);
//            return `${encodedHeader}.${encodedPayload}.`;
    }
}
