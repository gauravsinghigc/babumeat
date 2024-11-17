<?php

//page varibale
$PageName  = "Edit Address";
$AccessLevel = "../../../";

//include required files here
require $AccessLevel . "require/modules.php";
require $AccessLevel . "require/web-modules.php";

if (!isset($_SESSION['LOGIN_CustomerId'])) {
  LOCATION("info", "Please Login First!", DOMAIN . "/auth/web/login/");
}


//page varibale 
if (isset($_GET['access_url'])) {
  $AccessUrl = $_GET['access_url'];
}
if (isset($_GET['addressid'])) {
  $_SESSION['ADDRESS_ID'] = SECURE($_GET['addressid'], "d");
  $Addressid = $_SESSION['ADDRESS_ID'];
} else {
  $Addressid = $_SESSION['ADDRESS_ID'];
}

$PageSqls = "SELECT * FROM customeraddress where CustomerAddressid='$Addressid'";
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
</head>

<body>

  <body>

    <?php
    //header & loader
    include $AccessLevel . "include/web/header.php";
    include $AccessLevel . "include/web/navbar.php";
    ?>

    <section class="container section">
      <div class="row">
        <div class="col-md-12 header-bg">
          <h2 class="inline-list-view text-black p-t-10 p-b-10"><i class="fa fa-truck m-t-5 p-r-7 text-color"></i> <?php echo $PageName; ?></h2>
        </div>
      </div>
    </section>

    <section class="container m-t-10">
      <div class="row">
        <div class="col-lg-5 col-md-5 col-sm-6 col-12 section-div p-r-20">
          <form action="../../../controller/customercontroller.php" method="POST">
            <?php FormPrimaryInputs(DOMAIN . "/web/checkout/"); ?>
            <div class="row">
              <div class="col-md-12 header-bg m-b-10">
                <h4><i class='fa fa-map-marker'></i> Update Address Address</h4>
              </div>
              <div class="form-group col-md-6 col-lg-6 col-sm-6 col-6">
                <label>Contact Person</label>
                <input type="text" name="CustomerAddressContactPerson" value="<?php echo GET_DATA("CustomerAddressContactPerson"); ?>" class="form-control" required="" placeholder="first last name">
              </div>
              <div class="form-group col-md-6 col-lg-6 col-sm-6 col-6">
                <label>Alternate Phone</label>
                <input type="text" name="CustomerAddressAltPhone" value="<?php echo GET_DATA("CustomerAddressAltPhone"); ?>" class="form-control" required="" placeholder="+91">
              </div>
              <div class="form-group col-md-12 col-lg-12 col-sm-12 col-12">
                <label>Street Address/House No</label>
                <textarea type="text" name="CustomerAddressStreetAddress" rows="3" value="" class="form-control" required=""><?php echo SECURE(GET_DATA("CustomerAddressStreetAddress"), "d"); ?></textarea>
              </div>
              <div class="form-group col-md-6 col-lg-6 col-sm-6 col-6">
                <label>Area Locality</label>
                <input type="text" name="CustomerAddressArea" value="<?php echo GET_DATA("CustomerAddressArea"); ?>" class="form-control" required="">
              </div>
              <div class="form-group col-md-6 col-lg-6 col-sm-6 col-6">
                <label>City</label>
                <input type="text" name="CustomerAddressCity" value="<?php echo GET_DATA("CustomerAddressCity"); ?>" class="form-control" required="">
              </div>
              <div class=" form-group col-md-6 col-lg-6 col-sm-6 col-6">
                <label>State</label>
                <input type="text" name="CustomerAddressState" value="<?php echo GET_DATA("CustomerAddressState"); ?>" class="form-control" required="">
              </div>
              <div class="form-group col-md-6 col-lg-6 col-sm-6 col-6">
                <label>Pincode</label>
                <input type="pincode" name="CustomerAddressPincode" value="<?php echo GET_DATA('CustomerAddressPincode'); ?>" class="form-control" required="">
              </div>
              <div class="form-group col-md-6 col-lg-6 col-sm-6 col-6">
                <label>Country</label>
                <input type="text" name="CustomerAddressCountry" value="<?php echo GET_DATA("CustomerAddressCountry"); ?>" class="form-control" required="">
              </div>
              <div class="form-group col-md-6 col-lg-6 col-sm-6 col-6">
                <label>Address Type</label>
                <select name="CustomerAddressType" class="form-control" required="">
                  <option value="Home Address">Home Address</option>
                  <option value="Office Address">Office Address</option>
                </select>
              </div>
              <div class="form-group col-md-12 col-lg-12 col-sm-12 col-12">
                <label>GST</label>
                <input type="text" name="CustomerAddressGSTNo" value="<?php echo GET_DATA("CustomerAddressGSTNo"); ?>" class="form-control">
              </div>
              <div class="col-md-12 col-lg-12 col-sm-12 col-12 m-b-20">
                <button class="btn btn-md btn-primary" name="UpdateAddress">Update Address</button>
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