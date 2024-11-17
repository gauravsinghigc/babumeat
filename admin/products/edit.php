<?php

//required files
require '../../require/modules.php';
require '../../require/admin/access-control.php';
require '../../require/admin/sessionvariables.php';

//page variables
$PageName = "Edit Product Details";

if (isset($_GET['productid'])) {
  $ProductId = SECURE($_GET['productid'], "d");
  $_SESSION['VIEW_PRODUCT_ID'] = $ProductId;
} else {
  $ProductId = $_SESSION['VIEW_PRODUCT_ID'];
}

$PageSqls = "SELECT * FROM products where ProductId='$ProductId'";
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=0.9">
  <title><?php echo $PageName . " -> " . GET_DATA("ProductName"); ?> | <?php echo APP_NAME; ?></title>
  <?php include '../../include/admin/header_files.php'; ?>
</head>

<body>
  <div id="container" class="effect mainnav-lg navbar-fixed mainnav-fixed">
    <?php include '../../include/admin/header.php'; ?>

    <div class="boxed">
      <!--CONTENT CONTAINER-->
      <!--===================================================-->
      <div id="content-container">
        <div id="page-content">
          <!--====start content===============================================-->

          <div class="panel">
            <div class="panel-body">
              <form class="data-form" action="../../controller/productscontroller.php" method="POST" enctype="multipart/form-data">
                <?php FormPrimaryInputs(true); ?>
                <div class="row">
                  <div class="col-md-12">
                    <h4 class="app-heading"><i class="fa fa-edit"></i> <?php echo $PageName . " : " . GET_DATA("ProductName"); ?></h4>
                  </div>
                  <div class="col-md-12">
                    <div class="flex-s-b">
                      <?php include 'common.php'; ?>
                    </div>
                  </div>

                  <div class="form-group col-lg-6 col-md-6 col-ms-6 col-12">
                    <label>Enter Painting Name</label>
                    <input type="text" name="ProductName" value="<?php echo GET_DATA("ProductName"); ?>" class="form-control-2" required="" />
                  </div>
                  <div class="form-group col-lg-6 col-md-6 col-ms-6 col-12">
                    <label>Select Collection Name</label>
                    <select name="ProductCategoryId" class="form-control-2 demo-chosen-select" required="">
                      <?php
                      $SqlProCategories2 = SELECT("SELECT * FROM pro_categories ORDER BY ProCategoryName ASC");
                      while ($FetchProCategories2 = mysqli_fetch_array($SqlProCategories2)) {
                        if (GET_DATA("ProductCategoryId") == $FetchProCategories2['ProCategoriesId']) {
                          $selected = "selected=''";
                        } else {
                          $selected = "";
                        } ?>
                        <option value="<?php echo $FetchProCategories2['ProCategoriesId']; ?>" <?php echo $selected; ?>><?php echo $FetchProCategories2['ProCategoryName']; ?></option>
                      <?php } ?>
                    </select>
                  </div>
                  <div class="form-group col-lg-6 col-md-6 col-ms-6 col-12">
                    <label>Select Category</label>
                    <select name="ProductSubCategoryId" class="form-control-2 demo-chosen-select" required="">
                      <?php
                      $SqlSubcategory = SELECT("SELECT * FROM pro_sub_categories ORDER BY ProSubCategoryName ASC");
                      while ($fetchsubcategory = mysqli_fetch_array($SqlSubcategory)) {
                        if (GET_DATA("ProductSubCategoryId") == $fetchsubcategory['ProSubCategoriesId']) {
                          $selected = "selected=''";
                        } else {
                          $selected = "";
                        } ?>
                        <option value="<?php echo $fetchsubcategory['ProSubCategoriesId']; ?>" <?php echo $selected; ?>><?php echo $fetchsubcategory['ProSubCategoryName']; ?></option>
                      <?php } ?>
                    </select>
                  </div>
                  <div class="form-group col-lg-6 col-md-6 col-ms-6 col-12">
                    <label>Item MRP</label>
                    <input type="number" min="0" name="ProductMrpPrice" value="<?php echo GET_DATA("ProductMrpPrice"); ?>" class="form-control-2" required="" />
                  </div>
                  <div class="form-group col-lg-6 col-md-6 col-ms-6 col-12">
                    <label>Item Sell Price</label>
                    <input type="number" min="0" name="ProductSellPrice" value="<?php echo GET_DATA("ProductSellPrice"); ?>" class="form-control-2" required="" />
                  </div>
                  <div class="form-group col-lg-6 col-md-6 col-ms-6 col-12">
                    <label>Item Weight (eg; 500g, 1kg, Half, Full)</label>
                    <input type="text" min="0" name="ProductWeight" value="<?php echo GET_DATA("ProductWeight"); ?>" class="form-control-2" required="" />
                  </div>
                  <div class="form-group col-lg-6 col-md-6 col-sm-6 col-12">
                    <label>Servings</label>
                    <input type="text" name="ProductMedium" value='<?php echo GET_DATA("ProductMedium"); ?>' class="form-control-2">
                  </div>
                  <div class="form-group col-lg-6 col-md-6 col-sm-6 col-12">
                    <label>Pieces</label>
                    <input type="text" name="ProductLocation" class="form-control-2" value='<?php echo GET_DATA("ProductLocation"); ?>'>
                  </div>
                  <div class="form-group col-lg-6 col-md-6 col-ms-6 col-12">
                    <label>Sort By Order</label>
                    <input type="number" min="0" name="ProductPageOrder" value="<?php echo GET_DATA("ProductPageOrder"); ?>" class="form-control-2" required="" />
                  </div>
                  <div class="form-group col-lg-6 col-md-6 col-ms-6 col-12">
                    <label>ITEM Code</label>
                    <input type="text" name="ProductRefernceCode" value="<?php echo GET_DATA("ProductRefernceCode"); ?>" class="form-control-2" required="" />
                  </div>
                  <div class="form-group col-lg-6 col-md-6 col-ms-6 col-12">
                    <label>New Arrival ?</label>

                    <?php if (GET_DATA("ProductNewArrivalStatus") == "Yes") { ?>
                      <div class="flex-s">
                        <span class="m-l-5">
                          <input type="radio" name="ProductNewArrivalStatus" value="Yes" checked="" required="" /> Yes
                        </span>
                        <span class="m-l-30">
                          <input type="radio" name="ProductNewArrivalStatus" value="No" required="" /> No
                        </span>
                      </div>
                    <?php } else { ?>
                      <div class="flex-s">
                        <span class="m-l-5">
                          <input type="radio" name="ProductNewArrivalStatus" value="Yes" required="" /> Yes
                        </span>
                        <span class="m-l-30">
                          <input type="radio" name="ProductNewArrivalStatus" value="No" checked="" required="" /> No
                        </span>
                      </div>
                    <?php } ?>
                  </div>
                  <div class="col-md-12"></div>
                  <div class="form-group col-md-6 col-lg-6">
                    <label>Applicable GST in % (For All Prices)</label>
                    <select name="ProductApplicableTaxes" class="form-control-2" required="">
                      <?php echo InputOptions(["0", "5", "7", "10", "12", "15", "18", "20"], "" . GET_DATA("ProductApplicableTaxes") . ""); ?>
                    </select>
                  </div>
                  <div class="form-group col-lg-6 col-md-6 col-sm-6 col-12">
                    <label>Product listing Status</label>
                    <?php if (GET_DATA("ProductStatus") == "1") { ?>
                      <select name="ProductStatus" class="form-control-2">
                        <option value="1" selected>Active</option>
                        <option value="2">Inactive</option>
                      </select>
                    <?php } else { ?>
                      <select name="ProductStatus" class="form-control-2">
                        <option value="1">Active</option>
                        <option value="2" selected>Inactive</option>
                      </select>
                    <?php } ?>
                  </div>
                  <div class="form-group col-lg-12 col-md-12 col-ms-12 col-12">
                    <label>Enter Something about the item</label>
                    <textarea type="text" id="editor" name="ProductDescriptions" style="height:100% !important;" row="3" class="form-control-2"><?php echo SECURE(GET_DATA("ProductDescriptions"), "d"); ?></textarea>
                  </div>
                  <div class="form-group col-lg-6 col-md-6 col-ms-6 col-12">
                    <label>Upload Primary Image</label>
                    <input type="FILE" name="ProductImage" value="null" id="uploadimage" accept="image/png, image/gif, image/jpeg" class="form-control-2" />
                    <div class="flex-c mb-2-pr">
                      <img src="<?php echo STORAGE_URL; ?>/products/pro-img/<?php echo GET_DATA("ProductImage"); ?>" class="w-25" id="ImgPreview">
                    </div>
                  </div>

                  <div class="form-group col-lg-6 col-md-6 col-ms-6 col-12">
                    <label>Upload Secondary Image</label>
                    <input type="FILE" name="ProductImage2" value="null" id="uploadimage2" accept="image/png, image/gif, image/jpeg" class="form-control-2" />
                    <div class="flex-c mb-2-pr">
                      <img src="<?php echo STORAGE_URL; ?>/products/pro-img/<?php echo GET_DATA("ProductImage2"); ?>" class="w-25" id="ImgPreview2">
                    </div>
                  </div>


                  <div class="col-md-12">
                    <br><br>
                    <h4 class="app-sub-heading">Enter Product SEO Data</h4>
                  </div>

                  <div class="form-group col-md-12 m-t-10">
                    <label>Meta Title</label>
                    <input type="text" value="<?php echo SECURE(FETCH("SELECT * FROM product_meta_data where ProductMetaProId='$ProductId'", "ProductMetaTitle"), "d"); ?>" name="ProductMetaTitle" class="form-control-2">
                  </div>
                  <div class="form-group col-md-12 m-t-10">
                    <label>Meta Keywords</label>
                    <input type="text" VALUE="<?php echo SECURE(FETCH("SELECT * FROM product_meta_data where ProductMetaProId='$ProductId'", "ProductMetaKeywords"), "d"); ?>" name="ProductMetaKeywords" class="form-control-2">
                  </div>
                  <div class="form-group col-md-12 m-t-10">
                    <label>Meta Descriptions</label>
                    <textarea name="ProductMetaDescriptions" class="form-control-2" style="height:100% !important;" rows="3"><?php echo SECURE(FETCH("SELECT * FROM product_meta_data where ProductMetaProId='$ProductId'", "ProductMetaDescriptions"), "d"); ?></textarea>
                  </div>
                  <div class="col-md-12 m-t-20">
                    <button type="Submit" value="<?php echo SECURE($ProductId, "e"); ?>" name="UpdateProductsDetails" class="btn btn-md app-btn">Save Products</button>
                    <a href="<?php echo DOMAIN; ?>/admin/products/" class="btn btn-md btn-danger">Cancel</a>
                    <br><br>
                  </div>
                </div>
            </div>
          </div>
          </form>
        </div>

        <!--End page content-->
      </div>

      <?php include '../../include/admin/sidebar.php'; ?>
    </div>
    <?php include '../../include/admin/footer.php'; ?>
  </div>
  <script>
    function EnableOfferAmount() {
      var offerstatus = document.getElementById("offerstatus");
      if (offerstatus.value == "Yes") {
        document.getElementById("enableofferinput").style.display = "block";
      } else {
        document.getElementById("enableofferinput").style.display = "none";
      }
    }
  </script>
  <script>
    uploadimage2.onchange = evt => {
      const [file] = uploadimage2.files
      if (file) {
        ImgPreview2.src = URL.createObjectURL(file);
      }
    }
  </script>
  <script>
    uploadimage.onchange = evt => {
      const [file] = uploadimage.files
      if (file) {
        ImgPreview.src = URL.createObjectURL(file);
      }
    }
  </script>
  <?php include '../../include/admin/footer_files.php'; ?>
</body>

</html>