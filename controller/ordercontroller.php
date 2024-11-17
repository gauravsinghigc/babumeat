<?php

//require files
require '../require/modules.php';

//access_url
if (isset($_REQUEST['access_url']) == null) {
  echo "<h1>ERROR</h1>
 <p>Invalid OUTPUT request is received!</p>
 <a href='../index.php'>Back to Root</a>";
  die();
} else {
  $access_url = $_REQUEST['access_url'];
}

//save item into cart
if (isset($_POST['AddItemsToCart'])) {
  $CartProductId = SECURE($_POST['CartProductId'], "d");
  $CartProductSellPrice = $_POST['CartProductSellPrice'];
  $CartProductMrpPrice = $_POST['CartProductMrpPrice'];
  $CartProductWeight = $_POST['CartProductWeight'];
  $CartProductQty = $_POST['CartProductQty'];
  $CartDeviceInfo = IP_ADDRESS;
  $CartCreatedAt = date("Y-m-d");
  $CartFinalPrice = (int)$_POST['CartFinalPrice'] * (int)$CartProductQty;
  $CartItemDescriptions = SECURE($_POST['CartItemDescriptions'], "e");

  //if customer is login
  if (isset($_SESSION['LOGIN_CustomerId'])) {
    $CartCustomerId = $_SESSION['LOGIN_CustomerId'];
    //if customer is not login
  } else {
    $CartCustomerId = 0;
  }

  //save item into cart
  $CheckIfItemsExits = CHECK("SELECT * FROM cartitems where CartDeviceInfo='$CartDeviceInfo' and CartCustomerId='$CartCustomerId' and CartProductId='$CartProductId'");
  if ($CheckIfItemsExits == true) {
    LOCATION("warning", "Item Already Exits", $access_url);
  } else {
    $SaveCartItems = SAVE("cartitems", ["CartFinalPrice", "CartProductId", "CartProductSellPrice", "CartProductMrpPrice", "CartProductWeight", "CartProductQty", "CartCustomerId", "CartDeviceInfo", "CartCreatedAt", "CartItemDescriptions"]);
    RESPONSE($SaveCartItems, "Item Save into Cart Successfully!", "Unable to Save item into cart!");
  }

  //update cart quantity
} else if (isset($_POST['UpdateCartQuantity'])) {
  if ($_POST['UpdateCartQuantity'] == SECURE("true", "e")) {
    $CartItemsid = $_POST['CartItemsid'];
    $CartProductSellPrice = $_POST['CartProductSellPrice'];
    $CartProductQty = $_POST['CartProductQty'];
    $CartFinalPrice = (int)$CartProductSellPrice * (int)$CartProductQty;

    $save = UPDATE("UPDATE cartitems SET CartProductQty='$CartProductQty', CartFinalPrice='$CartFinalPrice' where CartItemsid='$CartItemsid'");
    RESPONSE($save, "Item quantity updated successfully!", "Unable to update quantity");
  } else {
    LOCATION("warning", "Unable to Update Product Quantity!", $access_url);
  }

  //delete cart
} else if (isset($_GET['deleteid'])) {
  $CartItemsid = SECURE($_GET['deleteid'], "d");
  $access_url  = SECURE($_GET['access_url'], "d");
  $Delete = DELETE("DELETE FROM cartitems where CartItemsid='$CartItemsid'");
  RESPONSE($Delete, "Item Deleted Successfully!", "Unable to delete cart items");

  //excute order from checkout and store value into the session
} elseif (isset($_POST['checkoutbutton'])) {
  $NetPayableAmount = $_POST['NetPayableAmount'];
  $TotalcartAmount = $_POST['TotalcartAmount'];
  $DeliveryCharges = $_POST['DeliveryCharges'];
  $chargename = $_POST['chargename'];

  //capture into session cart
  $_SESSION['NET_PAYABLE_AMOUNT'] = $NetPayableAmount;
  $_SESSION['TOTAL_CART_AMOUNT'] = $TotalcartAmount;
  $_SESSION['DELIVERY_CHARGES'] = $DeliveryCharges;
  $_SESSION['DELIVERY_CHARGES_NAME'] = $chargename;

  //url congrol
  $access_url = DOMAIN . "/web/checkout/";
  LOCATION("unknown", "Continue to checkout", $access_url);

  //save address
} elseif (isset($_POST['SaveAddress'])) {
  $CustomerAddressViewId = $_SESSION['LOGIN_CustomerId'];
  $CustomerAddressContactPerson = $_POST['CustomerAddressContactPerson'];
  $CustomerAddressAltPhone = $_POST['CustomerAddressAltPhone'];
  $CustomerAddressStreetAddress = SECURE($_POST['CustomerAddressStreetAddress'], "e");
  $CustomerAddressArea = $_POST['CustomerAddressArea'];
  $CustomerAddressCity = $_POST['CustomerAddressCity'];
  $CustomerAddressState = $_POST['CustomerAddressState'];
  $CustomerAddressPincode = $_POST['CustomerAddressPincode'];
  $CustomerAddressType = $_POST['CustomerAddressType'];
  $CustomerAddressGSTNo = $_POST['CustomerAddressGSTNo'];
  $CustomerAddressCountry = $_POST['CustomerAddressCountry'];

  $SaveAddress = SAVE("customeraddress", ["CustomerAddressCountry", "CustomerAddressViewId", "CustomerAddressStreetAddress", "CustomerAddressArea", "CustomerAddressCity", "CustomerAddressState", "CustomerAddressPincode", "CustomerAddressType", "CustomerAddressContactPerson", "CustomerAddressAltPhone", "CustomerAddressGSTNo"]);
  RESPONSE($SaveAddress, "Address Details Saved Successfully!", "Unable to save address details");

  //create order
} elseif (isset($_POST['CreateOrder'])) {
  //store common variable
  $_SESSION['PAYMENT_METHOD'] = $_POST['PAYMENT_METHOD'];
  $OrderPaymentMode = $_POST['PAYMENT_METHOD'];
  $OrderCreateDate = date("d M, Y");
  $OrderStatus = 1;
  $OrderPaymentAmount = $_SESSION['TOTAL_CART_AMOUNT'];
  $LOGIN_CustomerId = $_SESSION['LOGIN_CustomerId'];
  $DeliveryCharges = $_SESSION['DELIVERY_CHARGES'];
  $NetPayableAmount = $_SESSION['NET_PAYABLE_AMOUNT'];
  $OrderReferenceid = $_SESSION['OrderReferenceid'];
  $OrderBillingAddress = $_SESSION['BILLING_ADDRESS'];
  $OrderShippingAddress = $_SESSION['SHIPPING_ADDRESS'];
  $PaymentMode = $_POST['PAYMENT_METHOD'];

  //check charges
  $Dcchargename = FETCH("SELECT * FROM deliverycharges where deliverychargesid='1'", "Dcchargename");
  $dccartamount = FETCH("SELECT * FROM deliverycharges where deliverychargesid='1'", "dccartamount");
  $dcchargeamount = FETCH("SELECT * FROM deliverycharges where deliverychargesid='1'", "dcchargeamount");

  if ($OrderPaymentAmount <= $dccartamount) {
    $NetPayableAmount = (int)$OrderPaymentAmount + (int)$dcchargeamount;
  } elseif ($OrderPaymentAmount > $dccartamount) {
    $NetPayableAmount = $OrderPaymentAmount;
  } else {
    $NetPayableAmount = $OrderPaymentAmount;
  }
  $NetPayableAmount = (int)$NetPayableAmount - (int)$_SESSION['COUPON_DISCOUNT_AMOUNT'];
  //coupons details
  $OrderPaymentCoupons = $_SESSION['COUPON_CODE_DETAILS'];

  //customer order id
  $FirstYear = date("Y");
  $LastYear = date("Y", strtotime("+1 Year"));
  $OrderNumber = (int)TOTAL("SELECT * FROM orders") + (int)1;
  $CustomOrderId = "$FirstYear-$LastYear/000$OrderNumber";

  //seprate payment type variables
  if ($PaymentMode == "PAY_ON_DELIVERY") {
    $OrderPaymentName = "Pay On Delivery";
    $OrderPaymentDetails = "Cash";
    $OrderPaymentReferenceId = "Not Available";
    $OrderPaymentStatus = "Un Paid";
    $OrderPaymentDate = "Not Available";

    //create order for cash on delivery
    $CustomerId = $LOGIN_CustomerId;
    $OrderAmount = $_SESSION['TOTAL_CART_AMOUNT'];

    //order created
    $Save = SAVE("orders", ["OrderReferenceid", "OrderBillingAddress", "OrderShippingAddress", "CustomOrderId", "CustomerId", "OrderAmount", "DeliveryCharges", "NetPayableAmount", "OrderPaymentMode", "OrderCreateDate", "OrderStatus"], false);
    $OrderId = FETCH("SELECT * FROM orders where CustomOrderId='$CustomOrderId'", "OrderId");
    $OrderRefId = $OrderId;

    //also store orders status
    $OrderStatusOrderId = $OrderId;
    $OrderStatus = "Order Placed";
    $OrderStatusCreatedAt = date("d M, Y");
    $OrderStatusDescriptions = "Order is Placed at $OrderCreateDate with Payment Mode: $OrderPaymentMode";
    $SaveDetails = SAVE("orderstatus", ["OrderStatusOrderId", "OrderStatus", "OrderStatusCreatedAt", "OrderStatusDescriptions"], false);

    //payment stored
    $SavePaymentDetails = SAVE("order_payments", ["OrderRefId", "OrderPaymentCoupons", "OrderPaymentName", "OrderPaymentAmount", "OrderPaymentMode", "OrderPaymentDetails", "OrderPaymentReferenceId", "OrderPaymentStatus", "OrderPaymentDate"], false);

    //product saved into ordered products
    $CartItems = FetchConvertIntoArray("SELECT * FROM cartitems, products, pro_categories, pro_sub_categories where products.ProductCategoryId=pro_categories.ProCategoriesId and products.ProductSubCategoryId=pro_sub_categories.ProSubCategoriesId and cartitems.CartProductId=products.ProductId and cartitems.CartCustomerId='$LOGIN_CustomerId'", true);
    foreach ($CartItems as $Items) {
      $OrderOrderId = $OrderId;
      $OrderProProductId = $Items->CartProductId;
      $OrderProductName = $Items->ProductName;
      $OrderProductImage = $Items->ProductImage;
      $OrderProductCatName = $Items->ProCategoryName;
      $OrderProductSubCatName = $Items->ProSubCategoryName;
      $OrderProductSellPrice = $Items->CartProductSellPrice;
      $OrderProductMrpPrice = $Items->CartProductMrpPrice;
      $OrderProductQty = $Items->CartProductQty;
      $OrderProductSellAmount = $Items->CartFinalPrice;
      $OrderProductWeight = $Items->CartProductWeight;
      $OrderProductDescription = $Items->ProductDescriptions;
      $ProductRefernceCodes = $Items->ProductRefernceCode;
      $OrderDetails = $Items->CartItemDescriptions;
      $SaveItems = SAVE("ordered_products", ["ProductRefernceCodes", "OrderDetails", "OrderOrderId", "OrderProProductId", "OrderProductName", "OrderProductImage", "OrderProductCatName", "OrderProductSubCatName", "OrderProductSellPrice", "OrderProductMrpPrice", "OrderProductQty", "OrderProductSellAmount", "OrderProductWeight", "OrderProductDescription"], false);
    }

    //delete cart Items
    if ($SaveItems == true) {
      $DeleteItems = DELETE("DELETE from cartitems where CartCustomerId='$LOGIN_CustomerId'");
    }
    if ($DeleteItems == true) {
      $access_url = DOMAIN . "/web/done/";
      unset($_SESSION['TOTAL_CART_AMOUNT']);
      unset($_SESSION['FINAL_CHECKOUT_AMOUNT']);
      unset($_SESSION['COUPON_CODE']);
      unset($_SESSION['COUPON_MODE']);
      unset($_SESSION['COUPON_DISCOUNT_AMOUNT']);
      unset($_SESSION['DELIVERY_CHARGES']);
      unset($_SESSION['DELIVERY_CHARGES_NAME']);
      unset($_SESSION['NET_PAYABLE_AMOUNT']);
      unset($_SESSION['COUPON_CODE_DETAILS']);
    } else {
      $access_url = $access_url;
    }
    $CustomerEmailId = FETCH("SELECT * FROM customers where CustomerId='$CustomerId'", "CustomerEmailid");
    $CustomerName = FETCH("SELECT * FROM customers where CustomerId='$CustomerId'", "CustomerName");
    SENDMAILS("Order Placed #$CustomOrderId", "Dear $CustomerName", "$CustomerEmailId", "Your Order having Invoice No: $CustomOrderId and Order Amount Rs.$NetPayableAmount is placed successfully!<br>
  You can track, view invoice from here:
  <br><br><br>
  <a href='" . DOMAIN . "/web/track/?orderid=" . SECURE($OrderId, "e") . "' style='background-color:black;color:white;padding:0.5rem 1rem;'>Track Order</a>
  <a href='" . DOMAIN . "/web/invoices/?orderid=" . SECURE($OrderId, "e") . "' style='background-color:red;color:white;padding:0.5rem 1rem;'>View Invoice</a><br>

  <br>
  OR visit at<br>" . DOMAIN . "<br>
  <br>
   If your have any query regarding your order, please contact us at:<br>
   <a href='" . DOMAIN . "/web/contact-us/'>Contact Us</a><br><br> or call us at:<br>
   <a href='tel:" . PRIMARY_PHONE . "'>" . PRIMARY_PHONE . "</a>");

    SENDMAILS("Order Received #$CustomOrderId", "Dear, " . APP_NAME, PRIMARY_EMAIL, "Order having Invoice No: $CustomOrderId and Order Amount Rs.$NetPayableAmount is Received!. Details are as follow.<br>
  You can track, view invoice from here:
   <br><br><br>
  <a href='" . DOMAIN . "/web/track/?orderid=" . SECURE($OrderId, "e") . "' style='background-color:black;color:white;padding:0.5rem 1rem;'>Track Order</a>
  <a href='" . DOMAIN . "/web/invoices/?orderid=" . SECURE($OrderId, "e") . "' style='background-color:red;color:white;padding:0.5rem 1rem;'>View Invoice</a><br>

  <br>
  OR visit at<br>" . DOMAIN . "<br>
  <br>
   If your have any query regarding your order, please contact us at:<br>
   <a href='" . DOMAIN . "/web/contact-us/'>Contact Us</a><br><br> or call us at:<br>
   <a href='tel:" . PRIMARY_PHONE . "'>" . PRIMARY_PHONE . "</a>");

    RESPONSE($DeleteItems, "Order Placed Successfully!", "Unable to Process Order at the Moment");

    //online payment check
  } else if ($PaymentMode == "ONLINE") {

    //store variables
    $_SESSION['PAYMENT_METHOD'] = $_POST['PAYMENT_METHOD'];
    $OrderPaymentMode = $_POST['PAYMENT_METHOD'];
    $OrderCreateDate = date("d M, Y");
    $OrderStatus = 1;

    //customer order id
    $FirstYear = date("Y");
    $LastYear = date("Y", strtotime("+1 Year"));
    $OrderNumber = (int)TOTAL("SELECT * FROM orders") + (int)1;
    $CustomOrderId = "$FirstYear-$LastYear/000$OrderNumber";
    $CustomerPhone = FETCH("SELECT * FROM customers where CustomerId='$LOGIN_CustomerId'", "CustomerPhoneNumber");
    $CustomerEmailId = FETCH("SELECT * FROM customers where CustomerId='$LOGIN_CustomerId'", "CustomerEmailid");
    $CustomerName = FETCH("SELECT * FROM customers where CustomerId='$CustomerId'", "CustomerName");

    //createon line session variable for online PAYMENT
    $_SESSION['INITIATE_E_PAY'] = "Active";
    $_SESSION['CUSTOM_ORDER_ID'] = $CustomOrderId;
    $_SESSION['CUSTOMER_NAME'] = $CustomerName;
    $_SESSION['CUSTOMER_PHONE'] = $CustomerPhone;
    $_SESSION['CUSTOMER_EMAIL'] = $CustomerEmailId;
    $OrderPaymentAmount = $_SESSION['TOTAL_CART_AMOUNT'];
    $LOGIN_CustomerId = $_SESSION['LOGIN_CustomerId'];
    $DeliveryCharges = $_SESSION['DELIVERY_CHARGES'];
    $NetPayableAmount = $_SESSION['NET_PAYABLE_AMOUNT'];
    $OrderReferenceid = $_SESSION['OrderReferenceid'];
    $OrderBillingAddress = $_SESSION['BILLING_ADDRESS'];
    $OrderShippingAddress = $_SESSION['SHIPPING_ADDRESS'];

    //check charges
    $Dcchargename = FETCH("SELECT * FROM deliverycharges where deliverychargesid='1'", "Dcchargename");
    $dccartamount = FETCH("SELECT * FROM deliverycharges where deliverychargesid='1'", "dccartamount");
    $dcchargeamount = FETCH("SELECT * FROM deliverycharges where deliverychargesid='1'", "dcchargeamount");

    if ($OrderPaymentAmount <= $dccartamount) {
      $NetPayableAmount = (int)$OrderPaymentAmount + (int)$dcchargeamount;
    } elseif ($OrderPaymentAmount > $dccartamount) {
      $NetPayableAmount = $OrderPaymentAmount;
    } else {
      $NetPayableAmount = $OrderPaymentAmount;
    }
    $NetPayableAmount = (int)$NetPayableAmount - (int)$_SESSION['COUPON_DISCOUNT_AMOUNT'];

    //payment getways options
    if (PG_PROVIDER == "RAZORAPAY") {
      header("location: " . WEB_URL . "/checkout/payment/rzr/");
    } else if (PG_PROVIDER == "PAYTM") {
      header("location: " . WEB_URL . "/checkout/payment/ptm/");
    }
  }
  //save to cart
} elseif (isset($_POST['AddtoCart'])) {
  $CartProductId = $_POST['AddtoCart'];
  $package = $_POST['package'];

  if ($package == "default") {
    $CartProductSellPrice = FETCH("SELECT * FROM products where ProductId='$CartProductId'", "ProductSellPrice");
    $CartProductMrpPrice = FETCH("SELECT * FROM products where ProductId='$CartProductId'", "ProductMrpPrice");
    $CartProductWeight = FETCH("SELECT * FROM products where ProductId='$CartProductId'", "ProductWeight");
  } else {
    $ProductPackageId = SECURE($_POST['package'], "d");
    $CartProductSellPrice = FETCH("SELECT * FROM product_packages where ProductPackageId='$ProductPackageId' and ProductProId='" . $CartProductId . "'", "ProductPackageSellPrice");
    $CartProductMrpPrice = FETCH("SELECT * FROM product_packages where ProductPackageId='$ProductPackageId' and ProductProId='" . $CartProductId . "'", "ProductPackageMrp");
    $CartProductWeight = FETCH("SELECT * FROM product_packages where ProductPackageId='$ProductPackageId' and ProductProId='" . $CartProductId . "'", "ProductPackageName");
  }

  $CartProductQty = $_POST['qty'];
  $CartDeviceInfo = IP_ADDRESS;
  $CartCreatedAt = date("d M, Y");
  $CartFinalPrice = (int)$CartProductSellPrice * (int)$CartProductQty;

  //if customer is login
  if (isset($_SESSION['LOGIN_CustomerId'])) {
    $CartCustomerId = $_SESSION['LOGIN_CustomerId'];
    //if customer is not login
  } else {
    $CartCustomerId = 0;
  }

  //save item into cart
  $CheckIfItemsExits = CHECK("SELECT * FROM cartitems where CartDeviceInfo='$CartDeviceInfo' and CartCustomerId='$CartCustomerId' and CartProductId='$CartProductId'", false);
  if ($CheckIfItemsExits == true) {
    LOCATION("warning", "Item Already Exits", $access_url);
  } else {
    $SaveCartItems = SAVE("cartitems", ["CartFinalPrice", "CartProductId", "CartProductSellPrice", "CartProductMrpPrice", "CartProductWeight", "CartProductQty", "CartCustomerId", "CartDeviceInfo", "CartCreatedAt"], false);
    RESPONSE($SaveCartItems, "Item Save into Cart Successfully!", "Unable to Save item into cart!");
  }

  //update payment detailss
} else if (isset($_POST['updatepayments'])) {
  $OrderPayments = $_POST['OrderPayments'];
  $OrderId = $_SESSION['VIEW_ORDER_ID'];
  $OrderPayments = $_POST['OrderPayments'];
  $OrderPaymentName = $_POST['OrderPaymentName'];
  $OrderPaymentAmount = $_POST['OrderPaymentAmount'];
  $OrderPaymentMode = $_POST['OrderPaymentMode'];
  $OrderPaymentStatus = $_POST['OrderPaymentStatus'];
  $OrderPaymentDate = date("d M, Y", strtotime($_POST['OrderPaymentDate']));
  $OrderPaymentReferenceId = $_POST['OrderPaymentReferenceId'];
  $OrderPaymentDetails = $_POST['OrderPaymentDetails'];
  $OrderUpdateDate = date("d M, Y");

  $updatepayments = UPDATE("UPDATE order_payments SET OrderPaymentName='$OrderPaymentName', OrderPaymentAmount='$OrderPaymentAmount', OrderPaymentMode='$OrderPaymentMode', OrderPaymentDetails='$OrderPaymentDetails', OrderPaymentStatus='$OrderPaymentStatus', OrderPaymentReferenceId='$OrderPaymentReferenceId', OrderPaymentDate='$OrderPaymentDate' where OrderPayments='$OrderPayments'", false);
  $UpdateOrderds = UPDATE("UPDATE orders SET OrderUpdateDate='$OrderUpdateDate' where OrderId='$OrderId'", false);
  RESPONSE($UpdateOrderds, "Order Payment Details are updated Successully!", "Unable to Update Details");

  //update order status
} else if (isset($_GET['updateorder'])) {
  $updateorder = SECURE($_GET['updateorder'], "d");
  $status = (int)$_GET['status'];
  $status = $status++;
  $access_url = SECURE($_GET['access_url'], "d");
  $datetime = date("d M, Y h:m:a A");
  $OrderStatusCreatedAt = $datetime;
  $OrderUpdateDate = date("d M, Y");
  $inv = $_GET['inv'];
  $OrderStatusOrderId = $_SESSION['VIEW_ORDER_ID'];
  $OrderId = $OrderStatusOrderId;

  if ($status == 2) {
    $OrderStatus = "Accepted";
    $OrderStatus2 = 2;
    $OrderStatusDescriptions = "Order Accepted At $datetime having pay mode Cash on Delivery";
  } else if ($status == 3) {
    $OrderStatus = "Shipped";
    $OrderStatus2 = 3;
    $OrderStatusDescriptions = "Your Order having Invoice no: $inv is shipped today at $datetime";
  } else if ($status == 4) {
    $OrderStatus = "Out For Delivery";
    $OrderStatus2 = 4;
    $OrderStatusDescriptions = "Order Having Invoice No: $inv is Out for Delivery at $datetime, it will be at your door soon.";
  } else if ($status == 5) {
    $OrderStatus = "Delivered";
    $OrderStatus2 = 5;
    $OrderStatusDescriptions = "Your Order is Delivered today at $datetime";
  } else if ($status == 6) {
    $OrderStatus = "Cancelled";
    $OrderStatus2 = 6;
    $OrderStatusDescriptions = "Your order is Cancelled by the provider. to know more send your queries at " . PRIMARY_EMAIL;
  } else {
    LOCATION("info", "Order Already Delivered!", $access_url);
  }

  $Save = SAVE("orderstatus", ["OrderStatusOrderId", "OrderStatus", "OrderStatusCreatedAt", "OrderStatusDescriptions"], false);
  $Update = UPDATE("UPDATE orders SET OrderStatus='$OrderStatus2', OrderUpdateDate='$OrderUpdateDate' where OrderId='$updateorder'", false);
  RESPONSE($Update, "Order Status Updated Successfully!", "Unable to Update Order Status");

  //create online payment orders
} else if (isset($_GET['checkpayment'])) {
  $OrderPaymentReferenceId = SECURE("<script>document.write(sessionStorage.getItem('TxnId'))</script>", "e");
  $OrderPaymentName = "Online";
  $OrderPaymentDetails = "Online TxnID";
  $OrderPaymentReferenceId = "$OrderPaymentReferenceId";
  $OrderPaymentStatus = "Paid";
  $OrderPaymentDate = date("d M, Y");
  $OrderCreateDate = date("d M, Y");
  $OrderStatus = 1;
  $OrderPaymentAmount = $_SESSION['TOTAL_CART_AMOUNT'];
  $LOGIN_CustomerId = $_SESSION['LOGIN_CustomerId'];
  $DeliveryCharges = $_SESSION['DELIVERY_CHARGES'];
  $NetPayableAmount = $_SESSION['NET_PAYABLE_AMOUNT'];
  $OrderReferenceid = $_SESSION['OrderReferenceid'];
  $OrderBillingAddress = $_SESSION['BILLING_ADDRESS'];
  $OrderShippingAddress = $_SESSION['SHIPPING_ADDRESS'];
  $OrderPaymentMode = "Online";

  //check charges
  $Dcchargename = FETCH("SELECT * FROM deliverycharges where deliverychargesid='1'", "Dcchargename");
  $dccartamount = FETCH("SELECT * FROM deliverycharges where deliverychargesid='1'", "dccartamount");
  $dcchargeamount = FETCH("SELECT * FROM deliverycharges where deliverychargesid='1'", "dcchargeamount");

  if ($OrderPaymentAmount <= $dccartamount) {
    $NetPayableAmount = (int)$OrderPaymentAmount + (int)$dcchargeamount;
  } elseif ($OrderPaymentAmount > $dccartamount) {
    $NetPayableAmount = $OrderPaymentAmount;
  } else {
    $NetPayableAmount = $OrderPaymentAmount;
  }
  $NetPayableAmount = (int)$NetPayableAmount - (int)$_SESSION['COUPON_DISCOUNT_AMOUNT'];


  //create order for cash on delivery
  $CustomerId = $LOGIN_CustomerId;
  $OrderAmount = $_SESSION['TOTAL_CART_AMOUNT'];
  $CustomOrderId = $_SESSION['CUSTOM_ORDER_ID'];

  //order created
  $Save = SAVE("orders", ["OrderReferenceid", "OrderBillingAddress", "OrderShippingAddress", "CustomOrderId", "CustomerId", "OrderAmount", "DeliveryCharges", "NetPayableAmount", "OrderPaymentMode", "OrderCreateDate", "OrderStatus"], false);
  $OrderId = FETCH("SELECT * FROM orders where CustomOrderId='$CustomOrderId'", "OrderId");
  $OrderRefId = $OrderId;

  //also store orders status
  $OrderStatusOrderId = $OrderId;
  $OrderStatus = "Order Placed";
  $OrderStatusCreatedAt = date("d M, Y");
  $OrderStatusDescriptions = "Order is Placed at $OrderCreateDate with Payment Mode: $OrderPaymentMode";
  $SaveDetails = SAVE("orderstatus", ["OrderStatusOrderId", "OrderStatus", "OrderStatusCreatedAt", "OrderStatusDescriptions"], false);

  //payment stored
  $SavePaymentDetails = SAVE("order_payments", ["OrderRefId", "OrderPaymentName", "OrderPaymentAmount", "OrderPaymentMode", "OrderPaymentDetails", "OrderPaymentReferenceId", "OrderPaymentStatus", "OrderPaymentDate"], false);

  //product saved into ordered products
  $CartItems = FetchConvertIntoArray("SELECT * FROM cartitems, products, pro_categories, pro_sub_categories  where products.ProductCategoryId=pro_categories.ProCategoriesId and products.ProductSubCategoryId=pro_sub_categories.ProSubCategoriesId and cartitems.CartProductId=products.ProductId and cartitems.CartCustomerId='$LOGIN_CustomerId'", true);
  foreach ($CartItems as $Items) {
    $OrderOrderId = $OrderId;
    $OrderProProductId = $Items->CartProductId;
    $OrderProductName = $Items->ProductName;
    $OrderProductImage = $Items->ProductImage;
    $OrderProductCatName = $Items->ProCategoryName;
    $OrderProductSubCatName = $Items->ProSubCategoryName;
    $OrderProductSellPrice = $Items->CartProductSellPrice;
    $OrderProductMrpPrice = $Items->CartProductMrpPrice;
    $OrderProductQty = $Items->CartProductQty;
    $OrderProductSellAmount = $Items->CartFinalPrice;
    $OrderProductWeight = $Items->CartProductWeight;
    $OrderProductDescription = SECURE($Items->ProductDescriptions, "e");
    $ProductRefernceCodes = $Items->ProductRefernceCode;
    $OrderDetails = $Items->CartItemDescriptions;
    $SaveItems = SAVE("ordered_products", ["ProductRefernceCodes", "OrderDetails", "OrderOrderId", "OrderProProductId", "OrderProductName", "OrderProductImage", "OrderProductCatName", "OrderProductSubCatName", "OrderProductSellPrice", "OrderProductMrpPrice", "OrderProductQty", "OrderProductSellAmount", "OrderProductWeight", "OrderProductDescription"], false);
  }

  //delete cart Items
  if ($SaveItems == true) {
    $DeleteItems = DELETE("DELETE from cartitems where CartCustomerId='$LOGIN_CustomerId'", false);
  }
  if ($DeleteItems == true) {
    $access_url = DOMAIN . "/web/done/";
    unset($_SESSION['TOTAL_CART_AMOUNT']);
    unset($_SESSION['FINAL_CHECKOUT_AMOUNT']);
    unset($_SESSION['COUPON_CODE']);
    unset($_SESSION['COUPON_MODE']);
    unset($_SESSION['COUPON_DISCOUNT_AMOUNT']);
    unset($_SESSION['DELIVERY_CHARGES']);
    unset($_SESSION['DELIVERY_CHARGES_NAME']);
    unset($_SESSION['NET_PAYABLE_AMOUNT']);
    unset($_SESSION['COUPON_CODE_DETAILS']);
  } else {
    $access_url = SECURE($access_url, "d");
  }
  $CustomerEmailId = FETCH("SELECT * FROM customers where CustomerId='$CustomerId'", "CustomerEmailid");
  $CustomerName = FETCH("SELECT * FROM customers where CustomerId='$CustomerId'", "CustomerName");
  SENDMAILS("Order Placed #$CustomOrderId", "Dear $CustomerName", "$CustomerEmailId", "Your Order having Invoice No: $CustomOrderId and Order Amount Rs.$NetPayableAmount is placed successfully!<br>
  You can track, view invoice from here:
   <br><br><br>
  <a href='" . DOMAIN . "/web/track/?orderid=" . SECURE($OrderId, "e") . "' style='background-color:black;color:white;padding:0.5rem 1rem;'>Track Order</a>
  <a href='" . DOMAIN . "/web/invoices/?orderid=" . SECURE($OrderId, "e") . "' style='background-color:red;color:white;padding:0.5rem 1rem;'>View Invoice</a><br>

  <br>
  OR visit at<br>" . DOMAIN . "<br>
  <br>
   If your have any query regarding your order, please contact us at:<br>
   <a href='" . DOMAIN . "/web/contact-us/'>Contact Us</a><br><br> or call us at:<br>
   <a href='tel:" . PRIMARY_PHONE . "'>" . PRIMARY_PHONE . "</a>");

  SENDMAILS("Order Received #$CustomOrderId", "Dear, " . APP_NAME, PRIMARY_EMAIL, "Order having Invoice No: $CustomOrderId and Order Amount Rs.$NetPayableAmount is Received!. Details are as follow.<br>
  You can track, view invoice from here:
  <br><br><br>
  <a href='" . DOMAIN . "/web/track/?orderid=" . SECURE($OrderId, "e") . "' style='background-color:black;color:white;padding:0.5rem 1rem;'>Track Order</a>
  <a href='" . DOMAIN . "/web/invoices/?orderid=" . SECURE($OrderId, "e") . "' style='background-color:red;color:white;padding:0.5rem 1rem;'>View Invoice</a><br>

  <br>
  OR visit at<br>" . DOMAIN . "<br>
  <br>
   If your have any query regarding your order, please contact us at:<br>
   <a href='" . DOMAIN . "/web/contact-us/'>Contact Us</a><br><br> or call us at:<br>
   <a href='tel:" . PRIMARY_PHONE . "'>" . PRIMARY_PHONE . "</a>");

  RESPONSE($DeleteItems, "Order Placed Successfully!", "Unable to Process Order at the Moment");
}
