<?php

//required files
require '../../../require/modules.php';
require '../../../require/admin/access-control.php';
require '../../../require/admin/sessionvariables.php';

//page variables
$PageName = "Add New Offers";
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=0.9">
  <title><?php echo $PageName; ?> | <?php echo APP_NAME; ?></title>
  <?php include '../../../include/admin/header_files.php'; ?>

</head>

<body>
  <div id="container" class="effect mainnav-lg navbar-fixed mainnav-fixed">
    <?php include '../../../include/admin/header.php'; ?>

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
              </div>
              <div class="row m-t-10">
                <div class="col-md-12">
                  <form action="../../../controller/offercontroller.php" method="POST" enctype="multipart/form-data">
                    <?php FormPrimaryInputs(true); ?>
                    <div class="row">
                      <div class="form-group col-lg-4 col-sm-4 col-md-4 col-6">
                        <label>Offers Name</label>
                        <input type="text" name="OffersName" value="" placeholder="" class="form-control-2" required="">
                      </div>
                      <div class="form-group col-lg-4 col-sm-4 col-md-4 col-6">
                        <label>Offer Coupon Code</label>
                        <input type="text" name="OfferCouponCode" value="" placeholder="" class="form-control-2 text-capitalize" required="">
                      </div>
                      <div class="form-group col-lg-4 col-sm-4 col-md-4 col-6">
                        <label>Offer Discount Type</label>
                        <select class="form-control-2" name="OfferDiscountType" required="">
                          <?php InputOptions(["Percentage", "Amount"]); ?>
                        </select>
                      </div>
                      <div class="form-group col-lg-4 col-sm-4 col-md-4 col-6">
                        <label>Offer Discount Value (Maybe % or Amount/Value)</label>
                        <input type="number" name="OfferDiscountValue" value="" placeholder="" class="form-control-2 text-capitalize" required="">
                      </div>
                      <div class="col-md-12 form-group">
                        <label>Offer Descriptions</label>
                        <textarea name="OfferDescriptions" id="editor" class="form-control-2" rows="4"></textarea>
                      </div>
                      <div class="col-md-12">
                        <?php UploadImageInput("OfferImage", "OfferImage1", "image/*", true, ""); ?>
                      </div>
                      <div class="col-md-12">
                        <br>
                        <button type="submit" name="CreateOffers" class="btn btn-md app-btn">Save</button>
                        <button type="reset" class="btn btn-md btn-danger">Reset</button>
                        <a href="<?php echo DOMAIN; ?>/admin/website/offers/" class="btn btn-md btn-primary">Back to All</a>
                        <br>
                        <br>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>

          <!--End page content-->
        </div>

        <?php include '../../../include/admin/sidebar.php'; ?>
      </div>
      <?php include '../../../include/admin/footer.php'; ?>
    </div>

    <?php include '../../../include/admin/footer_files.php'; ?>
</body>

</html>