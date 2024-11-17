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

//update page content
if (isset($_POST['UpdatePageContent'])) {
 $PagedId = $_POST['PagedId'];
 $PageDisplayName = $_POST['PageDisplayName'];
 $PageContent = SECURE($_POST['PageContent'], 'e');
 $UpdatePAGE = UPDATE("UPDATE pages SET PageContent='$PageContent', PageDisplayName='$PageDisplayName' where PagedId='$PagedId'");
 RESPONSE($UpdatePAGE,  "$PageDisplayName is updated successfully!", "Unable to update page details!");

 //udpate profile image
} elseif (isset($_POST['UpdatePageImage'])) {
 $PagedId = $_POST['PagedId'];
 $CurrentFile = SECURE($_POST['CurrentFile'], "d");
 $PageFeatureImage = UPLOAD_FILES("../storage/pages", "$CurrentFile", "PageImg", "$PagedId", "PageFeatureImage");
 $UpdatePageImage = UPDATE("UPDATE pages SET PageFeatureImage='$PageFeatureImage' where PagedId='$PagedId'");
 RESPONSE($UpdatePageImage, "Page image is updated successfully!", "Unable to update page image");
}
