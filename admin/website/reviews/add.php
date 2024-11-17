<?php

//required files
require '../../../require/modules.php';
require '../../../require/admin/access-control.php';
require '../../../require/admin/sessionvariables.php';

//page variables
$PageName = "Add New Reviews";
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=0.9">
  <title><?php echo $PageName; ?> | <?php echo APP_NAME; ?></title>
  <?php include '../../../include/admin/header_files.php'; ?>

</head>

<body>
  <div id="container" class="effect mainnav-lg navbar-fixed mainnav-fixed">
    <?php include '../../../include/admin/header.php'; ?>

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
                  <h4 class="app-heading"><?php echo $PageName; ?></h4>
                </div>
              </div>
              <div class="row m-t-10">
                <div class="col-md-12">
                  <h4 class="app-sub-heading">Select Product Details</h4>
                  <form action="" method="GET">
                    <div class="form-group">
                      <select name="ReviewedProductid" class="form-control-2" onchange="form.submit()">
                        <option value="0">Select Product for Review</option>
                        <?php
                        $FetchProductId = FetchConvertIntoArray("SELECT * FROM products ORDER by ProductId DESC", true);
                        if ($FetchProductId != null) {
                          foreach ($FetchProductId as $Requests) { ?>
                            <option value="<?php echo $Requests->ProductId; ?>"><?php echo $Requests->ProductName; ?> @ Rs.<?php echo $Requests->ProductSellPrice; ?></option>
                        <?php
                          }
                        } ?>
                      </select>
                    </div>
                  </form>
                  <?php if (isset($_GET['ReviewedProductid'])) {
                    $ViewProductId = $_GET['ReviewedProductid'];
                    $PageSqls = "SELECT * FROM products where ProductId='$ViewProductId'"; ?>
                    <div class="row shadow-lg br10 p-1r m-t-10">
                      <div class="col-md-4 col-lg-4 col-sm-4 col-12 text-center">
                        <div class="product-image">
                          <img src="<?php echo STORAGE_URL; ?>/products/pro-img/<?php echo GET_DATA('ProductImage'); ?>" id="ImgPreview">
                        </div>
                      </div>
                      <div class="col-md-8 col-lg-8 col-sm-8 col-12">
                        <table class="table table-striped">
                          <tr>
                            <th>Reference Code/HSN/ProductCode</th>
                            <td class="text-info"><i class="fa fa-hashtag"></i> <?php echo GET_DATA("ProductRefernceCode"); ?></td>
                          </tr>
                          <tr>
                            <th>Product Name</th>
                            <td><?php echo GET_DATA("ProductName"); ?></td>
                          </tr>
                          <tr>
                            <th>Product Category</th>
                            <td><?php echo FETCH("SELECT * FROM pro_categories where ProCategoriesId='" . GET_DATA("ProductCategoryId") . "'", "ProCategoryName"); ?></td>
                          </tr>
                          <tr>
                            <th>Product Sub Category</th>
                            <td><?php echo FETCH("SELECT * FROM pro_sub_categories where ProSubCategoriesId='" . GET_DATA("ProductSubCategoryId") . "'", "ProSubCategoryName"); ?></td>
                          </tr>
                          <tr>
                            <th>Product Brand</th>
                            <td><?php echo FETCH("SELECT * FROM pro_brands where ProBrandId='" . GET_DATA("ProductBrandId") . "'", "ProBrandName"); ?></td>
                          </tr>
                          <tr>
                            <th>Product Price</th>
                            <td><?php echo Price(GET_DATA("ProductSellPrice")); ?> / <strike class="text-danger"><span class="text-primary"><?php echo Price(GET_DATA("ProductMrpPrice")); ?></span></strike></td>
                          </tr>
                          <tr>
                            <th>Product Quantity</th>
                            <td><?php echo GET_DATA("ProductWeight"); ?></td>
                          </tr>
                          <tr>
                            <th>Product Description</th>
                            <td><?php echo html_entity_decode(SECURE(GET_DATA("ProductDescriptions"), "d")); ?></td>
                          </tr>
                        </table>
                      </div>
                    </div>

                  <?php } ?>
                  <br>
                  <h4 class="app-sub-heading">Enter Review Details</h4>
                  <form action="../../../controller/reviewcontroller.php" method="POST" enctype="multipart/form-data">
                    <?php if (isset($_GET['ReviewedProductid'])) {
                      $ReviewedProductid = $_GET['ReviewedProductid'];
                    } else {
                      $ReviewedProductid = 0;
                    } ?>
                    <input type="text" name="ReviewedProductid" value="<?php echo $ReviewedProductid; ?>" hidden="">
                    <?php FormPrimaryInputs(true); ?>
                    <div class="row">
                      <div class="form-group col-lg-12 col-sm-12 col-md-12 col-6">
                        <label>Review Title</label>
                        <input type="text" name="ReviewTitle" value="" placeholder="" class="form-control-2" required="">
                      </div>
                      <div class="col-md-12 form-group">
                        <label>Review Descriptions</label>
                        <textarea name="ReviewDescriptions" id="editor" class="form-control-2" rows="4"></textarea>
                      </div>
                      <div class="form-group col-lg-4 col-md-4 col-sm-4">
                        <label>Review Display Status</label>
                        <select name="ReviewStatus" class="form-control-2" required="">
                          <option value="1">Active</option>
                          <option value="0">Inactive</option>
                        </select>
                      </div>
                      <div class="form-group col-lg-4 col-sm-4 col-md-4 col-6">
                        <label>Review Star Rating</label>
                        <select class="form-control-2" name="ReviewStarCount" required="">
                          <?php InputOptions(["1", "2", "3", "4", "5"]); ?>
                        </select>
                      </div>
                      <div class="form-group col-lg-4 col-md-4 col-sm-4 col-12">
                        <label>Review By (Customer Add)</label>
                        <select name="ReviewedCustomerId" class="form-control-2" required="">
                          <?php
                          $FetchCustomers = FetchConvertIntoArray("SELECT * FROM customers ORDER by CustomerName ASC", true);
                          if ($FetchCustomers != null) {
                            foreach ($FetchCustomers as $Requests) {
                          ?>
                              <option value="<?php echo $Requests->CustomerId; ?>"><?php echo $Requests->CustomerName; ?></option>
                          <?php
                            }
                          } ?>
                        </select>
                      </div>

                      <div class="col-md-12">
                        <?php UploadImageInput("ReviewProfileImage", "ReviewProfileImage1", "image/*", true, ""); ?>
                      </div>
                      <div class="col-md-12">
                        <br>
                        <button type="submit" name="CreateReviews" class="btn btn-md app-btn">Save</button>
                        <button type="reset" class="btn btn-md btn-danger">Reset</button>
                        <a href="index.php" class="btn btn-md btn-primary">Back to All</a>
                        <br>
                        <br>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>

          <!--End page content-->
        </div>

        <?php include '../../../include/admin/sidebar.php'; ?>
      </div>
      <?php include '../../../include/admin/footer.php'; ?>
    </div>

    <?php include '../../../include/admin/footer_files.php'; ?>
</body>

</html>