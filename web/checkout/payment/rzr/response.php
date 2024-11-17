<?php
//require 
require '../../../../require/modules.php';
require '../../../../require/web/sessionvariables.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=0.9">
  <title>Response | <?php echo APP_NAME; ?></title>
</head>

<body>
  <center>
    <img src="https://cdn.dribbble.com/users/5806/screenshots/309985/udorderloader.gif" style="width:35%;">
  </center>
  <script>
    if (sessionStorage.getItem("PAY_STATUS") == "Paid") {
      window.location.href = "<?php echo DOMAIN; ?>/controller/ordercontroller.php?checkpayment=<?php echo SECURE(true, 'e'); ?>&access_url=<?php echo SECURE(true, 'e'); ?>";
    } else {
      window.location.href = "<?php echo DOMAIN; ?>/web/checkout/payment/";
    }
  </script>
</body>

</html>