<!doctype html>
<html lang="en">
<head>
  <link rel="stylesheet" href="https://assets.edlin.app/bootstrap/v5.3/bootstrap.css">
  <script
    src="https://www.paypal.com/sdk/js?client-id={{config('paypal.client_id')}}&currency=GBP&intent=capture"></script>
</head>
<body>
<div class="container text-center">
  <div class="row mt-3">
    <div class="col-12 col-lg-6 offset-lg-3 alert alert-success"
         role="alert"
         id="paypal-success"
         style="display: none;">
      You have successfully sent me money! Thank you!
    </div>
    <div class="col-12 col-lg-6 offset-lg-3 mt-3 mb-3">
      <div class="input-group">
        <span class="input-group-text">£</span>
        <input type="text"
               class="form-control"
               id="paypal-amount"
               value="10"
               aria-label="Amount (to the nearest pound)">
        <span class="input-group-text">.00</span>
      </div>
    </div>
    <div class="col-12 col-lg-6 offset-lg-3" id="payment_options"></div>
  </div>
</div>
</body>
<script>
  paypal.Buttons({
    createOrder: function () {
      return fetch("/create/" + document.getElementById("paypal-amount").value)
        .then((response) => response.text())
        .then((id) => {
          return id;
        });
    },

    onApprove: function () {
      return fetch("/complete", {method: "post", headers: {"X-CSRF-Token": '{{csrf_token()}}'}})
        .then((response) => response.json())
        .then((order_details) => {
          console.log(order_details);
          document.getElementById("paypal-success").style.display = 'block';
          //paypal_buttons.close();
        })
        .catch((error) => {
          console.log(error);
        });
    },

    onCancel: function (data) {
      console.log(data);
    },

    onError: function (err) {
      console.log(err);
    }
  }).render('#payment_options');
</script>
</html>
