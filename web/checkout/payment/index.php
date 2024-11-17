<?php

//page varibale
$PageName  = "Order Review";
$AccessLevel = "../../../";

//include required files here
require $AccessLevel . "require/modules.php";
require $AccessLevel . "require/web-modules.php";

if (!isset($_SESSION['LOGIN_CustomerId'])) {
  LOCATION("info", "Please Login First!", DOMAIN . "/auth/web/login/");
}

//page actiti
if (isset($_POST['BillingAddress'])) {
  $_SESSION['BILLING_ADDRESS'] = SECURE($_POST['BillingAddress'], "e");
}

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

  <?php if (DEVICE_TYPE == "Computer") { ?>
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
            <a href="<?php echo WEB_URL; ?>/checkout/billing" class="active">
              <span class="count">3</span>
              <span>Billing</span>
            </a>
            <a href="<?php echo WEB_URL; ?>/checkout/billing" class="active">
              <span class="count">4</span>
              <span>Order Review</span>
            </a>
          </div>
        </div>
      </div>
    </section>

    <section class="container m-t-10 section">
      <div class="row">
        <?php if (CartItems() == 0) {
          NoCartItems("Empty Cart") . "<br><br>";
        } else { ?>
          <div class="col-lg-5 col-md-5 col-sm-6 col-12 section-div p-r-20">
            <div class="row">
              <div class="col-md-12 m-b-15 header-bg">
                <h4 class="m-l-5"><i class="fa fa-map-marker"></i> Shipping Address</h4>
              </div>
              <div class="col-md-12">
                <div class="cat-box">
                  <?php echo SECURE($_SESSION['SHIPPING_ADDRESS'], "d"); ?><br><br>
                  <a href="../index.php" class="btn btn-sm btn-primary">Edit Address</a>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12 m-b-15 header-bg">
                <h4 class="m-l-5"><i class="fa fa-inr"></i> Billing Address</h4>
              </div>
              <div class="col-md-12">
                <div class="cat-box">
                  <?php echo SECURE($_SESSION['BILLING_ADDRESS'], "d"); ?><br><br>
                  <a href="../billing/" class="btn btn-sm btn-primary">Edit Address</a>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-7 col-md-7 col-sm-6 col-12">
            <div class="row">
              <div class="col-md-12 header-bg m-b-10 m-l-10">
                <h4 class="m-l-5"><i class='fa fa-shopping-cart'></i> Item Details</h4>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <table class="table table-striped cart-table">
                  <?php
                  if (isset($_SESSION['LOGIN_CustomerId'])) {
                    $LOGIN_CustomerId = $_SESSION['LOGIN_CustomerId'];
                    $CartItems = FetchConvertIntoArray("SELECT * FROM cartitems, products, pro_categories, pro_sub_categories where products.ProductCategoryId=pro_categories.ProCategoriesId and products.ProductSubCategoryId=pro_sub_categories.ProSubCategoriesId and cartitems.CartProductId=products.ProductId and cartitems.CartCustomerId='$LOGIN_CustomerId'", true);
                  } else {
                    $CartItems = FetchConvertIntoArray("SELECT * FROM cartitems, products, pro_categories, pro_sub_categories where products.ProductCategoryId=pro_categories.ProCategoriesId and products.ProductSubCategoryId=pro_sub_categories.ProSubCategoriesId and cartitems.CartProductId=products.ProductId and cartitems.CartProductId=products.ProductId and cartitems.CartDeviceInfo='" . IP_ADDRESS . "'", true);
                  }
                  if ($CartItems ==  null) {
                    NoCartItems("Empty Shopping Cart!");
                  } else {
                    $CartItemsCount = 0;
                    $CartNetTotal = 0;
                    foreach ($CartItems as $CartProducts) {
                      $CartItemsCount++;
                  ?>
                      <tr>
                        <td style="width:15%;">
                          <a href="<?php echo DOMAIN; ?>/web/store/details/?view=<?php echo SECURE($CartProducts->ProductId, "e"); ?>">
                            <img src="<?php echo STORAGE_URL; ?>/products/pro-img/<?php echo $CartProducts->ProductImage; ?>" alt="<?php echo $CartProducts->ProductName; ?>" title="<?php echo $CartProducts->ProductName; ?>" class="w-100 cart-item-image">
                          </a>
                        </td>
                        <td>
                          <h6><b><?php echo $CartProducts->ProductName; ?></b></h6>
                          <p class="fs-12">
                            <span><?php echo $CartProducts->ProSubCategoryName; ?></span>
                            <span><?php echo $CartProducts->CartProductWeight; ?></span><br>
                            <span><?php echo SECURE($CartProducts->CartItemDescriptions, "d"); ?></span>
                          </p>
                        </td>
                        <td>
                          <span class="text-black">Rs.<?php echo $CartProducts->CartProductSellPrice; ?> </span>
                        </td>
                        <td>
                          <form action="<?php echo CONTROLLER; ?>/ordercontroller.php" method="POST" class="add-to-cart-options">
                            <input type="text" name="CartItemsid" value="<?php echo $CartProducts->CartItemsid; ?>" hidden="">
                            <input type="text" name="CartProductSellPrice" value="<?php echo $CartProducts->CartProductSellPrice; ?>" hidden="">
                            <input type="text" name="UpdateCartQuantity" hidden="" value="<?php echo SECURE('true', 'e'); ?>">
                            <?php FormPrimaryInputs(true); ?>
                            <div class="flex-space-between">
                              <select name="CartProductQty" class="form-control" required="" onchange="form.submit()">
                                <?php
                                $StartValue = MIN_ORDER_QTY;
                                while ($StartValue <= MAX_ORDER_QTY) {
                                  if ($StartValue == $CartProducts->CartProductQty) {
                                    $selected = "selected=''";
                                  } else {
                                    $selected = '';
                                  } ?>
                                  <option value="<?php echo $StartValue; ?>" <?php echo $selected; ?>><?php echo $StartValue; ?></option>
                                <?php $StartValue++;
                                } ?>
                              </select>
                            </div>
                          </form>
                        </td>
                        <td>
                          <span class="text-danger">
                            <?php
                            (int)$ApplicableTax = FETCH("SELECT * FROM products where ProductId='" . $CartProducts->CartProductId . "'", "ProductApplicableTaxes");
                            (int)$TaxAmount = round((int)$CartProducts->CartFinalPrice / 100 * $ApplicableTax);
                            ?>
                            <span>Rs.<?php echo $CartNetTotal += (int)$CartProducts->CartFinalPrice + $TaxAmount; ?></span>
                          </span>
                        </td>
                        <td>
                          <a onmouseover="Display()" href="<?php echo DOMAIN; ?>/controller/ordercontroller.php?deleteid=<?php echo SECURE($CartProducts->CartItemsid, 'e'); ?>&access_url=<?php echo SECURE(GET_URL(), "e"); ?>" class="btn btn-sm btn-danger text-center"><i class="fa fa-times text-white"></i></a>
                        </td>
                      </tr>
                  <?php }
                  }
                  ?>
                </table>
              </div>
            </div>
            <div class="row">
              <table class="table table-striped">
                <tr align="right">
                  <td>
                    <span class="cart-details">Total Cart Amount</span>
                  </td>
                  <td>
                    <span class="cart-price">Rs.<?php echo $_SESSION['TOTAL_CART_AMOUNT']; ?></span>
                  </td>
                </tr>
                <tr align="right">
                  <td>
                    <span class="cart-details"><?php echo $_SESSION['DELIVERY_CHARGES_NAME'] ?></span>
                  </td>
                  <td>
                    <span class="cart-price"> <?php echo ChargesCartAmount($dccartamount, $dcchargeamount, $_SESSION['TOTAL_CART_AMOUNT']); ?></span>
                  </td>
                </tr>
                <?php if (isset($_SESSION['COUPON_MODE'])) {
                  if ($_SESSION['COUPON_MODE'] == "enabled") { ?>
                    <tr align="right">
                      <td>
                        <span class="cart-details">Coupon Applied (<?php echo $_SESSION['COUPON_CODE']; ?>)</span>
                      </td>
                      <td>
                        <span class="cart-price">- Rs.<?php echo $_SESSION['COUPON_DISCOUNT_AMOUNT']; ?></span>
                      </td>
                    </tr>
                <?php }
                } else {
                } ?>
                <tr align="right">
                  <td>
                    <span class="cart-details text-success">Net Payable Amount</span>
                  </td>
                  <td>
                    <span class="cart-price text-success">Rs.<?php echo $_SESSION['FINAL_CHECKOUT_AMOUNT']; ?></span>
                  </td>
                </tr>
              </table>
            </div>
            <div class="row">
              <div class="col-md-12 header-bg m-b-10 m-l-10">
                <h4 class="m-l-5"><i class="fa fa-exchange"></i> Payment Method</h4>
              </div>
              <div class="col-md-12 text-center">
                <form action="../../../controller/ordercontroller.php" method="POST">
                  <?php FormPrimaryInputs(true); ?>
                  <div class="row text-center">
                    <div class="col-md-6 col-lg-6 col-sm-6 col-6 form-group shadow-lg" onclick="ChangeMethod('paymethod')">
                      <label for="cashpayment">
                        <img src="<?php echo STORAGE_URL_D; ?>/tool-img/cash.jpg" class="w-100 br10 paymethod" id="paymethod">
                      </label>
                      <input type="radio" name="PAYMENT_METHOD" required="" checked value="PAY_ON_DELIVERY" id="cashpayment" hidden="">
                    </div>
                    <?php if (ONLINE_PAYMENT_OPTION == "true") { ?>
                      <div class="col-md-6 col-lg-6 col-sm-6 col-6 form-group shadow-lg" onclick="ChangeMethod('onlinemethod')">
                        <label for="onlinepayment">
                          <img src="<?php echo STORAGE_URL_D; ?>/tool-img/online.jpg" class="w-100 br10" id="onlinemethod">
                        </label>
                        <input type="radio" name="PAYMENT_METHOD" value="ONLINE" id="onlinepayment" hidden="">
                      </div>
                    <?php } ?>
                    <div class="col-md-12">
                      <span id="paymodemsg" class="text-danger"></span><br>
                      <button class="btn btn-lg btn-success" onclick="CheckMode()" id="orderbtn" name="CreateOrder">Continue & Placed Order <i class="fa fa-angle-double-right text-white"></i></button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        <?php } ?>
      </div>
    </section>
    <hr>
    <br><br>
    <script>
      function CheckMode() {
        var cashpayment = document.getElementById("cashpayment");
        var onlinepayment = document.getElementById("onlinepayment");
        if (cashpayment.checked == false && onlinepayment.checked == false) {
          document.getElementById("paymodemsg").innerHTML = "Please Select Pay Mode";
        } else {
          document.getElementById("paymodemsg").classList.remove("text-danger");
          document.getElementById("paymodemsg").classList.add("text-success");
          document.getElementById("paymodemsg").innerHTML = "Please wait while processing your order, it may takes 5-6sec...";

          document.getElementById("orderbtn").innerHTML = "<i class='fa fa-spinner fa-spin text-white'></i> Processing Order...";
        }
      }
    </script>
    <script>
      function ChangeMethod(data) {
        if (data === "paymethod") {
          document.getElementById("paymethod").classList.add("paymethod");
          document.getElementById("onlinemethod").classList.remove("paymethod");
        } else {
          document.getElementById("onlinemethod").classList.add("paymethod");
          document.getElementById("paymethod").classList.remove("paymethod");
        }
      }
    </script>
    <?php include $AccessLevel . "include/web/footer.php"; ?>
    <?php include $AccessLevel . "include/web/footer_files.php"; ?>
  <?php
  } else {
  ?>
    <div class='fixed-top'>
      <section class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="flex-start">
              <a href="<?php echo WEB_URL; ?>/cart" class="btn btn-lg mr-3 bold h3 mt-1 back-btn"><i class="fa fa-angle-left"></i></a>
              <div class="page-title">
                <h5>Review Order</h5>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>

    <section class="container page-section">
      <div class="row">
        <div class="col-md-12">
          <h5 class="mb-0 mt-2">Item Details</h5>
          <p class="text-secondary small">purchasing item details are as follows,</p>
        </div>
      </div>

      <div class="row">
        <?php
        if (isset($_SESSION['LOGIN_CustomerId'])) {
          $LOGIN_CustomerId = $_SESSION['LOGIN_CustomerId'];
          $CartItems = FetchConvertIntoArray("SELECT * FROM cartitems, products, pro_categories, pro_sub_categories where products.ProductCategoryId=pro_categories.ProCategoriesId and products.ProductSubCategoryId=pro_sub_categories.ProSubCategoriesId and cartitems.CartProductId=products.ProductId and cartitems.CartCustomerId='$LOGIN_CustomerId'", true);
        } else {
          $CartItems = FetchConvertIntoArray("SELECT * FROM cartitems, products, pro_categories, pro_sub_categories where products.ProductCategoryId=pro_categories.ProCategoriesId and products.ProductSubCategoryId=pro_sub_categories.ProSubCategoriesId and cartitems.CartProductId=products.ProductId and cartitems.CartProductId=products.ProductId and cartitems.CartDeviceInfo='" . IP_ADDRESS . "'", true);
        }
        if ($CartItems ==  null) {
          NoCartItems("Empty Shopping Cart!");
        } else {
          $CartItemsCount = 0;
          $CartItemTotalAmount = 0;
          $CartItemTaxAmount = 0;
          $CartTotalCartProductSellPrice = 0;
          $CartItemNetPayableAmount = 0;
          foreach ($CartItems as $CartProducts) {
            $CartItemsCount++;
            $CartTotalCartProductSellPrice += (int)$CartProducts->CartProductSellPrice;
            $CartItemTotalAmount += (int)$CartProducts->CartFinalPrice;
            $CartItemTaxAmount += round((int)$CartProducts->CartFinalPrice / 100 * (int)$CartProducts->ProductApplicableTaxes);
            $CartItemNetPayableAmount += (int)$CartProducts->CartFinalPrice + round((int)$CartProducts->CartFinalPrice / 100 * (int)$CartProducts->ProductApplicableTaxes);
        ?>
            <div class="col-md-4 col-12 mb-2">
              <div class="app-bg rounded-1 p-2">
                <div class="flex-s-b">
                  <div class="w-30 p-1">
                    <a href="<?php echo DOMAIN; ?>/web/products/details/?view=<?php echo SECURE($CartProducts->ProductId, "e"); ?>">
                      <img src="<?php echo STORAGE_URL; ?>/products/pro-img/<?php echo $CartProducts->ProductImage; ?>" alt="<?php echo $CartProducts->ProductName; ?>" title="<?php echo $CartProducts->ProductName; ?>" class="w-100">
                    </a>
                  </div>
                  <div class="w-70 p-1 pt-3">
                    <a href="<?php echo DOMAIN; ?>/controller/ordercontroller.php?deleteid=<?php echo SECURE($CartProducts->CartItemsid, 'e'); ?>&access_url=<?php echo SECURE(GET_URL(), "e"); ?>" class="btn btn-xs pull-right mt--1"><i class="fa fa-times"></i></a>
                    <h6 class="bold mb-0"><?php echo $CartProducts->ProductName; ?></h6>
                    <p class="small mb-0">
                      <span class="small">
                        <span class="text-black"><?php echo $CartProducts->ProductWeight; ?></span> |
                        <span class="text-secondary mb-1"><?php echo $CartProducts->ProductLocation; ?></span> |
                        <span class="text-secondary mb-1"><?php echo $CartProducts->ProductMedium; ?></span>
                      </span>
                    </p>
                    <p class="mb-0 mt-0 small">
                      <span class="flex-s-b w-100">
                        <span class="w-50">
                          <span>Rs.<?php echo $CartProducts->CartProductSellPrice; ?></span>
                          <span class="text-secondary">x <?php echo $CartProducts->CartProductQty; ?></span><br>
                          <span class="h4 bold">Rs.<?php echo $CartProducts->CartProductSellPrice * $CartProducts->CartProductQty; ?></span>
                        </span>
                        <span class="">
                          <form action="<?php echo CONTROLLER; ?>/ordercontroller.php" method="POST" class="cart-mt w-50 pull-right">
                            <input type="text" name="CartItemsid" value="<?php echo $CartProducts->CartItemsid; ?>" hidden="">
                            <input type="text" name="CartProductSellPrice" value="<?php echo $CartProducts->CartProductSellPrice; ?>" hidden="">
                            <input type="text" name="UpdateCartQuantity" hidden="" value="<?php echo SECURE('true', 'e'); ?>">
                            <?php FormPrimaryInputs(true); ?>
                            <div class="flex-space-between">
                              <select name="CartProductQty" class="form-control" required="" onchange="form.submit()">
                                <?php
                                $StartValue = MIN_ORDER_QTY;
                                while ($StartValue <= MAX_ORDER_QTY) {
                                  if ($StartValue == $CartProducts->CartProductQty) {
                                    $selected = "selected=''";
                                  } else {
                                    $selected = '';
                                  } ?>
                                  <option value="<?php echo $StartValue; ?>" <?php echo $selected; ?>><?php echo $StartValue; ?></option>
                                <?php $StartValue++;
                                } ?>
                              </select>
                            </div>
                          </form>
                        </span>
                      </span>
                    </p>
                  </div>
                </div>
              </div>
            </div>
        <?php }
          $CartItemTotalAmount = $CartItemNetPayableAmount;
          if ($CartItemTotalAmount < $dccartamount) {
            $DeliveryChargeAmount = "+ Rs." . $dcchargeamount;
            $CartItemNetPayableAmount = (int)$CartItemTotalAmount + (int)$dcchargeamount;
          } elseif ($CartItemTotalAmount > $dccartamount) {
            $DeliveryChargeAmount = "Free Delivery";
            $CartItemNetPayableAmount = $CartItemTotalAmount;
          } else {
            $DeliveryChargeAmount = "Free Delivery";
            $CartItemNetPayableAmount = $CartItemTotalAmount;
          }
        } ?>
      </div>
    </section>

    <section class="container pb-5 mb-5">
      <div class="row">
        <div class="col-md-12 mt-2">
          <h5 class="mb-0">Payment details</h5>
          <p class="text-secondary small mb-0">total, taxes, and net payable</p>
        </div>
        <div class="col-md-12">
          <form action="" method="POST">
            <table class="table">
              <tr>
                <td class="h6 text-secondary">Sub-Total</th>
                <th class="text-right">Rs.<?php echo $CartItemTotalAmount; ?></th>
              </tr>
              <tr>
                <td class="h6 text-secondary">Delivery Charges</th>
                <th class="text-right"><?php echo $DeliveryChargeAmount; ?></th>
              </tr>
              <?php
              if (isset($_GET['remove_coupon'])) {
                unset($_SESSION['COUPON_MODE']);
                unset($_SESSION['COUPON_CODE']);
                unset($_SESSION['COUPON_CODE_DETAILS']);
                unset($_SESSION['COUPON_DISCOUNT_AMOUNT']);
                unset($_SESSION['FINAL_CHECKOUT_AMOUNT']);
              }
              if (isset($_SESSION['COUPON_MODE']) == true) {
                $Class = "text-success";
                $SubmittedCoupon = $_SESSION['COUPON_CODE'];
                $COUPON_CODE_DETAILS = $_SESSION['COUPON_CODE_DETAILS'];
                $COUPON_DISCOUNT_AMOUNT = $_SESSION['COUPON_DISCOUNT_AMOUNT'];
                $FINAL_CHECKOUT_AMOUNT = $_SESSION['FINAL_CHECKOUT_AMOUNT'];
                $OfferDiscountType = FETCH("SELECT * from offers where OfferCouponCode='$SubmittedCoupon'", "OfferDiscountType");
                $OfferDiscountValue = FETCH("SELECT * from offers where OfferCouponCode='$SubmittedCoupon'", "OfferDiscountValue");
                if ($OfferDiscountType == "Percentage") {
                  $DiscountedAmount = round((FinalCartAmount() * $OfferDiscountValue) / 100);
                } else {
                  $DiscountedAmount = $OfferDiscountValue;
                }

                $CartItemNetPayableAmount = $CartItemNetPayableAmount - $DiscountedAmount;

                $Text = "
                <small>
                You Save Rs." . $DiscountedAmount . " On this Order by using Coupon Code <code class='code'>$SubmittedCoupon</code>.
                </small><br>
                <a href='?remove_coupon=true' class='text-danger'><i class='fa fa-times'></i> Remove</a>
                ";
              ?>
                <tr align="right">
                  <td class="h6 text-secondary text-left">Order Amount</td>
                  <td align="right" class="">
                    <span class="cart-price net-price">Rs.<?php echo $CartItemNetPayableAmount; ?></span>
                  </td>
                </tr>
                <tr align="right">
                  <td align="right" colspan="2">
                    <span class="cart-details mr-2 text-right <?php echo $Class; ?>"><?php echo $Text; ?></span>
                  </td>
                </tr>
                <tr align="right">
                  <td class="h6 text-secondary text-left">Coupon Applied (<?php echo $SubmittedCoupon; ?>)</td>
                  <td align="right" class="text-right">
                    <span class="cart-price net-price">- Rs.<?php echo $DiscountedAmount; ?></span>
                  </td>
                </tr>
                <tr align="right">
                  <td class="h5 text-secondary text-left"><b>Net Payable Amount :</b></td>
                  <td align="right" class="">
                    <span class="text-right bold text-success h5"><b>Rs.<?php echo $CartItemNetPayableAmount; ?></b></span>
                  </td>
                </tr>
              <?php } else { ?>
                <tr align="right">
                  <td class="h5 text-secondary text-left"><b>Net Payable Amount :</b></td>
                  <td align="right" class="">
                    <span class="text-right bold text-success h5"><b>Rs.<?php echo $CartItemNetPayableAmount; ?></b></span>
                  </td>
                </tr>
              <?php } ?>
            </table>
            <div class="fs-10" style="font-size:10px !important;text-align:right;"><?php echo SECURE(CONFIG("INSTALLATION_SHIPPING"), "d"); ?></div>
          </form>
        </div>

        <div class="col-md-12 mt-1 mb-5 pb-5">
          <h5 class="mb-0">Delivery Type</h5>
          <p class="text-secondary small mb-0">select delivery type as per your need.</p>

          <div class="flex-s-b mt-3">
            <div class="w-100 mr-2 text-left">
              <div class="shadow-sm p-2 rounded-1 app-bdr">
                <h6 class="bold mt-1"><i class="fa fa-star fa-spin text-warning"></i> Standard Delivery</h6>
                <p class="mb-0 small"> Standard delivery in 60 mins for selected area only.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="fixed-bottom">
      <div id="Add-Address" class='hidden'>
        <div class="row bg-white pt-3 pl-2 pr-2">
          <div class="col-md-12 text-left">
            <div class="flex-s-b">
              <h6 class="bold"><i class="fa fa-map-marker text-success"></i> Select Delivery Address</h6>
              <a class="btn btn-sm btn-danger text-white" onclick="Databar('NewAddressAdd')"><i class="fa fa-plus"></i> New Address</a>
            </div>
          </div>
          <div class="col-md-12 text-left">
            <ul class="delivery-addresses">
              <?php
              $FetchAllAddress = FetchConvertIntoArray("SELECT * FROM customeraddress where CustomerAddressViewId='" . LOGIN_CustomerId . "' ORDER BY CustomerAddressid DESC", true);
              if ($FetchAllAddress != null) {
                $NewAddressOption = "hidden";
                foreach ($FetchAllAddress as $Address) {
                  if (isset($_GET['delivery_address'])) {
                    $_SESSION['delivery_address'] = $_GET['delivery_address'];
                    if (isset($_SESSION['delivery_address'])) {
                      if ($Address->CustomerAddressid == $_SESSION['delivery_address']) {
                        $selected_Address = "address-selected";
                      } else {
                        $selected_Address = "";
                      }
                    } else {
                      $selected_Address = "";
                    }
                  } else {
                    if (isset($_SESSION['delivery_address'])) {
                      if ($Address->CustomerAddressid == $_SESSION['delivery_address']) {
                        $selected_Address = "address-selected";
                      } else {
                        $selected_Address = "";
                      }
                    } else {
                      $selected_Address = "";
                    }
                  } ?>
                  <li>
                    <a href="?delivery_address=<?php echo $Address->CustomerAddressid; ?>" class="text-dark">
                      <p class="<?php echo $selected_Address; ?>">
                        <span class="bold"><i class="fa fa-map-marker text-success"></i> <?php echo $Address->CustomerAddressType; ?></span>
                        <span>
                          <?php echo $Address->CustomerAddressStreetAddress . "  " . $Address->CustomerAddressArea; ?>
                          <?php echo $Address->CustomerAddressCity . "  " . $Address->CustomerAddressState; ?>
                          <?php echo $Address->CustomerAddressCountry . "  " . $Address->CustomerAddressPincode; ?>
                        </span>
                        <span><?php echo $Address->CustomerAddressContactPerson; ?></span>
                        <span><?php echo $Address->CustomerAddressAltPhone; ?></span>
                      </p>
                    </a>
                  </li>
              <?php  }
              } else {
                $NewAddressOption = "";
              } ?>
            </ul>
          </div>
        </div>

        <div class="<?php echo $NewAddressOption; ?>" id='NewAddressAdd'>
          <div class="row bg-white">
            <div class="col-md-12 mb-0 text-left">
              <form action="../../controller/customercontroller.php" Method="POST" class="p-2">
                <?php echo FormPrimaryInputs(true, [
                  "CustomerAddressViewId" => LOGIN_CustomerId
                ]);  ?>
                <h6 class='bold small'><i class="fa fa-map-marker text-success"></i> Add New Delivery Address:</h6>
                <div class="flex-s-b mb-2">
                  <div class="form-group w-50 mr-2">
                    <label class="small text-secondary">House no/Flat No</label>
                    <input type="text" name="CustomerAddressStreetAddress" min='5' required class="form-control form-control-sm">
                  </div>
                  <div class="form-group w-50">
                    <label class="small text-secondary">Gali/Floor/Apart. No</label>
                    <input type="text" name='Floor_No' min='2' class="form-control form-control-sm">
                  </div>
                </div>

                <div class="flex-s-b mb-2">
                  <div class="form-group w-50 mr-2">
                    <label class="small text-secondary">Sector/Area locality</label>
                    <input type="text" name='CustomerAddressArea' required class="form-control form-control-sm">
                  </div>
                  <div class="form-group w-50">
                    <label class="small text-secondary">Landmark/near by</label>
                    <input type="text" name='LandMark' class="form-control form-control-sm">
                  </div>
                </div>

                <div class="flex-s-b mb-2">
                  <div class="form-group w-50 mr-2">
                    <label class="small text-secondary">City</label>
                    <input type="text" name='CustomerAddressCity' class="form-control form-control-sm">
                  </div>
                  <div class="form-group w-50">
                    <label class="small text-secondary">Pincode</label>
                    <input type="text" name='CustomerAddressPincode' class="form-control form-control-sm">
                  </div>
                </div>
                <div class="flex-s-b mb-2">
                  <div class="form-group w-50 mr-2">
                    <label class="small text-secondary">Receiver Name</label>
                    <input type="text" name='CustomerAddressContactPerson' class="form-control form-control-sm">
                  </div>
                  <div class="form-group w-50">
                    <label class="small text-secondary">Phone Number</label>
                    <input type="text" name='CustomerAddressAltPhone' class="form-control form-control-sm">
                  </div>
                </div>

                <div class="flex-s-b mt-3">
                  <div>
                    <label class="btn btn-xs bg-white shadow-sm app-bdr w-pr-20">
                      <input type='radio' checked class="radio-input-with-tag" value='HOME' name='CustomerAddressType'>
                      <span class="ml-3">HOME</span>
                    </label>
                    <label class="btn btn-xs bg-white shadow-sm app-bdr w-pr-20">
                      <input type='radio' class="radio-input-with-tag" value='WORK' name='CustomerAddressType'>
                      <span class="ml-3">WORK</span>
                    </label>
                  </div>
                  <div>
                    <a class="btn btn-sm btn-default text-danger" onclick="Databar('NewAddressAdd')">Cancel</a>
                    <button name='address_confirmed' class="btn btn-sm btn-success text-white"><i class="fa fa-check btn btn-xs text-white"></i> Save</button>
                  </div>
                </div>
                <hr class="mb-0">
              </form>
            </div>
          </div>
        </div>
      </div>
      <div class="row bg-white">
        <?php
        if (isset($_GET['delivery_address'])) {
          $_SESSION['delivery_address'] = $_GET['delivery_address'];
        } else {
          if (!isset($_SESSION['delivery_address'])) {
            $_SESSION['delivery_address'] = null;
          } else {
            if (isset($_SESSION['delivery_address'])) {
              if (isset($_GET['delivery_address'])) {
                $_SESSION['delivery_address'] = $_GET['delivery_address'];
              }
            } else {
              $_SESSION['delivery_address'] = $_SESSION['delivery_address'];
            }
          }
        }
        if (isset($_SESSION['delivery_address'])) {
          $CustomerAddressid = $_SESSION['delivery_address'];  ?>
          <div class="col-md-12 text-left">
            <p class="mb-0 text-left p-2 pr-3">
              <a onclick="Databar('Add-Address')" class="text-black">
                <small class="bold small">
                  <?php
                  $FetchAllAddress = FetchConvertIntoArray("SELECT * FROM customeraddress where CustomerAddressid='$CustomerAddressid' and CustomerAddressViewId='" . LOGIN_CustomerId . "' ORDER BY CustomerAddressid DESC", true);
                  if ($FetchAllAddress != null) {
                    foreach ($FetchAllAddress as $Address) { ?>
                      <i class="fa fa-map-marker text-success"></i>
                      <?php echo $Address->CustomerAddressType; ?>
                      <?php
                      echo $Address->CustomerAddressStreetAddress . "  " . $Address->CustomerAddressArea . "..."; ?>
                  <?php  }
                  } else {
                  } ?>
                </small>
                <span class="bold pull-right"><i class='fa fa-angle-right'></i></span>
              </a>
            </p>
          </div>
          <?php }
        if (isset($_SESSION['pay_method'])) {
          if (isset($_GET['pay_method'])) {
            $payMode = $_GET['pay_method']; ?>
          <?php } else {
            $payMode = $_SESSION['pay_method'];
          } ?>
          <a href="?pay_mode=true" class="btn btn-md m-1 btn-info text-white mt-2">Pay Mode :<?php echo $payMode; ?><i class="fa fa-check btn btn-sm text-white"></i></a>
        <?php }
        if (isset($_GET['pay_mode'])) { ?>
          <div class="col-md-12 mb-0">
            <div class="flex-s-b">
              <div class="w-50">
                <a href="?pay_method=ONLINE" class="btn btn-block btn-md shadow-sm text-info"><i class='fa fa-globe app-text'></i> Pay Online</a>
              </div>
              <div class="w-75 ml-2">
                <a href="?pay_method=PAY_ON_DELIVERY" class="btn btn-block btn-md shadow-sm text-success"><i class='fa fa-money app-text'></i> Pay on Delivery</a>
              </div>
            </div>
          </div>
        <?php } ?>
        <div class="col-md-12 bg-white">
          <div class="flex-s-b p-2">
            <div class="w-50 text-left">
              <p class="text-secondary small mb-0">Net Payable</p>
              <h3 class="bold mt-0">Rs.<?php echo $CartItemNetPayableAmount; ?></h3>
            </div>
            <div class="w-50 text-right">
              <?php
              if (isset($_GET['pay_method'])) {
                $_SESSION['pay_method'] = $_GET['pay_method'];
              } else {
                if (!isset($_SESSION['pay_method'])) {
                  $_SESSION['pay_method'] = null;
                } else {
                  if (isset($_SESSION['pay_method'])) {
                    if (isset($_GET['pay_method'])) {
                      $_SESSION['pay_method'] = $_GET['pay_method'];
                    }
                  } else {
                    $_SESSION['pay_method'] = $_SESSION['pay_method'];
                  }
                }
              }
              if (isset($_SESSION['pay_method'])) { ?>
                <form action="<?php echo CONTROLLER; ?>/ordercontroller.php" method="POST">
                  <?php FormPrimaryInputs(true); ?>
                  <div class="row text-center">
                    <input type="text" name="PAYMENT_METHOD" value="<?php echo $_SESSION['pay_method']; ?>" hidden="">
                  </div>
                  <div class="col-md-12">
                    <button class="btn btn-md btn-success mt-2" name="CreateOrder">Confirm & Placed Order <i class="fa fa-angle-double-right text-white"></i></button>
                  </div>
                </form>
              <?php }

              if (!isset($_SESSION['delivery_address'])) { ?>
                <a onclick="Databar('Add-Address')" class="btn btn-sm btn-info text-white mt-2">Delivery address <i class="fa fa-plus btn btn-sm text-white"></i></a>
                <?php } else {
                if (isset($_SESSION['delivery_address'])) {
                  if ($_SESSION['delivery_address'] == null) {
                ?>
                    <a onclick="Databar('Add-Address')" class='btn btn-info btn-sm mt-2 text-white'>Add Delivery Address</a>
                    <?php
                  } else {
                    if (!isset($_SESSION['pay_method'])) {
                    ?>
                      <a href="?pay_mode=true" class="btn btn-sm btn-info text-white mt-2">Select Pay method <i class="fa fa-angle-down btn btn-sm text-white"></i></a>
              <?php
                    }
                  }
                }
              } ?>
            </div>
          </div>
        </div>
      </div>
    </section>
    <br><br><br><br><br><br>
    <script>
      function Databar(data) {
        databar = document.getElementById("" + data + "");
        if (databar.style.display === "block") {
          databar.style.display = "none";
        } else {
          databar.style.display = "block";
        }
      }
    </script>
  <?php  } ?>
</body>

</html>