<?php

//form submit token
function FormInputToken()
{
  $TokenValue = SECURE(IP_ADDRESS, "e");
?><input type="text" name="AuthToken" value="<?php echo $TokenValue; ?>" hidden="">
<?php }

//page access
function AccessUrl($GetAutoUrl = true)
{
  if ($GetAutoUrl === true) {
    $RunningUrl = GET_URL();
  } else {
    $RunningUrl = $GetAutoUrl;
  }
?><input type="text" name="access_url" value="<?php echo $RunningUrl; ?>" hidden="">
  <?php }

//form primary details
function FormPrimaryInputs($url = true,  $HiddenValues = null)
{
  FormInputToken();
  if ($url === true) {
    $access_url = AccessUrl(true);
  } else {
    $access_url = AccessUrl($url);
  }
  if ($HiddenValues != null) {
    foreach ($HiddenValues as $key => $value) {
      echo "<input type='text' name='" . $key . "' value='" . SECURE($value, "e") . "' hidden=''>";
    }
  }
  return $access_url;
}

//status view
function StatusView($data)
{
  if ($data == "1" or $data == 1) {
    return "<span class='text-success'><i class='fa fa-check-circle-o'></i></span>";
  } else {
    return "<span class='text-danger'><i class='fa fa-warning'></i></span>";
  }
}

//status view
function StatusViewWithText($data)
{
  if ($data == "1" or $data == 1 || $data == "Active" || $data == "ACTIVE") {
    return "<span class='text-success'><i class='fa fa-check-circle-o'></i> Active</span>";
  } elseif ($data == "2" or $data == 2 || $data == "Inactive" || $data == "INACTIVE") {
    return "<span class='text-danger'><i class='fa fa-warning'></i> Inactive</span>";
  } elseif ($data == "3" or $data == 3 || $data == "Deleted" || $data == "DELETED") {
    return "<span class='text-danger'><i>Deleted!</i></span>";
  } else {
    return "<span class='text-danger'><i class='fa fa-warning'></i> Need Update</span>";
  }
}

//return value
function ReturnValue($data)
{
  if ($data == null) {
    return "Not Available";
  } else {
    return $data;
  }
}

//request price mode
function RequestPrice($price, $ProductName, $ProductRefernceCode, $ProductId)
{
  $ProductSellPrice = $price;
  if ($ProductSellPrice == "0" || $ProductSellPrice == 0) { ?>
    <a href="https://wa.me/<?php echo PRIMARY_PHONE; ?>?text=Hello <?php echo APP_NAME; ?>, I want to know the price and details of <?php echo $ProductName; ?> having Item Code : *<?php echo $ProductRefernceCode; ?>*. Item link is : <?php echo WEB_URL; ?>/products/details/?productid=<?php echo SECURE($ProductId, "e"); ?>" target="_blank" class="btn btn-sm app-btn mt-0 mb-2 fs-12"> Request Price <i class='fa fa-whatsapp text-success'></i></a>
<?php } else {
    echo Price($ProductSellPrice);
  }
}
