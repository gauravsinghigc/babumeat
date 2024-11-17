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

//create new enquiry 
if (isset($_POST['SubmitEnquiry'])) {
  $FullName = $_POST['FullName'];
  $PhoneNumber = $_POST['PhoneNumber'];
  $Subject = $_POST['Subject'];
  $EnquiryDate = date("d M, Y");
  $Message = POST('Message');
  $EnquiryStatus = '0';
  $EnquiryPhoto = $_POST['EnquiryPhoto'];
  $Enquiry = SAVE("enquiries", ["FullName", "EnquiryStatus", "PhoneNumber", "Subject", "EnquiryDate", "Message", "EnquiryPhoto"]);
  RESPONSE($Enquiry, "Enquiry details send Successfully!<br>You may receive a call from one of our executive for enquiry solution.", "Enquiry details send Failed!");

  //update eqnuiry
} elseif (isset($_GET['update_enquiry'])) {
  $EnquiriesId = SECURE($_GET['update_enquiry'], 'd');
  $EnquiryStatus = SECURE($_GET['update_to'], 'd');
  $access_url = SECURE($_GET['access_url'], 'd');
  $EnquiryViewDate = date("d M, Y");
  $Enquiry = UPDATE_TABLE("enquiries", ["EnquiryStatus", "EnquiryViewDate"], "EnquiriesId='$EnquiriesId'");
  RESPONSE($Enquiry, "Enquiry status updated Successfully!", "Enquiry status update Failed!");
}

RESPONSE(false, "", "Unknown Request of access is receive!");
