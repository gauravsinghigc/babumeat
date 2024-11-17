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

//create faqs
if (isset($_POST['CreateFAQS'])) {
 $FAQsName = SECURE($_POST['FAQsName'], "e");
 $FAQSDescriptions = SECURE($_POST['FAQSDescriptions'], "e");
 $FAQsStatus = 1;
 $FAQsCreatedAt = date("d M, Y");
 $save = SAVE("faqs", ["FAQsName", "FAQSDescriptions", "FAQsStatus", "FAQsCreatedAt"]);
 RESPONSE($save, "FAQs " . SECURE($FAQsName, "d") . "is created successfully!", "unable to save faqs!");

 //update faqs
} elseif (isset($_POST['UpdateFaqs'])) {
 $FaqsId = SECURE($_POST['UpdateFaqs'], "d");
 $FAQsName = SECURE($_POST['FAQsName'], "e");
 $FAQSDescriptions = SECURE($_POST['FAQSDescriptions'], "e");
 $FAQsStatus = $_POST['FAQsStatus'];
 $FAQsUpdatedAt = date("d M, Y");
 $update = UPDATE_TABLE("faqs", ["FAQsName", "FAQSDescriptions", "FAQsStatus", "FAQsUpdatedAt"], "FaqsId='$FaqsId'");
 RESPONSE($update, "FAQs " . SECURE($FAQsName, "d") . "is updated successfully!", "Unable to update faqs!");

 //delete faqs
} elseif (isset($_GET['delete_faqs_records'])) {
 $access_url = SECURE($_GET['access_url'], "d");
 $delete_faqs_records = SECURE($_GET['delete_faqs_records'], "d");

 if ($delete_faqs_records == true) {
  $FaqsId = SECURE($_GET['control_id'], "d");
  $delete = DELETE_FROM("faqs", "FaqsId='$FaqsId'");
  RESPONSE($delete, "FAQs is deleted successfully!", "Unable to delete faqs!");
 } else {
  RESPONSE(false, "FAQs delete query is completed", "Unable to delete faqs at the moment!");
 }
}
