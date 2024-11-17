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

//create new highlights
if (isset($_POST['CreateHIGHLIGHTS'])) {
 $OrderHighlightsTitle = SECURE($_POST['OrderHighlightsTitle'], "e");
 $OrderHighLighIcons = $_POST['OrderHighLighIcons'];
 $OrderHighLightDesc = POST("OrderHighLightDesc");
 $OrderHighlightCreatedAt = date("Y-m-d H:i:s");

 $Save = SAVE("orderhighlights", ["OrderHighlightsTitle", "OrderHighlightCreatedAt", "OrderHighLightDesc", "OrderHighLighIcons"]);
 RESPONSE($Save, "Order Hights Created Successfully!", "Unable to create Order High lights at the moment!");

 //update order hightlights 
} elseif (isset($_POST['UpdateHighlights'])) {
 $OrderHiglightsId = SECURE($_POST['UpdateHighlights'], "d");
 $OrderHighlightsTitle = SECURE($_POST['OrderHighlightsTitle'], "e");
 $OrderHighLighIcons = $_POST['OrderHighLighIcons'];
 $OrderHighLightDesc = POST("OrderHighLightDesc");
 $OrderHighlightsUpdatedAt = date("Y-m-d H:i:s");

 $Update = UPDATE_TABLE("orderhighlights", ["OrderHighlightsTitle", "OrderHighLighIcons", "OrderHighLightDesc", "OrderHighlightsUpdatedAt"], "OrderHiglightsId='$OrderHiglightsId'");
 RESPONSE($Update, "Order High lights Updated Successfully!", "Unable to update Order High lights at the moment!");

 //delete order hightlights
} else if (isset($_GET['delete_high_lights'])) {
 $access_url = SECURE($_GET['access_url'], "d");
 $delete_high_lights = SECURE($_GET['delete_high_lights'], "d");

 if ($delete_high_lights == true) {
  $OrderHiglightsId = SECURE($_GET['control_id'], "d");
  $Delete = DELETE_FROM("orderhighlights", "OrderHiglightsId='$OrderHiglightsId'");
  RESPONSE($Delete, "Order High lights Deleted Successfully!", "Unable to delete Order High lights at the moment!");
 } else {
  RESPONSE(false, "Invalid Request!", "Invalid Request!");
 }
}
