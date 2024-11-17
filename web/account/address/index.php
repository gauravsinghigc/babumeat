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
</head>

<body>
  <?php
  include $AccessLevel . "include/web/header.php";
  ?>
  <section class="container">
    <div class="row">
      <div class="col-md-12 col-lg-12 col-sm-12 col-12">
        <h3 class="account-header"><i class="fa fa-user text-color"></i> My Account <i class="fa fa-angle-double-right"></i> My Address</h3>
        <a href="<?php echo DOMAIN; ?>/web/account/" class="btn btn-md fs-16 text-primary"><i class="fa fa-angle-left"></i> Back to Account</a>
      </div </div>
  </section>

  <section class="container section">
    <div class="row">

      <?php
      $fetchAddress = FetchConvertIntoArray("SELECT * FROM customeraddress where CustomerAddressViewId='" . LOGIN_CustomerId . "'", true);
      if ($fetchAddress == null) {
        NoData("No Address Found!");
      } else {
        foreach ($fetchAddress as $Address) { ?>
          <div class="col-lg-6 col-md-6 col-sm-6 col-12">
            <div class="cat-box p-2">
              <h6 class="m-b-0 lh-1-0 m-t-5"><b><i class='fa fa-map-marker'></i> <?php echo $Address->CustomerAddressContactPerson; ?></b></h6>
              <p class="fs-13 p-l-10 address-box">
                <span class="text-grey"><?php echo $Address->CustomerAddressType; ?></span><br>
                <span>
                  <?php echo $Address->CustomerAddressAltPhone; ?>
                </span><br>
                <span>
                  <?php echo SECURE($Address->CustomerAddressStreetAddress, "d"); ?> <?php echo $Address->CustomerAddressArea; ?> <?php echo $Address->CustomerAddressCity; ?> <?php echo $Address->CustomerAddressState; ?> <?php echo $Address->CustomerAddressCountry; ?> - <?php echo $Address->CustomerAddressPincode; ?>
                </span>
                <br>
                <?php if ($Address->CustomerAddressGSTNo != null) {
                  echo "GST NO: " . $Address->CustomerAddressGSTNo;
                } ?>
              </p>
              <div class="flex-space-between">
                <a href="editaddress.php?addressid=<?php echo SECURE($Address->CustomerAddressid, "e"); ?>&access_url=<?php echo SECURE(GET_URL(), "e"); ?>" class="btn btn-sm btn-info">Edit</a>
              </div>
            </div>
          </div>
      <?php }
      } ?>

    </div>
  </section>
  <br><br>

  <?php include $AccessLevel . "include/web/footer.php"; ?>
  <?php include $AccessLevel . "include/web/footer_files.php"; ?>
</body>

</html>