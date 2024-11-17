<?php

//page varibale
$PageName  = "My Account";
$AccessLevel = "../../../";

//include required files here
require $AccessLevel . "require/modules.php";
require $AccessLevel . "require/web-modules.php";

if (!isset($_SESSION['LOGIN_CustomerId'])) {
  LOCATION("info", "Please Login First!", DOMAIN . "/auth/web/login/");
}

$PageSqls = "SELECT * FROM customers where CustomerId='" . LOGIN_CustomerId . "'";
if (FETCH($PageSqls, "CustomerProfileImage") == null) {
  $CustomerProfileImage = $CommonUserImage;
} else {
  $CustomerProfileImage = "customers/img/profile/" . GET_DATA("CustomerProfileImage");
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
  <title><?php echo GET_DATA("CustomerName") ?> | <?php echo APP_NAME; ?></title>
  <?php include $AccessLevel . "/include/web/header_files.php"; ?>
  <script>
    window.onload = function() {
      document.getElementById("account").classList.add("active");
    }
  </script>
</head>

<body>

  <?php
  include $AccessLevel . "include/web/header.php";
  ?>
  <?PHP if (DEVICE_TYPE == "Computer") { ?>
    <section class="container">
      <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12 col-12">
          <h3 class="account-header"><i class="fa fa-user text-color"></i> My Account <i class="fa fa-angle-double-right"></i> Account Settings</h3>
          <a href="<?php echo DOMAIN; ?>/web/account/" class="btn btn-md fs-16 text-primary"><i class="fa fa-angle-left"></i> Back to Account</a>
        </div>
      </div>
    </section>

    <section class="container section">
      <div class="row">
        <div class="col-md-6">
          <h4 class="account-header">Primary Details</h4>
          <hr>
          <form action="../../../controller/authcontroller.php" method="POST">
            <?php FormPrimaryInputs(true); ?>
            <table class="w-100">
              <tr>
                <th>Full name</th>
                <td>
                  <input type="text" name="CustomerName" class="form-control" required="" value="<?php echo GET_DATA('CustomerName'); ?>">
                </td>
              </tr>
              <tr>
                <th>Email Id</th>
                <td>
                  <input type="text" name="CustomerEmailid" class="form-control" readonly="" required="" value="<?php echo GET_DATA('CustomerEmailid'); ?>">
                </td>
              </tr>
              <tr>
                <th>Phone Number</th>
                <td>
                  <input type="text" name="CustomerPhoneNumber" class="form-control" readonly="" required="" value="<?php echo GET_DATA('CustomerPhoneNumber'); ?>">
                </td>
              </tr>
              <tr>
                <td colspan="2">
                  <button name="UpdateCustomerProfile" value="<?php echo LOGIN_CustomerId;  ?>" class="btn btn-md btn-primary">Update Profile</button>
                </td>
              </tr>
            </table>
          </form>
        </div>
        <div class="col-md-6">
          <h4 class="account-header">Security Details</h4>
          <hr>
          <form action="" method="POST">
            <?php FormPrimaryInputs(true); ?>
            <table class='w-100'>
              <tr>
                <th>Current Password</th>
                <td>
                  <input type="password" name="CustomerName" class="form-control" required="" value="">
                </td>
              </tr>
              <tr>
                <th>New Passwords <span id="passmsg"></span></th>
                <td>
                  <input type="password" name="CustomerEmailid" oninput="checkpass()" id="pass1" class="form-control" required="" value="">
                </td>
              </tr>
              <tr>
                <th>Re-Enter New Password</th>
                <td>
                  <input type="password" name="CustomerPhoneNumber" oninput="checkpass()" id="pass2" class="form-control" required="" value="">
                </td>
              </tr>
              <tr>
                <td colspan="2">
                  <button name="UpdatePasswords" class="btn btn-md btn-primary">Update Security</button>
                </td>
              </tr>
            </table>
          </form>
        </div>
      </div>
    </section>
    <hr><br><br>
    <?php include $AccessLevel . "include/web/footer.php"; ?>
    <?php include $AccessLevel . "include/web/footer_files.php"; ?>
  <?php } else { ?>
    <div class='fixed-top'>
      <section class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="flex-start">
              <a href="../index.php" class="btn btn-lg mr-3 bold h3 mt-1 back-btn"><i class="fa fa-angle-left"></i></a>
              <div class="page-title">
                <h5>Update Account Details</h5>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>

    <section class="page-section">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="flex-start">
              <div class="w-25">
                <img src="<?php echo STORAGE_URL; ?>/<?php echo $CustomerProfileImage; ?>" class='user-icon'>
              </div>
              <div class="w-75 text-left pl-3">
                <h5 class="mt-2 bold"><?php echo GET_DATA("CustomerName"); ?></h5>
                <h6><i class="fa fa-phone app-text"></i> <?php echo GET_DATA("CustomerPhoneNumber"); ?></h6>
                <h6><i class="fa fa-envelope app-text"></i> <?php echo GET_DATA("CustomerEmailid"); ?></h6>
              </div>
            </div>
          </div>

          <div class="col-md-6 mt-5">
            <h4 class="account-header">Primary Details</h4>
            <hr>
            <form action="../../../controller/authcontroller.php" method="POST">
              <?php FormPrimaryInputs(true); ?>
              <table class="w-100">
                <tr class="pt-2">
                  <th>Full name</th>
                  <td>
                    <input type="text" name="CustomerName" class="form-control" required="" value="<?php echo GET_DATA('CustomerName'); ?>">
                  </td>
                </tr>
                <tr class="pt-2">
                  <th>Email Id</th>
                  <td>
                    <input type="text" name="CustomerEmailid" class="form-control" readonly="" required="" value="<?php echo GET_DATA('CustomerEmailid'); ?>">
                  </td>
                </tr>
                <tr class="pt-2">
                  <th>Phone Number</th>
                  <td>
                    <input type="text" name="CustomerPhoneNumber" class="form-control" readonly="" required="" value="<?php echo GET_DATA('CustomerPhoneNumber'); ?>">
                  </td>
                </tr>
                <tr>
                  <td colspan="2" class="pt-4 text-right">
                    <button name="UpdateCustomerProfile" value="<?php echo LOGIN_CustomerId;  ?>" class="btn btn-md btn-danger">Update Profile</button>
                  </td>
                </tr>
              </table>
            </form>
          </div>

          <div class="col-md-6 mt-5">
            <h4 class="account-header">Security Details</h4>
            <hr>
            <form action="../../../controller/customercontroller.php" method="POST">
              <?php FormPrimaryInputs(true); ?>
              <table class='w-100'>
                <tr>
                  <th style="width:60%;">Current 6-Digit Passcode</th>
                  <td>
                    <input min='6' placeholder="******" type="number" name="CustomerPassword_OLD" class="form-control" required="" value="">
                  </td>
                </tr>
                <tr>
                  <th>New Passwords <span id="passmsg"></span></th>
                  <td>
                    <input min='6' type="number" placeholder="******" name="CustomerPassword_NEW" oninput="checkpass()" id="pass1" class="form-control" required="" value="">
                  </td>
                </tr>
                <tr>
                  <th>Re-Enter New Password</th>
                  <td>
                    <input min='6' type="number" placeholder="******" name="CustomerPassword_RE" oninput="checkpass()" id="pass2" class="form-control" required="" value="">
                  </td>
                </tr>
                <tr>
                  <td colspan="2" class="pt-4 text-right">
                    <button name="UpdatePasswords" class="btn btn-md btn-danger">Update Security</button>
                  </td>
                </tr>
              </table>
            </form>
          </div>

        </div>
      </div>
    </section>
    <br><br>
  <?php } ?>
</body>

</html>