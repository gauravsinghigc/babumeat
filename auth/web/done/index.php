<?php

//page varibale
$PageName  = "Password Changed";
$AccessLevel = "../../../";

//include required files here
require $AccessLevel . "require/modules.php";
require $AccessLevel . "require/web-modules.php";
require $AccessLevel . "require/web/sessionvariables.php";

//check urls
if (!isset($_SESSION['SENT_OTP'])) {
  header("location: " . DOMAIN . "/auth/web/");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=0.9">
  <meta name="description" content="">
  <meta name="keywords" content="">
  <title><?php echo $PageName; ?> | <?php echo APP_NAME; ?></title>
  <?php include $AccessLevel . "/include/web/header_files.php"; ?>
  <style>
    .pop-form {
      display: none !important;
    }

    #Authformlogo {
      display: none !important;
    }
  </style>
</head>

<body>

  <?php
  include $AccessLevel . "include/web/header.php";
  ?>

  <section class="container section">
    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 col-12 text-center m-t-30">
        <br>
        <img src="<?php echo STORAGE_URL_D; ?>/tool-img/verify.gif" class="w-pr-16 img-circle doneimg">
        <h3>Password Changed Successfully</h3>
        <p>Your password changed successfully. now you have to login with latest password.</p>
        <a href="<?php echo DOMAIN; ?>/auth/web/login" class="btn btn-md btn-success"><i class="fa fa-sign-in"></i> Log Now</a>
      </div>
    </div>
  </section>
  <br><br>
  <?php include $AccessLevel . "include/web/footer.php"; ?>
  <?php include $AccessLevel . "include/web/footer_files.php"; ?>
</body>

</html>