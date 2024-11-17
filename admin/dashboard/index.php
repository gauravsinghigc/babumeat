<?php

//required files
require '../../require/modules.php';
require '../../require/admin/access-control.php';
require '../../require/admin/sessionvariables.php';

//page variables
$PageName = "Dashboard";
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
    <div id="container" class="effect navbar-fixed mainnav-fixed mainnav-lg">
        <?php include '../../include/admin/header.php'; ?>

        <div class="boxed">
            <!--CONTENT CONTAINER-->
            <!--===================================================-->
            <div id="content-container">
                <!--Page content-->
                <!--===================================================-->
                <div id="page-content">
                    <div class="panel">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <h4 class="app-heading"><i class="fa fa-home"></i> Dashboard</h4>
                                </div>
                            </div>

                            <div class="row m-t-10">
                                <div class="col-lg-7 col-md-7 col-sm-7 col-12">
                                    <div class="widget-background">
                                        <div class="flex-space-between">
                                            <div>
                                                <h1><?php echo TOTAL("SELECT * FROM visitors where VisitorsType='New' and VisitorVisitingDate='" . date("d-m-Y") . "'"); ?> <span class="fs-13 text-grey"> New Visits Today</span></h1>
                                                <span>Yesterday :
                                                    <?php
                                                    $yesterday = date("d-m-Y", strtotime("-1 days"));
                                                    echo TOTAL("SELECT * FROM visitors where VisitorVisitingDate='" . $yesterday . "'"); ?>
                                                    <span class="fs-13 text-grey">visitors</span>
                                                </span>
                                                <br>
                                                <span>Last Month :
                                                    <?php
                                                    $lastmonth = date("d-m-Y", strtotime("-1 months"));
                                                    echo TOTAL("SELECT * FROM visitors where VisitorVisitingDate like '%" . $lastmonth . "%'"); ?>
                                                    <span class="fs-13 text-grey">visitors</span>
                                                </span>
                                            </div>
                                            <div>
                                                <h1><?php echo TOTAL("SELECT * FROM visitors where VisitorsType='Re-visits' and VisitorVisitingDate='" . date("d-m-Y") . "'"); ?> <span class="fs-13 text-grey"> Revisits Today</span></h1>
                                                <span>Fresh Visitors : <?php echo TOTAL("SELECT * FROM visitors where VisitorsType='New'"); ?> <span class="fs-13 text-grey">visitors</span></span><br>
                                                <span>Re-visit Visitors : <?php echo TOTAL("SELECT * FROM visitors where VisitorsType='Re-visits'"); ?> <span class="fs-13 text-grey">visitors</span></span>
                                            </div>
                                        </div>
                                        <div class="flex-space-between">
                                            <span class="text-success">
                                                <text>Mobile : <?php echo TOTAL("SELECT * FROM visitors where VisitorDeviceType='Mobile' and VisitorsType='New'"); ?></text> <span class="fs-13 text-grey"> fresh visitors</span><br>
                                                <text>Mobile : <?php echo TOTAL("SELECT * FROM visitors where VisitorDeviceType='Mobile' and VisitorsType='Re-visits'"); ?></text> <span class="fs-13 text-grey"> Re-visits visitors</span>
                                            </span>
                                            <span class="text-danger">
                                                <text>Desktop : <?php echo TOTAL("SELECT * FROM visitors where VisitorDeviceType='Computer' and VisitorsType='New'"); ?></text> <span class="fs-13 text-grey"> fresh visitors</span><br>
                                                <text>Desktop : <?php echo TOTAL("SELECT * FROM visitors where VisitorDeviceType='Computer' and VisitorsType='Re-visits'"); ?></text> <span class="fs-13 text-grey"> Re-visits visitors</span>
                                            </span>
                                            <span class="text-info">
                                                <text>Tablet : <?php echo TOTAL("SELECT * FROM visitors where VisitorDeviceType='Tablet' and VisitorsType='New'"); ?></text> <span class="fs-13 text-grey"> fresh visitors</span><br>
                                                <text>Tablet : <?php echo TOTAL("SELECT * FROM visitors where VisitorDeviceType='Tablet' and VisitorsType='Re-visits'"); ?></text> <span class="fs-13 text-grey">Re-visits visitors</span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-5 col-lg-5 col-sm-5 col-12">
                                    <div class="widget-background">
                                        <h1 style="font-size: 4.27rem;"><?php echo TOTAL("SELECT * FROM visitors where VisitorsType='New' and VisitorVisitingDate='" . date("d-m-Y") . "'"); ?></h1>
                                        <span class="text-primary">Fresh Visitors Today</span> <br> <span class="text-black">Net Total Visitors : <?php echo TOTAL("SELECT * FROM visitors"); ?></span>
                                    </div>
                                </div>
                            </div>
                            <hr>

                            <div class="row m-t-10">

                                <div class="col-lg-3 col-md-3 col-sm-3 col-6  m-b-5">
                                    <div class="widget-background">
                                        <h2><?php echo TOTAL("SELECT * FROM customers"); ?></h2>
                                        <p>Total Customers</p>
                                    </div>
                                </div>

                                <div class="col-lg-3 col-md-3 col-sm-3 col-6  m-b-5">
                                    <div class="widget-background">
                                        <h2><?php echo TOTAL("SELECT * FROM orders"); ?></h2>
                                        <p>Total Orders</p>
                                    </div>
                                </div>

                                <div class="col-lg-3 col-md-3 col-sm-3 col-6  m-b-5">
                                    <div class="widget-background">
                                        <h2>Rs.
                                            <?php
                                            $fetchpay2 = SELECT("SELECT * FROM order_payments");
                                            $TotalAMount = 0;
                                            while ($fetchpay = mysqli_fetch_array($fetchpay2)) {
                                                $TotalAMount += (int)$fetchpay['OrderPaymentAmount'];
                                            }
                                            echo $TotalAMount; ?></h2>
                                        <p>Total Order Amount</p>
                                    </div>
                                </div>

                                <div class="col-lg-3 col-md-3 col-sm-3 col-6  m-b-5">
                                    <div class="widget-background">
                                        <h2><?php echo TOTAL("SELECT * FROM products"); ?></h2>
                                        <p>Total Products</p>
                                    </div>
                                </div>

                                <div class="col-lg-3 col-md-3 col-sm-3 col-6  m-b-5">
                                    <div class="widget-background">
                                        <h2><?php echo TOTAL("SELECT * FROM enquiries"); ?></h2>
                                        <p>Total Enquiries</p>
                                    </div>
                                </div>

                                <div class="col-lg-3 col-md-3 col-sm-3 col-6  m-b-5">
                                    <div class="widget-background">
                                        <h2><?php echo TOTAL("SELECT * FROM reviews"); ?></h2>
                                        <p>Total Reviews</p>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="flex-s-b app-heading">
                                        <h4 class="m-t-4 m-b-0">Latest 10 Orders</h4>
                                        <a href="<?php echo DOMAIN; ?>/admin/orders/" class="btn btn-primary btn-sm pull-right">View All Orders</a>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-striped" id="demo-dt-basic">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>OrderId</th>
                                                    <th>CustomerName</th>
                                                    <th>OrderAmount</th>
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
                                                $DB_DATA_FETCH = FetchConvertIntoArray("SELECT * FROM orders where orders.$search_type='$searchvalue' ORDER BY OrderId DESC limit 0, 10", true);
                                            } else {
                                                $DB_DATA_FETCH = FetchConvertIntoArray("SELECT * FROM orders ORDER BY OrderId DESC limit 0, 10", true);
                                            }
                                            if ($DB_DATA_FETCH == null) {
                                                NoDataTableView("No Orders Found!", "3");
                                            } else {
                                                $count = 0;
                                                foreach ($DB_DATA_FETCH as $DATA) {
                                                    $count++;
                                                    $CustomerName = FETCH("SELECT * FROM customers where CustomerId='" . $DATA->CustomerId . "'", "CustomerName"); ?>
                                                    <tr>
                                                        <td>
                                                            <?php echo $count; ?>
                                                        </td>
                                                        <td>
                                                            <a href="<?php echo DOMAIN; ?>/admin/orders/view.php?orderid=<?php echo SECURE($DATA->OrderId, "e"); ?>" class="text-primary text-decoration-underline">
                                                                <?php echo $DATA->CustomOrderId; ?>
                                                            </a>
                                                        </td>
                                                        <td><i class="fa fa-user text-primary"></i> <?php echo $CustomerName; ?></td>
                                                        <td><span class="text-success">Rs.<?php echo $DATA->NetPayableAmount; ?></span></td>
                                                        <td><?php echo $DATA->OrderCreateDate; ?></td>
                                                        <td><?php echo orderStatus($DATA->OrderStatus); ?></td>
                                                        <td>
                                                            <div class="btn-group-sm btn-group">
                                                                <a href="<?php echo DOMAIN; ?>/admin/orders/view.php?orderid=<?php echo SECURE($DATA->OrderId, "e"); ?>" class="btn btn-sm btn-dark"><i class="fa fa-eye"></i></a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                            <?php }
                                            } ?>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="flex-s-b app-heading">
                                        <h4 class="m-t-4 m-b-0">Latest 10 Transactions</h4>
                                        <a href="<?php echo DOMAIN; ?>/admin/transactions/" class="btn btn-primary btn-sm pull-right">View All Transactions</a>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>ORDERID</th>
                                                    <th>CustomerName</th>
                                                    <th>Amount</th>
                                                    <th>OrderDate</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                if (isset($_GET['search']) == true) {
                                                    $searchvalue = $_GET['search_value'];
                                                    $search_type = $_GET['search_type'];
                                                    $FetchAllTxn = FetchConvertIntoArray("SELECT * FROM orders, order_payments where $search_type='$searchvalue' and orders.OrderId=order_payments.OrderRefId ORDER BY OrderPayments DESC limit 0, 10", true);
                                                } else {
                                                    $FetchAllTxn = FetchConvertIntoArray("SELECT * FROM orders, order_payments where orders.OrderId=order_payments.OrderRefId ORDER BY OrderPayments DESC limit 0, 10", true);
                                                }
                                                if ($FetchAllTxn != null) {
                                                    foreach ($FetchAllTxn as $Request) {
                                                        $CustomerName = FETCH("SELECT * FROM customers where CustomerId='" . $Request->CustomerId . "'", "CustomerName"); ?>
                                                        <tr>
                                                            <td>
                                                                <a href="<?php echo DOMAIN; ?>/admin/orders/view.php?orderid=<?php echo SECURE($Request->OrderId, "e"); ?>" class="text-primary text-decoration-underline">
                                                                    <?php echo $Request->CustomOrderId; ?>
                                                                </a>
                                                            </td>
                                                            <td><i class="fa fa-user text-primary"></i> <?php echo $CustomerName; ?></td>
                                                            <td><span class="text-success">Rs.<?php echo $Request->NetPayableAmount; ?></span></td>
                                                            <td><?php echo $Request->OrderCreateDate; ?></td>
                                                            <td><?php echo $Request->OrderPaymentStatus; ?></td>
                                                            <td>
                                                                <div class="btn-group-sm btn-group">
                                                                    <a href="<?php echo DOMAIN; ?>/admin/orders/view.php?orderid=<?php echo SECURE($Request->OrderId, "e"); ?>" class="btn btn-sm btn-success"><i class="fa fa-shopping-basket"></i></a>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                <?php }
                                                } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="flex-s-b app-heading">
                                        <h4 class="m-t-4 m-b-0">Latest 10 Reviews</h4>
                                        <a href="<?php echo DOMAIN; ?>/admin/reviews/" class="btn btn-primary btn-sm pull-right">View All Reviews</a>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Sno</th>
                                                    <th>Stars</th>
                                                    <th>ReviewBy</th>
                                                    <th>ReviewTitle</th>
                                                    <th>CreatedAt</th>
                                                </tr>
                                            </thead>
                                            <?php
                                            $FetchListings = FetchConvertIntoArray("SELECT * FROM reviews ORDER BY ReviewsId DESC Limit 0, 10", true);
                                            if ($FetchListings != null) {
                                                $Sno = 0;
                                                foreach ($FetchListings as $Fields) {
                                                    $Sno++; ?>
                                                    <tbody>
                                                        <tr>
                                                            <td><?php echo $Sno; ?></td>
                                                            <td class="text-warning">
                                                                <?php
                                                                $StarCounts = 0;
                                                                while ($StarCounts < (int)SECURE($Fields->ReviewStarCount, "d")) {
                                                                    $StarCounts++;
                                                                    echo "<i class='fa fa-star text-warning'></i>";
                                                                } ?>
                                                            </td>
                                                            <td><?php echo FETCH("SELECT * FROM customers where CustomerId='" . SECURE($Fields->ReviewedCustomerId, "d") . "'", "CustomerName"); ?></td>
                                                            <td><?php echo SECURE($Fields->ReviewTitle, "d"); ?></td>
                                                            <td><?php echo DATE_FORMATE2("d M, Y", $Fields->ReviewCreatedAt); ?></td>
                                                        </tr>
                                                    </tbody>
                                            <?php }
                                            }
                                            ?>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--===================================================-->
                <!--End page content-->
            </div>

            <?php include '../../include/admin/sidebar.php'; ?>
        </div>
        <?php include '../../include/admin/footer.php'; ?>
    </div>

    <?php include '../../include/admin/footer_files.php'; ?>
</body>

</html>