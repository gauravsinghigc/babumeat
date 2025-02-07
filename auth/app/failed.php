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
  <title>OTP Verification Failed | <?php echo APP_NAME; ?></title>
  <?php
  //header files
  include '../../include/app/header_files.php';
  ?>
</head>

<body>

  <section class="container-fluid mb-3 fixed-bottom">
    <div class="row">
      <div class="col-md-12 text-center mt-5">
        <img src="<?php echo STORAGE_URL_D . '/tool-img/failed.gif'; ?>" class="w-pr-70">
        <h3 class="mb-5">OTP Verification Failed!</h3>
        <a href="index.php" class="btn btn-lg login-sub-btn app-bg w-pr-60 rounded mt-5 mb-5">Try Again</a>
        <span class='mb-5'><br></span>
      </div>
    </div>
  </section>

  <script>
    function CheckPhoneInput() {
      var noinputmsg = document.getElementById("noinputmsg");
      var loadicon = document.getElementById("loadicon");
      var subbtn = document.getElementById("subbtn");
      var phone = document.getElementById("Phone");
      var otpform = document.getElementById("otpform");
      var backbtn = document.getElementById("backbtn");
      var successbtn = document.getElementById("successbtn");
      if (phone.value === "") {
        noinputmsg.innerHTML = "Please Enter valid OTP";
      } else {
        noinputmsg.innerHTML = "";
        loadicon.style.display = "block";
        subbtn.style.display = "none";
        otpform.style.display = "none";
        backbtn.style.display = "none";
        successbtn.style.display = "block";
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