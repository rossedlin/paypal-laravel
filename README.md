<p align="center">
    <a href="https://www.codewithross.com/" target="_blank">
        <img src="https://assets.edlin.app/logo/codewithross/logo-dark.svg" width="400" alt="Code with Ross Logo">
    </a>
</p>

# PayPal Laravel

https://developer.paypal.com/dashboard/
https://www.youtube.com/watch?v=MBfJEUGNNs0
https://developer.paypal.com/docs/checkout/standard/integrate/#link-beforeyoubeginyourintegration
https://laracasts.com/discuss/channels/requests/laravel-8-http-client-how-to-send-a-string-in-a-post-request

I built a PayPal Payment page in 4 minutes, where you can use the standard PayPal button to receive money on your website.
Just enter the amount and click the PayPal button and hey presto, you've earned money.

OR, they can enter their credit / debit card details if they don't have a PayPal account.

Built using Laravel, using the PayPal API, all in 4 minutes.

Let's go.

## Requirements

- PHP v8.2
- Composer v2.5

## Installation

- `composer create-project laravel/laravel paypal-laravel`
- `cd paypal-laravel`

- `php artisan make:controller PayPalController`

## Code

- `.env`
- `routes/web.php`
- `config/paypal.php`
- `app/Http/Controllers/PayPalController.php`
- `resources/views/checkout.blade.php`
