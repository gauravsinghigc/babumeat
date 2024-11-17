<?php

//page varibale
$PageName  = "My Cart";
$AccessLevel = "../../";

//include required files here
require $AccessLevel . "require/modules.php";
require $AccessLevel . "require/web-modules.php";

//page actiti
$Dcchargename = FETCH("SELECT * FROM deliverycharges where deliverychargesid='1'", "Dcchargename");
$dccartamount = FETCH("SELECT * FROM deliverycharges where deliverychargesid='1'", "dccartamount");
$dcchargeamount = FETCH("SELECT * FROM deliverycharges where deliverychargesid='1'", "dcchargeamount");

//OrderReferenceid
$_SESSION['OrderReferenceid'] = date("d/m/y/") . rand(000000, 99999999);
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
  <style>
    table tr td,
    table tr td h5 {
      font-size: 0.8rem !important;
    }
  </style>
</head>

<body>
  <?php if (DEVICE_TYPE == "Computer") { ?>
    <?php include $AccessLevel . "include/web/header.php"; ?>
    <section class="container section">
      <div class="row">
        <div class="col-md-12 header-bg mt-3">
          <div class="flex-s-b checkout-process">
            <a href="<?php echo WEB_URL; ?>/cart/" class="active">
              <span class="count">1</span>
              <span>Shopping Cart</span>
            </a>
            <a href="#">
              <span class="count">2</span>
              <span>Shipping</span>
            </a>
            <a href="#">
              <span class="count">3</span>
              <span>Billing</span>
            </a>
            <a href="#">
              <span class="count">4</span>
              <span>Review</span>
            </a>
          </div>
        </div>
      </div>
    </section>
    <br>
    <section class="container section">
      <div class="row">
        <div class="col-md-12">
          <?php
          if (isset($_SESSION['LOGIN_CustomerId'])) {
            $LOGIN_CustomerId = $_SESSION['LOGIN_CustomerId'];
            $CartItems = FetchConvertIntoArray("SELECT * FROM cartitems, products, pro_categories, pro_sub_categories where products.ProductCategoryId=pro_categories.ProCategoriesId and products.ProductSubCategoryId=pro_sub_categories.ProSubCategoriesId and cartitems.CartProductId=products.ProductId and cartitems.CartCustomerId='$LOGIN_CustomerId'", true);
          } else {
            $CartItems = FetchConvertIntoArray("SELECT * FROM cartitems, products, pro_categories, pro_sub_categories where products.ProductCategoryId=pro_categories.ProCategoriesId and products.ProductSubCategoryId=pro_sub_categories.ProSubCategoriesId and cartitems.CartProductId=products.ProductId and cartitems.CartProductId=products.ProductId and cartitems.CartDeviceInfo='" . IP_ADDRESS . "'", true);
          }
          if ($CartItems ==  null) {
            NoCartItems("Empty Shopping Cart!");
          } else { ?>

            <table class="table table-striped cart-table">
              <?php
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
                <tr>
                  <td>
                    <span class="cart-sno"><?php echo $CartItemsCount; ?></span>
                  </td>
                  <td style="width:10%;">
                    <a href="<?php echo DOMAIN; ?>/web/products/details/?view=<?php echo SECURE($CartProducts->ProductId, "e"); ?>">
                      <img src="<?php echo STORAGE_URL; ?>/products/pro-img/<?php echo $CartProducts->ProductImage; ?>" alt="<?php echo $CartProducts->ProductName; ?>" title="<?php echo $CartProducts->ProductName; ?>" class="w-100 cart-item-image">
                    </a>
                  </td>
                  <td>
                    <h5><b><?php echo $CartProducts->ProductName; ?></b></h5>
                    <p class="fs-14">
                      <span><?php echo $CartProducts->ProCategoryName; ?></span>
                      <span><?php echo $CartProducts->CartProductWeight; ?></span><br>
                      <span><?php echo SECURE($CartProducts->CartItemDescriptions, "d"); ?></span>
                    </p>
                  </td>
                  <td>
                    <span class="text-black">Rs.<?php echo $CartProducts->CartProductSellPrice; ?> </span>
                  </td>
                  <td>
                    <form action="../../controller/ordercontroller.php" method="POST" class="add-to-cart-options">
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
                    <span>
                      <span>Rs.<?php echo $CartProducts->CartFinalPrice; ?></span>
                    </span>
                  </td>
                  <td>
                    <span>+ Rs.<?php echo  round((int)$CartProducts->CartFinalPrice / 100 * (int)$CartProducts->ProductApplicableTaxes); ?></span><br>
                    <span>GST <?php echo $CartProducts->ProductApplicableTaxes; ?> % </span>
                  </td>
                  <td>
                    <span>
                      <b>Rs.<?php echo (int)$CartProducts->CartFinalPrice + round((int)$CartProducts->CartFinalPrice / 100 * (int)$CartProducts->ProductApplicableTaxes); ?></b>
                    </span>
                  </td>
                  <td>
                    <a onmouseover="Display()" href="<?php echo DOMAIN; ?>/controller/ordercontroller.php?deleteid=<?php echo SECURE($CartProducts->CartItemsid, 'e'); ?>&access_url=<?php echo SECURE(GET_URL(), "e"); ?>" class="btn btn-sm btn-danger text-center"><i class="fa fa-times text-white"></i></a>
                  </td>
                </tr>
              <?php }
              $CartItemTotalAmount = $CartItemNetPayableAmount;
              if ($CartItemTotalAmount < $dccartamount) {
                $CartItemNetPayableAmount = (int)$CartItemTotalAmount + (int)$dcchargeamount;
              } elseif ($CartItemTotalAmount > $dccartamount) {
                $CartItemNetPayableAmount = $CartItemTotalAmount;
              } else {
                $CartItemNetPayableAmount = $CartItemTotalAmount;
              }
              ?>
            </table>
        </div>
      </div>

      <div class="row">
        <div class="col-md-12 header-bg text-right">
          <table class="table table-striped text-right">
            <tr align="right">
              <td align="right" class="">
                <span class="cart-details">Cart Total : </span>
                <span class="cart-price"><b>Rs.<?php echo $CartItemTotalAmount; ?></b></span>
              </td>
            </tr>
            <tr align="right">
              <td align="right" class="">
                <span class="cart-details"><?php echo $Dcchargename; ?> : </span>
                <span class="cart-price"><?php echo ChargesCartAmount($dccartamount, $dcchargeamount, $CartTotalCartProductSellPrice); ?></span>
              </td>
            </tr>
            <?php
            if (isset($_GET['coupon_remove'])) {
              unset($_SESSION['COUPON_MODE']);
              unset($_SESSION['COUPON_CODE']);
              unset($_SESSION['COUPON_CODE_DETAILS']);
              unset($_SESSION['COUPON_DISCOUNT_AMOUNT']);
              unset($_SESSION['FINAL_CHECKOUT_AMOUNT']);
            }
            if (isset($_POST['CheckCoupon'])) {
              $SubmittedCoupon = strtoupper($_POST['CouponCode']);
              $CheckAvailability = CHECK("SELECT * from offers where OfferCouponCode='$SubmittedCoupon'");

              if ($CheckAvailability == null) {
                $_SESSION['COUPON_MODE'] = false;
                $_SESSION['COUPON_CODE'] = null;
                $_SESSION['COUPON_CODE_DETAILS'] = null;
                $_SESSION['COUPON_DISCOUNT_AMOUNT'] = 0;
                $_SESSION['FINAL_CHECKOUT_AMOUNT'] = $CartItemNetPayableAmount;
                $CartItemNetPayableAmount = $CartItemNetPayableAmount;

                $Class = "text-danger";
                $Text = "<i class='fa fa-warning'></i> Entered Coupon Code is Invalid! (<code>$SubmittedCoupon</code>).
                Please Try Again!. <a href='' class='btn btn-sm app-btn'>Try Again</a>";
                $DiscountedAmount = 0;
              } else {
                $Class = "text-success";
                $OfferDiscountType = FETCH("SELECT * from offers where OfferCouponCode='$SubmittedCoupon'", "OfferDiscountType");
                $OfferDiscountValue = FETCH("SELECT * from offers where OfferCouponCode='$SubmittedCoupon'", "OfferDiscountValue");

                if ($OfferDiscountType == "Percentage") {
                  $DiscountedAmount = round((FinalCartAmount() * $OfferDiscountValue) / 100);
                } else {
                  $DiscountedAmount = $OfferDiscountValue;
                }

                //order detaisl with coupons
                $_SESSION['COUPON_MODE'] = true;
                $_SESSION['COUPON_CODE'] = $SubmittedCoupon;
                $_SESSION['COUPON_CODE_DETAILS'] = "Coupon Code : <code>$SubmittedCoupon</code> <br> Discounted Amount : Rs." . $DiscountedAmount;
                $_SESSION['COUPON_DISCOUNT_AMOUNT'] = $DiscountedAmount;
                $_SESSION['FINAL_CHECKOUT_AMOUNT'] = $CartItemNetPayableAmount - $DiscountedAmount;
                $CartItemNetPayableAmount = $CartItemNetPayableAmount - $DiscountedAmount;

                $Text = "Congratulation <i class='text-success fa fa-check-circle-o'></i>. You Save Rs." . $DiscountedAmount . " On this Purchase by using Coupon Code <code class='code'>$SubmittedCoupon</code>.
                  <a href='?coupon_remove=true' class='btn btn-sm app-btn'> Remove <i class='fa fa-times'></i></a>";
              }
            }
            if (isset($_SESSION['COUPON_MODE']) == false) {
              $Class = "hidden";
              $Text = ""; ?>
              <tr align="right">
                <td align="right" class="flex-end">
                  <span class="cart-details mr-2 <?php echo $Class; ?>"><?php echo $Text; ?></span>
                </td>
              </tr>
            <?php
              unset($_SESSION['COUPON_MODE']);
              unset($_SESSION['COUPON_CODE']);
              unset($_SESSION['COUPON_CODE_DETAILS']);
              unset($_SESSION['COUPON_DISCOUNT_AMOUNT']);
              unset($_SESSION['FINAL_CHECKOUT_AMOUNT']);
            } ?>
            <?php if (isset($_SESSION['COUPON_MODE']) == true) { ?>
              <tr align="right">
                <td align="right" class="">
                  <span class="cart-details net-price">Coupon Applied (<?php echo $SubmittedCoupon; ?>) :</span>
                  <span class="cart-price net-price">- Rs.<?php echo $DiscountedAmount; ?></span>
                </td>
              </tr>
              <tr align="right">
                <td align="right" class="">
                  <span class="cart-details net-price">Order Amount :</span>
                  <span class="cart-price net-price">Rs.<?php echo $CartItemNetPayableAmount; ?></span>
                </td>
              </tr>
              <tr align="right">
                <td align="right" class="">
                  <span class="cart-details text-success net-price">Net Payable Amount :</span>
                  <span class="cart-price text-success net-price">Rs.<?php echo $CartItemNetPayableAmount; ?></span>
                </td>
              </tr>
              <tr align="right">
                <td align="right" class="flex-end">
                  <span class="cart-details mr-2 <?php echo $Class; ?>"><?php echo $Text; ?></span>
                </td>
              </tr>
            <?php } else {
              $_SESSION['COUPON_MODE'] = null;
              $_SESSION['COUPON_CODE'] = null;
              $_SESSION['COUPON_CODE_DETAILS'] = null;
              $_SESSION['COUPON_DISCOUNT_AMOUNT'] = 0;
              $_SESSION['FINAL_CHECKOUT_AMOUNT'] = $CartItemNetPayableAmount;
              $CartItemNetPayableAmount = $CartItemNetPayableAmount;  ?>
              <tr align="right">
                <td align="right" class="">
                  <span class="cart-details text-success net-price">Net Payable :</span>
                  <span class="cart-price text-success net-price">Rs.<?php echo $CartItemNetPayableAmount; ?></span>
                </td>
              </tr>
              <tr align="right">
                <td align="right" class="flex-end">
                  <span class="cart-details mr-2 p-1">Enter Coupon/Offer Code :</span>
                  <span class="cart-price">
                    <form action="" method="POST">
                      <input type="text" name="CouponCode" class="form-control-2 text-uppercase" placeholder="Enter Coupon Code">
                      <button name="CheckCoupon" value="true" class="btn btn-sm btn-success">Check</button>
                    </form>
                  </span>
                </td>
              </tr>
            <?php } ?>
          </table>
        </div>
        <div class="col-md-12 text-right p-t-10">
          <?php if (isset($_SESSION['LOGIN_CustomerId'])) { ?>
            <form class="form bg-white" action="../../controller/ordercontroller.php" method="POST">
              <?php FormPrimaryInputs(true); ?>
              <input type="text" name="NetPayableAmount" value="<?php echo $CartItemNetPayableAmount - $DiscountedAmount; ?>" hidden="">
              <input type="text" name="TotalcartAmount" value="<?php echo $CartItemTotalAmount; ?>" hidden="">
              <input type="text" name="chargename" value="<?php echo $Dcchargename; ?>" hidden="">
              <input type="text" name="TotalTaxAmount" value="<?php echo $CartItemTaxAmount; ?>" hidden="">
              <input type="text" name="DeliveryCharges" value="<?php echo ChargesCartAmount($dccartamount, $dcchargeamount, $CartItemNetPayableAmount); ?>" hidden="">
              <button class="btn btn-lg btn-primary" name="checkoutbutton">Checkout</button>
            </form>
          <?php } else { ?>
            <a href="<?php echo DOMAIN; ?>/auth/web/login/?return=<?php echo SECURE(RUNNING_URL, "e"); ?>" class="btn btn-lg btn-success text-white"> Login to Checkout <i class="fa fa-sign-in text-white"></i></a>
          <?php } ?>
        </div>
      <?php } ?>
      </div>
    </section>

    <br><br><br>

    <?php include $AccessLevel . "include/web/footer.php"; ?>
    <?php include $AccessLevel . "include/web/footer_files.php"; ?>
  <?php } else { ?>
    <div class='fixed-top'>
      <section class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="flex-start">
              <a href="<?php echo WEB_URL; ?>" class="btn btn-lg mr-3 bold h3 mt-1 back-btn"><i class="fa fa-angle-left"></i></a>
              <div class="page-title">
                <h5>Shopping Cart</h5>
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
                        <span class="w-75">
                          <span>Rs.<?php echo $CartProducts->CartProductSellPrice; ?></span>
                          <span class="text-secondary">x <?php echo $CartProducts->CartProductQty; ?></span><br>
                          <hr class="mb-1">
                          <span class="h5 bold">Rs.<?php echo $CartProducts->CartProductSellPrice * $CartProducts->CartProductQty; ?></span>
                        </span>
                        <span>
                          <form action="../../controller/ordercontroller.php" method="POST" style='margin-top:-3.5rem !important;' class="pull-right">
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
                                  <option value="<?php echo $StartValue; ?>" <?php echo $selected; ?>>x <?php echo $StartValue; ?></option>
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
            $DeliveryChargeNetAmount = $dcchargeamount;
            $CartItemNetPayableAmount = (int)$CartItemTotalAmount + (int)$dcchargeamount;
          } elseif ($CartItemTotalAmount > $dccartamount) {
            $DeliveryChargeAmount = "Free Delivery";
            $DeliveryChargeNetAmount = 0;
            $CartItemNetPayableAmount = $CartItemTotalAmount;
          } else {
            $DeliveryChargeAmount = "Free Delivery";
            $DeliveryChargeNetAmount = 0;
            $CartItemNetPayableAmount = $CartItemTotalAmount;
          }
          ?>
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
              if (isset($_GET['coupon_remove'])) {
                unset($_SESSION['COUPON_MODE']);
                unset($_SESSION['COUPON_CODE']);
                unset($_SESSION['COUPON_CODE_DETAILS']);
                unset($_SESSION['COUPON_DISCOUNT_AMOUNT']);
                unset($_SESSION['FINAL_CHECKOUT_AMOUNT']);
              }
              if (isset($_POST['CheckCoupon'])) {
                $SubmittedCoupon = strtoupper($_POST['CouponCode']);
                $CheckAvailability = CHECK("SELECT * from offers where OfferCouponCode='$SubmittedCoupon'");

                if ($CheckAvailability == null) {
                  $_SESSION['COUPON_MODE'] = false;
                  $Class = "text-danger";
                  $Text = "
                  <span class='fs-10'><i class='fa fa-warning'></i> Invalid Coupon Code! (<code>$SubmittedCoupon</code>).
                Please Try Again!.</span>
                  <br> <a href='' class='btn btn-xs app-btn'>Try Again</a>";
                  $DiscountedAmount = 0;
                } else {
                  $Class = "text-success";
                  $OfferDiscountType = FETCH("SELECT * from offers where OfferCouponCode='$SubmittedCoupon'", "OfferDiscountType");
                  $OfferDiscountValue = FETCH("SELECT * from offers where OfferCouponCode='$SubmittedCoupon'", "OfferDiscountValue");

                  if ($OfferDiscountType == "Percentage") {
                    $DiscountedAmount = round((FinalCartAmount() * $OfferDiscountValue) / 100);
                  } else {
                    $DiscountedAmount = $OfferDiscountValue;
                  }

                  //order detaisl with coupons
                  $_SESSION['COUPON_MODE'] = true;
                  $_SESSION['COUPON_CODE'] = $SubmittedCoupon;
                  $_SESSION['COUPON_CODE_DETAILS'] = "Coupon Code : <code>$SubmittedCoupon</code> <br> Discounted Amount : Rs." . $DiscountedAmount;
                  $_SESSION['COUPON_DISCOUNT_AMOUNT'] = $DiscountedAmount;
                  $_SESSION['FINAL_CHECKOUT_AMOUNT'] = $CartItemNetPayableAmount - $DiscountedAmount;
                  $CartItemNetPayableAmount = $CartItemNetPayableAmount - $DiscountedAmount;

                  $Text = "Congratulation <i class='text-success fa fa-check-circle-o'></i>. You Save Rs." . $DiscountedAmount . " On this Order by using Coupon Code <code class='code'>$SubmittedCoupon</code>.
                <a href='?coupon_remove=true' class='btn btn-xs app-btn'> Remove Coupon <i class='fa fa-times'></i></a>";
                }  ?>
                <?php if (isset($_SESSION['COUPON_MODE']) == true) { ?>
                  <tr align="right">
                    <td class="h6 text-secondary text-left">Order Amount</td>
                    <td align="right" class="">
                      <span class="cart-price net-price">Rs.<?php echo $CartItemNetPayableAmount; ?></span>
                    </td>
                  </tr>
                  <tr align="right">
                    <td class="h6 text-secondary text-left">Coupon Applied (<?php echo $SubmittedCoupon; ?>)</td>
                    <td align="right" class="">
                      <span class="cart-price net-price">- Rs.<?php echo $DiscountedAmount; ?></span>
                    </td>
                  </tr>
                <?php } ?>
                <tr align="right">
                  <td class="h5 text-secondary text-left"><b>Net Payable Amount :</b></td>
                  <td align="right" class="">
                    <span class="text-right bold text-success h5"><b>Rs.<?php echo $CartItemNetPayableAmount; ?></b></span>
                  </td>
                </tr>
                <tr align="right">
                  <td align="center" colspan="2" class="flex-end">
                    <span class="cart-details mr-2 <?php echo $Class; ?>"><?php echo $Text; ?></span>
                  </td>
                </tr>
              <?php } else {
                $DiscountedAmount = 0;
                $_SESSION['COUPON_MODE'] = null;
                $_SESSION['COUPON_CODE'] = null;
                $_SESSION['COUPON_CODE_DETAILS'] = null;
                $_SESSION['COUPON_DISCOUNT_AMOUNT'] = $DiscountedAmount;
                $_SESSION['FINAL_CHECKOUT_AMOUNT'] = $CartItemNetPayableAmount; ?>
                <tr align="right">
                  <td class="text-left h6 text-secondary w-50">
                    <input type="text" name="CouponCode" class="form-control form-control-sm text-uppercase" placeholder="Enter Coupon Code">
                  </td>
                  <td align="right" class="flex-end w-50">
                    <span class="cart-price">
                      <button name="CheckCoupon" value="true" class="btn btn-sm btn-success">Apply Coupon</button>
                    </span>
                  </td>
                </tr>
              <?php } ?>
              <tr>
                <td class="h5 text-secondary text-left"><b>Net Payable Amount :</b></td>
                <th class="text-right bold text-success h5">Rs.<?php echo $CartItemNetPayableAmount; ?></th>
              </tr>
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
                    $SHIPPING_ADDRESS = "";
                    foreach ($FetchAllAddress as $Address) {
                      $SHIPPING_ADDRESS .= $Address->CustomerAddressStreetAddress . " ";
                      $SHIPPING_ADDRESS .= $Address->CustomerAddressArea . " ";
                      $SHIPPING_ADDRESS .= $Address->CustomerAddressCity . " ";
                      $SHIPPING_ADDRESS .= $Address->CustomerAddressState . " ";
                      $SHIPPING_ADDRESS .= $Address->CustomerAddressCountry . " ";
                      $SHIPPING_ADDRESS .= $Address->CustomerAddressPincode . " "; ?>
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
          <a href="?pay_mode=true" class="btn btn-md m-1 btn-info text-white mt-2">Pay Mode: <?php echo $payMode; ?><i class="fa fa-check btn btn-sm text-white"></i></a>
        <?php }
          if (isset($_GET['pay_mode'])) { ?>
          <div class="col-md-12 mb-0">
            <hr>
            <h6 class="text-center bold">Select Payment Method</h6>
            <div class="flex-s-b">
              <div class="w-50">
                <a href="?pay_method=ONLINE" class="btn btn-block btn-md shadow-sm text-info"><i class='fa fa-globe app-text'></i> Pay Online</a>
              </div>
              <div class="w-50 ml-2">
                <a href="?pay_method=PAY_ON_DELIVERY" class="btn btn-block btn-md shadow-sm text-success"><i class='fa fa-money app-text'></i> Pay on Delivery</a>
              </div>
            </div>
            <hr>
          </div>
        <?php } ?>
        <div class="col-md-12 bg-white">
          <div class="flex-s-b p-2">
            <div class="w-25 text-left">
              <p class="text-secondary small mb-0">Net Payable</p>
              <h4 class="bold mt-0">Rs.<?php echo $CartItemNetPayableAmount; ?></h4>
            </div>
            <div class="w-75 text-right">
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
              if (isset($_SESSION['pay_method'])) {
                $_SESSION['TOTAL_CART_AMOUNT'] = $CartItemTotalAmount;
                $_SESSION['LOGIN_CustomerId'] = LOGIN_CustomerId;
                $_SESSION['DELIVERY_CHARGES'] = $DeliveryChargeNetAmount;
                $_SESSION['NET_PAYABLE_AMOUNT'] = $CartItemNetPayableAmount;
                $_SESSION['BILLING_ADDRESS'] = SECURE($SHIPPING_ADDRESS, "e");
                $_SESSION['SHIPPING_ADDRESS'] = SECURE($SHIPPING_ADDRESS, "e");
                $_SESSION['DELIVERY_CHARGES_NAME'] = $Dcchargename;
                $_SESSION['FINAL_CHECKOUT_AMOUNT'] = $CartItemNetPayableAmount;
              ?>
                <div class="w-100 text-right">
                  <a href="../checkout/payment/" class='btn btn-success m-1 btn-md mt-2 text-white'>Review Order</a>
                </div>
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
  <?php } ?>
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
<?php
  } ?>
</body>

</html>