<?php

//page varibale
$PageName  = "Shipping Address";
$AccessLevel = "../../";

//include required files here
require $AccessLevel . "require/modules.php";
require $AccessLevel . "require/web-modules.php";

if (!isset($_SESSION['LOGIN_CustomerId'])) {
  LOCATION("info", "Please Login First!", DOMAIN . "/auth/web/login/");
}

//page actiti
$Dcchargename = FETCH("SELECT * FROM deliverycharges where deliverychargesid='1'", "Dcchargename");
$dccartamount = FETCH("SELECT * FROM deliverycharges where deliverychargesid='1'", "dccartamount");
$dcchargeamount = FETCH("SELECT * FROM deliverycharges where deliverychargesid='1'", "dcchargeamount");
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
    ?>

    <section class="container section">
      <div class="row">
        <div class="col-md-12 header-bg mt-3">
          <div class="flex-s-b checkout-process">
            <a href="<?php echo WEB_URL; ?>/cart/" class="active">
              <span class="count">1</span>
              <span>Shopping Cart</span>
            </a>
            <a href="<?php echo WEB_URL; ?>/checkout/" class="active">
              <span class="count">2</span>
              <span>Shipping</span>
            </a>
            <a href="#">
              <span class="count">3</span>
              <span>Billing</span>
            </a>
            <a href="#">
              <span class="count">4</span>
              <span>Billing</span>
            </a>
          </div>
        </div>
      </div>
    </section>

    <section class="container m-t-10">
      <div class="row">
        <div class="col-lg-5 col-md-5 col-sm-6 col-12 section-div p-r-20">
          <form action="../../controller/ordercontroller.php" method="POST">
            <?php FormPrimaryInputs(true); ?>
            <div class="row">
              <div class="col-md-12 header-bg m-b-10">
                <h4><i class='fa fa-map-marker'></i> Add New Shipping Address</h4>
              </div>
              <div class="form-group col-md-6 col-lg-6 col-sm-6 col-6">
                <label>Contact Person</label>
                <input type="text" name="CustomerAddressContactPerson" value="" class="form-control" required="" placeholder="first last name">
              </div>
              <div class="form-group col-md-6 col-lg-6 col-sm-6 col-6">
                <label>Alternate Phone</label>
                <input type="text" name="CustomerAddressAltPhone" value="" class="form-control" required="" placeholder="+91">
              </div>
              <div class="form-group col-md-12 col-lg-12 col-sm-12 col-12">
                <label>Street Address/House No</label>
                <textarea type="text" name="CustomerAddressStreetAddress" rows="3" value="" class="form-control" required=""></textarea>
              </div>
              <div class="form-group col-md-6 col-lg-6 col-sm-6 col-6">
                <label>Area Locality</label>
                <input type="text" name="CustomerAddressArea" value="" class="form-control" required="">
              </div>
              <div class="form-group col-md-6 col-lg-6 col-sm-6 col-6">
                <label>City</label>
                <input type="text" name="CustomerAddressCity" value="" class="form-control" required="">
              </div>
              <div class="form-group col-md-6 col-lg-6 col-sm-6 col-6">
                <label>State</label>
                <input type="text" name="CustomerAddressState" value="" class="form-control" required="">
              </div>
              <div class="form-group col-md-6 col-lg-6 col-sm-6 col-6">
                <label>Pincode</label>
                <input type="pincode" name="CustomerAddressPincode" value="" class="form-control" required="">
              </div>
              <div class="form-group col-md-6 col-lg-6 col-sm-6 col-6">
                <label>Country</label>
                <input type="text" name="CustomerAddressCountry" class="form-control" required="">
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
                <input type="text" name="CustomerAddressGSTNo" value="" class="form-control">
              </div>
              <div class="col-md-12 col-lg-12 col-sm-12 col-12 m-b-20">
                <button class="btn btn-md btn-primary" name="SaveAddress">Save Address</button>
              </div>
            </div>
          </form>
        </div>
        <div class="col-lg-7 col-md-7 col-sm-6 col-12">
          <div class="row">
            <div class="col-md-12 header-bg m-b-10 m-l-10">
              <h4 class="m-l-5"><i class='fa fa-map-marker'></i> Select Shipping Address</h4>
            </div>
          </div>
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
                      <form action="billing/" method="POST">
                        <textarea hidden="" name="ShippingAddress"> <?php echo $Address->CustomerAddressContactPerson; ?><br> <?php echo SECURE($Address->CustomerAddressStreetAddress, "d"); ?> <?php echo $Address->CustomerAddressArea; ?> <?php echo $Address->CustomerAddressCity; ?> <?php echo $Address->CustomerAddressState; ?> <?php echo $Address->CustomerAddressCountry; ?> - <?php echo $Address->CustomerAddressPincode; ?>
                    <br>
                    <?php echo $Address->CustomerAddressAltPhone; ?><br>
                    <?php if ($Address->CustomerAddressGSTNo != null) {
                      echo "GST NO: " . $Address->CustomerAddressGSTNo;
                    } ?>
                    </textarea>
                        <button class="btn btn-sm btn-success" name="saveintoshipping">Select This</button>
                      </form>
                      <a href="editaddress/?addressid=<?php echo SECURE($Address->CustomerAddressid, "e"); ?>&access_url=<?php echo SECURE(GET_URL(), "e"); ?>" class="btn btn-sm btn-info">Edit</a>
                      <a href="../../controller/customercontroller.php?deleteaddress=<?php echo SECURE($Address->CustomerAddressid, "e"); ?>&access_url=<?php echo SECURE(GET_URL(), "e"); ?>" class="btn btn-sm btn-danger"><i class="fa fa-trash text-white"></i></a>
                    </div>
                  </div>
                </div>
            <?php }
            } ?>
          </div>
        </div>
      </div>
    </section>
    <hr>
    <br>

    <?php include $AccessLevel . "include/web/footer.php"; ?>
    <?php include $AccessLevel . "include/web/footer_files.php"; ?>
  </body>

</html>