<?php

//required files
require '../../require/modules.php';
require '../../require/admin/access-control.php';
require '../../require/admin/sessionvariables.php';

//page variables
$PageName = "All Cancelled";
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
                  <h4 class="app-heading"><i class="fa fa-shopping-cart"></i> <?php echo $PageName; ?></h4>
                </div>
              </div>
              <?php include "common.php"; ?>
              <div class="row m-t-10">
                <div class="col-md-12">
                  <div class="table-responsive">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>OrderId</th>
                          <th>CustomerName</th>
                          <th>OrderAmount</th>
                          <th>PayMode</th>
                          <th>OrderDate</th>
                          <th>OrderStatus</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <?php
                      if (isset($_GET['search']) == true) {
                        $searchvalue = $_GET['search_value'];
                        $search_type = $_GET['search_type'];
                        $search_type = str_replace(" ", "", $search_type);
                        $DB_DATA_FETCH = FetchConvertIntoArray("SELECT * FROM orders where orders.$search_type='$searchvalue' and OrderStatus='6' ORDER BY OrderId DESC", true);
                      } else {
                        $DB_DATA_FETCH = FetchConvertIntoArray("SELECT * FROM orders where OrderStatus='6' ORDER BY OrderId DESC", true);
                      }
                      if ($DB_DATA_FETCH == null) {
                        NoDataTableView("No Orders Found!", "3");
                      } else {
                        foreach ($DB_DATA_FETCH as $DATA) {
                          $CustomerName = FETCH("SELECT * FROM customers where CustomerId='" . $DATA->CustomerId . "'", "CustomerName"); ?>
                          <tr>
                            <td>
                              <img src="<?php echo STORAGE_URL_D; ?>/tool-img/orders..png" class="w-10 list-icon">
                            </td>
                            <td>
                              <a href="<?php echo DOMAIN; ?>/admin/orders/view.php?orderid=<?php echo SECURE($DATA->OrderId, "e"); ?>" class="text-primary text-decoration-underline"><?php echo $DATA->CustomOrderId; ?></a>
                            </td>
                            <td><i class="fa fa-user text-primary"></i> <?php echo $CustomerName; ?></td>
                            <td><span class="text-success">Rs.<?php echo $DATA->NetPayableAmount; ?></span></td>
                            <td><?php echo $DATA->OrderPaymentMode; ?></td>
                            <td><?php echo $DATA->OrderCreateDate; ?></td>
                            <td><?php echo orderStatus($DATA->OrderStatus); ?></td>
                            <td>
                              <div class="btn-group-sm btn-group">
                                <a href="<?php echo DOMAIN; ?>/admin/orders/view.php?orderid=<?php echo SECURE($DATA->OrderId, "e"); ?>" class="btn btn-sm btn-dark"><i class="fa fa-eye"></i></a>
                                <a href="<?php echo DOMAIN; ?>/admin/orders/view.php?orderid=<?php echo SECURE($DATA->OrderId, "e"); ?>" class="btn btn-sm btn-success"><i class="fa fa-check-circle-o"></i></a>
                              </div>
                            </td>
                          </tr>
                      <?php }
                      } ?>
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