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

//create slider save
if (isset($_POST['SaveSlider'])) {
  $SliderName = $_POST['SliderName'];
  $SliderOfferText = $_POST['SliderOfferText'];
  $SliderType = $_POST['SliderType'];
  $SliderLocations = $_POST['SliderLocations'];
  $SliderOpenAt = $_POST['SliderOpenAt'];
  $SliderTargetUrl = $_POST['SliderTargetUrl'];
  $SliderDescriptions = SECURE($_POST['SliderDescriptions'], "e");
  $SliderImage = UPLOAD_FILES("../storage/sliders", "SliderImage", "$SlilderName" . "$SliderType", "$SliderLocations", "SliderImage");
  $SliderCreatedAt = date("d M, Y");
  $SliderCreatedBy = LOGIN_UserId;
  $SliderStatus = 1;

  $SaveSliders = SAVE("sliders", ["SliderName", "SliderOfferText", "SliderType", "SliderLocations", "SliderOpenAt", "SliderTargetUrl", "SliderDescriptions", "SliderImage", "SliderCreatedAt", "SliderCreatedBy", "SliderStatus"]);
  RESPONSE($SaveSliders, "New Slider $SliderName is created successfully!", "Unable to create new slider!");

  //delete sliders
} else if (isset($_GET['delete_sliders'])) {
  $delete_sliders = SECURE($_GET['delete_sliders'], "d");
  $access_url = SECURE($_GET['access_url'], "d");

  if ($delete_sliders == true) {
    $control_id = SECURE($_GET['control_id'], "d");
    $Delete = DELETE_FROM("sliders", "SliderId='$control_id'");
    RESPONSE($Delete, "Slider is deleted successfully!", "Unable to delete slider!");
  } else {
    LOCATION("warning", "Unable to delete slider!", $access_url);
  }

  //update sliders
} elseif (isset($_POST['UpdateSlider'])) {
  $SliderId = SECURE($_POST['UpdateSlider'], "d");
  $SliderName = $_POST['SliderName'];
  $SliderOfferText = $_POST['SliderOfferText'];
  $SliderType = $_POST['SliderType'];
  $SliderLocations = $_POST['SliderLocations'];
  $SliderOpenAt = $_POST['SliderOpenAt'];
  $SliderTargetUrl = $_POST['SliderTargetUrl'];
  $SliderDescriptions = SECURE($_POST['SliderDescriptions'], "e");
  $SliderUpdatedAt = date("d M, Y");
  $SliderCreatedBy = LOGIN_UserId;
  $SliderStatus = $_POST['SliderStatus'];

  if ($_FILES['SliderImage']['name'] ==  null || $_FILES['SliderImage']['name'] == "null" || $_FILES['SliderImage']['name'] == " " || $_FILES['SliderImage']['name'] == "") {
    $SliderImage = SECURE($_POST['SliderImage_CURRENT'], "d");
  } else {
    $SliderImage = UPLOAD_FILES("../storage/sliders", "SliderImage", "$SlilderName" . "$SliderType", "$SliderLocations", "SliderImage");
  }

  $Update = UPDATE_TABLE("sliders", ["SliderName", "SliderImage", "SliderStatus", "SliderCreatedBy", "SliderUpdatedAt", "SliderTargetUrl", "SliderDescriptions", "SliderOpenAt", "SliderLocations",  "SliderOfferText", "SliderType"], "SliderId='$SliderId'");
  RESPONSE($Update, "Slider is updated successfully!", "Unable to update slider!");
}
RESPONSE(false, "", "Unknown Request of access is receive!");
