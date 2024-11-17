<?php

//required files
require '../../require/modules.php';
require '../../require/admin/access-control.php';
require '../../require/admin/sessionvariables.php';

//page variables
$PageName = "All Invoices";
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=0.9">
  <title><?php echo $PageName; ?> | <?php echo APP_NAME; ?></title>
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
                  <h4 class="app-heading"><i class="fa fa-file-pdf-o"></i> <?php echo $PageName; ?></h4>
                </div>
              </div>
              <div class="row m-t-5">
                <div class="col-md-5">
                  <div class="search-form m-t-0">
                    <form action="" method="get">
                      <div class="flex-s-b p-0 m-b-0">
                        <input type="text" name="search" value="true" hidden="">
                        <select name="search_type" class="form-control-2" id="searchoptions" onchange="CheckSearchOptions()">
                          <option value="orders.CustomOrderId" selected>Order Id</option>
                          <option value="orders.NetPayableAmount">Net Payable Amount</option>
                          <option value="orders.OrderReferenceid">Order Reference id</option>
                          <option value="orders.OrderPaymentMode">Order Payment Mode</option>
                          <option value="orders.OrderCreateDate">Order Create Date</option>
                          <option value="order_payments.OrderPaymentDetails"> Payment Details</option>
                          <option value="order_payments.OrderPaymentReferenceId"> Payment Refernce Id</option>
                        </select>
                        <input type="text" class="form-control-2" id="searchplaceholder" placeholder="Search By Order Id" onchange="form.submit()" list="available_details" name="search_value">
                        <datalist id="available_details">
                          <?php SelectOptions("SELECT * FROM orders GROUP BY CustomOrderId", "CustomOrderId", "CustomOrderId", "ASC"); ?>
                          <?php SelectOptions("SELECT * FROM orders GROUP BY NetPayableAmount", "NetPayableAmount", "NetPayableAmount", "ASC"); ?>
                          <?php SelectOptions("SELECT * FROM orders GROUP BY OrderReferenceid", "OrderReferenceid", "OrderReferenceid", "ASC"); ?>
                          <?php SelectOptions("SELECT * FROM orders GROUP By OrderPaymentMode", "OrderPaymentMode", "OrderPaymentMode", "ASC"); ?>
                          <?php SelectOptions("SELECT * FROM orders GROUP By OrderCreateDate", "OrderCreateDate", "OrderCreateDate", "ASC"); ?>
                          <?php SelectOptions("SELECT * FROM order_payments GROUP By OrderPaymentDetails", "OrderPaymentDetails", "OrderPaymentDetails", "ASC"); ?>
                          <?php SelectOptions("SELECT * FROM order_payments GROUP By OrderPaymentReferenceId", "OrderPaymentReferenceId", "OrderPaymentReferenceId", "ASC"); ?>
                        </datalist>
                      </div>
                    </form>
                  </div>
                </div>
                <?php CLEAR_SEARCH(); ?>
                <div class="col-md-12 m-t-5">
                  <table class="table table-striped">
                    <thead>
                      <tr>
                        <th>ORDERID</th>
                        <th>CustomerName</th>
                        <th>TxnAmount</th>
                        <th>OrderDate</th>
                        <th>PaymentMode</th>
                        <th>PaymentStatus</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      if (isset($_GET['search']) == true) {
                        $searchvalue = $_GET['search_value'];
                        $search_type = $_GET['search_type'];
                        $FetchAllTxn = FetchConvertIntoArray("SELECT * FROM orders, order_payments where $search_type='$searchvalue' and orders.OrderId=order_payments.OrderRefId ORDER BY OrderPayments DESC", true);
                      } else {
                        $FetchAllTxn = FetchConvertIntoArray("SELECT * FROM orders, order_payments where orders.OrderId=order_payments.OrderRefId ORDER BY OrderPayments DESC", true);
                      }
                      if ($FetchAllTxn != null) {
                        foreach ($FetchAllTxn as $Request) {
                          $CustomerName = FETCH("SELECT * FROM customers where CustomerId='" . $Request->CustomerId . "'", "CustomerName"); ?>
                          <tr>
                            <td>
                              <a href="<?php echo DOMAIN; ?>/admin/orders/view.php?orderid=<?php echo SECURE($Request->OrderId, "e"); ?>" class="text-primary text-decoration-underline">
                                <img src="<?php echo STORAGE_URL_D; ?>/tool-img/orders..png" class="w-10 list-icon">
                                <?php echo $Request->CustomOrderId; ?>
                              </a>
                            </td>
                            <td><i class="fa fa-user text-primary"></i> <?php echo $CustomerName; ?></td>
                            <td><span class="text-success">Rs.<?php echo $Request->NetPayableAmount; ?></span></td>
                            <td><?php echo $Request->OrderCreateDate; ?></td>
                            <td><?php echo $Request->OrderPaymentMode; ?></td>
                            <td><?php echo $Request->OrderPaymentStatus; ?></td>
                            <td>
                              <div class="btn-group-sm btn-group">
                                <a href="<?php echo DOMAIN; ?>/web/invoices/print.php?orderid=<?php echo SECURE($Request->OrderId, "e"); ?>" target="_blank" class="btn btn-sm btn-success"> View Invoice</a>
                              </div>
                            </td>
                          </tr>
                      <?php }
                      } ?>
                    </tbody>
                  </table>
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