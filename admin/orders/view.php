<?php

//required files
require '../../require/modules.php';
require '../../require/admin/access-control.php';
require '../../require/admin/sessionvariables.php';

//page variables
$PageName = "Order Details";

//order details
if (isset($_GET['orderid'])) {
  $ViewOrderId = SECURE($_GET['orderid'], "d");
  $_SESSION['VIEW_ORDER_ID'] = $ViewOrderId;
} else {
  $ViewOrderId = $_SESSION['VIEW_ORDER_ID'];
}

//page details
$PageSqls = "SELECT * FROM orders where OrderId='" . $ViewOrderId . "'";
$PageName = $PageName . " : " . GET_DATA("CustomOrderId");
$CustomerId = GET_DATA("CustomerId");
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=0.9">
  <title><?php echo GET_DATA("CustomOrderId"); ?> | <?php echo APP_NAME; ?></title>
  <?php include '../../include/admin/header_files.php'; ?>

</head>

<body>
  <div id="container" class="effect mainnav-lg navbar-fixed mainnav-fixed">
    <?php include '../../include/admin/header.php'; ?>

    <div class="boxed">
      <!--CONTENT CONTAINER-->
      <!--===================================================-->
      <div id="content-container">
        <div id="page-content">
          <!--====start content===============================================-->

          <div class="panel">
            <div class="panel-body">
              <div class="row">
                <div class="col-md-12">
                  <h4 class="app-heading"><i class="fa fa-shopping-cart"></i> <?php echo $PageName; ?>
                    <a href="<?php echo DOMAIN; ?>/web/invoices/print.php?orderid=<?php echo SECURE($ViewOrderId, "e"); ?>" target="_blank" class="btn btn-sm btn-default float-right m-t-neg"> View Invoice</a>
                  </h4>
                </div>
                <div class="col-md-12">
                  <div class="flex-s-b">
                    <?php include 'common.php'; ?>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12 header-bg p-l-5 m-l-5">
                  <div class="flex-space-between">
                    <h4 class="m-b-0"><img src="<?php echo STORAGE_URL_D; ?>/tool-img/shipping.png" class="w-10 list-icon"> Order Status</h4>
                    <?php if (GET_DATA("OrderStatus") == "5") { ?>
                      <span class="btn btn-md text-success"><I class="fa fa-check-circle-o"></I> Order Delivered</span>
                    <?php  } elseif (GET_DATA("OrderStatus") == 6) { ?>
                      <span class="btn btn-md text-danger"><I class="fa fa-times"></I> Order Cancelled</span>
                    <?php } else { ?>
                      <a href="<?php echo DOMAIN; ?>/controller/ordercontroller.php?updateorder=<?php echo SECURE($ViewOrderId, "e"); ?>&status=<?php if ((int)GET_DATA("OrderStatus") <= 5) {
                                                                                                                                                  echo (int)GET_DATA("OrderStatus") + 1;
                                                                                                                                                } else {
                                                                                                                                                  echo 5;
                                                                                                                                                }; ?>&access_url=<?php echo SECURE(GET_URL(), "e"); ?>&inv=<?php echo FETCH("SELECT * FROM orders where OrderId='$ViewOrderId'", "CustomOrderId"); ?>" class="btn btn-sm btn-default">Update Order Status to <?php echo OrderStatus((int)GET_DATA("OrderStatus") + 1); ?></a>
                    <?php } ?>
                  </div>
                </div>
                <div class="col-md-12 m-t-10">
                  <div class="row rows-2">
                    <?php $OrderStatusFetch = FetchConvertIntoArray("SELECT * FROM orderstatus where OrderStatusOrderId='$ViewOrderId'", true);
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
              </div>
              <div class="row m-t-10">

                <div class="col-md-5 col-lg-5 col-sm-6 col-12">
                  <div class="shadow-lg br10 p-1r">
                    <h4 class="m-t-1"><img src="<?php echo STORAGE_URL_D; ?>/tool-img/orders..png" class="w-10 list-icon"> Order Details
                    </h4>
                    <table class="table table-striped">
                      <tr>
                        <th>OrderStatus:</th>
                        <td><?php echo OrderStatus(GET_DATA("OrderStatus")); ?></td>
                      </tr>
                      <tr>
                        <th>Invoice No:</th>
                        <td><?php echo GET_DATA("CustomOrderId"); ?></td>
                      </tr>
                      <tr>
                        <th>RefNo:</th>
                        <td><?php echo GET_DATA("OrderReferenceid"); ?></td>
                      </tr>
                      <tr>
                        <th>OrderDate:</th>
                        <td><?php echo GET_DATA("OrderCreateDate"); ?></td>
                      </tr>
                      <tr>
                        <th>LastUpdatedAt:</th>
                        <td><?php echo ReturnValue(FETCH("SELECT * FROM orders where OrderId='$ViewOrderId'", "OrderUpdateDate")); ?></td>
                      </tr>
                      <tr>
                        <th>OrderAmount:</th>
                        <td><?php echo Price(GET_DATA("OrderAmount")); ?></td>
                      </tr>
                      <tr>
                        <th>DeliveryFees:</th>
                        <td><?php echo GET_DATA("DeliveryCharges"); ?></td>
                      </tr>
                      <tr>
                        <th>NetPayable:</th>
                        <td><?php echo PRICE(GET_DATA("NetPayableAmount")); ?></td>
                      </tr>
                      <tr>
                        <th>PayMode</th>
                        <td><?php echo GET_DATA("OrderPaymentMode"); ?></td>
                      </tr>
                    </table>
                  </div>

                  <div class="shadow-lg br10 p-1r">
                    <h4 class="m-t-1"><img src="<?php echo STORAGE_URL_D; ?>/tool-img/users.png" class="w-10 list-icon"> Customer Details</h4>
                    <table class="table table-striped">
                      <tr>
                        <th>CustomerID</th>
                        <td><?php echo $CustomerId; ?></td>
                      </tr>
                      <tr>
                        <th>Name</th>
                        <td><?php echo FETCH("SELECT * FROM customers where CustomerId='$CustomerId'", "CustomerName"); ?></td>
                      </tr>
                      <tr>
                        <th>EmailId</th>
                        <td><?php echo FETCH("SELECT * FROM customers where CustomerId='$CustomerId'", "CustomerEmailid"); ?></td>
                      </tr>
                      <tr>
                        <th>Phone Number</th>
                        <td><?php echo FETCH("SELECT * FROM customers where CustomerId='$CustomerId'", "CustomerPhoneNumber"); ?></td>
                      </tr>
                      <tr>
                        <th>Reg At</th>
                        <td><?php echo FETCH("SELECT * FROM customers where CustomerId='$CustomerId'", "CustomerCreatedAt"); ?></td>
                      </tr>
                      <tr>
                        <th>Status</th>
                        <td><?php echo StatusView(FETCH("SELECT * FROM customers where CustomerId='$CustomerId'", "CustomerStatus")); ?></td>
                      </tr>
                      <tr>
                        <th>TnC</th>
                        <td>Accepted</td>
                      </tr>
                    </table>
                  </div>

                  <div class="shadow-lg br10 p-1r">
                    <h4 class="m-t-1"><img src="<?php echo STORAGE_URL_D; ?>/tool-img/pay.png" class="w-10 list-icon"> Payment Details</h4>
                    <table class="table table-striped">
                      <tr>
                        <th>PayMode</th>
                        <td><?php echo GET_DATA("OrderPaymentMode"); ?></td>
                      </tr>
                      <tr>
                        <th>Payment Type</th>
                        <td><?php echo FETCH("SELECT * FROM order_payments where OrderRefId='$ViewOrderId'", "OrderPaymentName"); ?></td>
                      </tr>
                      <tr>
                        <th>NetPayable</th>
                        <td><?php echo Price(FETCH("SELECT * FROM order_payments where OrderRefId='$ViewOrderId'", "OrderPaymentAmount")); ?></td>
                      </tr>
                      <tr>
                        <th>Payment Refid</th>
                        <td><?php echo FETCH("SELECT * FROM order_payments where OrderRefId='$ViewOrderId'", "OrderPaymentReferenceId"); ?></td>
                      </tr>
                      <tr>
                        <th>Payment Date</th>
                        <td><?php echo FETCH("SELECT * FROM order_payments where OrderRefId='$ViewOrderId'", "OrderPaymentDate"); ?></td>
                      </tr>
                      <tr>
                        <th>Payment Status</th>
                        <td><?php echo PayStatus(FETCH("SELECT * FROM order_payments where OrderRefId='$ViewOrderId'", "OrderPaymentStatus")); ?></td>
                      </tr>
                      <tr>
                        <th>Payment Details</th>
                        <td><?php echo FETCH("SELECT * FROM order_payments where OrderRefId='$ViewOrderId'", "OrderPaymentDetails"); ?></td>
                      </tr>
                    </table>
                  </div>

                  <div class="shadow-lg br10 p-1r">
                    <h4 class="m-t-1"><img src="<?php echo STORAGE_URL_D; ?>/tool-img/shipping.png" class="w-10 list-icon"> Shipping Address</h4>
                    <p><?php echo SECURE(GET_DATA("OrderShippingAddress"), "d"); ?></p>
                  </div>

                  <div class="shadow-lg br10 p-1r">
                    <h4 class="m-t-1"><img src="<?php echo STORAGE_URL_D; ?>/tool-img/billing.png" class="w-10 list-icon"> Billing Address</h4>
                    <p><?php echo SECURE(GET_DATA("OrderBillingAddress"), "d"); ?></p>
                  </div>
                </div>

                <div class="col-lg-7 col-md-7 col-sm-6 col-12">

                  <div class="shadow-lg br10 p-1r">
                    <h4 class="m-t-1"><img src="<?php echo STORAGE_URL_D; ?>/tool-img/products.png" class="w-10 list-icon"> Product Details</h4>
                    <div class="row">
                      <?php
                      $fetchItems = FetchConvertIntoArray("SELECT * FROM ordered_products where OrderOrderId='$ViewOrderId' ORDER BY OrderProductId ASC", true);
                      if ($fetchItems == null) {
                        NoCartItems("No Item Found!");
                      } else {
                        foreach ($fetchItems as $Items) { ?>
                          <div class="col-lg-6 col-md-6 col-sm-6 col-12 m-b-10">
                            <div class="cat-box">
                              <div class="flex-space-between">
                                <div class="item-detail-img">
                                  <img src="<?php echo STORAGE_URL; ?>/products/pro-img/<?php echo $Items->OrderProductImage; ?>" class="w-100">
                                </div>
                                <div class="item-details-data">
                                  <h5><?php echo $Items->OrderProductName; ?></h5>
                                  <p class="text-grey fs-14">
                                    <span><?php echo $Items->OrderProductWeight; ?></span><br>
                                    <span><?php echo $Items->OrderProductBrandName; ?></span><br>
                                    <span><?php echo $Items->OrderProductCatName; ?> | <?php echo $Items->OrderProductSubCatName; ?></span>
                                    <br>
                                    <span class="text-black">Rs.<?php echo $Items->OrderProductSellPrice; ?> x <?php echo $Items->OrderProductQty; ?> = Rs.<?php echo $Items->OrderProductSellAmount; ?></span>
                                  </p>
                                </div>
                              </div>
                            </div>
                          </div>
                      <?php }
                      } ?>
                      <div class="col-md-12 header-bg text-right">
                        <table class="table text-right">
                          <tr align="right">
                            <td align="right" class="">
                              <span class="cart-details">Total Amount </span>
                            </td>
                            <td>
                              <span class="cart-price">Rs.<?php echo FETCH("SELECT * FROM orders where OrderId='$ViewOrderId'", "OrderAmount"); ?></span>
                            </td>
                          </tr>
                          <tr align="right">
                            <td align="right" class="">
                              <span class="cart-details">Delivery Charges </span>
                            </td>
                            <td>
                              <span class="cart-price">
                                <?php if (FETCH("SELECT * FROM orders where OrderId='$ViewOrderId'", "DeliveryCharges") == "Free") {
                                  echo "Free";
                                } else {
                                  echo "Rs." . FETCH("SELECT * FROM orders where OrderId='$ViewOrderId'", "DeliveryCharges");
                                }; ?>
                              </span>
                            </td>
                          </tr>
                          <tr align="right">
                            <td align="right" class="">
                              <span class="cart-details text-success net-price">Net Payable </span>
                            </td>
                            <td>
                              <span class="cart-price text-success net-price">Rs.<?php echo FETCH("SELECT * FROM orders where OrderId='$ViewOrderId'", "NetPayableAmount"); ?></span>
                            </td>
                          </tr>
                        </table>
                      </div>
                    </div>
                  </div>

                  <div class="shadow-lg br10 p-1r">
                    <h4 class="m-t-1"><img src="<?php echo STORAGE_URL_D; ?>/tool-img/pay.png" class="w-10 list-icon"> Update Payment Details</h4>
                    <form action="../../controller/ordercontroller.php" method="POST">
                      <?php FormPrimaryInputs(true); ?>
                      <input type="text" name="OrderPayments" value="<?php echo FETCH("SELECT * FROM order_payments where OrderRefId='$ViewOrderId'", "OrderPayments"); ?>" hidden="">
                      <div class="row">
                        <div class="form-group col-md-4 col-lg-4 col-sm-4 col-12">
                          <label>Payment Type</label>
                          <input type="text" name="OrderPaymentName" class="form-control-2" required="" value="<?php echo FETCH("SELECT * FROM order_payments where OrderRefId='$ViewOrderId'", "OrderPaymentName"); ?>">
                        </div>
                        <div class="form-group col-md-4 col-lg-4 col-sm-4 col-12">
                          <label>Payment Amount</label>
                          <input type="text" readonly="" name="OrderPaymentAmount" class="form-control-2" value="<?php echo FETCH("SELECT * FROM order_payments where OrderRefId='$ViewOrderId'", "OrderPaymentAmount"); ?>">
                        </div>
                        <div class="form-group col-md-4 col-lg-4 col-sm-4 col-12">
                          <label>Payment Mode</label>
                          <select class="form-control-2" name="OrderPaymentMode" required="">
                            <?php
                            if (FETCH("SELECT * FROM order_payments where OrderRefId='$ViewOrderId'", "OrderPaymentMode") == "Cash On Delivery") { ?>
                              <option value="Cash On Delivery" selected="">Cash On Delivery</option>
                              <option value="Online Payment">Online Payment</option>
                            <?php } else { ?>
                              <option value="Cash On Delivery">Cash On Delivery</option>
                              <option value="Online Payment" selected="">Online Payment</option>
                            <?php } ?>
                          </select>
                        </div>
                        <div class="form-group col-md-4 col-lg-4 col-sm-4 col-12">
                          <label>Payment Status</label>
                          <select class="form-control-2" name="OrderPaymentStatus" required="">
                            <?php
                            if (FETCH("SELECT * FROM order_payments where OrderRefId='$ViewOrderId'", "OrderPaymentStatus") == "Paid") { ?>
                              <option value="Paid" selected="">Paid</option>
                              <option value="Un Paid">Un Paid</option>
                            <?php } else { ?>
                              <option value="Paid">Paid</option>
                              <option value="Un Paid" selected="">Un Paid</option>
                            <?php } ?>
                          </select>
                        </div>
                        <div class="form-group col-md-4 col-lg-4 col-sm-4 col-12">
                          <label>Payment Date</label>
                          <input type="date" name="OrderPaymentDate" class="form-control-2" required="" value="<?php echo date("Y-m-d"); ?>">
                        </div>
                        <div class="form-group col-md-4 col-lg-4 col-sm-4 col-12">
                          <label>Payment Ref ID (txnid)</label>
                          <input type="text" name="OrderPaymentReferenceId" class="form-control-2" required="" value="<?php echo FETCH("SELECT * FROM order_payments where OrderRefId='$ViewOrderId'", "OrderPaymentReferenceId"); ?>">
                        </div>
                        <div class="form-group col-md-12 col-lg-12 col-sm-12 col-12">
                          <label>Payment Notes or Details</label>
                          <textarea name="OrderPaymentDetails" style="height:100% !important;" class="height-auto form-control-2" rows="3"><?php echo FETCH("SELECT * FROM order_payments where OrderRefId='$ViewOrderId'", "OrderPaymentDetails"); ?></textarea>
                        </div>
                        <div class="col-md-12 m-t-10">
                          <button class="btn btn-lg app-btn" name="updatepayments">Update Payment Details</button>
                        </div>
                      </div>
                    </form>
                  </div>

                  <div class="text-center">
                    <?php if (GET_DATA("OrderStatus") < 5) { ?>
                      <a href="<?php echo DOMAIN; ?>/controller/ordercontroller.php?updateorder=<?php echo SECURE($ViewOrderId, "e"); ?>&status=6&access_url=<?php echo SECURE(GET_URL(), "e"); ?>&inv=<?php echo FETCH("SELECT * FROM orders where OrderId='$ViewOrderId'", "CustomOrderId"); ?>" class="btn btn-sm text-danger">Cancel</a>
                    <?php  } elseif (GET_DATA("OrderStatus") == 6) { ?>
                      <span class="btn btn-md text-danger"><I class="fa fa-times"></I> Order Cancelled</span>
                    <?php } else { ?>
                      <span class="btn btn-md text-success"><I class="fa fa-check-circle-o"></I> Order Delivered</span>
                    <?php } ?>
                  </div>
                </div>
              </div>



            </div>
          </div>
        </div>

        <!--End page content-->
      </div>

      <?php include '../../include/admin/sidebar.php'; ?>
    </div>
    <?php include '../../include/admin/footer.php'; ?>
  </div>

  <?php include '../../include/admin/footer_files.php'; ?>
</body>

</html>