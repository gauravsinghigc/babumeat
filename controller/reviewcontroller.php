<?php
//require files
require '../require/modules.php';
require '../require/admin/sessionvariables.php';

//access_url 
if (isset($_REQUEST['access_url']) == null) {
  echo "<h1>ERROR</h1>
 <p>Invalid OUTPUT request is received!</p>
 <a href='../index.php'>Back to Root</a>";
  die();
} else {
  $access_url = $_REQUEST['access_url'];
}

//create new reviews
if (isset($_POST['CreateReviews']) || isset($_POST['SubmitProductReview'])) {
  $ReviewedProductid = $_POST['ReviewedProductid'];
  $ReviewTitle = POST("ReviewTitle");
  $ReviewDescriptions = POST("ReviewDescriptions");
  $ReviewStarCount = POST("ReviewStarCount");
  $ReviewProfileImage = UPLOAD_FILES("../storage/reviews", "ReviewProfileImage", "$ReviewTitle", "$ReviewStarCount", "ReviewProfileImage");
  $ReviewCreatedAt = date("Y-m-d H:i:s");
  $ReviewStatus = POST("ReviewStatus");
  $ReviewedCustomerId = POST("ReviewedCustomerId");

  $Save = SAVE("reviews", ["ReviewedProductid", "ReviewTitle", "ReviewDescriptions", "ReviewStarCount", "ReviewProfileImage", "ReviewCreatedAt", "ReviewStatus", "ReviewedCustomerId"]);
  RESPONSE($Save, "New Reviews is Saved Successfully!", "Unable to Created new reviews");

  //else if delete reviews
} elseif (isset($_GET['delete_reviews_records'])) {
  $access_url = SECURE($_GET['access_url'], "d");
  $delete_reviews_records = SECURE($_GET['delete_reviews_records'], "d");

  if ($delete_reviews_records == true) {
    $ReviewsId  = SECURE($_GET['control_id'], "d");
    $Delete = DELETE_FROM("reviews", "ReviewsId='$ReviewsId'");
    RESPONSE($Delete, "Reviews is Deleted Successfully!", "Unable to Delete Reviews");
  } else {
    RESPONSE(false, "Invalid Request!", "Unable to Delete Reviews");
  }
}
RESPONSE(false, "", "Unknown Request of access is receive!");
