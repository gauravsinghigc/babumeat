<?php
//require modules;
require '../../../require/modules.php';
require '../../../require/web-modules.php';

if (isset($_GET['wallpaperid'])) {
  $WallPapersId = SECURE($_GET['wallpaperid'], "d");
  $_SESSION['WallPapersId'] = $WallPapersId;
} else {
  $WallPapersId = $_SESSION['WallPapersId'];
}

$PageSqls = "SELECT * FROM wallpapers where WallPapersId='$WallPapersId'";
$ImageSql = "SELECT * FROM wallpaper_images where WallPaperMainId='$WallPapersId' ORDER BY WallPaperImagesId DESC";

$StandardSql = "SELECT * FROM wallpaper_customise_options where WallPaperCustomOptionType='STANDARD'";
$CustomSql = "SELECT * FROM wallpaper_customise_options where WallPaperCustomOptionType='CUSTOM'";
$SampleSql = "SELECT * FROM wallpaper_customise_options where WallPaperCustomOptionType='SAMPLE'";

?>

<!DOCTYPE html>
<html lang="zxx">

<head>
  <title><?php echo FETCH($PageSqls, "WallPaperName"); ?> | Wallpapers</title>
  <meta name="viewport" content="width=device-width, initial-scale=0.9">
  <meta charset="utf-8">
  <meta name="keywords" content="" />
  <link href="<?php echo ASSETS_URL; ?>/web/css/bootstrap.css" rel="stylesheet" type="text/css" />
  <link href="<?php echo ASSETS_URL; ?>/web/css/login_overlay.css" rel="stylesheet" type="text/css" />
  <link href="<?php echo ASSETS_URL; ?>/web/css/style6.css" rel="stylesheet" type="text/css" />
  <link rel="stylesheet" href="<?php echo ASSETS_URL; ?>/web/css/shop.css" type="text/css" />
  <link rel="stylesheet" href="<?php echo ASSETS_URL; ?>/web/css/owl.carousel.css" type="text/css" media="all" />
  <link rel="stylesheet" href="<?php echo ASSETS_URL; ?>/web/css/owl.theme.css" type="text/css" media="all" />
  <link rel="stylesheet" type="text/css" href="<?php echo ASSETS_URL; ?>/web/css/jquery-ui1.css" />
  <link href="<?php echo ASSETS_URL; ?>/web/css/easy-responsive-tabs.css" rel="stylesheet" type="text/css" />
  <link rel="stylesheet" href="<?php echo ASSETS_URL; ?>/web/css/flexslider.css" type="text/css" media="screen" />
  <link href="<?php echo ASSETS_URL; ?>/web/css/style.css" rel="stylesheet" type="text/css" />
  <link href="<?php echo ASSETS_URL; ?>/web/css/app.css" rel="stylesheet" type="text/css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
</head>

<body>
  <loader id="loader" style="display:none;">
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
                  <?php
                  //check images and update images
                  $CheckImages = FetchConvertIntoArray($ImageSql, true);
                  if ($CheckImages != null) {
                    foreach ($CheckImages as $Data) { ?>
                      <li data-thumb="<?php echo STORAGE_URL; ?>/wallpapers/pro-img/<?php echo $WallPapersId; ?>/<?php echo $Data->WallPaperImageFile; ?>">
                        <a href="#" onclick="Databar('zoomview')">
                          <div class="thumb-image"> <img src="<?php echo STORAGE_URL; ?>/wallpapers/pro-img/<?php echo $WallPapersId; ?>/<?php echo $Data->WallPaperImageFile; ?>" data-imagezoom="true" class="img-fluid" alt=" "> </div>
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
              <img loading="lazy" src="<?php echo STORAGE_URL; ?>/wallpapers/pro-img/<?php echo $WallPapersId; ?>/<?php echo $Data->WallPaperImageFile; ?>" id="zoomingimg">
            </div>
            <center>
              <ul class="product-image-zoom-img-list" style="display:none;">
                <li>
                  <a href="#">
                    <img loading="lazy" id="1" src="<?php echo STORAGE_URL; ?>/wallpapers/pro-img/<?php echo $WallPapersId; ?>/<?php echo $Data->WallPaperImageFile; ?>" class="img-fluid">
                  </a>
                </li>
                <li>
                  <a href="#">
                    <img loading="lazy" id="2" src="<?php echo STORAGE_URL; ?>/wallpapers/pro-img/<?php echo $WallPapersId; ?>/<?php echo $Data->WallPaperImageFile; ?>" class="img-fluid">
                  </a>
                </li>
                <?php
                //check images and update images
                $CheckImages = FetchConvertIntoArray($ImageSql, true);
                $TotalImages = TOTAL($ImageSql);
                if ($CheckImages != null) {
                  $ImageIds = 2;
                  foreach ($CheckImages as $Data) {
                    $ImageIds++; ?>
                    <li>
                      <a href="#">
                        <img loading="lazy" id="<?php echo $ImageIds; ?>" src="<?php echo STORAGE_URL; ?>/wallpapers/pro-img/<?php echo $WallPapersId; ?>/<?php echo $Data->WallPaperImageFile; ?>" class="img-fluid">
                      </a>
                    </li>
                <?php
                  }
                } ?>
              </ul>
            </center>
            <div class="img-actions placeholder">
              <img loading="lazy" src="<?php echo STORAGE_URL; ?>/<?php echo $WallPapersId; ?>/<?php echo $Data->WallPaperImageFile; ?>" id="previousimg">
              <img loading="lazy" src="<?php echo STORAGE_URL; ?>/<?php echo $WallPapersId; ?>/<?php echo $Data->WallPaperImageFile; ?>" id="nextimg">
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
            <h3><?php echo FETCH($PageSqls, "WallPaperName"); ?></h3>
            <p class="provider-name"> <?php echo FETCH("SELECT * FROM wallpaper_category where WallPaperCategoryId='" . FETCH($PageSqls, "WallPaperCategoryId") . "'", "WallPaperCategoryName"); ?> |
              <?php echo FETCH("SELECT * FROM wallpaper_brands where WallPaperBrandId='" . FETCH($PageSqls, "WallPaperBrandId") . "'", "WallPaperBrandName"); ?></p>
            <p>
              <?php
              if (FETCH($PageSqls, "WallPaperStartPrice") == null || FETCH($PageSqls, "WallPaperStartPrice") == 0) { ?>
                <a href="https://wa.me/<?php echo PRIMARY_PHONE; ?>?text=Hello <?php echo APP_NAME; ?>, I want to know the price and details of <?php echo FETCH($PageSqls, "WallPaperName"); ?> having Item Code : *<?php echo $ProductRefernceCode; ?>*. Item link is : <?php echo RUNNING_URL; ?>" target="_blank" class="btn btn-sm app-btn mt-2 mb-1"> Request Price <i class='fa fa-whatsapp text-success'></i></a>
                <br>
              <?php } else { ?>
                <span class="item_price"><span id="d_price"><?php echo Price($Defaultprice = (int)FETCH($StandardSql, "WallPaperCustomOptionPrice") + (int)FETCH("SELECT * FROM wallpaper_paper_options order by WallPaperPaperPrice ASC limit 1", "WallPaperPaperPrice")); ?></span></span>
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
                    <td class="text-info"><i class="fa fa-hashtag"></i> <?php echo FETCH($PageSqls, "WallPaperCode"); ?></td>
                  </tr>
                  <tr>
                    <th>WallPaper Name</th>
                    <td><?php echo FETCH($PageSqls, "WallPaperName"); ?></td>
                  </tr>
                </table>
              </div>
            </div>

            <div class="row">
              <div class="col-md-12">
                <h5 class="p-2 pl-0 section-headings">Select WallPaper Size</h5>
              </div>
              <div class="col-md-12">
                <div class="flex-s-b wallpaper-options">
                  <button class="active" onclick="GetOptions('standard')">
                    <img src="<?php echo STORAGE_URL_D; ?>/tool-img/roll.jpg" loading="lazy" class="w-25"><br>
                    <span>Standard Rolls</span>
                  </button>
                  <button onclick="GetOptions('custom')">
                    <img src="<?php echo STORAGE_URL_D; ?>/tool-img/custom-size.png" loading="lazy" class="w-75"><br>
                    <span>Custom Size</span>
                  </button>
                  <button onclick="GetOptions('sample')">
                    <img src="<?php echo STORAGE_URL_D; ?>/tool-img/a4.png" loading="lazy" class="w-75"><br>
                    <span>A4 Sample Roll</span>
                  </button>
                </div>
              </div>
            </div>

            <div class="row">
              <div id="standard">
                <div class="col-md-12">
                  <h4 class="mt-3">Standard Rolls</h4>
                  <br>
                  <label class="std-rolls" for="standardroll">
                    <input class="form-control" type="radio" name="standardroll" id="standardroll" value="radio1" checked>
                    <span class=""><b><?php echo FETCH($StandardSql, "WallPaperCustomOptionName"); ?> </b>: <?php echo FETCH($StandardSql, "WallPaperCustomOptionSize"); ?> @ Rs.<?php echo FETCH($StandardSql, "WallPaperCustomOptionPrice"); ?>
                    </span>
                  </label>
                  <p class="text-grey" style="color:grey !important;">
                    <span class="text-grey"><?php echo SECURE(FETCH($StandardSql, "WallPaperCustomOptionDesc"), "d"); ?></span>
                  </p>
                </div>
              </div>

              <div id="custom" style="display:none;">
                <div class="col-md-12">
                  <h4 class="mt-3">Custom Size</h4>

                  <div class="row mb-2">
                    <div class="col-md-5">
                      <h5 class="p-2">Width (in)</h5>
                    </div>
                    <div class="col-md-7">
                      <input type="number" oninput="CalculateCustomPrice()" id="width" value="1" min="1" class="form-control">
                    </div>
                  </div>

                  <div class="row mb-2">
                    <div class="col-md-5">
                      <h5 class="p-2">Height (in)</h5>
                    </div>
                    <div class="col-md-7">
                      <input type="number" oninput="CalculateCustomPrice()" min="1" value="1" id="height" class="form-control">
                    </div>
                  </div>

                  <div class="row mb-2">
                    <div class="col-md-5">
                      <h5 class="p-2">Area (sq ft)</h5>
                    </div>
                    <div class="col-md-7">
                      <input type="number" min="1" value="1" id="area" readonly="" class="form-control">
                    </div>
                  </div>


                  <div class="row mb-2">
                    <div class="col-md-5">
                      <h5 class="p-2">Custom Role Cost</h5>
                    </div>
                    <div class="col-md-7">
                      <input type="hidden" id="customcost" value="<?php echo $customsize = FETCH($CustomSql, "WallPaperCustomOptionPrice"); ?>" readonly="" class="form-control">
                      <h5>
                        <span id="widhthtml">1</span>
                        <span>x</span>
                        <span id="heighthtml">1</span>
                        <span>=</span>
                        <span id="areahtml">1</span> sq. ft.
                        <span id='customcosthtml'><br><?php echo Price(FETCH($CustomSql, "WallPaperCustomOptionPrice"), "text-success"); ?></span>
                      </h5>
                    </div>
                  </div>

                  <div class="row mb-2">
                    <div class="col-md-5">
                      <h5 class="p-2">Resizing Fees (Rs.)</h5>
                    </div>
                    <div class="col-md-7">
                      <input type="hidden" id="resizingfee" value="<?php echo (int)CONFIG("RESIZING_FEE"); ?>" readonly="" class="form-control">
                      <h5 id='resizingfeehtml'>+<?php echo Price(CONFIG("RESIZING_FEE"), "text-success"); ?></h5>
                    </div>
                  </div>

                  <div class="row mb-2">
                    <div class="col-md-5">
                      <h5 class="p-2">Total WallPaper Cost</h5>
                    </div>
                    <div class="col-md-7">
                      <input type="hidden" id="finalprice" value="0" readonly="" class="form-control">
                      <h4 id='finalpricehtml' class='app-text'>Rs.<?php echo (int)$customsize + (int)CONFIG("RESIZING_FEE"); ?></h4>
                    </div>
                  </div>



                </div>
              </div>

              <div id="sample" style="display:none;">
                <div class="col-md-12">
                  <h4 class="mt-3">A4 Sample Rolls</h4>
                  <br>
                  <label class="std-rolls" for="a4sample">
                    <input class="form-control" type="radio" name="sample" id="a4sample" value="radio1" checked>
                    <span class=""><b><?php echo FETCH($SampleSql, "WallPaperCustomOptionName"); ?> </b>: <?php echo FETCH($SampleSql, "WallPaperCustomOptionSize"); ?> @ Rs.<?php echo FETCH($SampleSql, "WallPaperCustomOptionPrice"); ?></span>
                  </label>
                  <p class="text-grey" style="color:grey !important;">
                    <span class="text-grey"><?php echo SECURE(FETCH($SampleSql, "WallPaperCustomOptionDesc"), "d"); ?></span>
                  </p>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-12">
                <h5 class="p-2 pl-0 section-headings">Select Paper Type</h5>
              </div>
              <div class="col-md-12 paper-options">
                <?php
                $GetPapers = FetchConvertIntoArray("SELECT * FROM wallpaper_paper_options order by WallPaperPaperPrice ASC", true);
                if ($GetPapers != null) {
                  $sno = 0;
                  foreach ($GetPapers as $Papers) {
                    $sno++;
                    if ($sno == 1) {
                      $checked = "checked";
                    } else {
                      $checked = "";
                    }
                ?>
                    <div class="flex-s-b">
                      <label for="paper_<?php echo $sno; ?>" onclick="PaperOptions('<?php echo strtoupper($Papers->WallPaperPaperName); ?>', '<?php echo $Papers->WallPaperPaperPrice; ?>');">
                        <input class="form-control w-25" type="radio" name="paper_type" id="paper_<?php echo $sno; ?>" value="<?php echo strtoupper($Papers->WallPaperPaperName); ?>" <?php echo $checked; ?>>
                        <span class="w-50"><?php echo strtoupper($Papers->WallPaperPaperName); ?> @ <?php echo Price($Papers->WallPaperPaperPrice); ?></span>
                        <img src="<?php echo STORAGE_URL; ?>/wallpapers/paper-options/<?php echo $Papers->WallPaperImage; ?>">
                      </label>
                    </div>
                <?php
                  }
                } ?>
              </div>
            </div>


            <div class="color-quality">
              <div class="color-quality-right">
                <h5 class="p-2 pl-0 section-headings">Quantity :</h5>
                <div class="flex-s-b">
                  <div class="item-quantity-button">
                    <button type="button" id="increase" onclick="Increase()"><i class="fa fa-plus"></i></button>
                    <input type="number" id="qty" min="<?php echo MIN_ORDER_QTY; ?>" VALUE="1" max="<?php echo MAX_ORDER_QTY; ?>">
                    <button type="button" id="decrease" onclick="Decrease()"><i class="fa fa-minus"></i></button>
                  </div>
                  <div class="occasion-cart">
                    <div class="googles single-item singlepage">
                      <form action="<?php echo CONTROLLER; ?>/ordercontroller.php" method="post">
                        <?php FormPrimaryInputs(true); ?>
                        <input type="hidden" name="CartProductId" value="<?php echo SECURE($WallPapersId, "e"); ?>">
                        <input type="hidden" name="CartProductSellPrice" id="sellprice1" value="<?php echo $Defaultprice; ?>">
                        <input type="hidden" name="CartProductMrpPrice" id="mrpprice1" value="<?php echo (int)$Defaultprice * 1.5; ?>">
                        <input type="hidden" name="CartProductWeight" id="wallpapercustomtype" value="STANDARD">
                        <input type="hidden" name="CartProductQty" value="1" id="qtyinput">
                        <input type="hidden" name="CartFinalPrice" id="netprice1" value="<?php echo $Defaultprice; ?>">
                        <input type="hidden" name="CartDeviceInfo" value="<?php echo SECURE(SYSTEM_INFO, "e"); ?>">
                        <input type="hidden" name="CartItemDescriptions" id="cartitemdesc" class="form-control w-100" value="WALLPAPER DETAILS: STANDARD Size of <?php echo FETCH($StandardSql, "WallPaperCustomOptionSize"); ?>(WxH) inch on <?php echo FETCH("SELECT * FROM wallpaper_paper_options order by WallPaperPaperPrice ASC limit 1", "WallPaperPaperName"); ?> ">
                        <button name="AddItemsToCart" type="submit" class="googles-cart pgoogles-cart mt-0" style="margin-top:0px !important;">
                          Add to Cart
                        </button>
                      </form>
                    </div>
                  </div>
                </div>
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

    <div class="container-fluid mt-4">
      <div class="row">
        <div class="col-md-4">
          <h4 class="app-bg text-white p-2">Frequently Asked Questions</h4>
          <br>
          <div class="row m-t-10">
            <?php $Data = FetchConvertIntoArray("SELECT * FROM wallpaper_faqs ORDER BY WallPaperFaqsId DESC", true);
            if ($Data == null) {
              NoData("No FAQ found!");
            } else {
              foreach ($Data as $List) { ?>
                <div class="col-md-12">
                  <div class="shadow-lg">
                    <div class="shadow-lg" style="border-radius:0.5rem !important;">
                      <h6 class="m-b-0 app-sub-heading" onclick="Databar('view_<?php echo $List->WallPaperFaqsId; ?>')"><?php echo $List->WallPaperFaqQuestions; ?>?
                        <i class="fa fa-angle-right pull-right btn-sm btn-dark btn" style="margin-top:-0.3rem !important;"></i>
                      </h6>
                      <div id="view_<?php echo $List->WallPaperFaqsId; ?>" style="display:none;">
                        <p style="font-size:0.75rem;"><?php echo $List->WallPaperFaqAnswer; ?></p>
                      </div>
                    </div>
                  </div>
                  <hr>
                </div>
            <?php
              }
            } ?>
          </div>
        </div>
        <div class="col-md-4">
          <h5 class="app-bg text-white p-2">Product & Care</h5>
          <img src="<?php echo STORAGE_URL_D; ?>/tool-img/product-care.png" class="img-fluid">
          <h5 class="mt-2">Dimensions</h5>
          <p>Each roll covers approximately 60 sq.ft.
            The wallpaper panel is 84 inches x 96 inches (w x h) with bleed margins on all four sides.
          </p>
          <h5>Care</h5>
          <p>We suggest you wipe them clean with a damp cloth.</p>
        </div>
        <div class="col-md-4">
          <h4 class="app-bg text-white p-2">Installation & Shippings</h4>
          <p>
            <?php echo SECURE(CONFIG("INSTALLATION_SHIPPING"), "d"); ?>
          </p>
        </div>
      </div>
    </div>

    <div class="container-fluid">

      <!--/slide-->
      <div class="slider-img mid-sec mt-lg-5 mt-2 px-lg-5 px-3">
        <!--//banner-sec-->
        <h3 class="tittle-w3layouts text-left my-lg-4 my-3">Related WallPapers</h3>
        <div class="mid-slider">
          <div class="owl-carousel owl-theme row">

            <?php
            //fetch conditions
            $fetchWallpapers = FetchConvertIntoArray("SELECT * FROM wallpapers where WallPaperCategoryId='" . FETCH($PageSqls, "WallPaperCategoryId") . "'", true);
            if ($fetchWallpapers != null) {
              foreach ($fetchWallpapers as $WallPapers) {
                $WallPaperImageFile = FETCH("SELECT * FROM wallpaper_images WHERE WallPaperMainId='" . $WallPapers->WallPapersId . "'", "WallPaperImageFile");
            ?>
                <div class="item">
                  <div class="gd-box-info text-center">
                    <div class="product-men women_two bot-gd">
                      <div class="product-googles-info slide-img googles">
                        <div class="men-pro-item">
                          <div class="men-thumb-item">
                            <a href="<?php echo DOMAIN; ?>/web/wallpapers/details/?wallpaperid=<?php echo SECURE($WallPapers->WallPapersId, "e"); ?>">
                              <img loading="lazy" src="<?php echo STORAGE_URL; ?>/wallpapers/pro-img/<?php echo $WallPapers->WallPapersId; ?>/<?php echo $WallPaperImageFile; ?>" alt="<?php echo $WallPapers->WallPaperName; ?>" title="<?php echo $WallPapers->WallPaperName; ?>" class=" img-fluid">
                            </a>
                            <span class="product-new-top">New</span>
                          </div>
                          <div class="item-info-product">

                            <div class="info-product-price">
                              <div class="grid_meta">
                                <div class="product_price">
                                  <a href="<?php echo DOMAIN; ?>/web/wallpapers/details/?wallpaperid=<?php echo SECURE($WallPapers->WallPapersId, "e"); ?>">

                                    <?php
                                    tags(
                                      "h5",
                                      $WallPapers->WallPaperName,
                                      [
                                        "class" => "bold mt-2"
                                      ]
                                    );
                                    tags(
                                      "p",
                                      "" . FETCH("SELECT * FROM wallpaper_category where WallPaperCategoryId='" . $WallPapers->WallPaperCategoryId . "'", "WallPaperCategoryName") . "",
                                      [
                                        "class" => "text-grey"
                                      ]
                                    );
                                    Price($WallPapers->WallPaperStartPrice, "text-danger h4");
                                    ?>
                                  </a>
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
              }
            } ?>

          </div>
        </div>
      </div>
      <!--//slider-->
    </div>
  </section>
  <!--footer -->
  <script type="text/javascript">
    function PaperOptions(name, price) {
      var wallpapercustomtype = document.getElementById("wallpapercustomtype");
      alert("Congratulations!");
      //standard
      if (wallpapercustomtype.value == "STANDARD") {
        var csttype = "STANDARD";
        var cstname = "<?php echo FETCH($StandardSql, "WallPaperCustomOptionName"); ?>";
        var cstprice = "<?php echo FETCH($StandardSql, "WallPaperCustomOptionPrice"); ?>";
        var cstsize = "<?php echo FETCH($StandardSql, "WallPaperCustomOptionSize"); ?>"
        var cstdesc = "<?php echo SECURE(FETCH($StandardSql, "WallPaperCustomOptionDesc"), "d"); ?>";

        //custom
      } else if (wallpapercustomtype.value == "CUSTOM") {

        var csttype = "CUSTOM";
        var cstname = "<?php echo FETCH($CustomSql, "WallPaperCustomOptionName"); ?>";
        var cstprice = document.getElementById("finalprice").value;
        var cstsize = document.getElementById("width").value + "x" + document.getElementById("height").value;
        var cstdesc = "<?php echo SECURE(FETCH($CustomSql, "WallPaperCustomOptionDesc"), "d"); ?>";

        //sample
      } else if (wallpapercustomtype.value == "SAMPLE") {
        var csttype = "SAMPLE";
        var cstname = "<?php echo FETCH($SampleSql, "WallPaperCustomOptionName"); ?>";
        var cstprice = "<?php echo FETCH($SampleSql, "WallPaperCustomOptionPrice"); ?>";
        var cstsize = "<?php echo FETCH($SampleSql, "WallPaperCustomOptionSize"); ?>"
        var cstdesc = "<?php echo SECURE(FETCH($SampleSql, "WallPaperCustomOptionDesc"), "d"); ?>";

        //else
      } else {
        var csttype = "STANDARD";
        var cstname = "<?php echo FETCH($StandardSql, "WallPaperCustomOptionName"); ?>";
        var cstprice = "<?php echo FETCH($StandardSql, "WallPaperCustomOptionPrice"); ?>";
        var cstsize = "<?php echo FETCH($StandardSql, "WallPaperCustomOptionSize"); ?>";
        var cstdesc = "<?php echo SECURE(FETCH($StandardSql, "WallPaperCustomOptionDesc"), "d"); ?>";
      }

      //send respond details
      var cartprice = +price + +cstprice;
      var cartdescriptions = "WALLPAPER DETAILS : " + csttype + "of" + cstsize + " (WxH) inch on " + name;

      document.getElementById("d_price").innerHTML = cartprice;
      document.getElementById("cartitemdesc").value = cartdescriptions;
    }
  </script>

  <?php include '../../../include/web/message.php'; ?>
  <script>
    function CalculateCustomPrice() {

      //inputs
      var width = document.getElementById("width");
      var height = document.getElementById("height");
      var area = document.getElementById("area");
      var customcost = document.getElementById("customcost");
      var resizingfee = document.getElementById("resizingfee");
      var finalprice = document.getElementById("finalprice");

      //html
      var widhthtml = document.getElementById("widhthtml");
      var heighthtml = document.getElementById("heighthtml");
      var areahtml = document.getElementById("areahtml");
      var customcosthtml = document.getElementById("customcosthtml");
      var resizingfeehtml = document.getElementById("resizingfeehtml");
      var finalpricehtml = document.getElementById("finalpricehtml");
      var d_price = document.getElementById("d_price");

      //price variables
      var customizationcost = <?php echo FETCH($CustomSql, "WallPaperCustomOptionPrice"); ?>;
      var customizationfee = <?php echo (int)CONFIG("RESIZING_FEE"); ?>;

      //calculattion
      if (width.value >= 1 || height.value >= 1) {

        //area
        var CalculationOfArea = +width.value * +height.value;
        var CalculationOfArea = Math.round(CalculationOfArea / 144, 2);

        if (CalculationOfArea == 0) {
          CalculationOfArea = 1;
        } else {
          CalculationOfArea = CalculationOfArea;
        }
        area.value = CalculationOfArea;
        widhthtml.innerHTML = width.value;
        heighthtml.innerHTML = height.value;
        areahtml.innerHTML = CalculationOfArea;

        //price
        var materialcost = CalculationOfArea * customizationcost;
        customcosthtml.innerHTML = "<br><span>Rs." + customizationcost + " x " + CalculationOfArea + " = </span>" + "<span class='text-success'>Rs." + materialcost + "</span>";
        var netfinalprice = +materialcost + +customizationfee;
        finalpricehtml.innerHTML = "Rs." + netfinalprice;
        finalprice.value = netfinalprice;
        d_price.innerHTML = "Rs." + netfinalprice;
      } else {

      }
    }
  </script>
  <script>
    function GetOptions(data) {
      if (data == "standard") {
        document.getElementById("standard").style.display = "block";
        document.getElementById("custom").style.display = "none";
        document.getElementById("sample").style.display = "none";

        //get price details
        var stdtype = "STANDARD";
        var stdname = "<?php echo FETCH($StandardSql, "WallPaperCustomOptionName"); ?>";
        var stdprice = "<?php echo FETCH($StandardSql, "WallPaperCustomOptionPrice"); ?>";
        var stdsize = "<?php echo FETCH($StandardSql, "WallPaperCustomOptionSize"); ?>"
        var stddesc = "<?php echo SECURE(FETCH($StandardSql, "WallPaperCustomOptionDesc"), "d"); ?>";
        var d_price = document.getElementById("d_price");
        var papertypeprice = <?php echo FETCH("SELECT * FROM wallpaper_paper_options order by WallPaperPaperPrice ASC limit 1", "WallPaperPaperPrice"); ?>;
        var calculateprice = +papertypeprice + +stdprice;
        d_price.innerHTML = "Rs." + calculateprice;
        document.getElementById("wallpapercustomtype").value = "STANDARD";
      } else if (data == "custom") {
        document.getElementById("custom").style.display = "block";
        document.getElementById("sample").style.display = "none";
        document.getElementById("standard").style.display = "none";
        document.getElementById("wallpapercustomtype").value = "CUSTOM";

      } else if (data == "sample") {
        document.getElementById("custom").style.display = "none";
        document.getElementById("sample").style.display = "block";
        document.getElementById("standard").style.display = "none";

        //get price details
        var stdtype = "SAMPLE";
        var stdname = "<?php echo FETCH($SampleSql, "WallPaperCustomOptionName"); ?>";
        var stdprice = "<?php echo FETCH($SampleSql, "WallPaperCustomOptionPrice"); ?>";
        var stdsize = "<?php echo FETCH($SampleSql, "WallPaperCustomOptionSize"); ?>"
        var stddesc = "<?php echo SECURE(FETCH($SampleSql, "WallPaperCustomOptionDesc"), "d"); ?>";
        var d_price = document.getElementById("d_price");
        var papertypeprice = <?php echo FETCH("SELECT * FROM wallpaper_paper_options order by WallPaperPaperPrice ASC limit 1", "WallPaperPaperPrice"); ?>;
        var calculateprice = +papertypeprice + +stdprice;
        d_price.innerHTML = "Rs." + calculateprice;
        document.getElementById("wallpapercustomtype").value = "SAMPLE";
      } else {
        document.getElementById("custom").style.display = "none";
        document.getElementById("sample").style.display = "none";
        document.getElementById("standard").style.display = "block";
        document.getElementById("wallpapercustomtype").value = "STANDARD";
      }
    }

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
    function GetCartDetails() {
      var getitemqty = document.getElementById("qty").value;
      var cart_item_desc = document.getElementById("cartitemdesc");
      var PaperDesc = document.getElementById("PaperDesc");
      var ColorDesc = document.getElementById("ColorDesc");
      var FrameDesc = document.getElementById("FrameDesc");
      document.getElementById("qtyinput").value = getitemqty;
      document.getElementById("qtyinput2").value = getitemqty;

      cart_item_desc.value = PaperDesc.innerHTML + "" + ColorDesc.innerHTML + "" + FrameDesc.innerHTML;
    }
  </script>
  <script>
    function GetCartDetails2() {
      var getitemqty = document.getElementById("qty").value;
      var cart_item_desc = document.getElementById("cartitemdesc");
      var PaperDesc = document.getElementById("PaperDesc");
      var ColorDesc = document.getElementById("ColorDesc");
      var FrameDesc = document.getElementById("FrameDesc");
      document.getElementById("qtyinput").value = getitemqty;
      document.getElementById("qtyinput2").value = getitemqty;
      cart_item_desc.value = PaperDesc.innerHTML + "" + ColorDesc.innerHTML + "" + FrameDesc.innerHTML;
    }
  </script>
  <script>
    function Increase() {
      var qty = document.getElementById("qty");

      //run increament
      if (qty.value < <?php echo MAX_ORDER_QTY; ?>) {
        qty.value++;
        document.getElementById("qty").value = qty.value;
        document.getElementById("netprice1").value = qty.value * +<?php echo $Defaultprice; ?>;
        document.getElementById("netprice2").value = qty.value * +<?php echo $Defaultprice; ?>;
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
        document.getElementById("netprice1").value = qty.value * +<?php echo $Defaultprice; ?>;
        document.getElementById("netprice2").value = qty.value * +<?php echo $Defaultprice; ?>;
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
        autoplayTimeout: 500,
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

    //scroll acitivity
    window.onscroll = function() {
      myFunction();
    };
    var header2 = document.getElementById("app-top-header");
    var sticky = header2.offsetTop;

    function myFunction() {
      if (window.pageYOffset > sticky) {
        header2.classList.add("fixed-top");
      } else {
        header2.classList.remove("fixed-top");
      }
    }
  </script>

</body>

</html>