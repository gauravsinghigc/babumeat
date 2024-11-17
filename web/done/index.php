<?php

//page varibale
$PageName  = "Order Placed";
$AccessLevel = "../../";

//include required files here
require $AccessLevel . "require/modules.php";
require $AccessLevel . "require/web-modules.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=0.9">
  <meta name="description" content="">
  <meta name="keywords" content="">
  <title><?php echo $PageName; ?> | <?php echo APP_NAME; ?></title>
  <?php include $AccessLevel . "/include/web/header_files.php"; ?>
</head>

<body>
  <?php if (DEVICE_TYPE == "Computer") { ?>
    <?php
    include $AccessLevel . "include/web/header.php";
    ?>

    <section class="container section">
      <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-12 text-center">
          <br><br>
          <img src="<?php echo STORAGE_URL_D; ?>/tool-img/verify.gif" class="w-pr-16 img-circle doneimg">
          <h3>Order Placed Successfully1</h3>
          <p>Your Order Having Order Ref Id : <?php echo $_SESSION['OrderReferenceid']; ?> is placed successfully. you can view order details in your my orders sections.</p>
          <br>
          <a href="<?php echo DOMAIN; ?>/web/account/orders" class="btn btn-md btn-success"><i class="fa fa-shopping-cart text-white"></i> View Orders</a>
        </div>
      </div>
    </section>
    <br><br><br>
    <?php include $AccessLevel . "include/web/footer.php"; ?>
    <?php include $AccessLevel . "include/web/footer_files.php"; ?>
  <?php } else { ?>
    <div class="fixed-bottom bg-white mb-5">
      <div class="row">
        <div class="col-md-12 text-center">
          <img src="https://media0.giphy.com/media/v1.Y2lkPTc5MGI3NjExaGo4ZXFiNGR4cXRyNnZ3bmxleTA2NmI4djR4YnRxb2ExOTNkNmR0MSZlcD12MV9naWZzX3NlYXJjaCZjdD1n/etKSrsbbKbqwW6vzOg/giphy.gif" class='w-50'>
        </div>
        <div class="col-md-12 text-center">
          <h2 class="mt-4">Order Placed!</h2>
          <p>Thanking you for placing an order with us!</p>
          <p>Your order is on the way and reach at you shortly!</p>
          <a href="<?php echo DOMAIN; ?>/web/account/orders" class="btn btn-md btn-success text-white">View Order Details <i class="fa fa-angle-right btn btn-md text-white"></i></a>
        </div>
      </div>
    </div>
  <?php } ?>
</body>

</html>