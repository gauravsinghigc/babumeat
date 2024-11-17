<?php

//required files
require '../../../require/modules.php';
require '../../../require/admin/access-control.php';
require '../../../require/admin/sessionvariables.php';

//page variables
$PageName = "Edit Offers";

if (isset($_GET['id'])) {
  $OffersId = SECURE($_GET['id'], "d");
  $_SESSION['OffersId'] = $OffersId;
} else {
  $OffersId = $_SESSION['OffersId'];
}

//page variables
$PageSqls = "SELECT * FROM offers WHERE OffersId='$OffersId'";
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=0.9">
  <title><?php echo GET_DATA("OffersName"); ?> | <?php echo APP_NAME; ?></title>
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
                        <input type="text" name="OffersName" value="<?php echo GET_DATA('OffersName'); ?>" placeholder="" class="form-control-2" required="">
                      </div>
                      <div class="form-group col-lg-4 col-sm-4 col-md-4 col-6">
                        <label>Offer Coupon Code</label>
                        <input type="text" name="OfferCouponCode" value="<?php echo GET_DATA('OfferCouponCode'); ?>" placeholder="" class="form-control-2 text-capitalize" required="">
                      </div>
                      <div class="form-group col-lg-4 col-sm-4 col-md-4 col-6">
                        <label>Offer Discount Type</label>
                        <select class="form-control-2" name="OfferDiscountType" required="">
                          <?php if (GET_DATA("OfferDiscountType") == "Percentage") {
                            echo '<option value="Percentage" selected>Percentage</option>';
                            echo '<option value="Amount">Amount</option>';
                          } else {
                            echo '<option value="Percentage">Percentage</option>';
                            echo '<option value="Amount" selected>Amount</option>';
                          } ?>
                        </select>
                      </div>
                      <div class="form-group col-lg-4 col-sm-4 col-md-4 col-6">
                        <label>Offer Discount Value (Maybe % or Amount/Value)</label>
                        <input type="number" name="OfferDiscountValue" value="<?php echo GET_DATA('OfferDiscountValue'); ?>" placeholder="" class="form-control-2 text-capitalize" required="">
                      </div>
                      <div class="col-md-12 form-group">
                        <label>Offer Descriptions</label>
                        <textarea name="OfferDescriptions" id="editor" class="form-control-2" rows="4"><?php echo html_entity_decode(SECURE(GET_DATA("OfferDescriptions"), "d")); ?></textarea>
                      </div>
                      <div class="col-md-12">
                        <img src="<?php echo STORAGE_URL; ?>/offers/<?php echo GET_DATA('OfferImage'); ?>" class="ImgPreview w-25">
                        <input type="text" name="OfferImage1" value="<?php echo GET_DATA("OfferImage"); ?>" hidden="">
                        <?php UploadImageInput("OfferImage", "OfferImage1", "image/*", false, ""); ?>
                      </div>
                      <div class="col-md-12">
                        <div class="row">
                          <div class="col-lg-3 col-md-3 col-sm-12 col-12">
                            <div class="form-group">
                              <label>Blogs Status</label>
                              <?php if (GET_DATA("OfferStatus") == "0") { ?>
                                <select name="OfferStatus" class="form-control-2" required="">
                                  <option value="1">Active</option>
                                  <option value="0" selected="">Inactive</option>
                                </select>
                              <?php } else { ?>
                                <select name="OfferStatus" class="form-control-2" required="">
                                  <option value="0">Inactive</option>
                                  <option value="1" selected="">Active</option>
                                </select>
                              <?php } ?>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-12">
                        <br>
                        <button type="submit" name="UpdateOffers" value="<?php echo SECURE(GET_DATA("OffersId"), "e"); ?>" class="btn btn-md app-btn">Update</button>
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