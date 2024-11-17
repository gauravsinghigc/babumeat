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

//create social links
if (isset($_POST['SaveSocialAccountLinks'])) {
  $socialaccountname = $_POST['socialaccountname'];
  $socialaccounticon = $_POST['socialaccounticon'];
  $socialaccounturl = $_POST['socialaccounturl'];
  $socialaccountopenat = $_POST['socialaccountopenat'];
  $socialaccountstatus = 1;
  $socialaccountcreatedat = date('Y-m-d');

  $Save = SAVE("socialaccounts", ["socialaccountname", "socialaccounticon", "socialaccounturl", "socialaccountopenat", "socialaccountstatus", "socialaccountcreatedat"]);
  RESPONSE($Save, "Social Account Created Successfully!", "Unable to create social account link at the moment!");

  //delete social accounts
} elseif (isset($_GET['delete_social_accounts'])) {
  $delete_social_accounts = SECURE($_GET['delete_social_accounts'], "d");
  $access_url = SECURE($_GET['access_url'], "d");

  if ($delete_social_accounts == true) {
    $control_id = SECURE($_GET['control_id'], "d");
    $Delete = DELETE_FROM("socialaccounts", "socialaccountid='$control_id'");
    RESPONSE($Delete, "Social Account Deleted Successfully!", "Unable to delete social account link at the moment!");
  } else {
    LOCATION("warning", "Unable to Delete social account links from the website", $access_url);
  }

  //update social accounts
} elseif (isset($_POST['UpdateSocialAccounts'])) {
  $socialaccountid = SECURE($_POST['UpdateSocialAccounts'], "d");
  $socialaccountname = $_POST['socialaccountname'];
  $socialaccounticon = $_POST['socialaccounticon'];
  $socialaccounturl = $_POST['socialaccounturl'];
  $socialaccountopenat = $_POST['socialaccountopenat'];
  $socialaccountstatus = $_POST['socialaccountstatus'];
  $socialaccountupdatedat = date("Y-m-d");

  $Update = UPDATE_TABLE("socialaccounts", ["socialaccountname", "socialaccounticon", "socialaccounturl", "socialaccountopenat", "socialaccountstatus", "socialaccountupdatedat"], "socialaccountid='$socialaccountid'");
  RESPONSE($Update, "Social Account Updated Successfully!", "Unable to update social account link at the moment!");
}
RESPONSE(false, "", "Unknown Request of access is receive!");
