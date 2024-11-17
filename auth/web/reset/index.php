<?php

//page varibale
$PageName  = "Change Password";
$AccessLevel = "../../../";

//include required files here
require $AccessLevel . "require/modules.php";
require $AccessLevel . "require/web-modules.php";

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

  <section class="container">
    <div class="row">
      <div class="col-md-12">
        <h2 class="m-t-20 m-b-2 text-center text-color"><i class="fa fa-edit text-primary fs-25"></i> <?php echo $PageName; ?></h2>
        <hr class="m-t-5">
      </div>
    </div>
  </section>

  <section class="container section">
    <div class="row">
      <?php include '../common-header.php'; ?>
      <div class="col-lg-6 col-md-6 col-sm-6 col-12">
        <form action="../../../controller/authcontroller.php" method="POST" class="pb-4">
          <?php FormPrimaryInputs(true); ?>
          <div class="row">
            <div class="col-md-12">
              <h3>Change Password <span id="passmsg"></span></h3>
              <hr class="m-t-7 m-b-7">
            </div>
            <div class="col-lg-8 col-md-8 col-sm-8 col-12">
              <br>
              <label>Enter New Password</label>
              <input type="password" name="CustomerPassword" oninput="checkpass()" id="pass1" placeholder="*******" class="form-control" required="">
            </div>
            <br>
            <div class="col-lg-8 col-md-8 col-sm-8 col-12 m-t-10">
              <br>
              <label>Re-Enter New Password</label>
              <input type="password" name="CustomerPassword2" placeholder="********" oninput="checkpass()" id="pass2" class="form-control" required="">
            </div>
            <br>
            <div class="col-lg-6 col-md-6 col-sm-6 col-12 m-t-20">
              <br>
              <button class="btn btn-md btn-success" name="ChangeCustomerPassword"><i class="fa fa-edit"></i> Request for Change</button>
            </div>

          </div>
        </form>
      </div>
    </div>
  </section>

  <?php include $AccessLevel . "include/web/footer.php"; ?>
  <?php include $AccessLevel . "include/web/footer_files.php"; ?>
</body>

</html>