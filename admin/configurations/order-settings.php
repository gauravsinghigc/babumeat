<?php

//required files
require '../../require/modules.php';
require '../../require/admin/access-control.php';
require '../../require/admin/sessionvariables.php';

//page variables
$PageName = "Order Settings";
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
                           <h4 class="app-heading"><?php echo $PageName; ?></h4>
                        </div>
                        <div class="col-md-12 m-b-10">
                           <div class="flex-s-b">
                              <?php include 'common.php'; ?>
                           </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-12">
                           <div class="shadow-lg br10 p-2">
                              <h4 class="app-heading">Delivery Charges</h4>
                              <form class="form row" action="../../controller/configcontroller.php" method="POST">
                                 <?php FormPrimaryInputs(true); ?>
                                 <div class="form-group form-group-2 col-md-12">
                                    <label>Field Name</label>
                                    <input type="text" name="Dcchargename" class="form-control-2" required="" value="<?php echo FETCH("SELECT * FROM deliverycharges where deliverychargesid='1'", "Dcchargename"); ?>">
                                 </div>
                                 <div class="form-group form-group-2 col-md-12">
                                    <label>Minimum Order Amount</label>
                                    <input type="text" name="dccartamount" class="form-control-2" required="" value="<?php echo FETCH("SELECT * FROM deliverycharges where deliverychargesid='1'", "dccartamount"); ?>">
                                 </div>
                                 <div class="form-group form-group-2 col-md-12">
                                    <label>Charge Below Minimum</label>
                                    <input type="text" name="dcchargeamount" class="form-control-2" required="" value="<?php echo FETCH("SELECT * FROM deliverycharges where deliverychargesid='1'", "dcchargeamount"); ?>">
                                 </div>
                                 <div class="form-group form-group-2 col-md-12">
                                    <label>Enable Charge or Not</label>
                                    <select name="dchargestatus" class="form-control-2" required="">
                                       <?php
                                       $pgstatus = FETCH("SELECT * FROM deliverycharges where deliverychargesid='1'", "dchargestatus");
                                       if ($pgstatus == "1") { ?>
                                          <option value="2">Disabled</option>
                                          <option value="1" selected="">Enabled</option>
                                       <?php } else { ?>
                                          <option value="2" selected="">Disabled</option>
                                          <option value="1">Enabled</option>
                                       <?php  } ?>
                                    </select>
                                 </div>
                                 <div class="col-md-12 m-t-10">
                                    <button name="UpdateDeliveryCharges" value="<?php echo SECURE("1", "e"); ?>" class="app-btn btn btn-md">Update Charges</button>
                                 </div>
                              </form>
                           </div>
                        </div>

                        <div class="col-lg-4 col-md-4 col-sm-4 col-12">
                           <div class="shadow-lg br10 p-2">
                              <h4 class="app-heading">MIN or Max Orders Qty</h4>
                              <form class="form row" action="../../controller/configcontroller.php" method="POST">
                                 <?php FormPrimaryInputs(true); ?>
                                 <div class="form-group form-group-2 col-md-12">
                                    <label>Max Order Qty</label>
                                    <input type="text" name="MAX_ORDER_QTY" class="form-control-2" required="" value="<?php echo MAX_ORDER_QTY; ?>">
                                 </div>
                                 <div class="form-group form-group-2 col-md-12">
                                    <label>Min Order Qty</label>
                                    <input type="text" name="MIN_ORDER_QTY" class="form-control-2" required="" value="<?php echo MIN_ORDER_QTY; ?>">
                                 </div>
                                 <div class="col-md-12 m-t-10">
                                    <button name="UpdateMaxOrderQTY" value="<?php echo SECURE("1", "e"); ?>" class="app-btn btn btn-md">Update Orders Qty</button>
                                 </div>
                              </form>
                           </div>
                        </div>

                        <div class="col-lg-4 col-md-4 col-sm-4 col-12">
                           <div class="shadow-lg br10 p-2">
                              <h4 class="app-heading">Payment & Order Terms</h4>
                              <form class="form row" action="../../controller/configcontroller.php" method="POST">
                                 <?php FormPrimaryInputs(true); ?>
                                 <div class="col-md-12 form-group">
                                    <label>Shipping & Installation Descriptions</label>
                                    <textarea class="form-control-2 editor" name="INSTALLATION_SHIPPING" rows="3" style="height:auto !important;"><?php echo SECURE(CONFIG("INSTALLATION_SHIPPING"), "d"); ?></textarea>
                                 </div>
                                 <div class="col-md-12">
                                    <br>
                                    <button type="submit" name="UpdateShippingInstalltion" class="app-btn btn btn-md">Update Details</button>
                                 </div>
                              </form>
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