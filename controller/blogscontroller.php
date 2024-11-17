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

//save nerw blogs
if (isset($_POST['CreateBlogs'])) {
  $BlogsTitle = POST("BlogsTitle");
  $BlogsDescriptions = POST("BlogsDescriptions");
  $BlogsFeatureImage = UPLOAD_FILES("../storage/blogs/", "BlogsFeatureImage", "BlogsFeatureImage", "BlogsFeatureImage", "BlogsFeatureImage");
  $BlogsCreatedAt = date("Y-m-d H:i:s");
  $BlogsStatus = 1;
  $BlogsPostedBy = LOGIN_UserId;

  $Save = SAVE("blogs", ["BlogsTitle", "BlogsDescriptions", "BlogsFeatureImage", "BlogsCreatedAt", "BlogsStatus", "BlogsPostedBy"]);
  RESPONSE($Save, "New Blog created successfully!", "Unable to create new blog!");

  //edit blogs
} elseif (isset($_POST['UpdateBlogs'])) {
  $BlogsId = SECURE($_POST['UpdateBlogs'], "d");
  $BlogsTitle = POST("BlogsTitle");
  $BlogsDescriptions = POST("BlogsDescriptions");

  if ($_FILES['BlogsFeatureImage']['name'] != "" || $_FILES['BlogsFeatureImage']['name'] != null ||  $_FILES['BlogsFeatureImage']['name'] != " ") {
    $BlogsFeatureImage = UPLOAD_FILES("../storage/blogs/", "BlogsFeatureImage", "BlogsFeatureImage", "BlogsFeatureImage", "BlogsFeatureImage");
    $Update = UPDATE_TABLE("blogs", ["BlogsTitle", "BlogsDescriptions", "BlogsFeatureImage", "BlogsUpdatedAt", "BlogsStatus"], "BlogsId='$BlogsId'");
  } else {
    $Update = UPDATE_TABLE("blogs", ["BlogsTitle", "BlogsDescriptions", "BlogsUpdatedAt", "BlogsStatus"], "BlogsId='$BlogsId'");
  }

  $BlogsUpdatedAt = date("Y-m-d H:i:s");
  $BlogsStatus = $_POST['BlogsStatus'];

  RESPONSE($Update, "Blog updated successfully!", "Unable to update blog!");

  //delete blogs
} elseif (isset($_GET['delete_blogs_records'])) {
  $access_url = SECURE($_GET['access_url'], "d");
  $delete_offers_records = SECURE($_GET['delete_blogs_records'], "d");

  if ($delete_offers_records == true) {
    $BlogsId = SECURE($_GET['control_id'], "d");
    $Delete = DELETE_FROM("blogs", "BlogsId='$BlogsId'");
    RESPONSE($Delete, "Blog deleted successfully!", "Unable to delete blog!");
  } else {
    RESPONSE(false, "Invalid request!", "Invalid request!");
  }
}

RESPONSE(false, "", "Unknown Request of access is receive!");
