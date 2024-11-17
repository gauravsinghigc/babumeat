<?php

//required files
require '../../require/modules.php';
require '../../require/admin/access-control.php';
require '../../require/admin/sessionvariables.php';

//page variables
$PageName = "ADD Products";

if (isset($_GET['id'])) {
   $ViewProductId = SECURE($_GET['id'], "d");
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
   <title><?php echo $PageName; ?> | <?php echo APP_NAME; ?></title>
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
                           <h4 class="app-heading">Upload Product Images</h4>
                        </div>
                     </div>
                     <div class="row m-t-10">
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
                     <br>
                     <div class="row">
                        <div class="col-md-12">
                           <form class="data-form" action="../../controller/productscontroller.php" method="POST" enctype="multipart/form-data">
                              <?php FormPrimaryInputs(ADMIN_URL . "/products/add-specification.php?id=" . SECURE($ViewProductId, "e")); ?>
                              <div class="flex-s-b app-heading">
                                 <h4 class="mt-0 mb-0">Upload Images</h4>
                              </div>
                              <div class="col-md-6 col-sm-6 col-lg-6 col-12 form-group">
                                 <label>Select Images</label>
                                 <input type="file" name="ProImageName[]" id="ProImages" class="form-control-2" accept="image/*" multiple="" placeholder="">
                              </div>
                              <div class="row">
                                 <div class="col-md-12">
                                    <div class="gallery"></div>
                                 </div>
                              </div>
                              <div class="row">
                                 <div class="col-md-12">
                                    <br><br>
                                    <button type="Submit" value="<?php echo SECURE($_SESSION['VIEW_PRODUCT_ID'], "e"); ?>" name="UploadProductImages" class="btn btn-md app-btn">Upload Images</button>
                                    <hr>
                                 </div>
                              </div>
                           </form>
                        </div>
                     </div>
                  </div>

                  <!--End page content-->
               </div>

               <?php include '../../include/admin/sidebar.php'; ?>
            </div>
            <?php include '../../include/admin/footer.php'; ?>
         </div>

         <?php include '../../include/admin/footer_files.php'; ?>
</body>

</html>