<?php
require '../../require/modules.php';

//session controller for user 
if (isset($_SESSION['LOGIN_USER'])) {
  header("location: " . DOMAIN . "/web/");
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=0.9">
  <title><?php echo $LoginPageName; ?> | <?php echo APP_NAME; ?></title>
  <?php
  //header files
  include '../../include/app/header_files.php';
  ?>
</head>

<body>
  <!--- main content area -->
  <section class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="flex-c mt-3 mb-3">
          <img src="<?php echo $MAIN_LOGO; ?>" class="img-fluid w-pr-60">
        </div>
      </div>
    </div>
  </section>

  <section class="container-fluid mt-2">
    <div class="row mt-5">
      <div class="col-md-12 mt-2">
        <h4 class="text-center"><?php echo $LoginHeading; ?></h4>
        <hr class="mb-3 w-50 d-block mx-auto">
        <form action="otp.php" class="form" method="POST" id="ismForm">
          <div class="form-group">
            <label class="mb-1 fs-18">Enter Phone <span id="noinputmsg" class="text-danger fs-15"></span></label>
            <input type="phonenumber" class="form-control fs-25" id="Phone" min="10" max="10" name="PhoneNumber" required="" placeholder="+91 00000 00000">
            <br>
            <span class="text-grey">Without +91</span><br>
            <br>
            <p class="text-grey">By continue to this you agree our <a href="<?php echo DOMAIN; ?>/app/pages/terms-and-conditions.php" class="text-info text-decoration-none">Terms & Conditions.</a></p>
          </div>

          <div class="form-group fixed-bottom text-center">
            <img src="<?php echo STORAGE_URL_D . '/tool-img/load.jpg'; ?>" class="mx-auto w-pr-15 mb-2 hidden" id="loadicon">
            <button type="submit" name="SentOtp" id="subbtn" onclick="CheckPhoneInput()" class="btn sqaure btn-lg btn-warning form-control app-bg fs-25 login-sub-btn">Send OTP</button>
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
        noinputmsg.innerHTML = "Please Enter Phone Number";
      } else {
        noinputmsg.innerHTML = "";
        loadicon.style.display = "block";
        subbtn.style.display = "none";
      }
    }
  </script>

  <script>
    if (document.getElementById("ismForm")) {
      setTimeout("submitForm()", 2000); // set timout 
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