<?php

//required files
require '../../../require/modules.php';
require '../../../require/admin/access-control.php';
require '../../../require/admin/sessionvariables.php';

//page variables
$PageName = "Add New Social Link";
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
              <div class="row">
                <div class="col-md-12 p-2">
                  <form action="<?php echo CONTROLLER; ?>/socialaccountcontroller.php" method="POST">
                    <?php FormPrimaryInputs(true); ?>
                    <div class="flex-s-b">
                      <div class="form-group w-50">
                        <label>Social Account Name</label>
                        <input type="text" class="form-control-2" name="socialaccountname" placeholder="Social Account Name" required>
                      </div>
                      <div class="form-group w-50">
                        <?php Label("Social Account Icon", [
                          "for" => "SocialAccountIcon"
                        ]); ?>
                        <select name="socialaccounticon" class="form-control-2" required="">
                          <?php InputOptions(["fa-facebook", "fa-twitter", "fa-youtube", "fa-instagram", "fa-google", "fa-phone", "fa-whatsapp", "fa-envelope", "fa-rss"]); ?>
                        </select>
                      </div>
                    </div>

                    <div class="form-group">
                      <?php
                      Label("Social Account URL", [
                        "for" => "SocialAccountUrl"
                      ]);
                      Input([
                        "name" => "socialaccounturl",
                        "type" => "url",
                        "class" => "form-control-2",
                        "required" => ""
                      ]);
                      ?>
                    </div>
                    <div class="form-group w-25">
                      <?php
                      Label("Url Open At", [
                        "for" => "TargetUrl"
                      ]);
                      ?>
                      <select class="form-control-2" name="socialaccountopenat">
                        <option value="_blank">New tab</option>
                        <option value="">Same Tab</option>
                      </select>
                    </div>
                    <div class="col-md-12 m-t-10">
                      <button class="btn app-btn" type="submit" name="SaveSocialAccountLinks" value="<?php echo SECURE("true", "e"); ?>">Save Links</button>
                      <button class="btn btn-md btn-default" name="resetform" type="reset">Reset</button>
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