<div class="reg-form">
  <div class="" id="Authformlogo">
    <img src="<?php echo $MAIN_LOGO; ?>" style="width:30% !important;" class="w-pr-20">
    <a onclick="hideform()" class="btn btn-lg btn-danger rounded closed-fix-btn"><i class="fa fa-times"></i></a>
  </div>
  <?php if (isset($_GET['signup'])) {
    $signup = "block";
    $login = "none";
  } else {
    $signup = "none";
    $login = "block";
  } ?>
  <div class="p-1" id="LoginArea" style="display:<?php echo $login; ?>">
    <form action="<?php echo DOMAIN; ?>/controller/authcontroller.php" method="POST">
      <?php FormPrimaryInputs(true); ?>
      <div class="row">
        <div class="col-md-12">
          <h3>Login into Account</h3>
          <hr>
        </div>
        <div class="form-group col-lg-8 col-md-8 col-12 text-left mb-3">
          <label class="text-left">Enter Phone Number</label>
          <input type="tel" min='10' max='12' name="CustomerPhoneNumber" class="form-control p-2r" required="" placeholder="+91" value="">
        </div>
        <div class="form-group col-lg-8 col-md-8 col-12 text-left">
          <label class="text-left">6 Digit Passcode</label>
          <input type="password" min='6' max='6' name="CustomerPassword" class="form-control p-2r passcode" required="" placeholder="********" value="">
        </div>
      </div>
      <div class="row mt-3">
        <div class="form-group col-lg-4 col-md-4 col-12">
          <button class="btn btn-lg btn-success" name="WebLoginRequest"><i class="fa fa-lock text-white"></i> Secured Login</button>
        </div>
        <div class="form-group col-lg-4 col-md-4 col-12">
          <a href="<?php echo DOMAIN; ?>/auth/web/forget/" class="btn btn-lg text-grey">Forget Password?</a>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12 text-center">
          <small class="text-secondary small btn btn-sm w-100">Don't Have Account?</small>
          <a class="btn btn-lg btn-default w-100" onclick="AuthAccess()">Signup</a>
        </div>
      </div>
      <?php if (DEVICE_TYPE != "Computer") {
      ?>
        <div class="fixed-bottom bg-white container-fluid">
          <div class="row">
            <div class="col-md-12">
              <small>
                <i class="fa fa-check text-success"></i>
                I agree <b><?php echo APP_NAME; ?></b>'s
                <a href="<?php echo WEB_URL; ?>/terms-and-conditions/" class="text-primary">Terms & Conditions</a> and
                <a href="<?php echo WEB_URL; ?>/privacy-policy/" class="text-primary">Privacy Policy</a>.
              </small>
            </div>
          </div>
        </div>
      <?php
      } ?>
    </form>
  </div>
  <div class="p-1" id="SignupArea" style="display:<?php echo $signup; ?>">

    <form action="<?php echo DOMAIN; ?>/controller/authcontroller.php" method="POST">
      <?php FormPrimaryInputs(true); ?>
      <div class="row">
        <div class="col-md-12">
          <h3>Create An Account</h3>
          <hr>
        </div>
        <div class="form-group col-lg-6 col-md-6 col-12 text-left mb-2">
          <label>Full Name</label>
          <input type="text" name="CustomerName" class="form-control" required="" placeholder="first last name" value="">
        </div>
        <div class="form-group col-lg-6 col-md-6 col-12 text-left mb-2">
          <label>Email ID</label>
          <input type="email" name="CustomerEmailid" class="form-control" required="" placeholder="email@domain.ext" value="">
        </div>
        <div class="form-group col-lg-6 col-md-6 col-12 text-left mb-2">
          <label>Phone Number</label>
          <input type="phone" name="CustomerPhoneNumber" class="form-control" required="" placeholder="+91" value="">
        </div>
      </div>
      <div class="row">
        <div class="form-group col-lg-6 col-md-6 col-12 text-left mb-2">
          <label>Set 6-Digit Passcode</label>
          <input type="password" min='6' max='6' name="CustomerPassword" oninput="checkpass()" id="pass1" class="form-control passcode" required="" placeholder="******" value="">
        </div>
        <div class="form-group col-lg-6 col-md-6 col-12 text-left mb-2">
          <label>Re-Enter Passcode</label>
          <input type="password" min='6' max='6' name="CustomerPassword2" oninput="checkpass()" id="pass2" class="form-control passcode" required="" placeholder="******" value="">
        </div>
        <div class="form-group col-lg-12 col-md-12 col-12 text-left mb-2">
          <input type="checkbox" name="accepttnc" value="true" required="">
          I agree <?php echo APP_NAME; ?>'s <a href="<?php echo WEB_URL; ?>/terms-and-conditions/" class="text-primary">Terms & Conditions</a> and <a href="<?php echo WEB_URL; ?>/privacy-policy/" class="text-primary">Privacy Policy</a>.
        </div>
        <div class="form-group col-lg-12 col-md-12 col-12 text-left mb-2">
          <button class="btn btn-lg btn-success" id="passbtn" name="CreateAccount"><i class="fa fa-lock"></i> Create Account</button>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12 text-center">
          <small class="btn btn-sm text-secondary">Already Have an Account?</small> <a class="btn btn-lg btn-default" onclick="AuthAccess()">Login Now</a>
        </div>
      </div>
    </form>
  </div>
</div>
<br>