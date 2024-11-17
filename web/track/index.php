<?php

//page varibale
$PageName  = "Track Orders";
$AccessLevel = "../../";


//include required files here
require $AccessLevel . "require/modules.php";
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

  <?php
  include $AccessLevel . "include/web/header.php";
  ?>
  <section class="container">
    <div class="row">
      <div class="col-md-12 col-lg-12 col-sm-12 col-12 header-bg">
        <h3 class="account-header">
          <i class="fa fa-map-marker text-color"></i> Track Order
        </h3>
      </div>
    </div>
  </section>

  <section class="container section">
    <div class="row">
      <div class="col-md-12">
        <br><br>
        <form action="" method="GET">
          <div class="row">
            <div class="col-md-12">
              <h4>Enter Any one Field or Both</h4>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-12 form-group">
              <input type="text" name="CustomOrderId" class="form-control" placeholder="INVOICE NO: 2021-2022/0001">
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-12 form-group">
              <input type="text" name="OrderReferenceid" class="form-control" placeholder="OrderRefID: 26/11/21/96492152">
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-12">
              <button class="btn btn-md btn-success" name="search">Search Order</button>
            </div>
          </div>
        </form>
      </div>

      <div class="col-md-12 header-bg p-l-5 m-l-5">
        <h4>Order Status :
          <?php if (isset($_GET['orderid'])) {
            $OrderMsgs = SECURE($_GET['orderid'], "d");
          } else if (isset($_GET['CustomOrderId'])) {
            $OrderMsgs = $_GET['CustomOrderId'];
          } else if (isset($_GET['OrderReferenceid'])) {
            $OrderMsgs = $_GET['OrderReferenceid'];
          } else {
            $OrderMsgs = "";
          }
          echo $OrderMsgs; ?>
        </h4>
      </div>
      <div class="col-md-12 m-t-10">
        <div class="row rows-2">
          <?php
          if (isset($_GET['orderid'])) {
            $Orderid = SECURE($_GET['orderid'], "d");
            $OrderStatusFetch = FetchConvertIntoArray("SELECT * FROM orderstatus where OrderStatusOrderId='$Orderid'", true);
          } else if (isset($_GET['CustomOrderId'])) {
            $CustomOrderId = $_GET['CustomOrderId'];
            $OrderStatusFetch = FetchConvertIntoArray("SELECT * FROM orderstatus, orders where orders.CustomOrderId='$CustomOrderId' and orderstatus.OrderStatusOrderId=orders.OrderId", true);
          } else if (isset($_GET['OrderReferenceid'])) {
            $OrderReferenceid = $_GET['OrderReferenceid'];
            $OrderStatusFetch = FetchConvertIntoArray("SELECT * FROM orderstatus, orders where orders.OrderReferenceid LIKE '%$OrderReferenceid%' and orderstatus.OrderStatusOrderId=orders.OrderId", true);
          } else {
            $OrderStatusFetch = null;
          }
          if ($OrderStatusFetch == null) {
            NoCartItems("No Status Available");
          } else {
            foreach ($OrderStatusFetch as $status) {
              $OrderStatusid = $status->OrderStatusid;
              $StateTitle = FETCH("SELECT * FROM orderstatus where OrderStatusid='$OrderStatusid'", "OrderStatus"); ?>
              <div class="col">
                <div class="delivery-box">
                  <img src="<?php echo STORAGE_URL_D; ?>/tool-img/arrow.png" class="del-img">
                  <h4 class="m-b-1 m-t-0"><i class="fa fa-check-circle-o text-success"></i> <?php echo $StateTitle; ?></h4>
                  <p class="fs-13 m-b-0">
                    <span class="text-grey"><i class="fa fa-calendar"></i> <?php echo $status->OrderStatusCreatedAt; ?></span><br>
                    <span><?php echo $status->OrderStatusDescriptions; ?></span>
                  </p>
                </div>
              </div>
          <?php }
          } ?>
        </div>
      </div>
      <div class="col-md-12">
        <hr>
        <a href="<?php echo DOMAIN; ?>/web/" class="btn btn-md btn-primary"><i class='fa fa-angle-left text-white'></i> Back to Store</a>
      </div>
    </div>
  </section>

  <br><br><br>

  <?php include $AccessLevel . "include/web/footer.php"; ?>
  <?php include $AccessLevel . "include/web/footer_files.php"; ?>
</body>

</html>