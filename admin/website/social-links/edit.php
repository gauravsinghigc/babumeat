<?php

//required files
require '../../../require/modules.php';
require '../../../require/admin/access-control.php';
require '../../../require/admin/sessionvariables.php';

//page variables
$PageName = "Edit Social Link";

if (isset($_GET['id'])) {
  $socialaccountid = SECURE($_GET['id'], "d");
  $_SESSION['socialaccountid'] = $socialaccountid;
} else {
  $socialaccountid = $_SESSION['socialaccountid'];
}

//page variables
$PageSqls = "SELECT * FROM socialaccounts WHERE socialaccountid='$socialaccountid'";
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=0.9">
  <title><?php echo GET_DATA("socialaccountname"); ?> | <?php echo APP_NAME; ?></title>
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
                  <h4 class="app-heading"><?php echo $PageName; ?> <i class="fa fa-angle-right"></i> <?php echo GET_DATA("socialaccountname"); ?></h4>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12 p-2">
                  <form action="<?php echo CONTROLLER; ?>/socialaccountcontroller.php" method="POST">
                    <?php FormPrimaryInputs(true); ?>
                    <div class="flex-s-b">
                      <div class="form-group w-50">
                        <label>Social Account Name</label>
                        <input type="text" class="form-control-2" value="<?php echo GET_DATA("socialaccountname"); ?>" name="socialaccountname" placeholder="Social Account Name" required>
                      </div>
                      <div class="form-group w-50">
                        <?php Label("Social Account Icon", [
                          "for" => "SocialAccountIcon"
                        ]); ?>
                        <select name="socialaccounticon" class="form-control-2" required="">
                          <option value="<?php echo GET_DATA("socialaccounticon"); ?>" selected><?php echo GET_DATA("socialaccounticon"); ?></option>
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
                        "required" => "",
                        "value" => GET_DATA("socialaccounturl")
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
                        <?php if (GET_DATA("socialaccountopenat") == "_blank") { ?>
                          <option value="_blank" selected="">New tab</option>
                          <option value="">Same Tab</option>
                        <?php } else { ?>
                          <option value="_blank">New tab</option>
                          <option value="" selected="">Same Tab</option>
                        <?php } ?>
                      </select>
                    </div>
                    <div class="form-group w-25">
                      <?php
                      Label("Social Account Visibility", [
                        "for" => "Status"
                      ]);
                      ?>
                      <select class="form-control-2" name="socialaccountstatus">
                        <?php if (GET_DATA("socialaccountstatus") == "_blank") { ?>
                          <option value="1" selected="">Active</option>
                          <option value="2">Inactive</option>
                        <?php } else { ?>
                          <option value="1">Active</option>
                          <option value="2">Inactive</option>
                        <?php } ?>
                      </select>
                    </div>
                    <div class="col-md-12 m-t-10">
                      <button class="btn app-btn" type="submit" name="UpdateSocialAccounts" value="<?php echo SECURE($socialaccountid, "e"); ?>">Update Links</button>
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