<?php
//require files are included here
require '../../../../require/modules.php';
require '../../../../require/web/sessionvariables.php';

if (!isset($_SESSION['LOGIN_CustomerId'])) {
  LOCATION("info", "Please Login First!", DOMAIN . "/auth/web/login/");
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=0.9">
  <title>E-Payment | <?php echo APP_NAME; ?></title>
</head>

<body>
  <?php if (isset($_SESSION['INITIATE_E_PAY']) == "true") { ?>
    <center>
      <h2>Do No Refresh the page</h2>
      <img src="https://cdn.dribbble.com/users/447957/screenshots/6899626/payment-animation.gif" style="width:40%;">
    </center>
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script>
      var options = {
        "key": "<?php echo MERCHENT_ID; ?>", // Enter the Key ID generated from the Dashboard
        "amount": "<?php echo $_SESSION['NET_PAYABLE_AMOUNT']; ?>00", // Amount is in currency subunits. Default currency is INR. Hence, 50000 refers to 50000 paise
        "currency": "INR",
        "name": "<?php echo APP_NAME; ?>",
        "description": "RefId: <?php echo $_SESSION['CUSTOM_ORDER_ID']; ?> @ <?php echo $_SESSION['OrderReferenceid']; ?>",
        "image": "<?php echo $MAIN_LOGO; ?>",
        "callback_url": "<?php echo DOMAIN; ?>/web/checkout/payment/rzr/response.php",
        "handler": function(response) {
          sessionStorage.setItem("PAY_STATUS", "Paid");
          sessionStorage.setItem("TxnId", response.razorpay_payment_id);
          window.location.href = "<?php echo DOMAIN; ?>/web/checkout/payment/rzr/response.php?view=true";
        },
        "notes": {
          "CustomerId": "<?PHP echo LOGIN_CustomerId; ?>"
        },
        "prefill": {
          "name": "<?php echo FETCH("SELECT * FROM customers where CustomerId='" . LOGIN_CustomerId . "'", "CustomerName"); ?>",
          "email": "<?php echo FETCH("SELECT * FROM customers where CustomerId='" . LOGIN_CustomerId . "'", "CustomerEmailid"); ?>",
          "contact": "<?php echo FETCH("SELECT * FROM customers where CustomerId='" . LOGIN_CustomerId . "'", "CustomerPhoneNumber"); ?>"
        },

        "theme": {
          "color": "#3399cc"
        }
      };
      var rzp1 = new Razorpay(options);
      rzp1.on('payment.failed', function(response) {
        sessionStorage.setItem("PAY_STATUS", "Failed");
        sessionStorage.setItem("PAY_STATUS_code", response.error.code);
        sessionStorage.setItem("PAY_STATUS_desc", response.error.description);
        sessionStorage.setItem("PAY_STATUS_source", response.error.source);
        sessionStorage.setItem("PAY_STATUS_step", response.error.step);
        sessionStorage.setItem("PAY_STATUS_reason", response.error.reason);
        sessionStorage.setItem("PAY_STATUS_order_id", response.error.metadata.order_id);
        sessionStorage.setItem("PAY_STATUS_pay_id", response.error.metadata.payment_id);
        alert("Payment Failed");
        window.location.href = "<?php echo DOMAIN; ?>/web/checkout/payment/rzr/response.php?view=false";
      });

      var rzp1 = new Razorpay(options);
      window.onload = function() {
        rzp1.open();
        e.preventDefault();
      }
    </script>

    <script>
      $('#modal-close').click(function() {
        window.location.href = "<?php echo DOMAIN; ?>/web/checkout/payment/";
      });
    </script>
  <?php } else {
    MSG("warning", "Something went wrong!");
    header("location: " . DOMAIN . "/web/checkout/payment/"); ?>

  <?php } ?>
  <center>
    <br><br>
    <a href="" style="background-color:goldenrod; font-size:1.5rem;border:none;padding:5px 12px;text-decoration:none;color:white;">Try Again</a>
    <a href="../index.php" style="background-color:grey; font-size:1.5rem;color:white; padding:5px 12px;text-decoration:none;">Back to Checkout</a>
  </center>


</body>

</html>