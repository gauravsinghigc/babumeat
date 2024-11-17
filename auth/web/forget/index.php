<?php

//page varibale
$PageName  = "Forget Password";
$AccessLevel = "../../../";

//include required files here
require $AccessLevel . "require/modules.php";
require $AccessLevel . "require/web-modules.php";
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
  <hr>
  <br>
  <section class="container section">
    <div class="row">
      <?php include '../common-header.php'; ?>
      <div class="col-lg-6 col-md-6 col-sm-6 col-12">
        <form action="../../../controller/authcontroller.php" method="POST" class="pb-4">
          <?php FormPrimaryInputs(true); ?>
          <div class="row">
            <div class="col-md-12">
              <h3>Recover Account</h3>
              <hr class="m-t-7 m-b-7">
            </div>
            <div class="col-lg-8 col-md-8 col-sm-8 col-12 p-1r">
              <label>Enter Registered Email-ID</label>
              <input type="text" name="submitted_data" placeholder="email@domain.ext" class="form-control" required="">
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-12 m-t-20 p-1r">
              <br>
              <button class="btn btn-md btn-success" name="RecoverAccount"> Search Account</button>
            </div>
            <div class="col-md-12">
              <p class="m-t-3 p-t-15"><br>
                if you are unable to find your account please contact us at <a href="mailto:<?php echo SUPPORT_MAIL; ?>" class="text-primary"><?php echo SUPPORT_MAIL; ?></a>
              </p>
            </div>

            <div class="col-md-12">
              Know Password? <a href="<?php echo DOMAIN; ?>/auth/web/login" onclick="showform()" class="btn btn-md btn-default">Login</a>
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