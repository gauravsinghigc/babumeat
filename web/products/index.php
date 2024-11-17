<?php
//require modules;
require '../../require/modules.php';
require '../../require/web-modules.php';

//page variable and activity
if (isset($_GET['categoryid'])) {
  $ProCategoriesId = SECURE($_GET['categoryid'], "d");
  $PageName = FETCH("SELECT * FROM pro_categories where ProCategoriesId='$ProCategoriesId'", "ProCategoryName");
  $Pagesubname = "Collection of $PageName by " . APP_NAME;
} elseif (isset($_GET['subcategoryid'])) {
  $ProSubCategoriesId = SECURE($_GET['subcategoryid'], "d");
  $PageName = FETCH("SELECT * FROM pro_sub_categories where ProSubCategoriesId='$ProSubCategoriesId'", "ProSubCategoryName");
  $Pagesubname = "Collection of $PageName by " . APP_NAME;
} else {
  $PageName = "All Food Item Collections";
  $Pagesubname = "Collection of " . APP_NAME;
}

if (isset($_GET['categoryid'])) {
  $ProCategoriesId = SECURE($_GET['categoryid'], "d");
  $_SESSION['ProCategoriesId'] = $ProCategoriesId;
} else {
  $ProCategoriesId = $_SESSION['ProCategoriesId'];
}

if (isset($_GET['subcategoryid'])) {
  $ProSubCategoriesId = SECURE($_GET['subcategoryid'], "d");
}
$CatsQL = "SELECT * FROM pro_categories where ProCategoriesId='$ProCategoriesId'";
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title><?php echo $PageName; ?> By <?php echo APP_NAME; ?></title>
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
  <?php include '../../include/web/header_files.php'; ?>
</head>

<body>
  <div class="banner-top container-fluid" id="home">
    <?php
    include '../../include/web/header.php';
    ?>
  </div>
  <?php if (DEVICE_TYPE == "Computer") { ?>
    <section class="banner-bottom-wthreelayouts">
      <div class="container-fluid">
        <div class="col-md-12">
          <div class="page-heading ml-0s">
            <h3 class="tittle-w3layouts text-center"><?php echo $PageName; ?></h3>
            <p><?php echo $Pagesubname; ?></p>
          </div>
        </div>
      </div>
      <div class="container-fluid">
        <div class="inner-sec-shop px-lg-4 px-3">
          <div class="row">

            <div class="col-lg-12 col-md-12 col-sm-12 col-12">
              <?php if (isset($_GET['product_name'])) { ?>
                <div class="row">
                  <div class="col-md-12">
                    <div class="flex-s-b">
                      <h5><i class="fa fa-search"></i> <b>Search Results for :</b> <span><?php echo $_GET['product_name']; ?></span>
                      </h5>
                      <a href="<?php echo WEB_URL; ?>/products/" class="btn btn-sm btn-danger"> Clear Search <i class="fa fa-times text-white"></i></a>
                    </div>
                    <hr>
                  </div>
                </div>
              <?php } ?>
              <div class="row">
                <?php
                //fetch conditions
                if (isset($_GET['categoryid'])) {
                  $SQLproducts = SELECT("SELECT * FROM products, pro_categories, pro_sub_categories where products.ProductCategoryId=pro_categories.ProCategoriesId and products.ProductCategoryId='$ProCategoriesId' and products.ProductSubCategoryId=pro_sub_categories.ProSubCategoriesId  ORDER BY products.ProductStatus DESC");
                } elseif (isset($_GET['subcategoryid'])) {
                  $SQLproducts = SELECT("SELECT * FROM products, pro_categories, pro_sub_categories where products.ProductCategoryId=pro_categories.ProCategoriesId and products.ProductSubCategoryId='$ProSubCategoriesId' and products.ProductSubCategoryId=pro_sub_categories.ProSubCategoriesId  ORDER BY products.ProductStatus DESC");
                } elseif (isset($_GET['product_name'])) {
                  $product_name = $_GET['product_name'];
                  $SQLproducts = SELECT("SELECT * FROM products, pro_categories, pro_sub_categories where products.ProductName LIKE '%$product_name%' and products.ProductCategoryId=pro_categories.ProCategoriesId and products.ProductSubCategoryId=pro_sub_categories.ProSubCategoriesId  ORDER BY products.ProductStatus DESC");
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


                  include __DIR__ . "/../../include/web/section/common/product-tab.php";
                } ?>
              </div>
            </div>
          </div>
        </div>
      </div>
      <?php
      if (isset($_GET['categoryid'])) { ?>
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12 text-center px-2 py-2">
              <a href="<?php echo DOMAIN; ?>/web/products/" class="app-text view-more">View All Food Items</a>
            </div>
          </div>
        </div>
      <?php } ?>
    </section>
    <!-- about -->


    <?php include '../../include/web/footer.php'; ?>
    <script>
      (function() {

        var parent = document.querySelector(".price-slider");
        if (!parent) return;

        var
          rangeS = parent.querySelectorAll("input[type=range]"),
          numberS = parent.querySelectorAll("input[type=number]");

        rangeS.forEach(function(el) {
          el.oninput = function() {
            var slide1 = parseFloat(rangeS[0].value),
              slide2 = parseFloat(rangeS[1].value);

            if (slide1 > slide2) {
              [slide1, slide2] = [slide2, slide1];
            }

            numberS[0].value = slide1;
            numberS[1].value = slide2;

            document.getElementById("from").innerHTML = "Rs." + slide1;
            document.getElementById("to").innerHTML = "Rs." + slide2;
          }
        });

        numberS.forEach(function(el) {
          el.oninput = function() {
            var number1 = parseFloat(numberS[0].value),
              number2 = parseFloat(numberS[1].value);

            if (number1 > number2) {
              var tmp = number1;
              numberS[0].value = number2;
              numberS[1].value = tmp;

              document.getElementById("from").innerHTML = "Rs." + number2;
              document.getElementById("to").innerHTML = "Rs." + number1;
            }

            rangeS[0].value = number1;
            rangeS[1].value = number2;

            document.getElementById("from").innerHTML = "Rs." + number1;
            document.getElementById("to").innerHTML = "Rs." + number2;

          }
        });

      })();
    </script>
    <script src="<?php echo ASSETS_URL; ?>/web/js/jquery-ui.js"></script>
    <?php include '../../include/web/footer_files.php'; ?>

  <?php } else { ?>
    <div class='fixed-top'>
      <section class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="flex-s-b">
              <div class="flex-start">
                <div class="page-title" onclick="MoreAction('BrowseCategories')">
                  <h5 id='iconBtn' class="mb-0">
                    <img src="<?php echo STORAGE_URL; ?>/products/category/<?php echo FETCH($CatsQL, "ProCategoryImage"); ?>">
                    <?php echo FETCH($CatsQL, "ProCategoryName"); ?> <i class='fa fa-angle-down ml-1'></i>
                    </h6>
                </div>
              </div>
              <div class="search-icon mt-1">
                <a href="" class="btn btn-md"><i class="fa fa-search"></i></a>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>

    <section class="container mt-5">
      <div class="row">
        <div class="col-md-12 mt-4 pt-2 pb-2 pl-1 pr-1">
          <div class="cat-list">

            <div class="item">
              <a href="?categoryid=<?php echo SECURE($ProCategoriesId, "e"); ?>" class="text-dark">
                <img src="<?php echo STORAGE_URL; ?>/products/category/<?php echo FETCH($CatsQL, "ProCategoryImage"); ?>">
                <p>All</p>
              </a>
            </div>

            <?php
            $FetchAllSubcategories = FetchConvertIntoArray("SELECT * FROM pro_sub_categories where ProSubCategoryId='$ProCategoriesId'", true);
            if ($FetchAllSubcategories != null) {
              foreach ($FetchAllSubcategories as $SubCats) {
                if (isset($_GET['subcategoryid'])) {
                  if ($ProSubCategoriesId == $SubCats->ProSubCategoriesId) {
                    $selected = "active";
                  } else {
                    $selected = "";
                  }
                } else {
                  $selected = "";
                } ?>
                <div class="item <?php echo $selected; ?>">
                  <a href="?categoryid=<?php echo SECURE($ProCategoriesId, "e"); ?>&subcategoryid=<?php echo SECURE($SubCats->ProSubCategoriesId, "e"); ?>" class="text-dark">
                    <img src="<?php echo STORAGE_URL; ?>/products/subcategory/<?php echo $SubCats->ProSubCategoryImage; ?>">
                    <p><?php echo $SubCats->ProSubCategoryName; ?></p>
                  </a>
                </div>
            <?php }
            } ?>
          </div>
        </div>
      </div>
    </section>


    <section class="container app-bg pb-5">
      <div class="row">
        <div class="col-md-12">
          <div class="flex-s-b">
            <h5 class="pt-1 mt-1">
              <b>
                <?php
                if (isset($_GET['subcategoryid'])) {
                  $subcategoryid = SECURE($_GET['subcategoryid'], "d");
                  echo TOTAL("SELECT ProductId from products where ProductSubCategoryId='$subcategoryid'");
                } else {
                  echo TOTAL("SELECT ProductId from products where ProductCategoryId='$ProCategoriesId'");
                }
                ?>
              </b>
              items found!
            </h5>
            <a class="btn btn-md btn-default bg-white rounded text-black bold"><i class="fa fa-filter text-danger"></i> Filters</a>
          </div>
        </div>
      </div>

      <div class="row mt-3">
        <?php
        if (isset($_GET['categoryid'])) {
          $SQLproducts = SELECT("SELECT * FROM products, pro_categories, pro_sub_categories where products.ProductCategoryId=pro_categories.ProCategoriesId and products.ProductCategoryId='$ProCategoriesId' and products.ProductSubCategoryId=pro_sub_categories.ProSubCategoriesId  ORDER BY products.ProductStatus DESC");
        } elseif (isset($_GET['subcategoryid']) && isset($_GET['categoryid'])) {
          $SQLproducts = SELECT("SELECT * FROM products, pro_categories, pro_sub_categories where products.ProductCategoryId=pro_categories.ProCategoriesId and products.ProductSubCategoryId='$ProSubCategoriesId' and products.ProductSubCategoryId=pro_sub_categories.ProSubCategoriesId  ORDER BY products.ProductStatus DESC");
        } elseif (isset($_GET['product_name'])) {
          $product_name = $_GET['product_name'];
          $SQLproducts = SELECT("SELECT * FROM products, pro_categories, pro_sub_categories where products.ProductName LIKE '%$product_name%' and products.ProductCategoryId=pro_categories.ProCategoriesId and products.ProductSubCategoryId=pro_sub_categories.ProSubCategoriesId  ORDER BY products.ProductStatus DESC");
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
          $ProductId = $fetchpro_brands['ProductId'];
          $ProductMedium = $fetchpro_brands['ProductMedium'];
          $ProductLocation = $fetchpro_brands['ProductLocation'];
          $CartItemDescriptions = "$ProCategoryName - $ProSubCategoryName - $ProductRefernceCode - $ProductWeight - $ProductLocation - $ProductMedium";

        ?>
          <div class="col-md-4 col-12 mb-3">
            <a href="details/?productid=<?php echo SECURE($ProductId, "e"); ?>">
              <div class="shadow-sm bg-white p-2 rounded-1">
                <img src='<?php echo STORAGE_URL; ?>/products/pro-img/<?php echo $ProductImage; ?>' class='img-fluid w-100'>
                <div class='p-1'>
                  <h5 class="text-black bold mt-2 mb-0"><?php echo $ProductName; ?></h5>
                  <p class="text-secondary small mt-0 mb-1"><?php echo $ProCategoryName; ?></p>
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
                  <p class="mb-1 small">
                    <span class="text-black"><?php echo $ProductWeight; ?></span> |
                    <span class="text-secondary mb-1"><?php echo $ProductLocation; ?></span> |
                    <span class="text-secondary mb-1"><?php echo $ProductMedium; ?></span>
                  </p>
                  <p>
                    <span class="bold app-text h5 mr-1">Rs.<?php echo $ProductSellPrice; ?></span>
                    <strike class='text-secondary mr-1'>Rs.<?php echo $ProductMrpPrice; ?></strike>
                    <span class="text-success"><?php echo 100 - round((int)$ProductSellPrice / (int)$ProductMrpPrice * 100, 2); ?>% Off</span>
                  </p>
                </div>
              </div>
            </a>
          </div>
        <?php  }  ?>
        <br><br><br><br><br><br><br><br><br><br><br><br><br><br>
    </section>
    <br>

    <div class='shadow-sm rounded-1 mt-6 fixed-top bg-white height-60 hidden' id='BrowseCategories'>
      <section class='container mb-2 mt-3'>
        <div class='row'>
          <?php
          $FetchCategories = FetchConvertIntoArray("SELECT * FROM pro_categories where ProCategoryStatus='1' ORDER BY ProCategoriesId DESC Limit 0, 8", true);
          if ($FetchCategories !=  null) {
            foreach ($FetchCategories as $Data) {
          ?>
              <div class="col-xs-4 col-4 text-center col-sm-4 mb-4">
                <a href="<?php echo WEB_URL; ?>/products/?categoryid=<?php echo SECURE($Data->ProCategoriesId, "e"); ?>">
                  <div class="w-100 p-1">
                    <img src="<?php echo STORAGE_URL; ?>/products/category/<?php echo $Data->ProCategoryImage; ?>" class="img-fluid img-bdr">
                    <a href="<?php echo WEB_URL; ?>/products/?categoryid=<?php echo SECURE($Data->ProCategoriesId, "e"); ?>" class='cat-name'><?php echo $Data->ProCategoryName; ?></a>
                  </div>
                </a>
              </div>
          <?php }
          } ?>
        </div>
      </section>
    </div>

    <script>
      function MoreAction(data) {
        var Data = document.getElementById(data);

        if (Data.style.display == "block") {
          Data.style.display = "none";
        } else {
          Data.style.display = "block";
        }
      }

      document.getElementById("iconBtn").addEventListener("click", function() {
        var iconElement = this.querySelector("i");
        if (iconElement.classList.contains("fa-angle-down")) {
          iconElement.classList.remove("fa-angle-down");
          iconElement.classList.add("fa-angle-up");
        } else {
          iconElement.classList.remove("fa-angle-up");
          iconElement.classList.add("fa-angle-down");
        }
      });
    </script>

    <script>
      window.onload = function() {
        document.getElementById("shop").classList.add("active");
      }
    </script>
    <br><br><br><br>
  <?php } ?>

</body>

</html>