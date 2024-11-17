<?php

//required files
require '../../require/modules.php';
require '../../require/admin/access-control.php';
require '../../require/admin/sessionvariables.php';

//page variables
$PageName = "Configurations";
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
                <div class="col-md-12">
                  <div class="flex-s-b">
                    <?php include 'common.php'; ?>
                  </div>
                </div>
                <div class="col-md-8 col-lg-8 col-sm-7 col-12">
                  <form class="form row" action="../../controller/configcontroller.php" method="POST">
                    <?php FormPrimaryInputs(true); ?>
                    <div class="form-group col-md-6 col-sm-6">
                      <label>Company Name</label>
                      <input type="text" name="APP_NAME" value="<?php echo APP_NAME; ?>" class="form-control-2" required="">
                    </div>
                    <div class="form-group col-md-6 col-sm-6">
                      <label>Tagline</label>
                      <input type="text" name="TAGLINE" value="<?php echo TAGLINE; ?>" class="form-control-2" required="">
                    </div>
                    <div class="form-group col-md-6 col-sm-6">
                      <label>Phone Number</label>
                      <input type="text" name="PRIMARY_PHONE" value="<?php echo PRIMARY_PHONE; ?>" class="form-control-2" required="">
                    </div>
                    <div class="form-group col-md-6 col-sm-6">
                      <label>Email-ID</label>
                      <input type="text" name="PRIMARY_EMAIL" value="<?php echo PRIMARY_EMAIL; ?>" class="form-control-2" required="">
                    </div>
                    <div class="form-group col-md-6 col-sm-6">
                      <label>GST No</label>
                      <input type="text" name="PRIMARY_GST" value="<?php echo PRIMARY_GST; ?>" class="form-control-2" required="">
                    </div>
                    <div class="form-group col-md-12">
                      <label>Short Descriptions</label>
                      <textarea style="height: 100% !important;" class="form-control-2" name="SHORT_DESCRIPTION" required="" rows="2"><?php echo SECURE(SHORT_DESCRIPTION, "d"); ?></textarea>
                    </div>
                    <div class="form-group col-md-12">
                      <label>Complete Address (Primary)</label>
                      <textarea style="height: 100% !important;" class="form-control-2" name="PRIMARY_ADDRESS" required="" rows="3"><?php echo SECURE(PRIMARY_ADDRESS, 'd'); ?></textarea>
                    </div>
                    <div class="form-group col-md-12">
                      <label>Map Location Url</label>
                      <textarea type="url" style="height: 100% !important;" class="form-control-2" name="PRIMARY_MAP_LOCATION_LINK" required="" rows="5"><?php echo SECURE(PRIMARY_MAP_LOCATION_LINK, 'd'); ?></textarea>
                    </div>
                    <div class="form-group col-md-12">
                      <label>Android APP Link (Play store App link)</label>
                      <textarea type="url" style="height: 100% !important;" class="form-control-2" name="DOWNLOAD_ANDROID_APP_LINK" required="" rows="2"><?php echo DOWNLOAD_ANDROID_APP_LINK; ?></textarea>
                    </div>
                    <div class="form-group col-md-12">
                      <label>iOS App Link</label>
                      <textarea type="url" style="height: 100% !important;" class="form-control-2" name="DOWNLOAD_IOS_APP_LINK" required="" rows="2"><?php echo DOWNLOAD_IOS_APP_LINK; ?></textarea>
                    </div>
                    <div class="form-group col-md-12">
                      <label>Brocher or Pdf File Link</label>
                      <textarea type="url" style="height: 100% !important;" class="form-control-2" name="DOWNLOAD_BROCHER_LINK" required="" rows="2"><?php echo DOWNLOAD_BROCHER_LINK; ?></textarea>
                    </div>
                    <div class="col-md-12 m-t-10 m-b-10">
                      <button type="Submit" name="UpdatePrimaryConfigurations" class="btn btn-md app-btn">Update Details</button>
                    </div>
                  </form>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-5 col-12">
                  <div class="shadow-lg br10 p-2 border-success">
                    <div class="text-center br10 app-bg-light p-3">
                      <center>
                        <img src="<?php echo $MAIN_LOGO; ?>" class="w-25 mx-auto d-block rounded config-logo">
                      </center>
                      <form class="form m-t-3" action="../../controller/configcontroller.php" method="POST" enctype="multipart/form-data">
                        <input type="text" name="updatelogo" value="true" hidden="">
                        <?php echo CurrentFile(APP_LOGO); ?>
                        <?php FormPrimaryInputs(true); ?>
                        <label for="UploadAppLogo">
                          <img src="<?php echo STORAGE_URL_D; ?>/tool-img/img-upload.png" class="w-pr-10 upload-icon">
                        </label>
                        <input type="file" class="hidden" onchange="form.submit()" hidden="" name="APP_LOGO" id="UploadAppLogo" value="<?php echo APP_LOGO; ?>" accept="images/*">
                      </form>
                    </div>
                    <p class="m-t-10">
                      <span class="fs-20"> <?php echo APP_NAME; ?></span><br>
                      <span><i class="fa fa-phone text-info"></i> <?php echo PRIMARY_PHONE; ?></span><br>
                      <span><i class="fa fa-envelope text-danger"></i> <?php echo PRIMARY_EMAIL; ?></span><br>
                      <span><i class="fa fa-tag text-warning"></i> <?php echo TAGLINE; ?></span><br>
                      <span><i class="fa fa-list text-primary"></i> <?php echo SECURE(SHORT_DESCRIPTION, "d"); ?></span><br>
                      <span><i class="fa fa-map-marker text-success"></i> <?php echo SECURE(PRIMARY_ADDRESS, "d"); ?></span><br>
                    </p>
                    <iframe src="<?php echo SECURE(PRIMARY_MAP_LOCATION_LINK, 'd'); ?>" width="100%" height="250" style="border:0;" allowfullscreen="" loading="lazy">
                    </iframe>
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