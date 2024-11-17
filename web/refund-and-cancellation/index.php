<?php
//include required files here
require '../../require/modules.php';
require '../../require/web-modules.php';

//page varibale
$PageName  = "Refund and Cancellations";
$PageAccess = "RefundAndCancellations";
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=0.9">
  <title><?php echo $PageName; ?> | <?php echo APP_NAME; ?></title>
  <?php include '../../include/web/header_files.php'; ?>
</head>

<body>
  <?php
  //header & loader
  include '../../include/web/header.php'; ?>

  <?php if (DEVICE_TYPE == "Computer") { ?>
    <section class="container-fluid section">
      <div class="row">
        <div class="col-md-12">
          <h3 class="account-header p-5 text-center"><?php echo $PageName; ?></h3>
        </div>
      </div>
    </section>

    <section class="container section">
      <div class="row">
        <div class="col-md-12">
          <h3 class="mt-3"><b><?php echo FETCH("SELECT * FROM pages where PageName='$PageAccess'", "PageDisplayName"); ?> </b></h3>
          <hr>
          <?php echo SECURE(FETCH("SELECT * FROM pages where PageName='$PageAccess'", "PageContent"), "d"); ?>
        </div>
      </div>
    </section>
    <br><br>
    <?php include '../../include/web/footer.php'; ?>
    <?php include '../../include/web/footer_files.php'; ?>

  <?php } else { ?>
    <div class='fixed-top'>
      <section class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="flex-start">
              <a href="<?php echo WEB_URL; ?>" class="btn btn-lg mr-3 bold h3 mt-1 back-btn"><i class="fa fa-angle-left"></i></a>
              <div class="page-title">
                <h5>Refund & Cancellations</h5>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>

    <section class="container section">
      <div class="row">
        <div class="col-md-12">
          <h3 class="mt-3"><b><?php echo FETCH("SELECT * FROM pages where PageName='$PageAccess'", "PageDisplayName"); ?> </b></h3>
          <hr>
          <?php echo SECURE(FETCH("SELECT * FROM pages where PageName='$PageAccess'", "PageContent"), "d"); ?>
        </div>
      </div>
    </section>
    <br><br><br><br>
  <?php } ?>
</body>

</html>