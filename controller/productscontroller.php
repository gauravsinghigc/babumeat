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


//start actiivity here
if (isset($_POST['CreateProductCategories'])) {
  $ProCategoryName = $_POST['ProCategoryName'];
  $ProCategoryImage = UPLOAD_FILES("../storage/products/category", "ProCategoryImage", "Category_", "$ProCategoryName", "ProCategoryImage");
  $ProCategoryStatus = 1;
  $ProCategoryCreatedAt = date("d M, Y");

  $Save = SAVE("pro_categories", ["ProCategoryName", "ProCategoryImage", "ProCategoryStatus", "ProCategoryCreatedAt"]);
  RESPONSE($Save, "New Category: <b>$ProCategoryName</b> is created successfully!", "Unable to create new category");

  //product sub category
} elseif (isset($_POST['CreateProductSubCategories'])) {
  $ProSubCategoryName = $_POST['ProSubCategoryName'];
  $ProSubCategoryId = $_POST['ProSubCategoryId'];
  $ProSubCategoryImage = UPLOAD_FILES("../storage/products/subcategory", "ProSubCategoryImage", "subcategory", "$ProSubCategoryName", "ProSubCategoryImage");
  $ProSubCategoryStatus = 1;
  $ProSubCategoryCreatedAt = date("d M, Y");

  $save = SAVE("pro_sub_categories", ["ProSubCategoryName", "ProSubCategoryId", "ProSubCategoryImage", "ProSubCategoryStatus", "ProSubCategoryCreatedAt"]);
  RESPONSE($save, "New Sub category <b>$ProSubCategoryName</b> is created successfully!", "Unable to create new sub category!");

  //product brands
} elseif (isset($_POST['CreateProductbrands'])) {
  $ProBrandName = $_POST['ProBrandName'];
  $ProBrandImage = UPLOAD_FILES("../storage/products/brands", "ProBrandImage", "brands", "$ProBrandName", "ProBrandImage");
  $ProBrandStatus = 1;
  $ProBrandCreatedAt = date("d M, Y");
  $ProBrandDescriptions = POST("ProBrandDescriptions");

  $save = SAVE("pro_brands", ["ProBrandName", "ProBrandDescriptions", "ProBrandStatus", "ProBrandCreatedAt", "ProBrandImage"]);
  RESPONSE($save, "New $ProBrandName is created successfully!", "unable to create new brand name");

  //save products
} else if (isset($_POST['CreateProducts'])) {
  $ProductName = $_POST['ProductName'];
  $ProductRefernceCode = $_POST['ProductRefernceCode'];
  $ProductImage = UPLOAD_FILES("../storage/products/pro-img", "ProductImage", "Primary_" . "$ProductName", "$ProductRefernceCode", "ProductImage");
  $ProductCategoryId = $_POST['ProductCategoryId'];
  $ProductSubCategoryId = $_POST['ProductSubCategoryId'];
  $ProductSellPrice = $_POST['ProductSellPrice'];
  $ProductMrpPrice = $_POST['ProductMrpPrice'];
  $ProductDescriptions = SECURE($_POST['ProductDescriptions'], "e");
  $ProductWeight = $_POST['ProductWeight'];
  $ProductStatus = 1;
  $ProductCreatedAt = date("d M, Y");
  $ProductCreatedBy = LOGIN_UserId;
  $ProductWorkType = $_POST['ProductWorkType'];
  $ProductMedium = $_POST['ProductMedium'];
  $ProductPageOrder = $_POST['ProductPageOrder'];
  $ProductNewArrivalStatus = $_POST['ProductNewArrivalStatus'];
  $ProductImage2 = UPLOAD_FILES("../storage/products/pro-img", "ProductImage2", "Secondary_" . "$ProductName", "$ProductRefernceCode", "ProductImage2");
  $ProductOfferAmount = $_POST['ProductOfferAmount'];
  $ProductApplicableTaxes = $_POST['ProductApplicableTaxes'];


  $SaveProducts = SAVE("products", ["ProductName", "ProductApplicableTaxes", "ProductOfferAmount", "ProductImage2", "ProductNewArrivalStatus", "ProductPageOrder", "ProductMedium", "ProductWorkType", "ProductSize", "ProductLocation", "ProductRefernceCode", "ProductImage", "ProductCategoryId", "ProductSubCategoryId", "ProductBrandId", "ProductSellPrice", "ProductMrpPrice", "ProductDescriptions", "ProductWeight", "ProductStatus", "ProductCreatedAt", "ProductCreatedBy"]);

  //save additional products informations
  if ($SaveProducts == true) {
    $ProductId = FETCH("SELECT * FROM products ORDER BY ProductId DESC LIMIT 1", "ProductId");

    //meta data
    $ProductMetaProId = $ProductId;
    $ProductMetaTitle = SECURE($_POST['ProductMetaTitle'], "e");
    $ProductMetaKeywords = SECURE($_POST['ProductMetaKeywords'], "e");
    $ProductMetaDescriptions = SECURE($_POST['ProductMetaDescriptions'], "e");
    $SaveMetaData = SAVE("product_meta_data", ["ProductMetaProId", "ProductMetaTitle", "ProductMetaKeywords", "ProductMetaDescriptions"]);

    //upload additional images
    $ProImageProductId = $ProductId;
    $total_count = count($_FILES['ProImageName']['name']);
    for ($i = 0; $i < $total_count; $i++) {
      $UploadDir = "../storage/products/pro-img/$ProImageProductId/";
      $ProImageName = $_FILES['ProImageName']['name'][$i];
      $ProImageType = $_FILES['ProImageName']['type'][$i];
      $ProImageSize = $_FILES['ProImageName']['size'][$i];
      $ProImageTmpName = $_FILES['ProImageName']['tmp_name'][$i];
      $ProImageError = $_FILES['ProImageName']['error'][$i];
      $ProImageExt = pathinfo($ProImageName, PATHINFO_EXTENSION);


      $ProductName = FETCH("SELECT * FROM products WHERE ProductId='$ProImageProductId'", "ProductName");
      $ProductRefernceCode = FETCH("SELECT * FROM products WHERE ProductId='$ProImageProductId'", "ProductReferenceCode");
      $ProductName = str_replace(" ", "_", $ProductName);
      $ProImageName = $ProductName . "_" . $ProductRefernceCode . "_" . $i . date("d_m_Y_h_m_s_a_") . "." . $ProImageExt;
      $ProImagePath = $UploadDir . $ProImageName;
      $ProImageStatus = 1;

      if ($ProImageExt === 'jpg' || $ProImageExt === 'jpeg' || $ProImageExt === 'png' || $ProImageExt === 'gif' || $ProImageExt === "webp") {
        if (!file_exists("$UploadDir/")) {
          mkdir("$UploadDir/", 0777, true);
        }
        move_uploaded_file($ProImageTmpName, $ProImagePath);
        $SaveImages = SAVE("pro_images", ["ProImageProductId", "ProImageName", "ProImageStatus"]);
      } else {
        $SaveImages = false;
      }
    }
  }

  RESPONSE($SaveProducts, "New product <b>$ProductName</b> is Saved successfully!", "Unable to save new product");

  //update products
} elseif (isset($_POST['UpdateProductsDetails'])) {
  $ViewProductId = SECURE($_POST['UpdateProductsDetails'], "d");
  $CurrentFile = SECURE($_POST['CurrentFile'], "d");

  $ProductName = $_POST['ProductName'];
  $ProductCategoryId = $_POST['ProductCategoryId'];
  $ProductSubCategoryId = $_POST['ProductSubCategoryId'];
  $ProductBrandId = $_POST['ProductBrandId'];
  $ProductRefernceCode = $_POST['ProductRefernceCode'];
  $ProductSellPrice = $_POST['ProductSellPrice'];
  $ProductMrpPrice = $_POST['ProductMrpPrice'];
  $ProductWeight = $_POST['ProductWeight'];
  $ProductDescriptions = SECURE($_POST['ProductDescriptions'], "e");
  $ProductStatus = $_POST['ProductStatus'];
  $ProductUpdatedAt = date("Y-m-d");
  $ProductSize = $_POST['ProductSize'];
  $ProductLocation = $_POST['ProductLocation'];
  $ProductWorkType = $_POST['ProductWorkType'];
  $ProductMedium = $_POST['ProductMedium'];
  $ProductPageOrder = $_POST['ProductPageOrder'];
  $ProductNewArrivalStatus = $_POST['ProductNewArrivalStatus'];
  $ProductOfferAmount = $_POST['ProductOfferAmount'];
  $ProductApplicableTaxes = $_POST['ProductApplicableTaxes'];

  if ($_FILES['ProductImage']['name'] == null || $_FILES['ProductImage']['name'] == "null" || $_FILES['ProductImage']['name'] == " " || $_FILES['ProductImage']['name'] == "") {
    $UpdateProducts = UPDATE_TABLE("products", ["ProductName", "ProductApplicableTaxes", "ProductOfferAmount", "ProductNewArrivalStatus", "ProductPageOrder", "ProductMedium", "ProductWorkType", "ProductSize", "ProductLocation", "ProductRefernceCode", "ProductCategoryId", "ProductSubCategoryId", "ProductBrandId", "ProductSellPrice", "ProductMrpPrice", "ProductDescriptions", "ProductWeight", "ProductStatus", "ProductUpdatedAt"], "ProductId='$ViewProductId'");
  } else {
    $ProductImage = UPLOAD_FILES("../storage/products/pro-img", "ProductImage", "$ProductName", "$ProductCategoryId", "ProductImage");
    $UpdateProducts = UPDATE_TABLE("products", ["ProductName", "ProductApplicableTaxes", "ProductOfferAmount", "ProductNewArrivalStatus", "ProductPageOrder", "ProductMedium", "ProductWorkType", "ProductSize", "ProductLocation", "ProductRefernceCode", "ProductImage", "ProductCategoryId", "ProductSubCategoryId", "ProductBrandId", "ProductSellPrice", "ProductMrpPrice", "ProductDescriptions", "ProductWeight", "ProductStatus", "ProductUpdatedAt"], "ProductId='$ViewProductId'");
  }

  if ($_FILES['ProductImage2']['name'] == null || $_FILES['ProductImage2']['name'] == "null" || $_FILES['ProductImage2']['name'] == " " || $_FILES['ProductImage2']['name'] == "") {
    $UpdateProducts = UPDATE_TABLE("products", ["ProductName", "ProductApplicableTaxes", "ProductOfferAmount", "ProductNewArrivalStatus", "ProductPageOrder", "ProductMedium", "ProductWorkType", "ProductSize", "ProductLocation", "ProductRefernceCode", "ProductCategoryId", "ProductSubCategoryId", "ProductBrandId", "ProductSellPrice", "ProductMrpPrice", "ProductDescriptions", "ProductWeight", "ProductStatus", "ProductUpdatedAt"], "ProductId='$ViewProductId'");
  } else {
    $ProductImage2 = UPLOAD_FILES("../storage/products/pro-img", "ProductImage2", "$ProductName", "$ProductCategoryId", "ProductImage2");
    $UpdateProducts = UPDATE_TABLE("products", ["ProductName", "ProductApplicableTaxes", "ProductOfferAmount", "ProductImage2", "ProductNewArrivalStatus", "ProductPageOrder", "ProductMedium", "ProductWorkType", "ProductSize", "ProductLocation", "ProductRefernceCode", "ProductCategoryId", "ProductSubCategoryId", "ProductBrandId", "ProductSellPrice", "ProductMrpPrice", "ProductDescriptions", "ProductWeight", "ProductStatus", "ProductUpdatedAt"], "ProductId='$ViewProductId'");
  }

  //Update SEO OR META DATA 
  $ProductMetaProId = $ViewProductId;
  $ProductMetaTitle = SECURE($_POST['ProductMetaTitle'], "e");
  $ProductMetaKeywords = SECURE($_POST['ProductMetaKeywords'], "e");
  $ProductMetaDescriptions = SECURE($_POST['ProductMetaDescriptions'], "e");

  $CheckIfexits = CHECK("SELECT * FROM product_meta_data WHERE ProductMetaProId='$ProductMetaProId'");
  if ($CheckIfexits != null) {
    $UpdateMetaData = UPDATE_TABLE("product_meta_data", ["ProductMetaProId", "ProductMetaTitle", "ProductMetaKeywords", "ProductMetaDescriptions"], "ProductMetaProId='$ProductMetaProId'");
  } else {
    $UpdateMetaData = SAVE("product_meta_data", ["ProductMetaProId", "ProductMetaTitle", "ProductMetaKeywords", "ProductMetaDescriptions"]);
  }
  RESPONSE($UpdateMetaData, "Product Details Updated!", "Unable to Update Product Details");

  //delete products
} elseif (isset($_POST['DeleteProducts'])) {
  $ProductId = $_SESSION['VIEW_PRODUCT_ID'];
  $ProductStatus = 3;
  $ProductUpdatedAt = date("d M, Y");

  $DeleteProducts = UPDATE_TABLE("products", ["ProductStatus", "ProductUpdatedAt"], "ProductId='$ProductId'");
  RESPONSE($DeleteProducts, "Product Deleted!", "Unable to Delete Product");

  //CreateNewPackages
} elseif (isset($_POST['CreateNewPackages'])) {
  $ProductProId = $_SESSION['VIEW_PRODUCT_ID'];
  $ProductPackageName = $_POST['ProductPackageName'];
  $ProductPackageDetails = POST("ProductPackageDetails");
  $ProductPackageSellPrice = $_POST['ProductPackageSellPrice'];
  $ProductPackageMrp = $_POST['ProductPackageMrp'];
  $ProductPackageRefNumber = $_POST['ProductPackageRefNumber'];

  $SaveProductPackage = SAVE("product_packages", ["ProductProId", "ProductPackageName", "ProductPackageDetails", "ProductPackageSellPrice", "ProductPackageMrp", "ProductPackageRefNumber"]);
  RESPONSE($SaveProductPackage, "New Package <b>$ProductPackageName</b> is created successfully!", "Unable to create new package");

  //delete products
} elseif (isset($_GET['delete_products'])) {
  $access_url = DOMAIN . "/admin/products";
  $delete_products = SECURE($_GET['delete_products'], "d");

  if ($delete_products == "true") {
    $control_id = SECURE($_GET['control_id'], "d");
    $delete_products = DELETE_FROM("products", "ProductId='$control_id'");

    $DeleteProductPackages = DELETE_FROM("product_packages", "ProductProId='$control_id'");
    $DeleteProductImages = DELETE_FROM("pro_images", "ProImageProductId='$control_id'");
    $DeleteProductoptions = DELETE_FROM("pro_options", "ProOptionProductId='$control_id'");
    $DeleteProductSpecifications = DELETE_FROM("pro_specifications", "ProdProductId='$control_id'");
    $DeleteProductMetadata = DELETE_FROM("product_meta_data", "ProductMetaProId='$control_id'");
    RESPONSE($DeleteProductMetadata, "Product Delete Permanently!", "Unable to Delete Product Permanently");
  } else {
    LOCATION("warning", "Invalid Activity Record!", $access_url);
  }

  //delete product packages
} elseif (isset($_GET['delete_product_packages'])) {
  $access_url = SECURE($_GET['access_url'], "d");
  $delete_product_packages = SECURE($_GET['delete_product_packages'], "d");

  if ($delete_product_packages == true) {
    $control_id = SECURE($_GET['control_id'], "d");
    $delete_product_packages = DELETE_FROM("product_packages", "ProductPackageId='$control_id'");
    RESPONSE($delete_product_packages, "Package Delete Permanently!", "Unable to Delete Package Permanently");
  } else {
    LOCATION("warning", "Invalid Activity Record!", $access_url);
  }

  //restore products
} elseif (isset($_GET['restore_products'])) {
  $restore_products = SECURE($_GET['restore_products'], "d");
  $access_url = SECURE($_GET['access_url'], "d");

  if ($restore_products == true) {
    $control_id = SECURE($_GET['control_id'], "d");
    $ProductStatus = 1;
    $ProductUpdatedAt = date("d M, Y");
    $restore_products = UPDATE_TABLE("products", ["ProductStatus", "ProductUpdatedAt"], "ProductId='$control_id'");
    RESPONSE($restore_products, "Product Restore Successfully!", "Unable to Restore Product");
  } else {
    LOCATION("warning", "Invalid Activity Record!", $access_url);
  }

  //update package details
} else if (isset($_POST['UpdatePackageDetails'])) {
  $ProductPackageId = SECURE($_POST['UpdatePackageDetails'], "d");
  $ProductPackageName = $_POST['ProductPackageName'];
  $ProductPackageSellPrice = $_POST['ProductPackageSellPrice'];
  $ProductPackageMrp = $_POST['ProductPackageMrp'];
  $ProductPackageDetails = POST("ProductPackageDetails");
  $ProductPackageRefNumber = $_POST['ProductPackageRefNumber'];

  $UpdateProductPackages = UPDATE_TABLE("product_packages", ["ProductPackageName", "ProductPackageSellPrice", "ProductPackageMrp", "ProductPackageDetails", "ProductPackageRefNumber"], "ProductPackageId='$ProductPackageId'");
  RESPONSE($UpdateProductPackages, "Package Details Updated!", "Unable to Update Package Details");

  //update product categories
} elseif (isset($_POST['UpdateCategories'])) {
  $ProCategoriesId = SECURE($_POST['UpdateCategories'], "d");
  $ProCategoryName = $_POST['ProCategoryName'];
  $ProCategoryUpdatedAt = date("d M, Y");
  $ProCategoryStatus = $_POST['ProCategoryStatus'];

  if ($_FILES['ProCategoryImage']['name'] ==  null || $_FILES['ProCategoryImage']['name'] == "null" || $_FILES['ProCategoryImage']['name'] == " " || $_FILES['ProCategoryImage']['name'] == "") {
    $ProCategoryImage = SECURE($_POST['CurrentFile'], "d");
  } else {
    $ProCategoryImage = UPLOAD_FILES("../storage/products/category", "ProCategoryImage", "$ProCategoryName", "$ProCategoriesId", "ProCategoryImage");
  }
  $UpdateProductCategories = UPDATE_TABLE("pro_categories", ["ProCategoryName", "ProCategoryImage", "ProCategoryUpdatedAt", "ProCategoryStatus"], "ProCategoriesId='$ProCategoriesId'");
  RESPONSE($UpdateProductCategories, "Category Details Updated!", "Unable to Update Category Details");

  //delete product categories
} elseif (isset($_GET['delete_product_categories'])) {
  $access_url = SECURE($_GET['access_url'], "d");
  $delete_product_categories = SECURE($_GET['delete_product_categories'], "d");

  if ($delete_product_categories == true) {
    $control_id = SECURE($_GET['control_id'], "d");
    $delete_product_categories = DELETE_FROM("pro_categories", "ProCategoriesId='$control_id'");
    RESPONSE($delete_product_categories, "Category Delete Permanently!", "Unable to Delete Category Permanently");
  } else {
    LOCATION("warning", "Invalid Activity Record!", $access_url);
  }

  //update product sub categories
} elseif (isset($_POST['UpdateSubCategories'])) {
  $ProSubCategoriesId = SECURE($_POST['UpdateSubCategories'], "d");
  $ProSubCategoryName = $_POST['ProSubCategoryName'];
  $ProSubCategoryUpdatedAt = date("d M, Y");
  $ProSubCategoryStatus = $_POST['ProSubCategoryStatus'];
  $ProSubCategoryId = $_POST['ProSubCategoryId'];

  if ($_FILES['ProSubCategoryImage']['name'] ==  null || $_FILES['ProSubCategoryImage']['name'] == "null" || $_FILES['ProSubCategoryImage']['name'] == " " || $_FILES['ProSubCategoryImage']['name'] == "") {
    $ProSubCategoryImage = SECURE($_POST['CurrentFile'], "d");
  } else {
    $ProSubCategoryImage = UPLOAD_FILES("../storage/products/subcategory", "ProSubCategoryImage", "$ProSubCategoryName", "$ProSubCategoriesId", "ProSubCategoryImage");
  }

  $UpdateProductSubCategories = UPDATE_TABLE("pro_sub_categories", ["ProSubCategoryName", "ProSubCategoryId", "ProSubCategoryImage", "ProSubCategoryStatus", "ProSubCategoryUpdatedAt"], "ProSubCategoriesId='$ProSubCategoriesId'");
  RESPONSE($UpdateProductSubCategories, "Sub Category Details Updated!", "Unable to Update Sub Category Details");

  //delete sub categories
} elseif (isset($_GET['delete_sub_categories'])) {
  $access_url = SECURE($_GET['access_url'], "d");
  $delete_sub_categories = SECURE($_GET['delete_sub_categories'], "d");

  if ($delete_sub_categories == true) {
    $control_id = SECURE($_GET['control_id'], "d");
    $delete_sub_categories = DELETE_FROM("pro_sub_categories", "ProSubCategoriesId='$control_id'");
    RESPONSE($delete_sub_categories, "Sub Category Delete Permanently!", "Unable to Delete Sub Category Permanently");
  } else {
    LOCATION("warning", "Invalid Activity Record!", $access_url);
  }

  //update product brands
} elseif (isset($_POST['UpdateProductbrands'])) {
  $ProBrandId = SECURE($_POST['UpdateProductbrands'], "d");
  $ProBrandName = $_POST['ProBrandName'];
  $ProBrandUpdatedAt = date("d M, Y");
  $ProBrandStatus = $_POST['ProBrandStatus'];
  $ProBrandDescriptions = POST("ProBrandDescriptions");

  if ($_FILES['ProBrandImage']['name'] ==  null || $_FILES['ProBrandImage']['name'] == "null" || $_FILES['ProBrandImage']['name'] == " " || $_FILES['ProBrandImage']['name'] == "") {
    $ProBrandImage = SECURE($_POST['CurrentFile'], "d");
  } else {
    $ProBrandImage = UPLOAD_FILES("../storage/products/brands", "ProBrandImage", "$ProBrandName", "$ProBrandId", "ProBrandImage");
  }
  $UpdateBrands = UPDATE_TABLE("pro_brands", ["ProBrandName", "ProBrandDescriptions", "ProBrandImage", "ProBrandUpdatedAt", "ProBrandStatus"], "ProBrandId='$ProBrandId'");
  RESPONSE($UpdateBrands, "Brand Details Updated!", "Unable to Update Brand Details");
} elseif (isset($_GET['delete_brands'])) {
  $access_url = SECURE($_GET['access_url'], "d");
  $delete_brands = SECURE($_GET['delete_brands'], "d");

  if ($delete_brands == true) {
    $control_id = SECURE($_GET['control_id'], "d");
    $delete_brands = DELETE_FROM("pro_brands", "ProBrandId='$control_id'");
    RESPONSE($delete_brands, "Brand Delete Permanently!", "Unable to Delete Brand Permanently");
  } else {
    LOCATION("warning", "Invalid Activity Record!", $access_url);
  }

  //upload product images
} elseif (isset($_POST['UploadProductImages'])) {
  $ProImageProductId = SECURE($_POST['UploadProductImages'], "d");

  //products images
  $total_count = count($_FILES['ProImageName']['name']);
  for ($i = 0; $i < $total_count; $i++) {
    $UploadDir = "../storage/products/pro-img/$ProImageProductId/";
    $ProImageName = $_FILES['ProImageName']['name'][$i];
    $ProImageType = $_FILES['ProImageName']['type'][$i];
    $ProImageSize = $_FILES['ProImageName']['size'][$i];
    $ProImageTmpName = $_FILES['ProImageName']['tmp_name'][$i];
    $ProImageError = $_FILES['ProImageName']['error'][$i];
    $ProImageExt = pathinfo($ProImageName, PATHINFO_EXTENSION);


    $ProductName = FETCH("SELECT * FROM products WHERE ProductId='$ProImageProductId'", "ProductName");
    $ProductRefernceCode = FETCH("SELECT * FROM products WHERE ProductId='$ProImageProductId'", "ProductReferenceCode");
    $ProductName = str_replace(" ", "_", $ProductName);
    $ProImageName = $ProductName . "_" . $ProductRefernceCode . "_" . $i . date("d_m_Y_h_m_s_a_") . "." . $ProImageExt;
    $ProImagePath = $UploadDir . $ProImageName;
    $ProImageStatus = 1;

    if ($ProImageExt == 'jpg' || $ProImageExt == 'jpeg' || $ProImageExt == 'png' || $ProImageExt == 'gif') {
      if (!file_exists("$UploadDir/")) {
        mkdir("$UploadDir/", 0777, true);
      }
      move_uploaded_file($ProImageTmpName, $ProImagePath);
      $SaveImages = SAVE("pro_images", ["ProImageProductId", "ProImageName", "ProImageStatus"]);
    } else {
      RESPONSE(false, "Product Image is not valid!", "Uploaded File is not Image");
      $SaveImages = false;
    }
  }

  //response
  //images saved successfully
  RESPONSE($SaveImages, "Product Image Uploaded Successfully!", "Unable to Upload Product Image");

  //delete products images
} elseif (isset($_GET['delete_product_images'])) {
  $access_url = SECURE($_GET['access_url'], "d");
  $delete_product_images = SECURE($_GET['delete_product_images'], "d");

  if ($delete_product_images == true) {
    $control_id = SECURE($_GET['control_id'], "d");
    $delete_product_images = DELETE_FROM("pro_images", "ProImagesId='$control_id'");
    RESPONSE($delete_product_images, "Product Image Delete Permanently!", "Unable to Delete Product Image Permanently");
  } else {
    LOCATION("warning", "Invalid Activity Record!", $access_url);
  }

  //add option category
} elseif (isset($_POST['AddProductOptionCategory'])) {
  $ProOptionCategoryName = $_POST['ProOptionCategoryName'];

  $AddOptionCategory = SAVE("pro_options_categories", ["ProOptionCategoryName"]);
  RESPONSE($AddOptionCategory, "Option Category Added Successfully!", "Unable to Add Option Category");

  //edit products option category
} elseif (isset($_POST['UpdateCategoryOptions'])) {
  $ProOptionCategoryId = SECURE($_POST['UpdateCategoryOptions'], "d");
  $ProOptionCategoryName = $_POST['ProOptionCategoryName'];

  $UpdateOptionCategory = UPDATE_TABLE("pro_options_categories", ["ProOptionCategoryName"], "ProOptionCategoryId='$ProOptionCategoryId'");
  RESPONSE($UpdateOptionCategory, "Option Category Updated Successfully!", "Unable to Update Option Category");

  //delete products option category
} elseif (isset($_GET['delete_options_category'])) {
  $access_url = SECURE($_GET['access_url'], "d");
  $delete_options_category = SECURE($_GET['delete_options_category'], "d");

  if ($delete_options_category == true) {
    $control_id = SECURE($_GET['control_id'], "d");
    $delete_options_category = DELETE_FROM("pro_options_categories", "ProOptionCategoryId='$control_id'");
    RESPONSE($delete_options_category, "Option Category Delete Permanently!", "Unable to Delete Option Category Permanently");
  } else {
    LOCATION("warning", "Invalid Activity Record!", $access_url);
  }

  //add option values for the propducts
} elseif (isset($_POST['AddProductOptionsValues'])) {
  $ProOptionProductId = SECURE($_POST['AddProductOptionsValues'], "d");

  //save product all available prices with frame
  $WithFrameSizes = array("10x13 inch", "14x18 inch", "18x24 inch", "24x30 inch", "27x37 inch");
  foreach ($_POST['WITHFRAMEPRICE'] as $key => $values) {
    $ProOptionCategoryId = "WITH_FRAME";
    $ProOptionName = "With Frame";
    $ProOptionValue = $WithFrameSizes[$key];
    $ProOptionCharges = $values;

    $SaveProductFrameOptionPrices = SAVE("pro_options", ["ProOptionCategoryId", "ProOptionName", "ProOptionValue", "ProOptionCharges", "ProOptionProductId"]);
  }

  //save product all available prices without frameoptions
  $WithOutFrameSizes = array("10x13 inch", "14x18 inch", "18x24 inch", "24x30 inch", "27x37 inch", "30x45 inch", "36x54 inch");
  foreach ($_POST['WITHOUTFRAMEPRICE'] as $key => $values) {
    $ProOptionCategoryId = "WITH_OUT_FRAME";
    $ProOptionName = "Without Frame";
    $ProOptionValue = $WithOutFrameSizes[$key];
    $ProOptionCharges = $values;

    $SaveProductWithoutFrameOptionPrices = SAVE("pro_options", ["ProOptionCategoryId", "ProOptionName", "ProOptionValue", "ProOptionCharges", "ProOptionProductId"]);
  }

  //save product paper options
  foreach ($_POST['PaperOption'] as $Key => $values) {
    $ProOptionCategoryId = "PAPER_OPTION";
    $ProOptionName = "Paper Options";
    $ProOptionValue = $values;
    $ProOptionCharges = 0;

    $SaveProductPaperOption = SAVE("pro_options", ["ProOptionCategoryId", "ProOptionName", "ProOptionValue", "ProOptionCharges", "ProOptionProductId"]);
  }

  //save product color options
  foreach ($_POST['ColorOptions'] as $Key => $values) {
    $ProOptionCategoryId = "COLOR_OPTION";
    $ProOptionName = "Color Options";
    $ProOptionValue = $values;
    $ProOptionCharges = 0;

    $SaveProductColorOption = SAVE("pro_options", ["ProOptionCategoryId", "ProOptionName", "ProOptionValue", "ProOptionCharges", "ProOptionProductId"]);
  }

  RESPONSE($SaveProductColorOption, "Product Option are save successfully", "Unable to save product option values");

  //edit products option values
} elseif (isset($_POST['UpdateProductOptionValues'])) {
  $ProOptionId = SECURE($_POST['UpdateProductOptionValues'], "d");
  $ProOptionCategoryId = $_POST['ProOptionCategoryId'];
  $ProOptionName = $_POST['ProOptionName'];
  $ProOptionValue = $_POST['ProOptionValue'];
  $ProOptionCharges = $_POST['ProOptionCharges'];

  $UpdateOptionValues = UPDATE_TABLE("pro_options", ["ProOptionName", "ProOptionValue", "ProOptionCharges"], "ProOptionsId='$ProOptionId'");
  RESPONSE($UpdateOptionValues, "Option Value Updated Successfully!", "Unable to Update Option Value");

  //delete products option values
} elseif (isset($_GET['delete_option_values'])) {
  $access_url = SECURE($_GET['access_url'], "d");
  $delete_option_values = SECURE($_GET['delete_option_values'], "d");

  if ($delete_option_values == true) {
    $control_id = SECURE($_GET['control_id'], "d");
    $delete_option_values = DELETE_FROM("pro_options", "ProOptionsId='$control_id'");
    RESPONSE($delete_option_values, "Option Value Delete Permanently!", "Unable to Delete Option Value Permanently");
  } else {
    LOCATION("warning", "Invalid Activity Record!", $access_url);
  }

  //create product specifications
} elseif (isset($_POST['createproductspecifications'])) {
  $ProdProductId = SECURE($_POST['createproductspecifications'], "d");
  $ProSpecificationName = $_POST['ProSpecificationName'];
  $ProSpecificationValue = POST("ProSpecificationValue");

  $Save = SAVE("pro_specifications", ["ProSpecificationName", "ProSpecificationValue", "ProdProductId"]);
  RESPONSE($Save, "Product Specification Created Successfully!", "Unable to Create Product Specification");

  //edit product specifications
} elseif (isset($_POST['UpdateProductSpecifications'])) {
  $ProSpecificationId  = SECURE($_POST['UpdateProductSpecifications'], "d");
  $ProSpecificationName = $_POST['ProSpecificationName'];
  $ProSpecificationValue = POST("ProSpecificationValue");

  $Update = UPDATE_TABLE("pro_specifications", ["ProSpecificationName", "ProSpecificationValue"], "ProSpecificationId='$ProSpecificationId'");
  RESPONSE($Update, "Product Specification Updated Successfully!", "Unable to Update Product Specification");

  //delete product specifications
} elseif (isset($_GET['delete_pro_specifications'])) {
  $access_url = SECURE($_GET['access_url'], "d");
  $delete_pro_specifications = SECURE($_GET['delete_pro_specifications'], "d");

  if ($delete_pro_specifications == true) {
    $control_id = SECURE($_GET['control_id'], "d");
    $delete_pro_specifications = DELETE_FROM("pro_specifications", "ProSpecificationId='$control_id'");
    RESPONSE($delete_pro_specifications, "Product Specification Delete Permanently!", "Unable to Delete Product Specification Permanently");
  } else {
    LOCATION("warning", "Invalid Activity Record!", $access_url);
  }
  //unknown request
  //unknown request found to this page and redirect to access denied page
} else {
  LOCATION("warning", "Unknown Product Request is received!", $access_url);
}

RESPONSE(false, "", "Unknown Request of access is receive!");
