<?php

//page varibale
$PageName  = "Order Details";
$AccessLevel = "../../../";

//include required files here
require $AccessLevel . "require/modules.php";
require $AccessLevel . "require/web-modules.php";

if (!isset($_SESSION['LOGIN_CustomerId'])) {
  LOCATION("info", "Please Login First!", DOMAIN . "/auth/web/login/");
}

//page actiticity
$PageSqls = "SELECT * FROM customers where CustomerId='" . LOGIN_CustomerId . "'";
if (isset($_GET['orderid'])) {
  $_SESSION['ORDER_ID'] = $_GET['orderid'];
  $Orderid = SECURE($_SESSION['ORDER_ID'], "d");
} else {
  $Orderid = SECURE($_SESSION['ORDER_ID'], "d");;
}
$OrderSql = "SELECT * FROM orders where OrderId='$Orderid'";
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=0.9">
  <meta name="description" content="">
  <meta name="keywords" content="">
  <title><?php echo GET_DATA("CustomerName") ?> | <?php echo APP_NAME; ?></title>
  <?php include $AccessLevel . "/include/web/header_files.php"; ?>
  <script>
    window.onload = function() {
      document.getElementById("orders").classList.add("active");
    }
  </script>
</head>

<body>

  <?php
  include $AccessLevel . "include/web/header.php";
  ?>
  <?php if (DEVICE_TYPE == "Computer") { ?>
    <section class="container">
      <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12 col-12">
          <h3 class="account-header">
            <i class="fa fa-user text-color"></i> My Account
            <i class="fa fa-angle-double-right"></i> My Orders
            <i class="fa fa-angle-double-right"></i> 00<?php echo $Orderid; ?>
          </h3>
          <a href="<?php echo DOMAIN; ?>/web/account/orders" class="btn btn-md fs-16 text-primary"><i class="fa fa-angle-left"></i> Back to Orders</a>
        </div>
      </div>
    </section>

    <section class="container section">
      <div class="row">
        <div class="col-md-12 header-bg p-l-5 m-l-5">
          <h4>Order Status</h4>
        </div>
        <div class="col-md-12 m-t-10">
          <div class="row rows-2">
            <?php $OrderStatusFetch = FetchConvertIntoArray("SELECT * FROM orderstatus where OrderStatusOrderId='$Orderid'", true);
            if ($OrderStatusFetch == null) {
              NoCartItems("No Status Available");
            } else {
              foreach ($OrderStatusFetch as $status) { ?>
                <div class="col">
                  <div class="delivery-box">
                    <img src="<?php echo STORAGE_URL_D; ?>/tool-img/arrow.png" class="del-img">
                    <h4 class="m-b-1 m-t-0"><i class="fa fa-check-circle-o text-success"></i> <?php echo $status->OrderStatus; ?></h4>
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
        <div class="col-md-6 col-lg-6 col-sm-6 col-12">
          <div class="row">
            <div class="col-md-12 header-bg">
              <h4 class="p-1r">Item Details</h4>
            </div>
          </div>
          <div class="row m-t-15">
            <?php
            $fetchItems = FetchConvertIntoArray("SELECT * FROM ordered_products where OrderOrderId='$Orderid' ORDER BY OrderProductId ASC", true);
            if ($fetchItems == null) {
              NoCartItems("No Item Found!");
            } else {
              foreach ($fetchItems as $Items) { ?>
                <div class="col-lg-12 col-md-12 col-sm-12 col-12 m-b-10">
                  <div class="cat-box">
                    <div class="flex-space-between">
                      <div class="item-detail-img">
                        <img src="<?php echo STORAGE_URL; ?>/products/pro-img/<?php echo $Items->OrderProductImage; ?>" class="w-100">
                      </div>
                      <div class="item-details-data">
                        <h5><?php echo $Items->OrderProductName; ?></h5>
                        <p class="text-grey fs-12">
                          <span><?php echo $Items->OrderProductWeight; ?></span><br>
                          <span><?php echo $Items->OrderProductBrandName; ?></span><br>
                          <span><?php echo $Items->OrderProductCatName; ?> | <?php echo $Items->OrderProductSubCatName; ?></span>
                          <br>
                          <span><?php echo SECURE($Items->OrderDetails, "d"); ?></span><br>
                          <hr>
                          <span class="text-black">Rs.<?php echo $Items->OrderProductSellPrice; ?> x <?php echo $Items->OrderProductQty; ?> = Rs.<?php echo $Items->OrderProductSellAmount; ?>
                            <br>
                            <?php
                            (int)$ApplicableTax = FETCH("SELECT * FROM products where ProductId='" . $Items->OrderProProductId . "'", "ProductApplicableTaxes");
                            (int)$TaxAmount = round((int)$Items->OrderProductSellPrice / 100 * $ApplicableTax);
                            ?>
                            <span>Rs.<?php echo $Items->OrderProductSellAmount; ?> + GST (<?php echo $ApplicableTax; ?>%) = Rs.<?php echo (int)$Items->OrderProductSellAmount + $TaxAmount; ?>
                        </p>
                      </div>
                    </div>
                  </div>
                </div>
            <?php }
            } ?>

            <div class="col-md-12 header-bg text-right">
              <br>
              <table class="table table-striped text-right">
                <tr align="right">
                  <td align="right" class="">
                    <span class="cart-details">Total Amount </span>
                  </td>
                  <th>
                    <span class="cart-price">Rs.<?php echo FETCH("SELECT * FROM orders where OrderId='$Orderid'", "OrderAmount"); ?></span>
                  </th>
                </tr>
                <tr align="right">
                  <td align="right" class="">
                    <span class="cart-details">Delivery Charges </span>
                  </td>
                  <th>
                    <span class="cart-price">
                      <?php if (FETCH("SELECT * FROM orders where OrderId='$Orderid'", "DeliveryCharges") == "Free") {
                        echo "Free";
                      } else {
                        echo FETCH("SELECT * FROM orders where OrderId='$Orderid'", "DeliveryCharges");
                      }; ?>
                    </span>
                  </th>
                </tr>
                <tr align="right">
                  <td align="right" class="">
                    <span class="cart-details">Coupon Details </span>
                  </td>
                  <th>
                    <span class="cart-price">
                      <?php echo html_entity_decode(FETCH("SELECT * FROM order_payments where OrderRefId='$Orderid'", "OrderPaymentCoupons")); ?>
                    </span>
                  </th>
                </tr>
                <tr align="right">
                  <td align="right" class="">
                    <span class="cart-details text-success net-price">Net Payable </span>
                  </td>
                  <th>
                    <span class="cart-price text-success net-price">Rs.<?php echo FETCH("SELECT * FROM orders where OrderId='$Orderid'", "NetPayableAmount"); ?></span>
                  </th>
                </tr>
              </table>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-6 col-sm-6 col-12">
          <div class="row">
            <div class="col-md-12 header-bg p-l-5 m-l-5">
              <h4>Shipping & Billing Address</h4>
            </div>
            <div class="col-md-12 m-t-10">
              <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                  <div class="cat-box fs-13">
                    <h5 class="m-b-0"><b>Shipping Address</b></h5>
                    <?php echo SECURE(FETCH("SELECT * FROM orders where OrderId='$Orderid'", "OrderShippingAddress"), "d"); ?>
                  </div>
                </div>

                <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                  <div class="cat-box fs-13">
                    <h5 class="m-b-0"><b>Billing Address</b></h5>
                    <?php echo SECURE(FETCH("SELECT * FROM orders where OrderId='$Orderid'", "OrderBillingAddress"), "d"); ?>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-12 header-bg p-l-5 m-l-5">
              <h4>Order Details</h4>
            </div>
            <div class="col-md-12">
              <table class="table table-striped">
                <tr>
                  <th>InvoiceNo</th>
                  <td><?php echo FETCH("SELECT * FROM orders where OrderId='$Orderid'", "CustomOrderId"); ?></td>
                </tr>
                <tr>
                  <th>OrderRefId</th>
                  <td><?php echo FETCH("SELECT * FROM orders where OrderId='$Orderid'", "OrderReferenceid"); ?></td>
                </tr>
                <tr>
                  <th>Order Date</th>
                  <td><?php echo FETCH("SELECT * FROM orders where OrderId='$Orderid'", "OrderCreateDate"); ?></td>
                </tr>
                <tr>
                  <th>Last Update At</th>
                  <td><?php echo ReturnValue(FETCH("SELECT * FROM orders where OrderId='$Orderid'", "OrderUpdateDate")); ?></td>
                </tr>
              </table>
            </div>

            <div class="col-md-12 header-bg p-l-5 m-l-5">
              <h4>Payment Details</h4>
            </div>
            <div class="col-md-12">
              <table class="table table-striped">
                <tr>
                  <th>Net Payable Amount</th>
                  <td>Rs.<?php echo FETCH("SELECT * FROM orders where OrderId='$Orderid'", "NetPayableAmount"); ?></td>
                </tr>
                <tr>
                  <th>Payment Mode</th>
                  <td><?php echo FETCH("SELECT * FROM orders where OrderId='$Orderid'", "OrderPaymentMode"); ?></td>
                </tr>
                <tr>
                  <th>Payment Refid</th>
                  <td><?php echo $TxnId = SECURE(FETCH("SELECT * FROM order_payments where OrderRefId='$Orderid'", "OrderPaymentReferenceId"), "d"); ?></td>
                </tr>
                <tr>
                  <th>Payment Details</th>
                  <td><?php echo FETCH("SELECT * FROM order_payments where OrderRefId='$Orderid'", "OrderPaymentDetails") . " - " . $TxnId; ?></td>
                </tr>
                <tr>
                  <th>Payment Date</th>
                  <td><?php echo FETCH("SELECT * FROM order_payments where OrderRefId='$Orderid'", "OrderPaymentDate"); ?></td>
                </tr>
                <tr>
                  <th>Payment Status</th>
                  <td><?php echo FETCH("SELECT * FROM order_payments where OrderRefId='$Orderid'", "OrderPaymentStatus"); ?></td>
                </tr>

              </table>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="container section">
      <div class="row">
        <div class="col-md-12 text-center">
          <center>
            <a href="<?php echo DOMAIN; ?>/web/invoices/?orderid=<?php echo SECURE($Orderid, "e"); ?>" target="_blank" class="btn btn-md btn-primary"><i class="fa fa-file-pdf-o text-white"></i> View Invoice</a>
            <a href="<?php echo DOMAIN; ?>/web/invoices/print.php?orderid=<?php echo SECURE($Orderid, "e"); ?>" target="_blank" class="btn btn-md btn-danger"><i class="fa fa-print text-white"></i> Print Invoice</a>
            <a href="<?php echo DOMAIN; ?>/web/track/?orderid=<?php echo SECURE($Orderid, "e"); ?>" target="_blank" class="btn btn-md btn-success"><i class="fa fa-map-marker text-white"></i> Track Order</a>
          </center>
        </div>
      </div>
    </section>
    <br><br>

    <?php include $AccessLevel . "include/web/footer.php"; ?>
    <?php include $AccessLevel . "include/web/footer_files.php"; ?>

  <?php } else { ?>

    <div class='fixed-top'>
      <section class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="flex-start">
              <a href="<?php echo WEB_URL; ?>/account/orders" class="btn btn-lg mr-3 bold h3 mt-1 back-btn"><i class="fa fa-angle-left"></i></a>
              <div class="page-title">
                <h5 class="mb-0 mt-2">Details : # <?php echo FETCH($OrderSql, "OrderReferenceid"); ?></h5>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>

    <section class="container section mt-5">
      <div class="row">
        <div class="col-md-12 header-bg p-l-5 m-l-5 mt-5">
          <h4 class="text-dark bold">Order Status</h4>
          <hr>
        </div>
        <div class="col-md-12 m-t-10">
          <div class="row rows-2">
            <div class="col-md-12">
              <ul class="order-tracking-status">
                <?php $OrderStatusFetch = FetchConvertIntoArray("SELECT * FROM orderstatus where OrderStatusOrderId='$Orderid'", true);
                if ($OrderStatusFetch == null) {
                  NoCartItems("No Status Available");
                } else {
                  foreach ($OrderStatusFetch as $status) { ?>
                    <li>
                      <div class="status">
                        <h5 class="mb-0 m-t-7">
                          <img src="<?php echo STORAGE_URL_D; ?>/tool-img/arrow.png" class="del-img">
                          <?php echo $status->OrderStatus; ?>
                        </h5>
                        <p class="fs-13 m-b-0">
                          <span class="text-grey"><i class="fa fa-calendar"></i> <?php echo $status->OrderStatusCreatedAt; ?></span><br>
                          <span><?php echo $status->OrderStatusDescriptions; ?></span>
                        </p>
                      </div>
                    </li>
                <?php }
                } ?>
              </ul>
            </div>
          </div>
        </div>
        <div class="col-md-12 col-lg-12 col-sm-12 col-12">
          <div class="row">
            <div class="col-md-12 header-bg">
              <h4 class="p-1r bold">Item Details</h4>
              <hr>
            </div>
          </div>
          <div class="row m-t-15">
            <div class='col-md-12'>
              <ul class="order-items">
                <?php
                $fetchItems = FetchConvertIntoArray("SELECT * FROM ordered_products where OrderOrderId='$Orderid' ORDER BY OrderProductId ASC", true);
                if ($fetchItems == null) {
                  NoCartItems("No Item Found!");
                } else {
                  foreach ($fetchItems as $Items) { ?>
                    <li>
                      <div class="image">
                        <img src="<?php echo STORAGE_URL; ?>/products/pro-img/<?php echo $Items->OrderProductImage; ?>">
                      </div>
                      <div class="details">

                        <p class="text-grey fs-12">
                          <span class="bold"><?php echo $Items->OrderProductName; ?></span><br>
                          <span><?php echo $Items->OrderProductCatName; ?> | <?php echo $Items->OrderProductSubCatName; ?></span>
                          <br>
                          <span><?php echo SECURE($Items->OrderDetails, "d"); ?></span><br>
                        </p>
                        <p class="text-right">
                          <span>Rs.<?php echo $Items->OrderProductSellPrice; ?> x <?php echo $Items->OrderProductQty; ?> = Rs.<?php echo $Items->OrderProductSellAmount; ?>
                            <br>
                            <?php
                            (int)$ApplicableTax = FETCH("SELECT * FROM products where ProductId='" . $Items->OrderProProductId . "'", "ProductApplicableTaxes");
                            (int)$TaxAmount = round((int)$Items->OrderProductSellPrice / 100 * $ApplicableTax);
                            ?>
                            <span>Rs.<?php echo $Items->OrderProductSellAmount; ?> + GST (<?php echo $ApplicableTax; ?>%) =
                              <span class="bold h5">Rs.<?php echo (int)$Items->OrderProductSellAmount + $TaxAmount; ?></span>
                        </p>
                    </li>
                <?php }
                } ?>
              </ul>
            </div>
            <div class="col-md-12 header-bg text-right">
              <br>
              <table class="table table-striped text-right">
                <tr align="right">
                  <td align="right" class="">
                    <span class="cart-details">Total Amount </span>
                  </td>
                  <th>
                    <span class="cart-price">Rs.<?php echo FETCH("SELECT * FROM orders where OrderId='$Orderid'", "OrderAmount"); ?></span>
                  </th>
                </tr>
                <tr align="right">
                  <td align="right" class="">
                    <span class="cart-details">Delivery Charges </span>
                  </td>
                  <th>
                    <span class="cart-price">
                      <?php if (FETCH("SELECT * FROM orders where OrderId='$Orderid'", "DeliveryCharges") == "Free") {
                        echo "Free";
                      } else {
                        echo "Rs." . FETCH("SELECT * FROM orders where OrderId='$Orderid'", "DeliveryCharges");
                      }; ?>
                    </span>
                  </th>
                </tr>
                <tr align="right">
                  <td align="right" class="">
                    <span class="cart-details">Coupon Details </span>
                  </td>
                  <th>
                    <span class="cart-price">
                      <?php echo html_entity_decode(FETCH("SELECT * FROM order_payments where OrderRefId='$Orderid'", "OrderPaymentCoupons")); ?>
                    </span>
                  </th>
                </tr>
                <tr align="right">
                  <td align="right" class="">
                    <span class="cart-details text-success net-price">Net Payable </span>
                  </td>
                  <th>
                    <span class="cart-price text-success net-price">Rs.<?php echo FETCH("SELECT * FROM orders where OrderId='$Orderid'", "NetPayableAmount"); ?></span>
                  </th>
                </tr>
              </table>
            </div>
          </div>
        </div>
        <div class="col-md-12 col-lg-12 col-sm-12 col-12">
          <div class="row">
            <div class="col-md-12 header-bg p-l-5 m-l-5">
              <h4 class="bold">Shipping & Billing Address</h4>
              <hr>
            </div>
            <div class="col-md-12 m-t-10">
              <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                  <div class="cat-box fs-13">
                    <h5 class="m-b-0"><b>Shipping Address</b></h5>
                    <?php echo SECURE(FETCH("SELECT * FROM orders where OrderId='$Orderid'", "OrderShippingAddress"), "d"); ?>
                  </div>
                </div>

                <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                  <div class="cat-box fs-13">
                    <h5 class="m-b-0"><b>Billing Address</b></h5>
                    <?php echo SECURE(FETCH("SELECT * FROM orders where OrderId='$Orderid'", "OrderBillingAddress"), "d"); ?>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-12 header-bg p-l-5 m-l-5">
              <h4 class="bold">Order Details</h4>
              <hr>
            </div>
            <div class="col-md-12">
              <table class="table table-striped">
                <tr>
                  <th>InvoiceNo</th>
                  <td><?php echo FETCH("SELECT * FROM orders where OrderId='$Orderid'", "CustomOrderId"); ?></td>
                </tr>
                <tr>
                  <th>OrderRefId</th>
                  <td><?php echo FETCH("SELECT * FROM orders where OrderId='$Orderid'", "OrderReferenceid"); ?></td>
                </tr>
                <tr>
                  <th>Order Date</th>
                  <td><?php echo FETCH("SELECT * FROM orders where OrderId='$Orderid'", "OrderCreateDate"); ?></td>
                </tr>
                <tr>
                  <th>Last Update At</th>
                  <td><?php echo ReturnValue(FETCH("SELECT * FROM orders where OrderId='$Orderid'", "OrderUpdateDate")); ?></td>
                </tr>
              </table>
            </div>

            <div class="col-md-12 header-bg p-l-5 m-l-5">
              <h4 class="bold">Payment Details</h4>
              <hr>
            </div>
            <div class="col-md-12">
              <table class="table table-striped">
                <tr>
                  <th>Net Payable Amount</th>
                  <td>Rs.<?php echo FETCH("SELECT * FROM orders where OrderId='$Orderid'", "NetPayableAmount"); ?></td>
                </tr>
                <tr>
                  <th>Payment Mode</th>
                  <td><?php echo FETCH("SELECT * FROM orders where OrderId='$Orderid'", "OrderPaymentMode"); ?></td>
                </tr>
                <tr>
                  <th>Payment Refid</th>
                  <td><?php echo $TxnId = SECURE(FETCH("SELECT * FROM order_payments where OrderRefId='$Orderid'", "OrderPaymentReferenceId"), "d"); ?></td>
                </tr>
                <tr>
                  <th>Payment Details</th>
                  <td><?php echo FETCH("SELECT * FROM order_payments where OrderRefId='$Orderid'", "OrderPaymentDetails") . " - " . $TxnId; ?></td>
                </tr>
                <tr>
                  <th>Payment Date</th>
                  <td><?php echo FETCH("SELECT * FROM order_payments where OrderRefId='$Orderid'", "OrderPaymentDate"); ?></td>
                </tr>
                <tr>
                  <th>Payment Status</th>
                  <td><?php echo FETCH("SELECT * FROM order_payments where OrderRefId='$Orderid'", "OrderPaymentStatus"); ?></td>
                </tr>

              </table>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="container section">
      <div class="row">
        <div class="col-md-12 text-center">
          <center>
            <a href="<?php echo DOMAIN; ?>/web/invoices/?orderid=<?php echo SECURE($Orderid, "e"); ?>" target="_blank" class="btn btn-md btn-primary text-white m-1"><i class="fa fa-file-pdf-o text-white"></i> View Invoice</a>
            <a href="<?php echo DOMAIN; ?>/web/invoices/print.php?orderid=<?php echo SECURE($Orderid, "e"); ?>" target="_blank" class="btn btn-md btn-danger text-white m-1"><i class="fa fa-envelope text-white"></i> Mail Invoice</a>
          </center>
        </div>
      </div>
    </section>
    <br><br><br><br>
  <?php } ?>
</body>

</html>