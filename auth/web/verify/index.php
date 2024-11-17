<?php

//page varibale
$PageName  = "Verify Account";
$AccessLevel = "../../../";

//include required files here
require $AccessLevel . "require/modules.php";
require $AccessLevel . "require/web-modules.php";

//page activity
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

  <section class="container section">
    <div class="row">
      <?php include '../common-header.php'; ?>
      <div class="col-lg-6 col-md-6 col-sm-6 col-12">
        <div class="row">
          <form action="../../../controller/authcontroller.php" method="POST" class="pb-4">
            <?php FormPrimaryInputs(true); ?>
            <div class="col-md-12">
              <h3>Verify Your Account</h3>
              <hr class="m-t-7 m-b-7">
            </div>
            <div class="col-lg-8 col-md-8 col-sm-8 col-12">
              <label>Enter OTP</label>
              <p class="text-grey">Enter One Time Password send to your registered email id: <?php echo $_SESSION['SUBMIITED_EMAIL']; ?></p>
              <input type="text" name="SubmittedOTP" placeholder="******" min="1" max="6" class="form-control otp-view" required="">
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-6 m-t-20">
              <button class="btn btn-md btn-success" name="VerifyAccount"><i class="fa fa-check-circle-o"></i> Verify Account</button>
          </form>
        </div>
        <div class="col-lg-6 col-md-6 col-6 m-t-20">
          <form action="../../../controller/authcontroller.php" method="POST">
            <?php FormPrimaryInputs(true); ?>
            <button class="btn btn-md btn-dark disabled" name="TryAgainOtp" id="sendagainbtn" style="display:none;">Send Again</button>
            <span class="p-2 bg-info br30" id="datahide"><span><i class="fa fa-spinner fa-spin"></i> <span id="countdown"></span></span></span>
          </form>
        </div>
        <div class="col-md-12">
          <p class="fs-12 text-grey">Some otp may arrive late or within sec, please wait for 30sec.</p>
        </div>


      </div>
      <div class="col-md-12">
        <p class="m-t-10">
          if you are unable to find your account please contact us at <a href="mailto:<?php echo SUPPORT_MAIL; ?>" class="text-primary"><?php echo SUPPORT_MAIL; ?></a>
        </p>
      </div>
    </div>
    </div>
  </section>

  <script>
    timeLeft = 31;

    function countdown() {
      timeLeft--;
      document.getElementById("countdown").innerHTML = String(timeLeft);
      if (timeLeft > 0) {
        setTimeout(countdown, 1000);
      }
      if (timeLeft === 0) {
        document.getElementById("sendagainbtn").classList.remove("disabled");
        document.getElementById("sendagainbtn").style.display = "block";
        document.getElementById("datahide").style.display = "none";
      }
    };

    setTimeout(countdown, 1000);
  </script>

  <?php include $AccessLevel . "include/web/footer.php"; ?>
  <?php include $AccessLevel . "include/web/footer_files.php"; ?>
</body>

</html>