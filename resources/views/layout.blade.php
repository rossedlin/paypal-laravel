<!doctype html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="icon" type="image/x-icon" href="https://assets.edlin.app/favicon/favicon.ico">

  <link rel="stylesheet" href="https://assets.edlin.app/bootstrap/v5.3/bootstrap.css">

  <!-- Title -->
  <title>PayPal Laravel</title>
</head>
<body>
<div class="container text-center">
  <div class="row mt-5">
    <div class="col-12">
      <img src="https://assets.edlin.app/logo/codewithross/logo-symbol-dark.png" height='100' alt="Ross Edlin Logo"/>
    </div>
  </div>
  <div class="row mt-5">
    <div class="col-12">
      <h1>PayPal Laravel</h1>
    </div>
  </div>
  <div class="row mt-4">
    <div class="col-12">
      <div class="links h5">
        <a class="text-decoration-none mx-3" href="https://edlin.xyz/website" target="_blank">Home</a>
        <a class="text-decoration-none mx-3" href="https://edlin.xyz/portfolio" target="_blank">Portfolio</a>
        <a class="text-decoration-none mx-3" href="https://edlin.xyz/contact" target="_blank">Contact</a>
        <a class="text-decoration-none mx-3" href="https://edlin.xyz/linkedin" target="_blank">LinkedIn</a>
        <a class="text-decoration-none mx-3" href="https://edlin.xyz/github/paypal-laravel" target="_blank">GitHub</a>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-12">
      @yield('content')
    </div>
  </div>
</div>
</body>
<script>

  let url_to_head = (url) => {
    return new Promise(function (resolve, reject) {
      let script = document.createElement('script');
      script.src = url;
      script.onload = function () {
        resolve();
      };
      script.onerror = function () {
        reject('Error loading script.');
      };
      document.head.appendChild(script);
    });
  }

  url_to_head('https://www.paypal.com/sdk/js?client-id={{config('paypal.client_id')}}&currency=GBP&intent=capture')
    .then(() => {

      let paypal_buttons = paypal.Buttons({ // https://developer.paypal.com/sdk/js/reference
        createOrder: function (data, actions) { //https://developer.paypal.com/docs/api/orders/v2/#orders_create
          return fetch("/create")
            .then((response) => response.text())
            .then((id) => {
              return id;
            });
        },

        onApprove: function (data, actions) {
          let order_id = data.orderID;
          return fetch("/complete", {
            method: "post", headers: {"Content-Type": "application/json; charset=utf-8"},
            body: JSON.stringify({
              "intent": 'capture',
              "order_id": order_id
            })
          })
            .then((response) => response.json())
            .then((order_details) => {
              console.log(order_details); //https://developer.paypal.com/docs/api/orders/v2/#orders_capture!c=201&path=create_time&t=response
              let intent_object = intent === "authorize" ? "authorizations" : "captures";
              //Custom Successful Message
              // alerts.innerHTML = `<div class=\'ms-alert ms-action\'>Thank you ` + order_details.payer.name.given_name + ` ` + order_details.payer.name.surname + ` for your payment of ` + order_details.purchase_units[0].payments[intent_object][0].amount.value + ` ` + order_details.purchase_units[0].payments[intent_object][0].amount.currency_code + `!</div>`;

              //Close out the PayPal buttons that were rendered
              paypal_buttons.close();
            })
            .catch((error) => {
              console.log(error);
              // alerts.innerHTML = `<div class="ms-alert ms-action2 ms-small"><span class="ms-close"></span><p>An Error Ocurred!</p>  </div>`;
            });
        },

        onCancel: function (data) {
          // alerts.innerHTML = `<div class="ms-alert ms-action2 ms-small"><span class="ms-close"></span><p>Order cancelled!</p>  </div>`;
        },

        onError: function (err) {
          console.log(err);
        }
      });

      paypal_buttons.render('#payment_options');
    });
</script>
</html>
