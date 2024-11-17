<?php

//required files
require '../../require/modules.php';
require '../../require/admin/access-control.php';
require '../../require/admin/sessionvariables.php';

//page variables
$PageName = "Add Slider";
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
                        <input type="text" name="SliderName" class="form-control-2" required="">
                      </div>
                      <div class="form-group col-lg-4 col-md-4 col-sm-6 col-12">
                        <label>Slider Offer Text <?php echo $req ?></label>
                        <input type="text" name="SliderOfferText" class="form-control-2" required="">
                      </div>
                      <div class="form-group col-lg-4 col-md-4 col-sm-6 col-12">
                        <label>Slider Type <?php echo $req ?></label>
                        <select name="SliderType" class="form-control-2" required="">
                          <option value="Website" selected="">Website</option>
                        </select>
                      </div>
                      <div class="form-group col-lg-4 col-md-4 col-sm-6 col-12">
                        <label>Slider Location <?php echo $req ?></label>
                        <select name="SliderLocations" class="form-control-2" required="">
                          <option value="HomePageWebsite" selected="">HomePageWebsite</option>
                        </select>
                      </div>
                      <div class="form-group col-lg-4 col-md-4 col-sm-6 col-12">
                        <label>Slider Open At <?php echo $req ?></label>
                        <select name="SliderOpenAt" class="form-control-2" required="">
                          <option value="Same Page" selected="">Same Page</option>
                          <option value="New Tab">New Tab</option>
                        </select>
                      </div>
                      <div class="form-group col-lg-4 col-md-4 col-sm-6 col-12">
                        <label>Slider Target Url <?php echo $req ?></label>
                        <input type="text" name="SliderTargetUrl" class="form-control-2" required="">
                      </div>
                      <div class="form-group col-lg-12 col-md-12 col-sm-12 col-12">
                        <label>Slider Description <?php echo $req ?></label>
                        <textarea name="SliderDescriptions" rows="5" class="form-control-2 height-auto" required=""></textarea>
                      </div>
                      <?php UploadImageInput("SliderImage", "sliderImage", "image/png, image/gif, image/jpeg", true, "col-lg-12 col-md-12 col-sm-12 col-12"); ?>
                      <div class="col-md-12">
                        <button name="SaveSlider" type="submit" class="btn btn-lg app-btn">Save</button>
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