<?php
require '../../require/modules.php';

//session controller for user 
if (isset($_SESSION['LOGIN_USER'])) {
  header("location: ../app/");
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=0.9">
  <title>Verify OTP | <?php echo APP_NAME; ?></title>
  <?php
  //header files
  include '../../include/app/header_files.php';
  ?>
</head>

<body>
  <!--- main content area -->
  <section class="container-fluid" id="backbtn">
    <div class="row">
      <div class="col-md-12 text-left mt-3">
        <a href="index.php" class="text-decoration-none">
          <img src="<?php echo STORAGE_URL_D . '/tool-img/back.png'; ?>" class="w-pr-6">
          <img src="<?php echo $MAIN_LOGO; ?>" class="w-pr-17 m-l-10">
        </a>
      </div>
    </div>
  </section>

  <section class="container-fluid">
    <div class="row">
      <div class="col-md-12 mt-5">
        <h3 class="text-left text-black mb-5">Verify OTP</h3>
        <form action="verify.php" class="form" method="POST" id="ismForm">
          <div class="form-group">
            <label class="mb-2 fs-18">Enter OTP</label>
            <input type="text" class="form-control fs-25 text-center l-s-3" id="Phone" min="4" max="6" name="SUBMITTED_OTP" required="" placeholder="* * * * * *">
            <br>
            <span class="text-grey mt-3">please enter otp send to your mobile number</span>
          </div>
          <div class="form-group fixed-bottom text-center">
            <img src="<?php echo STORAGE_URL_D . '/tool-img/load.jpg'; ?>" class="mx-auto w-pr-15 mb-2 hidden" id="loadicon">
            <button type="submit" name="SentOtp" id="subbtn" onclick="CheckPhoneInput()" class="btn sqaure btn-lg btn-warning form-control app-bg fs-25 login-sub-btn">Verify OTP</button>
          </div>
        </form>
      </div>
    </div>
  </section>

  <script>
    function CheckPhoneInput() {
      var noinputmsg = document.getElementById("noinputmsg");
      var loadicon = document.getElementById("loadicon");
      var subbtn = document.getElementById("subbtn");
      var phone = document.getElementById("Phone");

      if (phone.value === "") {
        noinputmsg.innerHTML = "Please Enter valid OTP";
      } else {
        noinputmsg.innerHTML = "";
        loadicon.style.display = "block";
        subbtn.style.display = "none";
      }
    }
  </script>

  <!-- main content end area -->
  <?php

  //message
  include '../../include/app/message.php';

  //footer
  include '../../include/app/footer.php';

  //footer files
  include '../../include/app/footer_files.php';
  ?>
</body>

</html>