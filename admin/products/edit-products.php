<?php

//required files
require '../../require/modules.php';
require '../../require/admin/access-control.php';
require '../../require/admin/sessionvariables.php';

//page variables
$PageName = "Edit Product Details";

//page requests
if (isset($_GET['productid'])) {
  $ViewProductId = SECURE($_GET['productid'], "d");
  $_SESSION['VIEW_PRODUCT_ID'] = $ViewProductId;
} else {
  $ViewProductId = $_SESSION['VIEW_PRODUCT_ID'];
}

//product details
$PageSqls = "SELECT * FROM products where ProductId='$ViewProductId'";
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=0.9">
  <title><?php echo GET_DATA("ProductName"); ?> | <?php echo APP_NAME; ?></title>
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
              <div class="row">
                <div class="col-md-12">
                  <h4 class="app-sub-heading"><i class="fa fa-edit"></i> <?php echo $PageName; ?> : <?php echo GET_DATA("ProductName"); ?></h4>
                </div>
                <div class="col-md-12">
                  <div class="flex-s-b">
                    <?php include 'common.php'; ?>
                  </div>
                </div>
              </div>
              <div class="row shadow-lg br10 p-1r m-t-10">
                <div class="col-md-4 col-lg-4 col-sm-4 col-12 text-center">
                  <div class="product-image flex-s-b">
                    <img src="<?php echo STORAGE_URL; ?>/products/pro-img/<?php echo GET_DATA('ProductImage'); ?>" id="ImgPreview">
                    <img src="<?php echo STORAGE_URL; ?>/products/pro-img/<?php echo GET_DATA('ProductImage2'); ?>" id="ImgPreview">
                  </div>
                </div>
                <div class="col-md-8 col-lg-8 col-sm-8 col-12">
                  <table class="table">
                    <tr>
                      <th>ITEM CODE</th>
                      <td class="text-info"><i class="fa fa-hashtag"></i> <?php echo GET_DATA("ProductRefernceCode"); ?></td>
                    </tr>
                    <tr>
                      <th>Painting Name</th>
                      <td><?php echo GET_DATA("ProductName"); ?></td>
                    </tr>
                    <tr>
                      <th>Painting Collection</th>
                      <td><?php echo FETCH("SELECT * FROM pro_categories where ProCategoriesId='" . GET_DATA("ProductCategoryId") . "'", "ProCategoryName"); ?></td>
                    </tr>
                    <tr>
                      <th>Size</th>
                      <td><?php echo GET_DATA("ProductSize"); ?></td>
                    </tr>
                    <tr>
                      <th>Work Type</th>
                      <td><?php echo GET_DATA("ProductWorkType"); ?></td>
                    </tr>
                    <tr>
                      <th>Painting Medium</th>
                      <td><?php echo GET_DATA("ProductMedium"); ?></td>
                    </tr>
                    <tr>
                      <th>Product Description</th>
                      <td><?php echo html_entity_decode(SECURE(GET_DATA("ProductDescriptions"), "d")); ?></td>
                    </tr>
                  </table>
                  <div class="flex-s-b">
                    <a href="edit.php?productid=<?php echo SECURE($ViewProductId, "e"); ?>" class="btn btn-md btn-primary">Edit Details</a>
                    <?php if (GET_DATA("ProductStatus") == 3) { ?>
                      <a href="<?php echo DOMAIN; ?>/controller/productscontroller.php?delete_products=<?php echo SECURE('true', 'e'); ?>&access_url=<?php echo SECURE(RUNNING_URL, "e"); ?>&control_id=<?php echo SECURE($ViewProductId, "e"); ?>" class="btn-danger btn-md btn"><i class="fa fa-trash"></i> Delete Permanent</a>
                      <a href="<?php echo DOMAIN; ?>/controller/productscontroller.php?restore_products=<?php echo SECURE('true', 'e'); ?>&access_url=<?php echo SECURE(DOMAIN . "/admin/products/edit-products.php", "e"); ?>&control_id=<?php echo SECURE($ViewProductId, "e"); ?>" class="btn-success btn-md btn"><i class="fa fa-refresh"></i> Restore</a>
                    <?php } else { ?>
                      <form action="../../controller/productscontroller.php" method="POST">
                        <?php FormPrimaryInputs(true); ?>
                        <button type="submit" name="DeleteProducts" value="<?php SECURE($ViewProductId, "e"); ?>" class="btn btn-md btn-danger"><i class="fa fa-trash"></i> Delete</button>
                      </form>
                    <?php  } ?>
                  </div>
                </div>
              </div>

              <br>
              <div class="row">
                <div class="col-md-5">
                  <div class="flex-s-b app-sub-heading">
                    <h4 class="mb-0 mt-0 p-1">Product Images</h4>
                    <a href="#" onclick="Databar('UploadImages')" class="btn btn-sm btn-primary pull-right"><i class="fa fa-upload"></i> Upload Images</a>
                  </div>
                  <div class="pro-image">
                    <?php
                    //check images and update images
                    $CheckImages = FetchConvertIntoArray("SELECT * FROM pro_images where ProImageProductId='$ViewProductId' ORDER BY ProImagesId DESC", true);
                    if ($CheckImages != null) {
                      foreach ($CheckImages as $Data) { ?>
                        <a href="<?php echo STORAGE_URL; ?>/products/pro-img/<?php echo $Data->ProImageProductId; ?>/<?php echo $Data->ProImageName; ?>" target="_blank">
                          <img src="<?php echo STORAGE_URL; ?>/products/pro-img/<?php echo $Data->ProImageProductId; ?>/<?php echo $Data->ProImageName; ?>" class="img-fluid" title="<?php echo GET_DATA("ProductName"); ?>" alt="<?php echo GET_DATA("ProductName"); ?>">
                        </a>
                    <?php
                        CONFIRM_DELETE_POPUP(
                          "pro_img" . $Data->ProImagesId,
                          $Requests = [
                            "delete_product_images" => "true",
                            "control_id" => $Data->ProImagesId,
                          ],
                          "productscontroller",
                          "<i class='fa fa-trash'></i>",
                          "btn-danger pro-img-del-btn"
                        );
                      }
                    } ?>
                  </div>
                </div>


                <div class="col-md-7">
                  <div class="flex-s-b app-sub-heading">
                    <h4 class="mt-0 mb-0 p-1">Available Options</h4>
                    <a href="#" onclick="Databar('AddOptions')" class="btn btn-sm btn-primary pull-right m-1">Add Options</a>
                  </div>


                  <div class="table-responsive">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th>Sno</th>
                          <th>OptionName</th>
                          <th>Options</th>
                          <th>Charges</th>
                          <th>Taxes (GST)</th>
                          <th>Net Price</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $fetchoptions = FetchConvertIntoArray("SELECT * FROM  pro_options where  pro_options.ProOptionProductId='$ViewProductId' ORDER BY ProOptionsId ASC", true);
                        if ($fetchoptions != null) {
                          $CountNo = 0;
                          foreach ($fetchoptions as $Request) {
                            $CountNo++;
                            $Requestid = $Request->ProOptionsId;
                            $ProOptionCategoryId = $Request->ProOptionCategoryId;
                            $ProOptionName = $Request->ProOptionName;
                            $ProOptionName = str_replace("_", " ", $ProOptionName);
                            $ProOptionCharges = $Request->ProOptionCharges;
                            $ProOptionValue = $Request->ProOptionValue;
                        ?>
                            <tr>
                              <td><?php echo $CountNo; ?></td>
                              <th><b><?php echo $ProOptionName; ?></b></th>
                              <td>
                                <?php echo $Request->ProOptionValue; ?>
                                <?php if ($ProOptionCategoryId == "COLOR_OPTION") { ?>
                                  <span class="color-box-2" style="background-color:<?php echo $ProOptionValue; ?> !important;"></span>
                                <?php } ?>
                              </td>
                              <td><?php echo Price($Request->ProOptionCharges); ?></td>
                              <td><?php echo GET_DATA("ProductApplicableTaxes"); ?>% (+<?php echo Price($NetPrice =  (int)$ProOptionCharges / 100 * (int)GET_DATA("ProductApplicableTaxes")); ?>)</td>
                              <td>
                                <?php $NetPrice =  (int)$ProOptionCharges / 100 * (int)GET_DATA("ProductApplicableTaxes");
                                $Netprice = round($NetPrice + (int)$ProOptionCharges);
                                echo Price($Netprice); ?>
                              </td>
                              <td>
                                <a href="#" onclick="Databar('edit_options_<?php echo $Requestid; ?>')" class="btn btn-sm btn-info"><i class="fa fa-edit"></i></a>
                                <?php
                                CONFIRM_DELETE_POPUP(
                                  "delete_option_values",
                                  $Request = [
                                    "delete_option_values" => "true",
                                    "control_id" => $Request->ProOptionsId
                                  ],
                                  "productscontroller",
                                  "<i class='fa fa-trash'></i>",
                                  "btn-danger btn-sm"
                                );
                                ?>
                                <section class="add-section" id="edit_options_<?php echo $Requestid; ?>">
                                  <div class="add-data-form">
                                    <form class="data-form" action="../../controller/productscontroller.php" method="POST" enctype="multipart/form-data">
                                      <?php FormPrimaryInputs(true); ?>
                                      <div class="main-data">
                                        <div class="main-data-header app-bg">
                                          <div class="flex-s-b app-heading">
                                            <h4 class="mt-0 mb-0">Add Optional Values</h4>
                                            <a class="btn btn-sm btn-danger sqaure" onclick="Databar('edit_options_<?php echo $Requestid; ?>')"><i class="fa fa-times fs-17"></i></a>
                                          </div>
                                        </div>
                                        <div class="main-data-body p-2">
                                          <div class="row">
                                            <div class="col-md-6 col-sm-6 col-lg-6 col-12 form-group">
                                              <label>Option Name</label>
                                              <input type="text" name="ProOptionName" value="<?php echo $ProOptionName; ?>" list="ProOptionName" class="form-control-2" required="">
                                              <?php SUGGEST("pro_options", "ProOptionName", "ASC"); ?>
                                            </div>
                                            <div class="col-md-6 col-sm-6 col-lg-6 col-12 form-group">
                                              <label>Option Value</label>
                                              <input type="text" name="ProOptionValue" list="ProOptionValue" value="<?php echo $ProOptionValue; ?>" class="form-control-2" required="">
                                              <?php SUGGEST("pro_options", "ProOptionValue", "ASC"); ?>
                                            </div>
                                            <div class="col-md-6 col-sm-6 col-lg-6 col-12 form-group">
                                              <label>Applicable Additional Charges (in Rs.)</label>
                                              <input type="text" name="ProOptionCharges" list="ProOptionCharges" value="<?php echo $ProOptionCharges; ?>" class="form-control-2" required="">
                                              <?php SUGGEST("pro_options", "ProOptionCharges", "ASC"); ?>
                                            </div>
                                          </div>
                                        </div>
                                        <div class="main-data-footer">
                                          <button type="Submit" value="<?php echo SECURE($Requestid, "e"); ?>" name="UpdateProductOptionValues" class="btn btn-md app-btn">Update Details</button>
                                          <a onclick="Databar('edit_options_<?php echo $Requestid; ?>')" class="btn btn-md btn-danger">Cancel</a>
                                        </div>
                                    </form>
                                  </div>
                                </section>
                              </td>
                            </tr>
                        <?php }
                        }
                        ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6 m-t-10">
                  <div class="flex-s-b app-sub-heading">
                    <h4 class="mt-0 mb-0 p-1">Product Specifications</h4>
                    <a href="add-specifications.php?proid=<?php echo SECURE($ViewProductId, "e"); ?>" class="btn btn-sm btn-primary">Add Specifications</a>
                  </div>
                  <div class="table-responsive">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th>SNo</th>
                          <th>Name</th>
                          <th>Value</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $FetchSpecifications = FetchConvertIntoArray("SELECT * FROM pro_specifications where ProdProductId='$ViewProductId' ORDER BY ProSpecificationId ASC", true);
                        if ($FetchSpecifications != null) {
                          $CountNo = 0;
                          foreach ($FetchSpecifications as $Data) {
                            $CountNo++;
                        ?>
                            <tr>
                              <td><?php echo $CountNo; ?></td>
                              <td><?php echo $Data->ProSpecificationName; ?></td>
                              <td><?php echo SECURE($Data->ProSpecificationValue, "d"); ?></td>
                              <td>
                                <a href="edit-specifications.php?spec-id=<?php echo SECURE($Data->ProSpecificationId, "e"); ?>" class="btn btn-sm btn-info"><i class="fa fa-edit"></i></a>
                                <?php
                                CONFIRM_DELETE_POPUP(
                                  "delete_options_",
                                  $Requests = [
                                    "delete_pro_specifications" => true,
                                    "control_id" => $Data->ProSpecificationId,
                                  ],
                                  "productscontroller",
                                  "<i class='fa fa-trash'></i>",
                                  "btn-danger btn-sm"
                                ); ?>
                              </td>
                            </tr>
                        <?php
                          }
                        } ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>

              <?php include '../../include/admin/sidebar.php'; ?>
            </div>
            <?php include '../../include/admin/footer.php'; ?>
          </div>
        </div>
      </div>
    </div>

    <section class="add-section" id="Addpackages">
      <div class="add-data-form">
        <form class="data-form" action="../../controller/productscontroller.php" method="POST" enctype="multipart/form-data">
          <?php FormPrimaryInputs(true); ?>
          <div class="main-data">
            <div class="main-data-header app-bg">
              <div class="flex-s-b app-heading">
                <h4 class="mt-0 mb-0">Add New Package</h4>
                <a class="btn btn-sm btn-danger sqaure" onclick="Databar('Addpackages')"><i class="fa fa-times fs-17"></i></a>
              </div>
            </div>
            <div class="main-data-body p-2">
              <div class="row">
                <div class="col-md-6 col-sm-6 col-lg-6 col-12 form-group">
                  <label>Product Package Name</label>
                  <input type="text" name="ProductPackageName" class="form-control" placeholder="">
                </div>
                <div class="col-md-6 col-sm-6 col-lg-6 col-12 form-group">
                  <label>Product Package Sell Price</label>
                  <input type="text" name="ProductPackageSellPrice" class="form-control" placeholder="">
                </div>
                <div class="col-md-6 col-sm-6 col-lg-6 col-12 form-group">
                  <label>Product Package Mrp</label>
                  <input type="text" name="ProductPackageMrp" class="form-control" placeholder="">
                </div>
                <div class="col-md-6 col-sm-6 col-lg-6 col-12 form-group">
                  <label>Product Package Ref Number</label>
                  <input type="text" name="ProductPackageRefNumber" class="form-control" placeholder="">
                </div>
                <div class="col-md-12 col-sm-12 col-12 form-group">
                  <label>Package Description</label>
                  <textarea name="ProductPackageDetails" rows="3" id="editor"></textarea>
                </div>
              </div>
            </div>
            <div class="main-data-footer">
              <button type="Submit" value="null" name="CreateNewPackages" class="btn btn-md app-btn">Add Packages</button>
              <a onclick="Databar('Addpackages')" class="btn btn-md btn-danger">Cancel</a>
            </div>
        </form>
      </div>
    </section>

    <section class="add-section" id="Editproducts">
      <div class="add-data-form">
        <form class="data-form" action="../../controller/productscontroller.php" method="POST" enctype="multipart/form-data">
          <?php FormPrimaryInputs(true); ?>
          <div class="main-data">
            <div class="main-data-header app-bg">
              <div class="flex-s-b app-heading">
                <h4 class="mt-0 mb-0">Update Product Details</h4>
                <a class="btn btn-sm btn-danger sqaure" onclick="Databar('Editproducts')"><i class="fa fa-times fs-17"></i></a>
              </div>
            </div>
            <div class="main-data-body p-2">
              <div class="row">
                <?php CurrentFile(GET_DATA("ProductImage"));  ?>
                <?php FormPrimaryInputs(true); ?>
                <div class="form-group col-lg-6 col-md-6 col-ms-6 col-12">
                  <label>Enter Painting Name</label>
                  <input type="text" name="ProductName" value="<?php echo GET_DATA('ProductName'); ?>" class="form-control-2" required="" />
                </div>
                <div class="form-group col-lg-6 col-md-6 col-ms-6 col-12">
                  <label>Select Collection Name</label>
                  <select name="ProductCategoryId" class="form-control-2" required="">
                    <?php
                    $ProductCategoryId = GET_DATA("ProductCategoryId");
                    $SqlProCategories2 = SELECT("SELECT * FROM pro_categories ORDER BY ProCategoryName ASC");
                    while ($FetchProCategories2 = mysqli_fetch_array($SqlProCategories2)) {
                      if ($FetchProCategories2['ProCategoriesId'] == $ProductCategoryId) {
                        $selected = "selected=''";
                      } else {
                        $selected = "";
                      } ?>
                      <option value="<?php echo $FetchProCategories2['ProCategoriesId']; ?>" <?php echo $selected; ?>><?php echo $FetchProCategories2['ProCategoryName']; ?></option>
                    <?php } ?>
                  </select>
                </div>
                <div class="form-group col-lg-6 col-md-6 col-ms-6 col-12">
                  <label>Select Sub Collection Name</label>
                  <select name="ProductSubCategoryId" class="form-control-2" required="">
                    <?php
                    $ProductSubCategoryId = GET_DATA("ProductSubCategoryId");
                    $SqlSubcategory = SELECT("SELECT * FROM pro_sub_categories ORDER BY ProSubCategoryName ASC");
                    while ($fetchsubcategory = mysqli_fetch_array($SqlSubcategory)) {
                      if ($fetchsubcategory['ProSubCategoriesId'] == $ProductSubCategoryId) {
                        $selected = "selected=''";
                      } else {
                        $selected = "";
                      } ?>
                      <option value="<?php echo $fetchsubcategory['ProSubCategoriesId']; ?>" <?php echo $selected; ?>><?php echo $fetchsubcategory['ProSubCategoryName']; ?></option>
                    <?php } ?>
                  </select>
                </div>
                <div class="form-group col-lg-6 col-md-6 col-ms-6 col-12">
                  <label>Select Artist</label>
                  <select name="ProductBrandId" class="form-control-2" required="">
                    <?php
                    $ProductBrandId = GET_DATA("ProductBrandId");
                    $Sqlbrands = SELECT("SELECT * FROM pro_brands ORDER BY ProBrandName ASC");
                    while ($fetchbrands = mysqli_fetch_array($Sqlbrands)) {
                      if ($fetchbrands['ProBrandId'] == $ProductBrandId) {
                        $selected = "selected=''";
                      } else {
                        $selected = "";
                      } ?>
                      <option value="<?php echo $fetchbrands['ProBrandId']; ?>" <?php echo $selected; ?>><?php echo $fetchbrands['ProBrandName']; ?></option>
                    <?php } ?>
                  </select>
                </div>
                <div class="form-group col-lg-6 col-md-6 col-ms-6 col-12">
                  <label>Item Code</label>
                  <input type="text" name="ProductRefernceCode" value="<?php echo GET_DATA('ProductRefernceCode'); ?>" class="form-control-2" required="" />
                </div>
                <div class="form-group col-lg-6 col-md-6 col-ms-6 col-12">
                  <label>Enter Sell Price</label>
                  <input type="text" name="ProductSellPrice" value="<?php echo GET_DATA('ProductSellPrice'); ?>" class="form-control-2" required="" />
                </div>
                <div class="form-group col-lg-6 col-md-6 col-ms-6 col-12">
                  <label>Enter MRP</label>
                  <input type="text" name="ProductMrpPrice" value='<?php echo GET_DATA("ProductMrpPrice"); ?>' class="form-control-2" required="" />
                </div>
                <div class="form-group col-lg-6 col-md-6 col-ms-6 col-12">
                  <label>Enter Weight/Measurement Unit</label>
                  <input type="text" name="ProductWeight" value="<?php echo GET_DATA('ProductWeight'); ?>" class="form-control-2" required="" />
                </div>
                <div class="form-group col-lg-12 col-md-12 col-ms-12 col-12">
                  <label>Enter Product Descriptions</label>
                  <textarea type="text" id="editor" name="ProductDescriptions" style="height:100% !important;" row="3" class="form-control-2"><?php echo SECURE(GET_DATA("ProductDescriptions"), "d"); ?></textarea>
                </div>
                <div class="form-group col-lg-6 col-md-6 col-ms-6 col-12">
                  <label>Upload New Primary Image</label>
                  <input type="FILE" name="ProductImage" value="null" id="uploadimage" accept="image/png, image/gif, image/jpeg" class="form-control-2" />
                </div>
                <div class="form-group col-md-6 col-lg-6 col-sm-6 col-12">
                  <label>Product Status</label>
                  <select class="form-control-2" name="ProductStatus" required="">
                    <?php
                    if (GET_DATA("ProductStatus") == 1) { ?>
                      <option value="1" selected="">Active</option>
                      <option value="2">Inactive</option>
                    <?php } else { ?>
                      <option value="1">Active</option>
                      <option value="2" selected="">Inactive</option>
                    <?php } ?>
                  </select>
                </div>
                <div class="col-md-12 m-t-10 m-b-100">
                  <div class="flex-c mb-2-pr">
                    <img src="<?php echo STORAGE_URL; ?>/products/pro-img/<?php echo GET_DATA('ProductImage'); ?>" id="ImgPreview">
                  </div>
                </div>

                <br><br><br><br><br><br><br><br><br>
              </div>
              <div class="main-data-footer">
                <button type="Submit" value="null" name="UpdateProducts" class="btn btn-md app-btn">Update Details</button>
                <a onclick="Databar('Editproducts')" class="btn btn-md btn-danger">Cancel</a>
              </div>

            </div>
        </form>
      </div>
    </section>

    <!-- upload images -->
    <section class="add-section" id="AddOptionsCategory">
      <div class="add-data-form">
        <form class="data-form" action="../../controller/productscontroller.php" method="POST" enctype="multipart/form-data">
          <?php FormPrimaryInputs(true); ?>
          <div class="main-data">
            <div class="main-data-header app-bg">
              <div class="flex-s-b app-heading">
                <h4 class="mt-0 mb-0">Option Category</h4>
                <a class="btn btn-sm btn-danger sqaure" onclick="Databar('AddOptionsCategory')"><i class="fa fa-times fs-17"></i></a>
              </div>
            </div>
            <div class="main-data-body p-2">
              <div class="row">
                <div class="col-md-6 col-sm-6 col-lg-6 col-12 form-group">
                  <label>Enter Option Category Name</label>
                  <input type="text" name="ProOptionCategoryName" list="ProOptionCategoryName" class="form-control-2" placeholder="">
                  <?php SUGGEST("pro_options_categories", "ProOptionCategoryName", "ASC"); ?>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="gallery"></div>
                </div>
              </div>
            </div>
            <div class="main-data-footer">
              <button type="Submit" value="<?php echo SECURE($_SESSION['VIEW_PRODUCT_ID'], "e"); ?>" name="AddProductOptionCategory" class="btn btn-md app-btn">Save Option Category</button>
              <a onclick="Databar('AddOptionsCategory')" class="btn btn-md btn-danger">Cancel</a>
            </div>
        </form>
      </div>
    </section>

    <!-- upload images -->
    <section class="add-section" id="AddOptions">
      <div class="add-data-form">
        <form class="data-form" action="../../controller/productscontroller.php" method="POST" enctype="multipart/form-data">
          <?php FormPrimaryInputs(true); ?>
          <div class="main-data">
            <div class="main-data-header app-bg">
              <div class="flex-s-b app-heading">
                <h4 class="mt-0 mb-0">Add Optional Values</h4>
                <a class="btn btn-sm btn-danger sqaure" onclick="Databar('AddOptions')"><i class="fa fa-times fs-17"></i></a>
              </div>
            </div>
            <div class="main-data-body p-2">
              <div class="row">
                <div class="col-md-6 m-t-10">
                  <h4 class="app-sub-heading">Paper Options</h4>
                  <div class="flex-start col-md-6 col-lg-6 col-sm-6">
                    <?php
                    $PaperOptions = array("Canvas", "Paper");
                    foreach ($PaperOptions as $key => $value) {
                      if ($key == 0) {
                        $checked = "checked";
                      } else {
                        $checked = "";
                      } ?>
                      <div class="form-group btn btn-md btn-default option-btn">
                        <label class="m-0 mt-0 mb-3">
                          <input type="checkbox" name="PaperOption[]" value="<?php echo $value; ?>" <?php echo $checked;  ?>> <?php echo $value; ?>
                        </label>
                      </div>
                    <?php } ?>
                  </div>
                </div>

                <div class="col-md-6 m-t-10">
                  <h4 class="app-sub-heading">Frame Color Options</h4>
                  <div class="flex-start col-md-6 col-lg-6 col-sm-6">
                    <?php
                    $PaperOptions = array("Black", "Brown", "Gold");
                    foreach ($PaperOptions as $key => $value) {
                      if ($key == 0) {
                        $checked = "checked";
                      } else {
                        $checked = "";
                      } ?>
                      <div class="form-group btn btn-md btn-default option-btn">
                        <label class="m-0 mt-0 mb-3">
                          <input type="checkbox" name="ColorOptions[]" value="<?php echo $value; ?>" <?php echo $checked;  ?>> <?php echo $value; ?>
                          <span class="color-box" style="background-color:<?php echo $value; ?> !important;"></span>
                        </label>
                      </div>
                    <?php } ?>
                  </div>
                </div>

                <div class="col-lg-6 col-md-6 col-sm-6 col-12 m-t-10">
                  <h4 class="app-sub-heading">With Frame Price</h4>
                  <table class="table">
                    <tr>
                      <th>Frame Size (In inches)</th>
                      <th>Applicable Price (without GST)</th>
                    </tr>
                    <?php
                    $WithFrameSizes = array("10x13 inch", "14x18 inch", "18x24 inch", "24x30 inch", "27x37 inch");
                    foreach ($WithFrameSizes as $Framesizes) { ?>
                      <tr>
                        <td><span class="btn btn-md"><?php echo $Framesizes; ?></span></td>
                        <td>
                          <input type="text" name="WITHFRAMEPRICE[]" class="form-control-2 fs-12" required="" placeholder="Rs.">
                        </td>
                      </tr>
                    <?php } ?>
                  </table>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-12 m-t-10">
                  <h4 class="app-sub-heading">Without Frame Price</h4>
                  <table class="table">
                    <tr>
                      <th>Unframed Size (In inches)</th>
                      <th>Applicable Price (without GST)</th>
                    </tr>
                    <?php
                    $WithOutFrameSizes = array("10x13 inch", "14x18 inch", "18x24 inch", "24x30 inch", "27x37 inch", "30x45 inch", "36x54 inch");
                    foreach ($WithOutFrameSizes as $Framesizes) { ?>
                      <tr>
                        <td><span class="btn btn-md"><?php echo $Framesizes; ?></span></td>
                        <td>
                          <input type="text" name="WITHOUTFRAMEPRICE[]" class="form-control-2 fs-12" required="" placeholder="Rs.">
                        </td>
                      </tr>
                    <?php } ?>
                  </table>
                </div>
              </div>
            </div>
            <div class="main-data-footer">
              <button type="Submit" value="<?php echo SECURE($_SESSION['VIEW_PRODUCT_ID'], "e"); ?>" name="AddProductOptionsValues" class="btn btn-md app-btn">Save Details</button>
              <a onclick="Databar('AddOptions')" class="btn btn-md btn-danger">Cancel</a>
            </div>
        </form>
      </div>
    </section>

    <!-- upload images -->
    <section class="add-section" id="UploadImages">
      <div class="add-data-form">
        <form class="data-form" action="../../controller/productscontroller.php" method="POST" enctype="multipart/form-data">
          <?php FormPrimaryInputs(true); ?>
          <div class="main-data">
            <div class="main-data-header app-bg">
              <div class="flex-s-b app-heading">
                <h4 class="mt-0 mb-0">Upload Images</h4>
                <a class="btn btn-sm btn-danger sqaure" onclick="Databar('UploadImages')"><i class="fa fa-times fs-17"></i></a>
              </div>
            </div>
            <div class="main-data-body p-2">
              <div class="row">
                <div class="col-md-6 col-sm-6 col-lg-6 col-12 form-group">
                  <label>Select Images</label>
                  <input type="file" name="ProImageName[]" id="ProImages" class="form-control-2" accept="image/*" multiple="" placeholder="">
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="gallery"></div>
                </div>
              </div>
            </div>
            <div class="main-data-footer">
              <button type="Submit" value="<?php echo SECURE($_SESSION['VIEW_PRODUCT_ID'], "e"); ?>" name="UploadProductImages" class="btn btn-md app-btn">Upload Images</button>
              <a onclick="Databar('Addpackages')" class="btn btn-md btn-danger">Cancel</a>
            </div>
        </form>
      </div>
    </section>

    <script>
      $(function() {
        // Multiple images preview in browser
        var imagesPreview = function(input, placeToInsertImagePreview) {

          if (input.files) {
            var filesAmount = input.files.length;

            for (i = 0; i < filesAmount; i++) {
              var reader = new FileReader();

              reader.onload = function(event) {
                $($.parseHTML('<img>')).attr('src', event.target.result).appendTo(placeToInsertImagePreview);
              }

              reader.readAsDataURL(input.files[i]);
            }
          }
        };

        $('#ProImages').on('change', function() {
          imagesPreview(this, '.gallery');
        });
      });
    </script>
    <?php include '../../include/admin/footer_files.php'; ?>
</body>

</html>