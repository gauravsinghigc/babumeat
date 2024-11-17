<?php
//function for cart item counts
function CartItems()
{
  if (isset($_SESSION['LOGIN_CustomerId'])) {
    $LOGIN_CustomerId = $_SESSION['LOGIN_CustomerId'];
    $CheckCartItems = TOTAL("SELECT * FROM cartitems where CartCustomerId='$LOGIN_CustomerId'");
  } else {
    $CheckCartItems = TOTAL("SELECT * FROM cartitems where CartDeviceInfo='" . IP_ADDRESS . "'");
  }
  if ($CheckCartItems == 0) {
    return 0;
  } else {
    return $CheckCartItems;
  }
}

//no data found View
function NoCartItems($title)
{ ?>
  <div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
      <div class="shadow-lg br10">
        <div class="flex-s-b">
          <div class="img-section">
            <img src="<?php echo STORAGE_URL_D; ?>/tool-img/cart.gif" class="w-100">
          </div>
          <div class="item-details p-1">
            <p class="lh-1-2">
              <span class="fs-15 bold"><?php echo $title; ?></span><br>
              <span class="fs-13 text-grey">
                No Items found in the cart. Add some items in the cart.
              </span>
            </p>
            <a href="<?php echo DOMAIN; ?>/web/" class="btn btn-md btn-primary">Visit Store</a>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php }


//product price in cart
function TotalCartPrice()
{
  if (isset($_SESSION['LOGIN_CustomerId'])) {
    $LOGIN_CustomerId = $_SESSION['LOGIN_CustomerId'];
    $CheckCartItems = SELECT("SELECT * FROM cartitems where CartCustomerId='$LOGIN_CustomerId' and CartDeviceInfo='" . IP_ADDRESS . "'");
  } else {
    $CheckCartItems = SELECT("SELECT * FROM cartitems where CartDeviceInfo='" . IP_ADDRESS . "'");
  }
  $CartFinalPrice = 0;
  while ($fetchcarts = mysqli_fetch_array($CheckCartItems)) {
    $CartFinalPrice += (int)$fetchcarts['CartFinalPrice'];
  }

  if ($CartFinalPrice == 0) {
    return 0;
  } else {
    return $CartFinalPrice;
  }
}

//cart charges amount
function ChargesCartAmount($dccartamount, $dcchargeamount, $NetOrderAmount)
{
  if ($NetOrderAmount < $dccartamount) {
    $TotalCartPrice = "+ Rs." . (int)$dcchargeamount;
  } else {
    $TotalCartPrice = "Free";
  }
  return $TotalCartPrice;
}

//final order amount or net payable amount 
function FinalCartAmount()
{
  global $dccartamount;
  global $dcchargeamount;
  global $CartItemTotalAmount;
  global $CartItemNetPayableAmount;
  global $CartTotalCartProductSellPrice;

  if (ChargesCartAmount($dccartamount, $dcchargeamount, $CartTotalCartProductSellPrice) == "Free") {
    $TotalCartPrice =  (int)$CartItemNetPayableAmount;
  } else {
    $TotalCartPrice = (int)$CartItemNetPayableAmount + (int)$dcchargeamount;
  }

  return $TotalCartPrice;
}

//charge finction
function ChargeDisplay($checkcharge, $compare)
{
  if ($_SESSION["$checkcharge"] == "$compare") {
    echo "Free";
  } else {
    echo "Rs." . $_SESSION["$checkcharge"];
  }
}
