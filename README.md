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

- `app/Http/Controllers/PayPalController.php`
  - 3 public methods, index, create, complete
    - Can use capture, or authorise
  - 1 private method, getAccessToken
- `config/paypal.php`
  - base_url, ternary statement for Sandbox or LIVE api url
  - mode, for choosing sandbox or LIVE
  - client_id
  - client_secret, which we will get in a minute
  - currency
- `.env`
  - Head to paypal website, signup if you haven't already, you will need a business account
  - In developer
  - API Credentials
  - Create an App if you don't have one already, or click on your application.
  - Copy your client ID + Secret, I will use the LIVE details for this example, so you can see it working with real money
  - Paste them in your .env file
- `routes/web.php`
  - 2 GET routes, to index + create (with the amount)
  - 1 POST route, to complete
- `resources/views/checkout.blade.php`
  - The finally we can build the UI to tie it all together.
  - Add in some basic HTML, with a head + body.
  - Add in some bootstrap styling.
  - Then most importantly, the PayPal JavsScript SDK file.
    - You'll need to include your client_id, currency, and intent, I'll be setting the intent to "capture", but you can use authorise if you wish
  - Add a div container, with 3 key divs inside it
    - The success alert, which is hidden by default which we will show when the payment succeeds
    - The input field which will allow you to send a custom value so you can charge what you like
    - And the most important DIV, the payment_options div, make sure you include this ID exactly as shown
  - The finally the JavaScript to tie it all together

done

Upload it all to a web server and make sure you're using HTTPS for a secure environment.
Then go ahead and enter an amount, then click on the paypal button to sign into your account, so you can complete the transfer.
You should see the success alter pop up and the money has left my account.
To confirm it's all worked, log into your paypal dashboard and you should see the money in your account.

And there you have it, a fully work PayPal Payment Page built in Laravel, in 4 minutes.

If you liked it, please let me know in the comments, hit the like & subscribe button and I'll see you next time!

Ross
