<?php
$VisitorsIP = IP_ADDRESS;
$VisitorDeviceType = DEVICE_TYPE;
$VisitorDeviceDetails = SECURE(SYSTEM_INFO, "e");
$VisitorVisitingDate = date("d-m-Y");
if (isset($_SESSION['LOGIN_CustomerId'])) {
  $VisitorCustomerId = $_SESSION['LOGIN_CustomerId'];
} else {
  $VisitorCustomerId = 0;
}

//check visitors type 
$VisitorIsComing = CHECK("SELECT * FROM visitors where VisitorsIP='$VisitorsIP'");
if ($VisitorIsComing == null) {
  $VisitorsType = "New";
} else {
  $VisitorsType = "Re-visits";
}

$SAVE = SAVE("visitors", ["VisitorsIP", "VisitorDeviceType", "VisitorsType", "VisitorDeviceDetails", "VisitorVisitingDate", "VisitorCustomerId"], false);
?>
<?php if (DEVICE_TYPE == "Computer" || DEVICE_TYPE == "Tablet") { ?>
  <section class="container-fluid pb-4">
    <div class="row">
      <div class="col-md-12 text-center app-bg pt-1">
        <p class="text-white mb-0">
          <?php
          $FetchListings = FetchConvertIntoArray("SELECT * FROM offers where OfferStatus='1' ORDER BY OffersId ASC", true);
          if ($FetchListings != null) {
            $Sno = 0;
            foreach ($FetchListings as $Fields) {
              $Sno++;
              if ($Fields->OfferDiscountType == "Percentage") {
                $OfferDiscountValue = "" . $Fields->OfferDiscountValue . "%";
              } else {
                $OfferDiscountValue = "Rs. " . $Fields->OfferDiscountValue;
              } ?>
              <?php echo $Fields->OffersName; ?> - <?php echo $Fields->OfferCouponCode; ?> and get
              <?php echo $OfferDiscountValue; ?> off on your purchase.
          <?php }
          }
          ?>
        </p>
      </div>
    </div>
    <div class="row">
      <div class="col-md-4 top-info text-left mt-lg-4">
        <ul class="footer-social text-center mt-1">
          <li class="mx-2">
            <a href="tel:<?php echo PRIMARY_PHONE; ?>" target="_blank" alt="Call @ <?php echo APP_NAME; ?>" title="Call @ <?php echo APP_NAME; ?>"> <?php echo PRIMARY_PHONE; ?></i>
              |
            </a>
          </li>
          <?php echo SocialAccounts(); ?>
        </ul>
      </div>
      <div class="col-md-4 logo-w3layouts text-center">
        <h1 class="logo-w3layouts">
          <a class="navbar-brand" href="<?php echo DOMAIN; ?>">
            <img src="<?php echo MAIN_LOGO; ?>" loading="lazy" class="app-logo lazyload">
          </a>
        </h1>
      </div>

      <div class="col-md-4 top-info-cart text-center mt-lg-4">
        <ul class="cart-inner-info">
          <li class="button-log">
            <button id="trigger-overlay" type="button">
              <i class="fa fa-search"></i>
            </button>
            <div class="overlay overlay-door">
              <button type="button" class="overlay-close">
                <i class="fa fa-times" aria-hidden="true"></i>
              </button>
              <form action="<?php echo WEB_URL; ?>/products/" method="get" class="d-flex">
                <input class="form-control" list="productname" onchange="form.submit()" type="text" name="product_name" placeholder="Search here..." required="">
                <datalist id="productname">
                  <?php echo SelectOptions("SELECT * FROM products ORDER BY ProductName ASC", "ProductName", "ProductName", null); ?>
                </datalist>
                <button type="submit" class="mt-0 mb-0 btn app-btn btn-lg submit">
                  <i class="fa fa-search"></i>
                </button>
              </form>
            </div>
          </li>
          <li class="button-log">
            <?php if (isset($_SESSION['LOGIN_CustomerId'])) { ?>
              <a href="<?php echo WEB_URL; ?>/account/">
                <i class="fa fa-user"></i>
                My Account
              </a>
              <a href="<?php echo DOMAIN; ?>/logout.php" class="ml-2">
                Logout <i class="fa fa-sign-out"></i>
              </a>
            <?php } else { ?>
              <a href="<?php echo DOMAIN; ?>/auth/web/">
                <i class="fa fa-user"></i>
                Login / Signup
              </a>
            <?php  } ?>
          </li>
          <li class="galssescart galssescart2 cart cart box_1">
            <a href="<?php echo DOMAIN; ?>/web/cart/">
              <button class="top_googles_cart" type="button">
                <i class="fa fa-cart-arrow-down"></i>
                <span class="cart-item-count"><?php echo CartItems(); ?></span>
              </button>
            </a>
          </li>
        </ul>
      </div>
    </div>
    <center>
      <div class="row">
        <div class="col-md-12">
          <form action="<?php echo WEB_URL; ?>/products/" method="get" class="d-flex w-75 mt-3">
            <input class="form-control-lg form-control" list="productname" onchange="form.submit()" type="text" name="product_name" placeholder="What you want to buy?..." required="">
            <datalist id="productname">
              <?php echo SelectOptions("SELECT ProductName FROM products ORDER BY ProductName ASC", "ProductName", "ProductName", null); ?>
            </datalist>
          </form>
        </div>
      </div>
    </center>
  </section>
<?php } else { ?>
  <section class="fixed-bottom pb-2">
    <div class="row">
      <div class="col-md-12">
        <div class="app-menus flex-s-a">
          <a href="<?php echo APP_URL; ?>/" id='home'><i class="fa fa-home"></i>Home</a>
          <a href="<?php echo WEB_URL; ?>/collection" id='shop'><i class="fa fa-table"></i>Shop</a>
          <a href="<?php echo WEB_URL; ?>/account/orders" id='orders'><i class='fa fa-truck'></i>Orders</a>
          <a href="<?php echo WEB_URL; ?>/account" id='account'><i class='fa fa-user'></i>Accounts</a>
        </div>
      </div>
  </section>

  <?php
  if (isset($_SESSION['LOGIN_CustomerId'])) {
    $CheckCartItems = CHECK("SELECT * FROM cartitems where CartCustomerId='" . LOGIN_CustomerId . "'");
    if ($CheckCartItems != null) { ?>
      <section class="fixed-bottom cart-order">
        <div class="row">
          <div class="col-md-12 bg-white">
            <div class="flex-s-b p-2 pt-1">
              <div class="w-50 text-left">
                <small class="text-secondary text-left small"><small> Cart Total:</small></small><br>
                <h4 class="bold mb-0">Rs.<?php echo AMOUNT("SELECT * FROM cartitems where CartCustomerId='" . LOGIN_CustomerId . "'", "CartFinalPrice"); ?></h4>
              </div>
              <div class="w-50 text-right pt-1 mt-1">
                <a href="<?php echo WEB_URL; ?>/cart" class="btn btn-md btn-success text-white">Continue <i class='fa fa-angle-right btn btn-sm text-white'></i></a>
              </div>
            </div>
          </div>
        </div>
      </section>
  <?php }
  } ?>
<?php }
include(__DIR__ . "/message.php"); ?>