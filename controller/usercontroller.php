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

//update profile image 
if (isset($_POST['updateprofileimage'])) {
  $UserId  = LOGIN_UserId;
  $current_img = SECURE($_POST['current_img'], "d");
  $UserProfileImage = UPLOAD_FILES("../storage/users/img/profile", "$current_img", LOGIN_UserName . "_UID_" . $UserId, "Profile", "UserProfileImage");
  $Update = UPDATE("UPDATE users SET UserProfileImage='$UserProfileImage' where UserId='$UserId'");
  RESPONSE($Update, "Profile Image Updated!", "Unable to update profile image!");

  //update
}

RESPONSE(false, "", "Unknown Request of access is receive!");
