<?php
//require modules;
require '../../../require/modules.php';
require '../../../require/web-modules.php';

if (isset($_GET['productid'])) {
  $ProductId = SECURE($_GET['productid'], "d");
  $_SESSION['productid'] = $ProductId;
} else {
  $ProductId = $_SESSION['productid'];
}

$SQLproducts = SELECT("SELECT * FROM products, pro_categories, pro_sub_categories where products.ProductCategoryId=pro_categories.ProCategoriesId and products.ProductSubCategoryId=pro_sub_categories.ProSubCategoriesId and products.ProductId='$ProductId' ORDER BY products.ProductStatus DESC");
$fetchpro_brands = mysqli_fetch_array($SQLproducts);
$ProductName = $fetchpro_brands['ProductName'];
$ProCategoryName = $fetchpro_brands['ProCategoryName'];
$ProSubCategoryName = $fetchpro_brands['ProSubCategoryName'];
$ProductRefernceCode = $fetchpro_brands['ProductRefernceCode'];
$ProductImage = $fetchpro_brands['ProductImage'];
$ProductCategoryId = $fetchpro_brands['ProductCategoryId'];
$ProductSubCategoryId = $fetchpro_brands['ProductSubCategoryId'];
$ProductBrandId = $fetchpro_brands['ProductBrandId'];
$ProductSellPrice = $fetchpro_brands['ProductSellPrice'];
$ProductMrpPrice = $fetchpro_brands['ProductMrpPrice'];
$ProductDescriptions = $fetchpro_brands['ProductDescriptions'];
$ProductWeight = $fetchpro_brands['ProductWeight'];
$ProductStatus = StatusViewWithText($fetchpro_brands['ProductStatus']);
$ProductCreatedAt = $fetchpro_brands['ProductCreatedAt'];
$ProductUpdatedAt = ReturnValue($fetchpro_brands['ProductUpdatedAt']);
$ProductCreatedBy = $fetchpro_brands['ProductCreatedBy'];
$ProductId = $fetchpro_brands['ProductId'];
$ProductAvailibility = $fetchpro_brands['ProductStatus'];
$ProductSize = $fetchpro_brands['ProductSize'];
$ProductMedium = $fetchpro_brands['ProductMedium'];
$ProductImage2 = $fetchpro_brands['ProductImage2'];
$ProductLocation = $fetchpro_brands['ProductLocation'];
$PageSqls = "SELECT * FROM products where ProductId='$ProductId'";

$CartItemDescriptions = "$ProCategoryName - $ProSubCategoryName - $ProductRefernceCode - $ProductWeight - $ProductLocation - $ProductMedium";

//frame options
if (isset($_GET['frame-option'])) {
  $_SESSION['frame-option'] = $_GET['frame-option'];
  $_SESSION['Price'] = $_GET['Price'];
  $_SESSION['optionid'] = $_GET['optionid'];
  $_SESSION['frame_size'] = $_GET['frame-size'];

  $frame_option = $_SESSION['frame-option'];
  $Price = $_SESSION['Price'];
  $optionid = $_SESSION['optionid'];
  $frame_size = $_SESSION['frame_size'];
} else if (isset($_SESSION['frame-option'])) {
  $frame_option = $_SESSION['frame-option'];
  $Price = $_SESSION['Price'];
  $optionid = $_SESSION['optionid'];
  $frame_size = $_SESSION['frame_size'];
} else {
  $frame_option = null;
  $Price = $ProductSellPrice;
  $optionid = null;
  $frame_size = null;
}

//paper options
if (isset($_GET['paperoptionid'])) {
  $_SESSION['paperoptionid'] = $_GET['paperoptionid'];
  $_SESSION['Paper'] = $_GET['Paper'];

  $paperoptionid = $_SESSION['paperoptionid'];
  $paperoptiontype = $_SESSION['Paper'];
} elseif (isset($_SESSION['paperoptionid'])) {
  $paperoptionid = $_SESSION['paperoptionid'];
  $paperoptiontype = $_SESSION['Paper'];
} else {
  $paperoptionid = null;
  $paperoptiontype = null;
}

//color GetOptionsValues 
if (isset($_SESSION['colrbtn'])) {
  $colorbtn = $_SESSION['colrbtn'];
} elseif (isset($_GET['colrbtn'])) {
  $colorbtn = $_GET['colrbtn'];
} else {
  $colorbtn = "No Color Selected";
}
?>

<!DOCTYPE html>
<html lang="zxx">

<head>
  <title><?php echo $ProductName; ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=0.9">
  <meta charset="utf-8">
  <meta name="keywords" content="" />
  <?php include "../../../include/web/header_files.php"; ?>
</head>

<body>
  <?php if (DEVICE_TYPE == "Computer") { ?>
    <style>
      .table tr th,
      .table tr td {
        padding: 0.1rem !important;
        font-size: 0.8rem !important;
      }

      .descriptions p,
      .descriptions {
        font-size: 0.9rem !important;
      }

      .table {
        margin-bottom: 0px !important;
      }
    </style>
    <loader id="loader">
      <img src="<?php echo STORAGE_URL_D; ?>/tool-img/loader.gif" class="img-fluid">
    </loader>
    <?php include '../../../include/web/header.php'; ?>

    <!--/shop-->
    <section class="banner-bottom-wthreelayouts py-lg-1 py-0">
      <div class="container">
        <div class="inner-sec-shop pt-lg-0 pt-0">
          <div class="row">
            <div class="col-lg-5 single-right-center p-3" style="padding-top:1rem !important;">
              <div class="grid images_3_of_2">
                <div class="flexslider1">
                  <ul class="slides">

                    <li data-thumb="<?php echo STORAGE_URL; ?>/products/pro-img/<?php echo $ProductImage; ?>">
                      <a href="#" onclick="Databar('zoomview')">
                        <div class="thumb-image"> <img loading="lazy" src="<?php echo STORAGE_URL; ?>/products/pro-img/<?php echo $ProductImage; ?>" data-imagezoom="true" class="img-fluid" alt=" "></div>
                      </a>
                    </li>
                    <li data-thumb="<?php echo STORAGE_URL; ?>/products/pro-img/<?php echo $ProductImage2; ?>">
                      <a href="#" onclick="Databar('zoomview')">
                        <div class="thumb-image"> <img loading="lazy" src="<?php echo STORAGE_URL; ?>/products/pro-img/<?php echo $ProductImage2; ?>" data-imagezoom="true" class="img-fluid" alt=" "> </div>
                      </a>
                    </li>
                    <?php
                    //check images and update images
                    $CheckImages = FetchConvertIntoArray("SELECT * FROM pro_images where ProImageProductId='$ProductId' ORDER BY ProImagesId DESC", true);
                    if ($CheckImages != null) {
                      foreach ($CheckImages as $Data) { ?>
                        <li data-thumb="<?php echo STORAGE_URL; ?>/products/pro-img/<?php echo $Data->ProImageProductId; ?>/<?php echo $Data->ProImageName; ?>">
                          <a href="#" onclick="Databar('zoomview')">
                            <div class="thumb-image"> <img src="<?php echo STORAGE_URL; ?>/products/pro-img/<?php echo $Data->ProImageProductId; ?>/<?php echo $Data->ProImageName; ?>" data-imagezoom="true" class="img-fluid" alt=" "> </div>
                          </a>
                        </li>
                    <?php
                      }
                    } ?>
                  </ul>
                  <div class="clearfix"></div>
                </div>
              </div>
            </div>
            <div class="product-image-zoom-area" id="zoomview">
              <a href="#" onclick="Databar('zoomview')" class="close-zoom-view"><i class="fa fa-times"></i></a>
              <div class="actions">
                <a href="#" onclick="zoomout()" class="close-zoom-view"><i class="fa fa-search-minus"></i></a>
                <a href="#" onclick="zoomin()" class="close-zoom-view"><i class="fa fa-search-plus"></i></a>
              </div>
              <div class="zoomable-img">
                <img loading="lazy" src="<?php echo STORAGE_URL; ?>/products/pro-img/<?php echo $ProductImage; ?>" id="zoomingimg">
              </div>
              <center>
                <ul class="product-image-zoom-img-list" style="display:none;">
                  <li>
                    <a href="#">
                      <img loading="lazy" id="1" src="<?php echo STORAGE_URL; ?>/products/pro-img/<?php echo $ProductImage; ?>" class="img-fluid">
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <img loading="lazy" id="2" src="<?php echo STORAGE_URL; ?>/products/pro-img/<?php echo $ProductImage2; ?>" class="img-fluid">
                    </a>
                  </li>
                  <?php
                  //check images and update images
                  $CheckImages = FetchConvertIntoArray("SELECT * FROM pro_images where ProImageProductId='$ProductId' ORDER BY ProImagesId DESC", true);
                  $TotalImages = TOTAL("SELECT * FROM pro_images where ProImageProductId='$ProductId'");
                  if ($CheckImages != null) {
                    $ImageIds = 2;
                    foreach ($CheckImages as $Data) {
                      $ImageIds++; ?>
                      <li>
                        <a href="#">
                          <img loading="lazy" id="<?php echo $ImageIds; ?>" src="<?php echo STORAGE_URL; ?>/products/pro-img/<?php echo $Data->ProImageProductId; ?>/<?php echo $Data->ProImageName; ?>" class="img-fluid">
                        </a>
                      </li>
                  <?php
                    }
                  } ?>
                </ul>
              </center>
              <div class="img-actions placeholder">
                <img loading="lazy" src="<?php echo STORAGE_URL; ?>/products/pro-img/<?php echo $ProductImage; ?>" id="previousimg">
                <img loading="lazy" src="<?php echo STORAGE_URL; ?>/products/pro-img/<?php echo $ProductImage2; ?>" id="nextimg">
              </div>

              <div class="img-actions">
                <button type="button" onclick="PreviousImage()" id="PreviousImagesValue" value="1">
                  <i class="fa fa-angle-left"></i>
                </button>
                <button type="button" onclick="NextImage()" id="NextImagesValue" value="2">
                  <i class="fa fa-angle-right"></i>
                </button>
              </div>
            </div>

            <script>
              function NextImage() {
                var NextImagesValue = document.getElementById("NextImagesValue");
                var TargetedImage = NextImagesValue.value;
                var TargetedImage = +TargetedImage;

                //check total slides or if we are at last slide then rest to first slide
                if (TargetedImage == <?php echo $TotalImages; ?> + 1) {
                  var TargetedImage = 1;
                  document.getElementById("zoomingimg").src = document.getElementById("" + TargetedImage + "").src;
                  var NewTargetedImage = 2;
                  var PreviousTargetedImage = 1;

                  document.getElementById("NextImagesValue").value = NewTargetedImage;
                  document.getElementById("PreviousImagesValue").value = PreviousTargetedImage;
                  document.getElementById("nextimg").src = document.getElementById("" + NewTargetedImage + "").src;
                  document.getElementById("previousimg").src = document.getElementById("" + PreviousTargetedImage + "").src;

                  //if we are not at last slide then get next slides
                } else {
                  document.getElementById("zoomingimg").src = document.getElementById("" + TargetedImage + "").src;
                  var NewTargetedImage = +TargetedImage + 1;
                  var PreviousTargetedImage = +TargetedImage - 1;

                  document.getElementById("NextImagesValue").value = NewTargetedImage;
                  document.getElementById("PreviousImagesValue").value = PreviousTargetedImage;
                  document.getElementById("nextimg").src = document.getElementById("" + NewTargetedImage + "").src;
                  document.getElementById("previousimg").src = document.getElementById("" + PreviousTargetedImage + "").src;
                }
                console.log("Next Image  is :" + TargetedImage);

              }
            </script>

            <script>
              function PreviousImage() {
                var PreviousImagesValue = document.getElementById("PreviousImagesValue");
                var PreviousTargetedImage = PreviousImagesValue.value;
                var PreviousTargetedImage = +PreviousTargetedImage;

                //check total slides or if we are at last slide then rest to first slide
                if (PreviousTargetedImage == 0) {
                  var PreviousTargetedImage = <?php echo $TotalImages; ?>;
                  document.getElementById("zoomingimg").src = document.getElementById("" + PreviousTargetedImage + "").src;
                  var NewTargetedImage2 = +PreviousTargetedImage;
                  var PreviousTargetedImage2 = +PreviousTargetedImage - 1;

                  document.getElementById("NextImagesValue").value = NewTargetedImage2;
                  document.getElementById("PreviousImagesValue").value = PreviousTargetedImage2;
                  document.getElementById("previousimg").src = document.getElementById("" + PreviousTargetedImage2 + "").src;
                  document.getElementById("nextimg").src = document.getElementById("" + NewTargetedImage2 + "").src;

                  //if we are not at last slide then get next slides
                } else {
                  document.getElementById("zoomingimg").src = document.getElementById("" + PreviousTargetedImage + "").src;
                  var NewTargetedImage2 = +PreviousTargetedImage + 1;
                  var PreviousTargetedImage2 = +PreviousTargetedImage - 1;

                  if (PreviousTargetedImage == 1) {
                    PreviousTargetedImage2 = <?php echo $TotalImages; ?>;
                  }

                  document.getElementById("NextImagesValue").value = NewTargetedImage2;
                  document.getElementById("PreviousImagesValue").value = PreviousTargetedImage2;
                  document.getElementById("previousimg").src = document.getElementById("" + PreviousTargetedImage2 + "").src;
                  document.getElementById("nextimg").src = document.getElementById("" + NewTargetedImage2 + "").src;
                }

                console.log("Preivous Image  is :" + PreviousTargetedImage);
              }
            </script>
            <script>
              function zoomin() {
                var myImg = document.getElementById("zoomingimg");
                var currWidth = myImg.clientWidth;
                if (currWidth == 2500) return false;
                else {
                  myImg.style.width = (currWidth + 100) + "px";
                }
              }

              function zoomout() {
                var myImg = document.getElementById("zoomingimg");
                var currWidth = myImg.clientWidth;
                if (currWidth == 100) return false;
                else {
                  myImg.style.width = (currWidth - 100) + "px";
                }
              }
            </script>
            <div class="col-lg-7 single-right-left simpleCart_shelfItem" style="padding-top:1rem !important;">
              <h3><?php echo $ProductName; ?></h3>
              <p class="provider-name"> <?php echo $ProCategoryName; ?> | <?php echo $ProSubCategoryName; ?></p>
              <p>
                <?php
                if ($ProductSellPrice == "0" || $ProductSellPrice == 0) { ?>
                  <a href="https://wa.me/<?php echo PRIMARY_PHONE; ?>?text=Hello <?php echo APP_NAME; ?>, I want to know the price and details of <?php echo $ProductName; ?> having Item Code : *<?php echo $ProductRefernceCode; ?>*. Item link is : <?php echo RUNNING_URL; ?>" target="_blank" class="btn btn-sm app-btn mt-2 mb-1"> Request Price <i class='fa fa-whatsapp text-success'></i></a>
                  <br>
                <?php } else { ?>
                  <span class="item_price"><span id="d_price"><?php echo Price($Price); ?></span></span>
                  <span class="tax-options">All Taxes & Charges are excluded.</span><br>
                <?php } ?>
                <span class="rating-star" hidden="">
                  <i class="fa fa-star text-warning"></i>
                  <i class="fa fa-star text-warning"></i>
                  <i class="fa fa-star text-warning"></i>
                  <i class="fa fa-star text-warning"></i>
                  <i class="fa fa-star text-warning"></i>
                  <span class="review-text"><?php echo TOTAL("SELECT * FROM reviews where ReviewedProductid='$ProductId'"); ?>
                    Reviews</span>
                </span>
              </p>
              <div class="row">
                <div class="col-md-12">
                  <table class="table">
                    <tr>
                      <th>ITEM CODE</th>
                      <td class="text-info"><i class="fa fa-hashtag"></i> <?php echo GET_DATA("ProductRefernceCode"); ?></td>
                    </tr>
                    <tr>
                      <th>Item Name</th>
                      <td><?php echo GET_DATA("ProductName"); ?></td>
                    </tr>
                    <tr>
                      <th>Item Collection</th>
                      <td>
                        <?php echo FETCH("SELECT * FROM pro_categories where ProCategoriesId='" . GET_DATA("ProductCategoryId") . "'", "ProCategoryName"); ?>
                      </td>
                    </tr>
                    <tr>
                      <th>Size</th>
                      <td><?php echo GET_DATA("ProductSize"); ?></td>
                    </tr>
                    <tr>
                      <th>Work Type</th>
                      <td><?php echo GET_DATA("ProductWorkType"); ?></td>
                    </tr>
                  </table>
                </div>
              </div>
              <?php if (isset($_GET['selected-options'])) { ?>
                <a href="<?php echo DOMAIN; ?>/web/products/details/" class="btn btn-md btn-danger pull-right"><i class="fa fa-times text-white"></i> Remove Options</a>
              <?php } ?>

              <?php $GetOptionsValues = FetchConvertIntoArray("SELECT * FROM pro_options_categories where ProOptionCategoryId='13'", true);
              if ($GetOptionsValues != null) {
                foreach ($GetOptionsValues as $Request) { ?>
                  <div class="occasional">
                    <h5 class="pl-0"><?php echo $Request->ProOptionCategoryName; ?>:</h5>
                    <div class="option-list">
                      <?php
                      $FetchOptions = FetchConvertIntoArray("SELECT * FROM pro_options where ProOptionProductId='$ProductId' and ProOptionCategoryId='" . $Request->ProOptionCategoryId . "'", true);
                      if ($FetchOptions != null) {
                        foreach ($FetchOptions as $Request2) { ?>
                          <form action="" method="GET" onclick="form.submit()">
                            <input type="text" name="selected-options" value="<?php echo $Request->ProOptionCategoryId; ?>" hidden="">
                            <input type="text" name="frame-size" value="<?php echo $Request->ProOptionName; ?>" hidden="">
                            <input type="text" name="selected-value" value="<?php echo LowerCase(RemoveSpace($Request2->ProOptionName)); ?>" hidden="">
                            <input type="text" name="option-value" value="<?php echo $Request2->ProOptionCharges; ?>" hidden="">
                            <div class="options">
                              <button class="option-value" name="filter-options" value="<?php echo $Request2->ProOptionsId; ?>">
                                <?php echo $Request2->ProOptionName; ?>
                                <span class="option-price">@ <?php echo Price($Request2->ProOptionCharges); ?></span>
                              </button>
                            </div>
                          </form>
                      <?php }
                      } ?>
                      <?php ?>
                    </div>
                    <div class="clearfix"></div>
                  </div>
              <?php }
              } ?>

              <div class="color-quality">
                <div class="color-quality-right">
                  <h5 class="p-2">Quantity :</h5>
                  <div class="item-quantity-button">
                    <button type="button" id="increase" onclick="Increase()"><i class="fa fa-plus"></i></button>
                    <input type="number" id="qty" min="<?php echo MIN_ORDER_QTY; ?>" VALUE="1" max="<?php echo MAX_ORDER_QTY; ?>">
                    <button type="button" id="decrease" onclick="Decrease()"><i class="fa fa-minus"></i></button>
                  </div>
                </div>
              </div>
              <div class="occasion-cart">
                <div class="googles single-item singlepage flex-start">
                  <form action="<?php echo CONTROLLER; ?>/ordercontroller.php" method="post">
                    <?php FormPrimaryInputs(true); ?>
                    <input type="hidden" name="CartProductId" value="<?php echo SECURE($ProductId, "e"); ?>">
                    <input type="hidden" name="CartProductSellPrice" id="sellprice1" value="<?php echo $Price; ?>">
                    <input type="hidden" name="CartProductMrpPrice" id="mrpprice1" value="<?php echo $ProductMrpPrice; ?>">
                    <input type="hidden" name="CartProductWeight" value="<?php echo $ProductWeight; ?>">
                    <input type="hidden" name="CartProductQty" value="1" id="qtyinput">
                    <input type="hidden" name="CartFinalPrice" id="netprice1" value="<?php echo $Price; ?>">
                    <input type="hidden" name="CartDeviceInfo" value="<?php echo SECURE(SYSTEM_INFO, "e"); ?>">
                    <input type="hidden" name="CartItemDescriptions" id="cart-item-desc" value="<?php echo $CartItemDescriptions; ?>">
                    <button name="AddItemsToCart" type="submit" class="googles-cart pgoogles-cart">
                      Add to Cart
                    </button>
                  </form>

                  <form class="ml-4" action="<?php echo CONTROLLER; ?>/ordercontroller.php" method="post">
                    <?php FormPrimaryInputs(WEB_URL . "/checkout"); ?>
                    <input type="hidden" name="CartProductId" value="<?php echo SECURE($ProductId, "e"); ?>">
                    <input type="hidden" name="CartProductSellPrice" id="sellprice2" value="<?php echo $Price; ?>">
                    <input type="hidden" name="CartProductMrpPrice" id="mrpprice2" value="<?php echo $ProductMrpPrice; ?>">
                    <input type="hidden" name="CartProductWeight" value="<?php echo $ProductWeight; ?>">
                    <input type="hidden" name="CartProductQty" value="1" id="qtyinput2">
                    <input type="hidden" name="CartFinalPrice" id="netprice2" value="<?php echo $Price; ?>">
                    <input type="hidden" name="CartDeviceInfo" value="<?php echo SECURE(SYSTEM_INFO, "e"); ?>">
                    <input type="hidden" name="CartItemDescriptions" id="cartitemdesc" value="<?php echo $CartItemDescriptions; ?>">
                    <button name="AddItemsToCart" type="submit" class="googles-cart pgoogles-cart buy-now-btn">
                      Buy Now
                    </button>
                  </form>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <ul class="footer-social text-left mt-lg-4 mt-3">
                    <li>Share Design : </li>
                    <li>
                      <div class="sharing-button">
                        <input type="text" id="readytext" style="display:none;" value="<?php echo DOMAIN . "/s.php?i=" . SECURE(RUNNING_URL, "e"); ?>">
                        <button type="button" class="btn btn-lg" onclick="CopyText()" id="copybutton"><span id="CCText"><i class="fa fa-copy"></i> copy link</span></button>
                      </div>

                      <script>
                        function CopyText() {
                          document.getElementById("readytext").style.display = "block";
                          var copyText = document.getElementById("readytext");
                          copyText.select();
                          copyText.setSelectionRange(0, 99999);
                          document.execCommand("copy");
                          document.getElementById("CCText").innerHTML = "Sharing Link Copied!";
                          document.getElementById("copybutton").classList.add("btn-danger");
                        }
                      </script>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="clearfix"> </div>
            <!--/tabs-->
          </div>

        </div>
      </div>
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="responsive_tabs">
              <div id="horizontalTab">
                <ul class="resp-tabs-list">
                  <li>Description</li>
                  <li>Reviews</li>
                </ul>
                <div class="resp-tabs-container">
                  <!--/tab_one-->
                  <div class="tab1">

                    <div class="single_page">
                      <h6><?php echo $ProductName; ?></h6>
                      <div class="description item-descriptions" id="viewdesc">
                        <?php echo html_entity_decode($ProductDescriptions); ?>
                        <button type="button" value="true" class="btn btn-sm app-btn pull-right" onclick="ViewMoreBtn()" id="viewbtn">Read More <i class='fa fa-plus'></i></button>
                      </div>
                      <table class="table table-striped">
                        <?php
                        $ViewProductId = $ProductId;
                        $FetchSpecifications = FetchConvertIntoArray("SELECT * FROM pro_specifications where ProdProductId='$ViewProductId' ORDER BY ProSpecificationId ASC", true);
                        if ($FetchSpecifications != null) {
                          $CountNo = 0;
                          foreach ($FetchSpecifications as $Data) {
                            $CountNo++;
                        ?>
                            <tr>
                              <th><?php echo $Data->ProSpecificationName; ?></th>
                              <td><?php echo SECURE($Data->ProSpecificationValue, "d"); ?></td>
                            </tr>
                        <?php
                          }
                        } ?>
                      </table>
                    </div>
                  </div>
                  <!--//tab_one-->
                  <div class="tab2">

                    <div class="single_page">
                      <div class="row">
                        <div class="col-lg-5 col-md-5 col-sm-6 col-12">
                          <h4 class="account-header">Submit New review</h4>
                          <?php if (isset($_SESSION['LOGIN_CustomerId'])) { ?>
                            <div class="add-review">
                              <form action="<?php echo CONTROLLER; ?>/reviewcontroller.php" method="post" enctype="multipart/form-data">
                                <?php FormPrimaryInputs(true); ?>
                                <div class="submit-review-stars">
                                  <i class="fa fa-star" id="star1" onmouseover="StartColor(1)"></i>
                                  <i class="fa fa-star" id="star2" onmouseover="StartColor(2)"></i>
                                  <i class="fa fa-star" id="star3" onmouseover="StartColor(3)"></i>
                                  <i class="fa fa-star" id="star4" onmouseover="StartColor(4)"></i>
                                  <i class="fa fa-star" id="star5" onmouseover="StartColor(5)"></i>

                                  <span class="" id="ReviewText"></span>
                                </div>
                                <br>
                                <input type="text" name="ReviewStarCount" id="starcountvalue" hidden="">
                                <input type="text" name="ReviewedCustomerId" value="<?php echo LOGIN_CustomerId; ?>" hidden="">
                                <input type="text" name="ReviewedProductid" value="<?php echo $ProductId; ?>" hidden="">
                                <input type="text" name="ReviewTitle" placeholder="Enter Review Title" class="w-100">
                                <input type="text" name="ReviewStatus" value="1" hidden="" class="w-100">
                                <textarea name="ReviewDescriptions" rows="5" placeholder="Write your review"></textarea>
                                <label for="ReviewProfileImage">
                                  <img src="<?php echo STORAGE_URL_D; ?>/tool-img/upload-review.jpg" id="ImgPreview" class="img-fluid hov-pointer">
                                </label>
                                <input type="FILE" name="ReviewProfileImage" id="ReviewProfileImage" hidden="">
                                <br><br>
                                <button type="submit" value="Submit Feedback" name="SubmitProductReview" class="btn btn-lg buy-now-btn">
                                  Submit Feedback
                                </button>
                              </form>
                            </div>
                          <?php } else { ?>
                            <br><br>
                            <h5>To submit new review you have to login into your account.</h5>
                            <br>
                            <a href="<?php echo DOMAIN; ?>/auth/web/login/?return=<?php echo SECURE(RUNNING_URL, "e"); ?>" class="btn btn-lg buy-now-btn">Login to Submit Review</a>
                          <?php } ?>
                        </div>
                        <div class="col-lg-7 col-md-7 col-sm-6 col-12">
                          <h4 class="account-header">All Reviews <span class="pull-right">(<?php echo TOTAL("SELECT * FROM reviews where ReviewedProductid='$ProductId'"); ?>)
                              Reviews</span></h4>
                          <div class="bootstrap-tab-text-grids">
                            <?php
                            $FetchReviews = FetchConvertIntoArray("SELECT * FROM reviews where ReviewedProductid='$ProductId' ORDER BY ReviewsId DESC LIMIT 0, 5", true);
                            if ($FetchReviews != null) {
                              foreach ($FetchReviews as $Request) { ?>
                                <div class="bootstrap-tab-text-grid">
                                  <div class="bootstrap-tab-text-grid-left">
                                    <img src="<?php echo STORAGE_URL_D; ?>/tool-img/feedback.jpg" accept="image/*" alt="" class="img-fluid">
                                  </div>
                                  <div class="bootstrap-tab-text-grid-right">
                                    <ul>
                                      <li>
                                        <h4><?php echo SECURE($Request->ReviewTitle, "d"); ?><h4>
                                      </li>
                                    </ul>
                                    <style>
                                      p {
                                        margin-top: 0px !important;
                                      }
                                    </style>
                                    <p><?php echo html_entity_decode(SECURE($Request->ReviewDescriptions, "d")); ?></p>
                                    <a href="<?php echo STORAGE_URL; ?>/reviews/<?php echo $Request->ReviewProfileImage; ?>" target="_blank">
                                      <img src="<?php echo STORAGE_URL; ?>/reviews/<?php echo $Request->ReviewProfileImage; ?>" class="w-25">
                                    </a>
                                  </div>
                                  <div class="clearfix"> </div>
                                </div>
                                <hr>
                            <?php
                              }
                            } ?>
                            <a href="<?php echo WEB_URL; ?>/reviews/?proid=<?php echo SECURE($ProductId, "e"); ?>" class="btn btn-md buy-now-btn pull-right">View All</a>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!--//tabs-->

          </div>
        </div>
      </div>
      <div class="container-fluid">

        <!--/slide-->
        <div class="slider-img mid-sec mt-lg-5 mt-2 px-lg-5 px-3">
          <!--//banner-sec-->
          <h3 class="tittle-w3layouts text-left my-lg-4 my-3">Related Products</h3>
          <div class="mid-slider">
            <div class="owl-carousel owl-theme row">

              <?php
              //fetch conditions
              if (isset($_GET['categoryid'])) {
                $SQLproducts = SELECT("SELECT * FROM products, pro_categories, pro_sub_categories where products.ProductCategoryId=pro_categories.ProCategoriesId and products.ProductCategoryId='$ProCategoriesId' and products.ProductSubCategoryId=pro_sub_categories.ProSubCategoriesId  ORDER BY products.ProductStatus DESC");
              } elseif (isset($_GET['subcategoryid'])) {
                $SQLproducts = SELECT("SELECT * FROM products, pro_categories, pro_sub_categories where products.ProductCategoryId=pro_categories.ProCategoriesId and products.ProductSubCategoryId='$ProSubCategoriesId' and products.ProductSubCategoryId=pro_sub_categories.ProSubCategoriesId  ORDER BY products.ProductStatus DESC");
              } else {
                $SQLproducts = SELECT("SELECT * FROM products, pro_categories, pro_sub_categories where products.ProductCategoryId=pro_categories.ProCategoriesId and products.ProductSubCategoryId=pro_sub_categories.ProSubCategoriesId  ORDER BY products.ProductStatus DESC");
              }
              //product fetch loops
              while ($fetchpro_brands = mysqli_fetch_array($SQLproducts)) {
                $ProductName = $fetchpro_brands['ProductName'];
                $ProCategoryName = $fetchpro_brands['ProCategoryName'];
                $ProSubCategoryName = $fetchpro_brands['ProSubCategoryName'];
                $ProductRefernceCode = $fetchpro_brands['ProductRefernceCode'];
                $ProductImage = $fetchpro_brands['ProductImage'];
                $ProductCategoryId = $fetchpro_brands['ProductCategoryId'];
                $ProductSubCategoryId = $fetchpro_brands['ProductSubCategoryId'];
                $ProductBrandId = $fetchpro_brands['ProductBrandId'];
                $ProductSellPrice = $fetchpro_brands['ProductSellPrice'];
                $ProductMrpPrice = $fetchpro_brands['ProductMrpPrice'];
                $ProductDescriptions = SECURE($fetchpro_brands['ProductDescriptions'], "e");
                $ProductWeight = $fetchpro_brands['ProductWeight'];
                $ProductStatus = StatusViewWithText($fetchpro_brands['ProductStatus']);
                $ProductCreatedAt = $fetchpro_brands['ProductCreatedAt'];
                $ProductUpdatedAt = ReturnValue($fetchpro_brands['ProductUpdatedAt']);
                $ProductCreatedBy = $fetchpro_brands['ProductCreatedBy'];
                $ProductId2 = $fetchpro_brands['ProductId'];
                $ProductAvailibility = $fetchpro_brands['ProductStatus'];
                $ProductImage2 = $fetchpro_brands['ProductImage2'];
                $ProductSize = $fetchpro_brands['ProductSize'];
                $ProductMedium = $fetchpro_brands['ProductMedium'];
                $ProductSellPrice = FETCH("SELECT MIN(ProOptionCharges) AS ProOptionCharges FROM pro_options where ProOptionProductId='$ProductId2' and ProOptionCharges!='0'", "ProOptionCharges");

                //product tabs
              ?>
                <div class="item">
                  <div class="gd-box-info text-center">
                    <div class="product-men women_two bot-gd">
                      <div class="product-googles-info slide-img googles">
                        <div class="men-pro-item">
                          <div class="men-thumb-item">
                            <a href="<?php echo DOMAIN; ?>/web/products/details/?productid=<?php echo SECURE($ProductId2, "e"); ?>">
                              <img loading="lazy" onmouseout="ChangeImage_<?php echo $ProductId2; ?>()" onmouseenter="ChangeImage_<?php echo $ProductId2; ?>()" id="secimg_<?php echo $ProductId2; ?>" src="<?php echo STORAGE_URL; ?>/products/pro-img/<?php echo $ProductImage; ?>" alt="<?php echo $ProductName; ?>" title="<?php echo $ProductName; ?>" class=" img-fluid" alt="">
                              <script>
                                function ChangeImage_<?php echo $ProductId2; ?>() {
                                  var img_<?php echo $ProductId2; ?> = document.getElementById("secimg_<?php echo $ProductId2; ?>");
                                  if (img_<?php echo $ProductId2; ?>.src ==
                                    "<?php echo STORAGE_URL; ?>/products/pro-img/<?php echo $ProductImage; ?>") {
                                    img_<?php echo $ProductId2; ?>.src =
                                      "<?php echo STORAGE_URL; ?>/products/pro-img/<?php echo $ProductImage2; ?>";
                                  } else {
                                    img_<?php echo $ProductId2; ?>.src =
                                      "<?php echo STORAGE_URL; ?>/products/pro-img/<?php echo $ProductImage; ?>";
                                  }
                                }
                              </script>
                            </a>
                            <span class="product-new-top">New</span>
                          </div>
                          <div class="item-info-product">

                            <div class="info-product-price">
                              <div class="grid_meta">
                                <div class="product_price">
                                  <h4 class="mt-2">
                                    <a href="<?php echo DOMAIN; ?>/web/products/details/?productid=<?php echo SECURE($ProductId2, "e"); ?>"><?php echo $ProductName; ?></a><br>
                                  </h4>
                                  <span class="rating-star" hidden="">
                                    <i class="fa fa-star text-warning"></i>
                                    <i class="fa fa-star text-warning"></i>
                                    <i class="fa fa-star text-warning"></i>
                                    <i class="fa fa-star text-warning"></i>
                                    <i class="fa fa-star text-warning"></i>
                                    <span class="review-text">
                                      (<?php echo TOTAL("SELECT * FROM reviews where ReviewedProductid='$ProductId2'"); ?>)</span>
                                  </span>
                                  <?php if ($ProductSellPrice == "0" || $ProductSellPrice == 0) { ?>
                                    <div class="grid-price mt-0">
                                      <a href="https://wa.me/<?php echo PRIMARY_PHONE; ?>?text=Hello <?php echo APP_NAME; ?>, I want to know the price and details of <?php echo $ProductName; ?> having Item Code : *<?php echo $ProductRefernceCode; ?>*. Item link is : <?php echo RUNNING_URL; ?>" target="_blank" class="btn btn-sm app-btn mt-2 mb-1"> Request Price <i class='fa fa-whatsapp text-success'></i></a>
                                    </div>
                                  <?php } else { ?>
                                    <div class="grid-price mt-3">
                                      <span class="money"><?php echo RequestPrice($ProductSellPrice, $ProductName, $ProductRefernceCode, $ProductId2); ?></span>
                                      <span class="money-mrp text-grey"><strike><?php echo Price($ProductMrpPrice); ?></strike></span>
                                    </div>
                                  <?php } ?>
                                </div>

                              </div>
                            </div>

                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              <?php
                //end of product listing loop
              } ?>

            </div>
          </div>
        </div>
        <!--//slider-->
      </div>
    </section>
    <!--footer -->

    <?php include '../../../include/web/message.php'; ?>
    <script>
      var frameoption2 = "<?php echo $frame_option; ?>";
      window.onload = function() {
        document.getElementById("loader").style.display = "none";
        if (frameoption2 === "With Frame") {
          document.getElementById("withframes").style.display = "block";
          document.getElementById("withoutframes").style.display = "none";
        } else {
          document.getElementById("withframes").style.display = "none";
          document.getElementById("withoutframes").style.display = "block";
        }
      };
    </script>
    <script>
      function ViewMoreBtn() {
        var viewbtn = document.getElementById("viewbtn");
        var viewdesc = document.getElementById("viewdesc");

        if (viewbtn.value == "false") {
          viewdesc.classList.add("item-descriptions");
          viewbtn.innerHTML = "Read More <i class='fa fa-plus'></i>";
          viewbtn.value = "true";
        } else {
          viewdesc.classList.remove("item-descriptions");
          viewbtn.innerHTML = "Read Less <i class='fa fa-minus'></i>";
          viewbtn.value = "false";
        }
      }
    </script>
    <script>
      ReviewProfileImage.onchange = evt => {
        const [file] = ReviewProfileImage.files
        if (file) {
          ImgPreview.src = URL.createObjectURL(file);
        }
      }
    </script>
    <script>
      function StartColor(starcount) {
        if (starcount === 1) {
          document.getElementById("star1").classList.add("selected-star");
          document.getElementById("star2").classList.remove("selected-star");
          document.getElementById("star3").classList.remove("selected-star");
          document.getElementById("star4").classList.remove("selected-star");
          document.getElementById("star5").classList.remove("selected-star");
          document.getElementById("starcountvalue").value = 1;
          document.getElementById("ReviewText").classList.add("ReviewText");
          document.getElementById("ReviewText").innerHTML = "<i class=' fa fa-thumbs-down text-danger'></i> Poor";
          document.getElementById("ReviewText").style.color = "green !important";
        } else if (starcount === 2) {
          document.getElementById("star1").classList.add("selected-star");
          document.getElementById("star2").classList.add("selected-star");
          document.getElementById("star3").classList.remove("selected-star");
          document.getElementById("star4").classList.remove("selected-star");
          document.getElementById("star5").classList.remove("selected-star");
          document.getElementById("starcountvalue").value = 2;
          document.getElementById("ReviewText").classList.add("ReviewText");
          document.getElementById("ReviewText").innerHTML = "<i class='fa fa-thumbs-up text-info'></i> Not Bad";
          document.getElementById("ReviewText").style.color = "green !important";
        } else if (starcount === 3) {
          document.getElementById("star1").classList.add("selected-star");
          document.getElementById("star2").classList.add("selected-star");
          document.getElementById("star3").classList.add("selected-star");
          document.getElementById("star4").classList.remove("selected-star");
          document.getElementById("star5").classList.remove("selected-star");
          document.getElementById("starcountvalue").value = 3;
          document.getElementById("ReviewText").classList.add("ReviewText");
          document.getElementById("ReviewText").innerHTML = "<i class='fa fa-thumbs-up text-primary'></i> Good";
          document.getElementById("ReviewText").style.color = "green !important";
        } else if (starcount === 4) {
          document.getElementById("star1").classList.add("selected-star");
          document.getElementById("star2").classList.add("selected-star");
          document.getElementById("star3").classList.add("selected-star");
          document.getElementById("star4").classList.add("selected-star");
          document.getElementById("star5").classList.remove("selected-star");
          document.getElementById("starcountvalue").value = 4;
          document.getElementById("ReviewText").classList.add("ReviewText");
          document.getElementById("ReviewText").innerHTML = "<i class='fa fa-thumbs-up text-success'></i> Very Good";
          document.getElementById("ReviewText").style.color = "green !important";
        } else if (starcount === 5) {
          document.getElementById("star1").classList.add("selected-star");
          document.getElementById("star2").classList.add("selected-star");
          document.getElementById("star3").classList.add("selected-star");
          document.getElementById("star4").classList.add("selected-star");
          document.getElementById("star5").classList.add("selected-star");
          document.getElementById("starcountvalue").value = 5;
          document.getElementById("ReviewText").classList.add("ReviewText");
          document.getElementById("ReviewText").innerHTML = "<i class='fa fa-star text-warning fa-spin'></i> Excellent";
          document.getElementById("ReviewText").style.color = "green !important";
        } else {
          document.getElementById("star1").classList.remove("selected-star");
          document.getElementById("star2").classList.remove("selected-star");
          document.getElementById("star3").classList.remove("selected-star");
          document.getElementById("star4").classList.remove("selected-star");
          document.getElementById("star5").classList.remove("selected-star");
          document.getElementById("starcountvalue").value = 0;
          document.getElementById("ReviewText").classList.remove("ReviewText");
          document.getElementById("ReviewText").innerHTML = "<i class='fa fa-thumbs-down text-danger'></i> Poor";
          document.getElementById("ReviewText").style.color = "green !important";
        }
      }
    </script>
    <script>
      function Increase() {
        var qty = document.getElementById("qty");

        //run increament
        if (qty.value < <?php echo MAX_ORDER_QTY; ?>) {
          qty.value++;
          document.getElementById("qty").value = qty.value;
          document.getElementById("netprice1").value = qty.value * +<?php echo $Price; ?>;
          document.getElementById("netprice2").value = qty.value * +<?php echo $Price; ?>;
        } else if (qty == <?php echo MAX_ORDER_QTY; ?>) {
          document.getElementById("qty").value = <?php echo MAX_ORDER_QTY; ?>;
        }
      }
    </script>
    <script>
      function Decrease() {
        var qty = document.getElementById("qty");

        //run increament
        if (qty.value > <?php echo MIN_ORDER_QTY; ?>) {
          qty.value--;
          document.getElementById("qty").value = qty.value;
          document.getElementById("netprice1").value = qty.value * +<?php echo $Price; ?>;
          document.getElementById("netprice2").value = qty.value * +<?php echo $Price; ?>;
        } else if (qty == <?php echo MIN_ORDER_QTY; ?>) {
          document.getElementById("qty").value = <?php echo MIN_ORDER_QTY; ?>;
        }
      }
    </script>

    <?php include '../../../include/web/footer.php'; ?>

    <!--jQuery-->
    <script src="<?php echo ASSETS_URL; ?>/web/js/jquery-2.2.3.min.js"></script>
    <!-- newsletter modal -->
    <!--search jQuery-->
    <script src="<?php echo ASSETS_URL; ?>/web/js/modernizr-2.6.2.min.js"></script>
    <script src="<?php echo ASSETS_URL; ?>/web/js/classie-search.js"></script>
    <script src="<?php echo ASSETS_URL; ?>/web/js/demo1-search.js"></script>
    <!--//search jQuery-->
    <!-- cart-js -->
    <script src="<?php echo ASSETS_URL; ?>/web/js/minicart.js"></script>
    <script>
      googles.render();

      googles.cart.on("googles_checkout", function(evt) {
        var items, len, i;

        if (this.subtotal() > 0) {
          items = this.items();

          for (i = 0, len = items.length; i < len; i++) {}
        }
      });
    </script>
    <!-- //cart-js -->
    <script>
      $(document).ready(function() {
        $(".button-log a").click(function() {
          $(".overlay-login").fadeToggle(200);
          $(this).toggleClass("btn-open").toggleClass("btn-close");
        });
      });
      $(".overlay-close1").on("click", function() {
        $(".overlay-login").fadeToggle(200);
        $(".button-log a").toggleClass("btn-open").toggleClass("btn-close");
        open = false;
      });
    </script>
    <!-- carousel -->
    <!-- price range (top products) -->
    <script src="<?php echo ASSETS_URL; ?>/web/js/jquery-ui.js"></script>
    <script>
      //<![CDATA[
      $(window).load(function() {
        $("#slider-range").slider({
          range: true,
          min: 0,
          max: 9000,
          values: [50, 6000],
          slide: function(event, ui) {
            $("#amount").val("$" + ui.values[0] + " - $" + ui.values[1]);
          },
        });
        $("#amount").val("$" + $("#slider-range").slider("values", 0) + " - $" + $("#slider-range").slider("values", 1));
      }); //]]>
    </script>
    <!-- //price range (top products) -->

    <script src="<?php echo ASSETS_URL; ?>/web/js/owl.carousel.js"></script>
    <script>
      $(document).ready(function() {
        $(".owl-carousel").owlCarousel({
          loop: true,
          margin: 10,
          responsiveClass: true,
          autoplay: false,
          autoplayTimeout: 1000,
          autoplayHoverPause: false,
          responsive: {
            0: {
              items: 2,
              nav: true,
              loop: true,
            },
            600: {
              items: 2,
              nav: true,
              loop: true,
            },
            900: {
              items: 4,
              nav: true,
              loop: true,
            },
            1000: {
              items: 4,
              nav: true,
              loop: true,
              margin: 20,
            },
          },
        });
      });
    </script>

    <!-- //end-smooth-scrolling -->

    <!-- <script src="<?php echo ASSETS_URL; ?>/web/js/imagezoom.js"></script> -->
    <!-- script for responsive tabs -->
    <script src="<?php echo ASSETS_URL; ?>/web/js/easy-responsive-tabs.js"></script>
    <script>
      $(document).ready(function() {
        $("#horizontalTab").easyResponsiveTabs({
          type: "default", //Types: default, vertical, accordion
          width: "auto", //auto or any width like 600px
          fit: true, // 100% fit in a container
          closed: "accordion", // Start closed if in accordion view
          activate: function(event) {
            // Callback function if tab is switched
            var $tab = $(this);
            var $info = $("#tabInfo");
            var $name = $("span", $info);
            $name.text($tab.text());
            $info.show();
          },
        });
        $("#verticalTab").easyResponsiveTabs({
          type: "vertical",
          width: "auto",
          fit: true,
        });
      });
    </script>
    <!-- FlexSlider -->
    <script src="<?php echo ASSETS_URL; ?>/web/js/jquery.flexslider.js"></script>
    <script>
      // Can also be used with $(document).ready()
      $(window).load(function() {
        $(".flexslider1").flexslider({
          animation: "slide",
          controlNav: "thumbnails",
        });
      });
    </script>
    <!-- //FlexSlider-->

    <!-- dropdown nav -->
    <script>
      $(document).ready(function() {
        $(".dropdown").hover(
          function() {
            $(".dropdown-menu", this).stop(true, true).slideDown("fast");
            $(this).toggleClass("open");
          },
          function() {
            $(".dropdown-menu", this).stop(true, true).slideUp("fast");
            $(this).toggleClass("open");
          }
        );
      });
    </script>
    <!-- //dropdown nav -->
    <script src="<?php echo ASSETS_URL; ?>/web/js/move-top.js"></script>
    <script src="<?php echo ASSETS_URL; ?>/web/js/easing.js"></script>
    <script>
      jQuery(document).ready(function($) {
        $(".scroll").click(function(event) {
          event.preventDefault();
          $("html,body").animate({
              scrollTop: $(this.hash).offset().top,
            },
            500
          );
        });
      });
    </script>
    <script>
      $(document).ready(function() {
        var defaults = {
          containerID: 'toTop', // fading element id
          containerHoverID: 'toTopHover', // fading element hover id
          scrollSpeed: 1200,
          easingType: 'linear'
        };
        $().UItoTop({
          easingType: "easeOutQuart",
        });
      });
    </script>
    <!--// end-smoth-scrolling -->

    <script src="<?php echo ASSETS_URL; ?>/web/js/bootstrap.js"></script>
    <!-- js file -->

    <script>
      function Databar(data) {
        databar = document.getElementById("" + data + "");
        if (databar.style.display === "block") {
          databar.style.display = "none";
        } else {
          databar.style.display = "block";
        }
      }
    </script>

    <script>
      function AuthAccess() {
        var SignupArea = document.getElementById("SignupArea");
        var LoginArea = document.getElementById("LoginArea");
        if (LoginArea.style.display === "none") {
          LoginArea.style.display = "block";
          SignupArea.style.display = "none";
        } else {
          LoginArea.style.display = "none";
          SignupArea.style.display = "block";
        }
      }
    </script>
    <script>
      function checkpass() {
        var pass1 = document.getElementById("pass1");
        var pass2 = document.getElementById("pass2");
        if (pass1.value === "") {

        } else {
          if (pass1.value === pass2.value) {
            document.getElementById("passbtn").classList.remove("disabled");
            document.getElementById("passmsg").classList.add("text-success");
            document.getElementById("passmsg").classList.remove("text-danger");
            document.getElementById("passmsg").innerHTML = "<i class='fa fa-check-circle-o'></i> Password Matched!";
          } else {
            document.getElementById("passmsg").classList.remove("text-success");
            document.getElementById("passmsg").classList.add("text-danger");
            document.getElementById("passbtn").classList.add("disabled");
            document.getElementById("passmsg").innerHTML = "<i class='fa fa-warning'></i> Password do not matched!";
          }
        }
      }
    </script>
  <?php } else { ?>
    <div class="slider w-100 flex-s-b">
      <img id="sliderImage" onclick="nextSlide()" class='img-fluid w-100 no-round img-bdr ' src="" alt="Slider Image">
    </div>


    <section class="container">
      <div class="row">
        <div class="col-md-12">
          <h5 class="pt-3 bold"><?php echo $ProductName; ?></h5>
          <p class="text-secondary"><?php echo $ProCategoryName; ?></p>
          <p class="flex-s-b">
            <span class="btn btn-sm app-bg w-50"><i class='fa fa-analytics'></i> <?php echo $ProductWeight; ?></span>
            <span class="btn btn-sm app-bg w-50 ml-1 mr-1"><i class='fa fa-analytics'></i> <?php echo $ProductLocation; ?></span>
            <span class="btn btn-sm app-bg w-50"><i class='fa fa-analytics'></i> <?php echo $ProductMedium; ?></span>
          </p>
          <p class="small">
            <i class="fa fa-check text-danger"></i> Item Code: <?php echo $ProductRefernceCode; ?><br>
            <i class='fa fa-check text-danger'></i> Gauranteed Freshness <br>
            <i class='fa fa-check text-danger'></i> Quality non-veg food provider
          </p>
        </div>

        <div class="col-md-12">
          <div class="bg-white">
            <div class="flex-s-b">
              <div>
                <p class="mb-0">
                  <span class="bold app-text h4 mr-1">Rs.<?php echo $ProductSellPrice; ?></span>
                  <strike class='text-secondary mr-1'>Rs.<?php echo $ProductMrpPrice; ?></strike>
                  <span class="text-success"><?php echo 100 - round($ProductSellPrice / $ProductMrpPrice * 100); ?>% Off</span>
                </p>
              </div>
              <div>
                <?php if (isset($_GET['continue'])) {
                ?>
                  <form class='pull-right'>
                    <button class="btn btn-sm btn-danger h4"><i class="fa fa-minus"></i></button>
                    <span class="btn btn-sm btn-default h4 bold shadow-sm pl-3 pr-3">1</span>
                    <button name='continue' class="btn btn-sm btn-danger h4"><i class="fa fa-plus"></i></button>
                  </form>
                <?php
                } else {
                ?>
                  <form action="<?php echo CONTROLLER; ?>/ordercontroller.php" method="POST" class='pull-right'>
                    <?php FormPrimaryInputs(true); ?>
                    <input type="hidden" name="CartProductId" value="<?php echo SECURE($ProductId, "e"); ?>">
                    <input type="hidden" name="CartProductSellPrice" id="sellprice1" value="<?php echo $ProductSellPrice; ?>">
                    <input type="hidden" name="CartProductMrpPrice" id="mrpprice1" value="<?php echo $ProductMrpPrice; ?>">
                    <input type="hidden" name="CartProductWeight" value="<?php echo $ProductWeight; ?>">
                    <input type="hidden" name="CartProductQty" value="1" id="qtyinput">
                    <input type="hidden" name="CartFinalPrice" id="netprice1" value="<?php echo $ProductSellPrice; ?>">
                    <input type="hidden" name="CartDeviceInfo" value="<?php echo SECURE(SYSTEM_INFO, "e"); ?>">
                    <input type="hidden" name="CartItemDescriptions" id="cart-item-desc" value="<?php echo $CartItemDescriptions; ?>">
                    <button name="AddItemsToCart" type="submit" class="btn btn-sm btn-danger">
                      Add <i class="fa fa-plus"></i>
                    </button>
                  </form>
                <?php
                } ?>
              </div>
            </div>
          </div>
        </div>

        <div class="col-md-12">
          <h5 class="bold small mt-3">More Info:</h5>
          <hr>
        </div>
        <div class="pro-intro">
          <h2>Introduction:</h2>
          <?php echo SECURE($ProductDescriptions, "d"); ?>

        </div>
      </div>
    </section>

    <section class='container'>
      <div class='row'>
        <div class='col-md-12 text-left mt-2 mb-3'>
          <h4 class='mb-0'>Similar Items</h4>
          <small class='mt-0 text-secondary mb-3 small'><span class='small'>most popular items near by you</span></small>
        </div>
      </div>

      <div class='row'>
        <div class="col-md-12">
          <div class="trending-item">
            <?php
            $SQLproducts = SELECT("SELECT * FROM products, pro_categories, pro_sub_categories where ProductId!='$ProductId' and ProductCategoryId='$ProductCategoryId' and products.ProductCategoryId=pro_categories.ProCategoriesId and products.ProductSubCategoryId=pro_sub_categories.ProSubCategoriesId  ORDER BY products.ProductId DESC limit 1, 10");
            //product fetch loops
            while ($fetchpro_brands = mysqli_fetch_array($SQLproducts)) {
              $ProductName = $fetchpro_brands['ProductName'];
              $ProCategoryName = $fetchpro_brands['ProCategoryName'];
              $ProSubCategoryName = $fetchpro_brands['ProSubCategoryName'];
              $ProductRefernceCode = $fetchpro_brands['ProductRefernceCode'];
              $ProductImage = $fetchpro_brands['ProductImage'];
              $ProductCategoryId = $fetchpro_brands['ProductCategoryId'];
              $ProductSubCategoryId = $fetchpro_brands['ProductSubCategoryId'];
              $ProductSellPrice = $fetchpro_brands['ProductSellPrice'];
              $ProductMrpPrice = $fetchpro_brands['ProductMrpPrice'];
              $ProductDescriptions = SECURE($fetchpro_brands['ProductDescriptions'], "e");
              $ProductWeight = $fetchpro_brands['ProductWeight'];
              $ProductStatus = StatusViewWithText($fetchpro_brands['ProductStatus']);
              $ProductCreatedAt = $fetchpro_brands['ProductCreatedAt'];
              $ProductUpdatedAt = ReturnValue($fetchpro_brands['ProductUpdatedAt']);
              $ProductCreatedBy = $fetchpro_brands['ProductCreatedBy'];
              $ProductId = $fetchpro_brands['ProductId'];
              $ProductAvailibility = $fetchpro_brands['ProductStatus'];
              $ProductImage2 = $fetchpro_brands['ProductImage2'];
              $ProductSize = $fetchpro_brands['ProductSize'];
              $ProductMedium = $fetchpro_brands['ProductMedium'];
              $ProductLocation = $fetchpro_brands['ProductLocation'];
              $CartItemDescriptions = "$ProCategoryName - $ProSubCategoryName - $ProductRefernceCode - $ProductWeight - $ProductLocation - $ProductMedium";

            ?>
              <div class='item' style='display:block;'>
                <div class='w-100 bx-sh p-1'>
                  <a href="<?php echo DOMAIN; ?>/web/products/details/?productid=<?php echo SECURE($ProductId, "e"); ?>">
                    <img src=' <?php echo STORAGE_URL; ?>/products/pro-img/<?php echo $ProductImage; ?>' class='img-fluid w-100'>
                  </a>
                  <div class='p-1'>
                    <a href="<?php echo DOMAIN; ?>/web/products/details/?productid=<?php echo SECURE($ProductId, "e"); ?>">
                      <h6 class="app-text"><?php echo $ProductName; ?></h6>
                      <p>
                        <span class="text-dark"><?php echo $ProCategoryName; ?></span><br>
                        <span class="text-secondary"><?php echo $ProductWeight; ?></span> |
                        <span class="text-secondary"><?php echo $ProductLocation; ?></span>|
                        <span class="text-secondary"><?php echo $ProductMedium; ?></span>
                      </p>
                    </a>
                    <form action="<?php echo CONTROLLER; ?>/ordercontroller.php" method="POST" class=' pull-right'>
                      <?php FormPrimaryInputs(true); ?>
                      <input type="hidden" name="CartProductId" value="<?php echo SECURE($ProductId, "e"); ?>">
                      <input type="hidden" name="CartProductSellPrice" id="sellprice1" value="<?php echo $ProductSellPrice; ?>">
                      <input type="hidden" name="CartProductMrpPrice" id="mrpprice1" value="<?php echo $ProductMrpPrice; ?>">
                      <input type="hidden" name="CartProductWeight" value="<?php echo $ProductWeight; ?>">
                      <input type="hidden" name="CartProductQty" value="1" id="qtyinput">
                      <input type="hidden" name="CartFinalPrice" id="netprice1" value="<?php echo $ProductSellPrice; ?>">
                      <input type="hidden" name="CartDeviceInfo" value="<?php echo SECURE(SYSTEM_INFO, "e"); ?>">
                      <input type="hidden" name="CartItemDescriptions" id="cart-item-desc" value="<?php echo $CartItemDescriptions; ?>">
                      <button name="AddItemsToCart" type="submit" class="btn btn-sm btn-danger">
                        <i class="fa fa-plus"></i>
                      </button>
                    </form>
                    <a class='price'>Rs.<?php echo $ProductSellPrice; ?> <span class='mrp'>Rs.<?php echo $ProductMrpPrice; ?></span></a>
                  </div>
                </div>
              </div>
            <?php
            } ?>
          </div>
        </div>
      </div>
    </section>
    <br><br><br><br><br><br><br><br><br>

    <script>
      var images = [
        "<?php echo STORAGE_URL; ?>/products/pro-img/<?php echo $ProductImage; ?>",
        "<?php echo STORAGE_URL; ?>/products/pro-img/<?php echo $ProductImage2; ?>",
        <?php
        $CheckImages = FetchConvertIntoArray("SELECT * FROM pro_images where ProImageProductId='$ProductId' ORDER BY ProImagesId DESC", true);
        if ($CheckImages != null) {
          foreach ($CheckImages as $Data) { ?> "<?php echo STORAGE_URL; ?>/products/pro-img/<?php echo $Data->ProImageProductId; ?>/<?php echo $Data->ProImageName; ?>",
        <?php }
        } ?>
      ];
      var currentSlide = 0;

      function showSlide() {
        var sliderImage = document.getElementById("sliderImage");
        sliderImage.src = images[currentSlide];
      }

      function prevSlide() {
        currentSlide--;
        if (currentSlide < 0) {
          currentSlide = images.length - 1;
        }
        showSlide();
      }

      function nextSlide() {
        currentSlide++;
        if (currentSlide >= images.length) {
          currentSlide = 0;
        }
        showSlide();
      }
      setInterval(nextSlide, 2500);
      showSlide();
    </script>
  <?php
    include "../../../include/web/header.php";
  } ?>
</body>

</html>