<?php
//request variables
function Req_Data($req, $method, $sessional = false, $securitylevel = "enc")
{

  //get & post method data access
  if ($method === "GET") {
    $RequestedData = $_GET["$req"];
  } elseif ($method === "POST") {
    $RequestedData = $_POST["$req"];
  } else {
    $RequestedData = false;
  }

  //encrptionlevel
  if ($securitylevel == "enc") {
    $RequestedData = SECURE($RequestedData, "e");
  } else {
    $RequestedData =  SECURE($RequestedData, "d");
  }

  //sessional access
  if ($sessional == true) {
    $_SESSION["$req"] = $RequestedData;
  } else {
    $_SESSION["$req"] = false;
  }

  //reqturn value
  if ($RequestedData == false) {
    return false;
  } else {
    return $RequestedData;
  }
}

//price function display
function Price($price, $class = null)
{
  echo "<span class='$class'>Rs." . $price . "</span>";
}

//mrp price function display
function MrpPrice($price)
{
  echo "<span class='text-danger'><strike>Rs.$price</strike></span>";
}

//payment status
function PayStatus($paystatus)
{
  if ($paystatus == "Un Paid") {
    echo "<span class='text-danger'><i class='fa fa-warning'></i> Un Paid</span>";
  } else {
    echo "<span class='text-success'><i class='fa fa-check-circle-o'></i> Paid</span>";
  }
}

//enquiry status
function EnquiryStatus($enquiryno)
{
  if ($enquiryno == "0") {
    echo "<span class='text-danger'><i class='fa fa-warning'></i> Un Read</span>";
  } elseif ($enquiryno == "1") {
    echo "<span class='text-warning'><i>Read</i></span>";
  } elseif ($enquiryno == "2") {
    echo "<span class='text-success'><i class='fa fa-check-circle-o'></i> Replied</span>";
  } elseif ($enquiryno == "3") {
    echo "<span class='text-info'><i class='fa fa-info-circle'></i> Closed</span>";
  } else {
    echo "<span class='text-danger'><i class='fa fa-warning'></i> Un Read</span>";
  }
}

//delete confirmation pop 
function CONFIRM_DELETE_POPUP($id, array $Requests, $controller, $btnname = null, $btncss = null)
{
  //if btnname is null
  if ($btnname == null) {
    $btnname = "<i class='fa fa-trash'></i>";
  }

  //if btncss is null
  if ($btncss == null) {
    $btncss = "btn-danger";
  }

  //create requests
  $CreateRequests = "?";
  foreach ($Requests as $key => $values) {
    if ($key == 0) {
      $CreateRequests .= "" . $key . "=" . SECURE($values, "e") . "&";
    } else {
      $CreateRequests .= $key . "=" . SECURE($values, "e") . "&";
    }
  }

  //default request
  $CreateRequests .= "&access_url=" . SECURE(RUNNING_URL, "e") . "&AuthToken=" . SECURE(VALIDATOR_REQ, "e");

  //define controller request 
  $Controller_Requests = CONTROLLER . "/" . $controller . ".php" . $CreateRequests;
?>
  <a class="btn btn-danger sqaure <?php echo $btncss; ?>" onclick="Databar('<?php echo $id; ?>')"><?php echo $btnname; ?></a>
  <section class="popup-background" id="<?php echo $id; ?>">
    <div class="action-area">
      <div class="ref-image">
        <img src="<?php echo ActionDeleteImage; ?>" class="pop-img blink-data">
      </div>
      <div class="activity-details">
        <h3 class="action-title">
          <span class="action-title-text"><?php echo ActionDeleteTitle; ?></span>
        </h3>
        <p class="action-desc">
          <span class="action-desc-text"><?php echo ActionDeleteMessage; ?></span>
        </p>
      </div>
      <div class="activity-action">
        <a onclick="Databar('<?php echo $id; ?>')" class="btn btn-lg btn-danger"><?php echo ActionDeleteCancel; ?></a>
        <a href="<?= $Controller_Requests ?>" class="btn btn-lg btn-success"><?php echo ActionDeleteConfirm; ?></a>
      </div>
    </div>
  </section>
  <?php }

//function for cal records
function CallTypes($calltype)
{
  if ($calltype == 1) {
    echo "<span class='text-success'><img src='" . STORAGE_URL_D . "/tool-img/incoming.png' class='list-icon pro-img'></span>";
  } elseif ($calltype == 2) {
    echo "<span class='text-danger'><img src='" . STORAGE_URL_D . "/tool-img/outgoing.png' class='list-icon pro-img'></span>";
  } else {
    echo "<span class='text-info'><img src='" . STORAGE_URL_D . "/tool-img/missed.png' class='list-icon pro-img'></span>";
  }
}


//social accounts links
function SocialAccounts($listclass = null, $anchorclass = null, $iconclass = null)
{
  $SelectSocialAccounts = FetchConvertIntoArray("SELECT* FROM socialaccounts where socialaccountstatus='1'", true);
  if ($SelectSocialAccounts != null) {
  ?>
    <?php foreach ($SelectSocialAccounts as $Social) {
    ?>
      <li class="mx-2 <?php echo $listclass; ?>">
        <a href="<?php echo $Social->socialaccounturl; ?>" class="<?php echo $anchorclass; ?>" target="<?php echo $Social->socialaccountopenat; ?>" alt="<?php echo $Social->socialaccountname; ?>" title="<?php echo $Social->socialaccountname; ?>">
          <i class="fa <?php echo $Social->socialaccounticon; ?> <?php echo $iconclass; ?>"></i>
        </a>
      </li>
<?php }
  } else {
    return false;
  }
}
