<?php

//required files
require '../../require/modules.php';
require '../../require/admin/access-control.php';
require '../../require/admin/sessionvariables.php';

//page variables
$PageName = "Edit Slider";
if (isset($_GET['viewid'])) {
  $Requested_SliderId = $_GET['viewid'];
  $_SESSION['SLIDER_VIEW_ID'] = $Requested_SliderId;
} else {
  $Requested_SliderId = $_SESSION['SLIDER_VIEW_ID'];
}

$Requested_SliderId = SECURE($Requested_SliderId, "d");
$PageSqls = "SELECT * FROM sliders WHERE SliderId='$Requested_SliderId'";
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=0.9">
  <title><?php echo GET_DATA("SliderName"); ?> | <?php echo APP_NAME; ?></title>
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
                  <h3 class="app-heading"><?php echo $PageName; ?></h3>
                </div>
              </div>
              <div class="row m-t-10">
                <div class="col-md-12">
                  <form action="../../controller/slidercontroller.php" method="POST" enctype="multipart/form-data">
                    <?php FormPrimaryInputs(true); ?>
                    <div class="row">
                      <div class="form-group col-lg-4 col-md-4 col-sl-6 col-12">
                        <label>Slider name <?php echo $req ?></label>
                        <input type="text" name="SliderName" value="<?php echo GET_DATA("SliderName"); ?>" class="form-control-2" required="">
                      </div>
                      <div class="form-group col-lg-4 col-md-4 col-sm-6 col-12">
                        <label>Slider Offer Text <?php echo $req ?></label>
                        <input type="text" name="SliderOfferText" value="<?php echo GET_DATA("SliderOfferText"); ?>" class="form-control-2" required="">
                      </div>
                      <div class="form-group col-lg-4 col-md-4 col-sm-6 col-12">
                        <label>Slider Type <?php echo $req ?></label>
                        <select name="SliderType" class="form-control-2" required="">
                          <option value="<?php echo GET_DATA("SliderType"); ?>" selected=""><?php echo GET_DATA('SliderType'); ?></option>
                        </select>
                      </div>
                      <div class="form-group col-lg-4 col-md-4 col-sm-6 col-12">
                        <label>Slider Location <?php echo $req ?></label>
                        <select name="SliderLocations" class="form-control-2" required="">
                          <option value="<?php echo GET_DATA("SliderLocations"); ?>" selected=""><?php echo GET_DATA('SliderLocations'); ?></option>
                        </select>
                      </div>
                      <div class="form-group col-lg-4 col-md-4 col-sm-6 col-12">
                        <label>Slider Open At <?php echo $req ?></label>
                        <select name="SliderOpenAt" class="form-control-2" required="">
                          <option value="<?php echo GET_DATA("SliderOpenAt"); ?>" selected=""><?php echo GET_DATA('SliderOpenAt'); ?></option>
                        </select>
                      </div>
                      <div class="form-group col-lg-4 col-md-4 col-sm-6 col-12">
                        <label>Slider Target Url <?php echo $req ?></label>
                        <input type="text" name="SliderTargetUrl" value="<?php echo GET_DATA("SliderTargetUrl"); ?>" class="form-control-2" required="">
                      </div>
                      <div class="form-group col-md-6 col-lg-6 col-sm-6 col-12">
                        <label>Slider Status</label>
                        <select class="form-control-2" name="SliderStatus" required="">
                          <?php
                          if (GET_DATA("SliderStatus") == 1) { ?>
                            <option value="1" selected="">Active</option>
                            <option value="2">Inactive</option>
                          <?php } else { ?>
                            <option value="1">Active</option>
                            <option value="2" selected="">Inactive</option>
                          <?php } ?>
                        </select>
                      </div>
                      <div class="form-group col-lg-12 col-md-12 col-sm-12 col-12">
                        <label>Slider Description <?php echo $req ?></label>
                        <textarea name="SliderDescriptions" rows="5" class="form-control-2 height-auto" required=""><?php echo SECURE(GET_DATA("SliderDescriptions"), "d"); ?></textarea>
                      </div>
                      <div class="form-group col-lg-4 col-md-4 col-ms-4 col-12">
                        <label>Slider Image</label>
                        <input type="FILE" name="SliderImage" value="null" class="form-control-2" />
                        <input type="hidden" name="SliderImage_CURRENT" value="<?php echo SECURE(GET_DATA('SliderImage'), "e"); ?>" class="form-control-2" hidden="">
                        <img src="<?php echo STORAGE_URL; ?>/sliders/<?php echo GET_DATA("SliderImage"); ?>" class="imgrpreview m-t-10">
                      </div>
                      <div class="col-md-12">
                        <button name="UpdateSlider" value="<?php echo SECURE($Requested_SliderId, "e"); ?>" type="submit" class="btn btn-lg app-btn">Update Slider</button>
                        <button type="reset" class="btn btn-lg btn-default">Reset</button>
                        <a href="<?php echo DOMAIN; ?>/admin/website/" class="btn btn-lg btn-primary">Back to All</a>
                      </div>
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