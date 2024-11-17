<?php

//page varibale
$PageName  = "Login & Signup";
$AccessLevel = "../../../";

//include required files here
require $AccessLevel . "require/modules.php";
require $AccessLevel . "require/web-modules.php";
require $AccessLevel . "require/web/sessionvariables.php";

//page activity
if (isset($_SESSION['LOGIN_CustomerId'])) {
  header("location: " . DOMAIN . "/web");
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
  <?php if (DEVICE_TYPE == "Computer") { ?>
    <div class="banner-top container-fluid" id="home">
      <?php
      include '../../../include/web/header.php';
      ?>
    </div>
    <hr>
    <br>
    <section class="container section">
      <div class="row">
        <?php include '../common-header.php'; ?>
        <div class="col-lg-6 col-md-6 col-sm-6 col-12">
          <?php include '../../../include/web/auth-form.php'; ?>
        </div>
      </div>
    </section>

    <?php include $AccessLevel . "include/web/footer.php"; ?>
    <?php include $AccessLevel . "include/web/footer_files.php"; ?>
  <?php } else { ?>
    <div class="container">
      <div class="row">
        <div class="col-md-12 mt-3 mb-3">
          <div>
            <img src="<?php echo MAIN_LOGO; ?>" class="w-25">
          </div>
        </div>
        <div class="col-md-12">
          <?php include '../../../include/web/auth-form.php'; ?>
        </div>
      </div>
    </div>
    <script>
      function AuthAccess() {
        var SignupArea = document.getElementById("SignupArea");
        var LoginArea = document.getElementById("LoginArea");
        if (LoginArea.style.display === "none") {
          LoginArea.style.display = "block";
          SignupArea.style.display = "none";
        } else {
          LoginArea.style.display = "none";
          SignupArea.style.display = "block";
        }
      }
    </script>
  <?php } ?>
</body>

</html>