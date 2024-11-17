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

//create offers
if (isset($_POST['CreateOffers'])) {
  $OffersName = $_POST['OffersName'];
  $OfferCouponCode = $_POST['OfferCouponCode'];
  $OfferDiscountType = $_POST['OfferDiscountType'];
  $OfferCouponCode = strtoupper($OfferCouponCode);
  $OfferDiscountValue = $_POST['OfferDiscountValue'];
  $OfferImage = UPLOAD_FILES("../storage/offers/", "OfferImage", "$OfferCouponCode", "$OfferDiscountType", "OfferImage");
  $OfferDescriptions = POST("OfferDescriptions");
  $OfferCreatedAt = date("Y-m-d H:i:s");
  $OfferStatus = 0;

  $Save = SAVE("offers", ["OffersName", "OfferCouponCode", "OfferDiscountType", "OfferDiscountValue", "OfferImage", "OfferDescriptions", "OfferCreatedAt", "OfferStatus"]);
  RESPONSE($Save, "New Offer created successfully!", "Unable to create new offer!");

  //delete offers 
} else if (isset($_GET['delete_offers_records'])) {
  $access_url = SECURE($_GET['access_url'], "d");
  $delete_offers_records = SECURE($_GET['delete_offers_records'], "d");

  if ($delete_offers_records == true) {
    $OffersId = SECURE($_GET['control_id'], "d");
    $delete = DELETE_FROM("offers", "OffersId='$OffersId'");
    RESPONSE($delete, "Offer is deleted successfully!", "Unable to delete offer!");
  } else {
    RESPONSE(false, "Offer delete query is completed", "Unable to delete offer at the moment!");
  }

  //update offers 
} elseif (isset($_POST['UpdateOffers'])) {
  $OffersId = SECURE($_POST['UpdateOffers'], "d");
  $OffersName = $_POST['OffersName'];
  $OfferCouponCode = $_POST['OfferCouponCode'];
  $OfferDiscountType = $_POST['OfferDiscountType'];
  $OfferCouponCode = strtoupper($OfferCouponCode);
  $OfferDiscountValue = $_POST['OfferDiscountValue'];
  $OfferDescriptions = POST("OfferDescriptions");
  $OfferUpdatedAt = date("Y-m-d H:i:s");
  $OfferStatus = $_POST['OfferStatus'];

  if ($_FILES['OfferImage']['name'] == "" || $_FILES['OfferImage']['name'] == " " || $_FILES['OfferImage']['name'] == null || $_FILES['OfferImage']['name'] == "null") {
    $Update = UPDATE_TABLE("offers", ["OffersName", "OfferCouponCode", "OfferDiscountType", "OfferDiscountValue", "OfferDescriptions", "OfferUpdatedAt", "OfferStatus"], "OffersId='$OffersId'");
  } else {
    $OfferImage = UPLOAD_FILES("../storage/offers/", "OfferImage2", "$OfferCouponCode", "$OfferDiscountType", "OfferImage");
    $Update = UPDATE_TABLE("offers", ["OffersName", "OfferCouponCode", "OfferDiscountType", "OfferDiscountValue", "OfferImage", "OfferDescriptions", "OfferUpdatedAt", "OfferStatus"], "OffersId='$OffersId'");
  }

  $OfferStatus = 0;
  $Update = UPDATE_TABLE("offers", ["OfferStatus"], "OffersId!='$OffersId'");

  RESPONSE($Update, "Offer is updated successfully!", "Unable to update offer!");
}

RESPONSE(false, "", "Unknown Request of access is receive!");
