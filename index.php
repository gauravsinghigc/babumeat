<?php
//require modules;
require 'require/modules.php';
require 'require/web-modules.php';

$VisitorsIP = IP_ADDRESS;
$VisitorDeviceType = DEVICE_TYPE;
$VisitorDeviceDetails = SECURE(SYSTEM_INFO, "e");
$VisitorVisitingDate = date("d-m-Y");
if (isset($_SESSION['LOGIN_CustomerId'])) {
  $VisitorCustomerId = $_SESSION['LOGIN_CustomerId'];
} else {
  $VisitorCustomerId = 0;
}

//check visitors type 
$VisitorIsComing = CHECK("SELECT * FROM visitors where VisitorsIP='$VisitorsIP'");
if ($VisitorIsComing == null) {
  $VisitorsType = "New";
} else {
  $VisitorsType = "Re-visits";
}

$SAVE = SAVE("visitors", ["VisitorsIP", "VisitorDeviceType", "VisitorsType", "VisitorDeviceDetails", "VisitorVisitingDate", "VisitorCustomerId"], false);


?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>Home : <?php echo APP_NAME; ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=0.9">
  <meta charset="utf-8">
  <meta name="keywords" content="" />
  <script>
    addEventListener("load", function() {
      setTimeout(hideURLbar, 0);
    }, false);

    function hideURLbar() {
      window.scrollTo(0, 1);
    }
  </script>
  <?php include 'include/web/header_files.php'; ?>
  <script>
    window.onload = function() {
      document.getElementById("home").classList.add("active");
    }
  </script>
</head>

<body>
  <?php include "include/web/header.php";
  if (DEVICE_TYPE == "Computer") { ?>
    <loader id="loader">
      <img src="<?php echo STORAGE_URL_D; ?>/tool-img/loader.gif" class="img-fluid">
    </loader>
    <section class="banner-bottom-wthreelayouts py-lg-4">
      <div class="container">
        <div class="inner-sec-shop px-lg-4 px-3">
          <h3 class="tittle-w3layouts my-lg-3 my-4 toptitle">Shop by categories</h3>
          <div class="row">
            <?php
            $FetchCategories = FetchConvertIntoArray("SELECT * FROM pro_categories where ProCategoryStatus='1' ORDER BY ProCategoriesId DESC Limit 0, 8", true);
            if ($FetchCategories !=  null) {
              foreach ($FetchCategories as $Data) {
                include 'include/web/section/common/category-tab.php';
              }
            } ?>
          </div>
          <?php $CountCategories = TOTAL("SELECT * FROM pro_categories where ProCategoryStatus='1'");
          if ($CountCategories >= 8) { ?>
            <div class="col-md-12 text-center">
              <a href="<?php echo DOMAIN; ?>/web/collection/" class="app-text view-more">View More <i class="fas fa-angle-right"></i></a>
            </div>
          <?php } ?>
        </div>
      </div>
    </section>

    <?php
    $FetchListings = FetchConvertIntoArray("SELECT * FROM offers where OfferStatus='1' ORDER BY OffersId ASC", true);
    if ($FetchListings != null) {
      $Sno = 0; ?>
      <section class="welcome-offer" style="display:none;" id="offerbox">
        <div class="content-box">
          <a href="#" onclick="Databar('offerbox')"><i class="fa fa-times"></i></a>
          <?php foreach ($FetchListings as $Fields) {
            $Sno++;
            if ($Fields->OfferDiscountType == "Percentage") {
              $OfferDiscountValue = "" . $Fields->OfferDiscountValue . "%";
            } else {
              $OfferDiscountValue = "Rs. " . $Fields->OfferDiscountValue;
            } ?>
            <img loading="lazy" src="<?php echo STORAGE_URL; ?>/offers/<?php echo $Fields->OfferImage; ?>" class="img-fluid">
          <?php } ?>
        </div>
      </section>
    <?php } ?>

    <?php include 'include/web/footer.php'; ?>
    <script>
      setTimeout(function() {
        document.getElementById("offerbox").style.display = "block";
      }, 5000); //run this after 5 seconds
    </script>
    <script>
      window.onload = function() {
        document.getElementById("loader").style.display = "none";
      };
    </script>

    <!-- // modal -->
    <?php include 'include/web/footer_files.php'; ?>

  <?php } else {
    if (!isset($_SESSION['LOGIN_CustomerId'])) {
      header("location: auth/web/");
    } ?>
    <section class="container">
      <div class="row">
        <div class="col-12 mt-3">
          <div class='user-d'>
            <?php if (isset($_SESSION['LOGIN_CustomerId'])) { ?>
              <a href="<?php echo WEB_URL; ?>/account/">
                <span class="flex-s-b">
                  <span class="p-2"><i class="fa fa-user"></i></span>
                  <span class="p-2 text-left w-100">
                    <span class="sal">Hey,</span><br>
                    <span class='name'><?php echo LOGIN_CustomerName; ?> <i class="fa fa-angle-down"></i></span>
                  </span>
                </span>
              </a>
            <?php } else { ?>
              <a href="<?php echo DOMAIN; ?>/auth/web/">
                <span class="flex-s-b">
                  <span class="p-2"><i class="fa fa-user"></i></span>
                  <span class="p-2 text-left w-100">
                    <span class="sal"><?php echo APP_NAME; ?></span><br>
                    <span class='name'>Login <i class="fa fa-sign-in"></i></span>
                  </span>
                </span>
              </a>
            <?php  } ?>
          </div>
        </div>
      </div>
    </section>

    <section class="container">
      <div class='row'>
        <div class='col-md-12'>
          <form class="mt-3">
            <input type='search' placeholder="Search Chicken, meat, fish, egg...." class='form-control form-control-md'>
          </form>
        </div>
      </div>
    </section>

    <section class="container">
      <div class="row">
        <div class='col-md-12 mt-3'>
          <div class="slider w-100 flex-s-b">
            <img id="sliderImage" onclick="nextSlide()" class='img-fluid w-100 img-bdr' src="" alt="Slider Image">
          </div>
        </div>
      </div>
    </section>

    <section class='container mb-2'>
      <div class='row'>
        <div class='col-md-12 text-left mt-4 mb-3'>
          <h4 class='mb-0'>Shop by categories</h4>
          <small class='mt-0 text-secondary mb-3 small'><span class='small'>Fresh meat and much more</span></small>
        </div>
      </div>

      <div class='row'>
        <?php
        $FetchCategories = FetchConvertIntoArray("SELECT * FROM pro_categories where ProCategoryStatus='1' ORDER BY ProCategoriesId DESC Limit 0, 8", true);
        if ($FetchCategories !=  null) {
          foreach ($FetchCategories as $Data) {
        ?>
            <div class="col-xs-4 col-4 text-center col-sm-4 mb-4">
              <a href="<?php echo DOMAIN; ?>/web/products/?categoryid=<?php echo SECURE($Data->ProCategoriesId, "e"); ?>">
                <div class="w-100 p-1">
                  <img loading="lazy" src="<?php echo STORAGE_URL; ?>/products/category/<?php echo $Data->ProCategoryImage; ?>" class="img-fluid img-bdr">
                  <a class='cat-name'><?php echo $Data->ProCategoryName;  ?></a>
                </div>
              </a>
            </div>
        <?php
          }
        } ?>
      </div>
    </section>

    <section class='container'>
      <div class='row'>
        <div class='col-md-12 text-left mt-2 mb-3'>
          <h4 class='mb-0'>Trending Items</h4>
          <small class='mt-0 text-secondary mb-3 small'><span class='small'>most popular items near by you</span></small>
        </div>
      </div>

      <div class='row'>
        <div class="col-md-12">
          <div class="trending-item">
            <?php
            $SQLproducts = SELECT("SELECT * FROM products, pro_categories, pro_sub_categories where products.ProductCategoryId=pro_categories.ProCategoriesId and products.ProductSubCategoryId=pro_sub_categories.ProSubCategoriesId  ORDER BY products.ProductId DESC limit 1, 10");
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
    <br><br><br><br><br><br>
    <script>
      window.onload = function() {
        document.getElementById("home").classList.add("active");
      }
    </script>
    <script>
      var images = [
        <?php
        $FetchSliders = FetchConvertIntoArray("SELECT * FROM sliders ORDER BY SliderId ASC", true);
        if ($FetchSliders != null) {
          foreach ($FetchSliders as $data) {  ?> "<?php echo STORAGE_URL; ?>/sliders/<?php echo $data->SliderImage; ?>",
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

      showSlide();
    </script>

  <?php } ?>
</body>

</html>