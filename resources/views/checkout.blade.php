@extends('layout')
@section('content')
    <div class="row mt-5">
        <div class="col-12 col-md-6 offset-md-3">
            <p>Hey there, I'm a PayPal Payment Page.</p>

            <p>Click the button below and you'll be taken to a <a href="https://developer.paypal.com/docs/checkout/"
                                                                  target="_blank">PayPal</a>
                checkout form where you can enter real credit / debit card details and send me money.</p>

            <p>My purpose is to demonstrate building a <a href="https://laravel.com/docs/10.x/"
                                                          target="_blank">Laravel</a> / <a
                    href="https://developer.paypal.com/docs/checkout/" target="_blank">PayPal</a> app in 5 minutes.</p>

            <p>You can see me building this app on <a href="https://edlin.xyz/youtube/paypal-laravel"
                                                      target="_blank">YouTube</a>
                and view the <a href="https://edlin.xyz/github/paypal-laravel"
                                            target="_blank">source code</a>.</p>

            <p class="text-danger">
                WARNING!!!<br/>
                This is set to LIVE mode, so real money is used.<br/>
                No refunds, use at your own risk.
            </p>
        </div>
    </div>

    <div class="row mt-5 mb-5">
        <div class="col-4"></div>
        <div class="col-2">
            <form action="/test" method="POST">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <button type="submit" id="checkout-test-button" class="btn btn-warning">Checkout (Test)</button>
            </form>
        </div>
        <div class="col-2">
            <form action="/live" method="POST">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <button type="submit" id="checkout-live-button" class="btn btn-success">Checkout (LIVE)</button>
            </form>
        </div>
        <div class="col-4"></div>
    </div>
@endsection
