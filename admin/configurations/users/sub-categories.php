<?php

//required files
require '../../../require/modules.php';
require '../../../require/admin/access-control.php';
require '../../../require/admin/sessionvariables.php';

//page variables
$PageName = "Sub Categories";
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
        <div class="pageheader hidden-xs">
          <h3><i class="fa fa-refresh"></i> <?php echo $PageName; ?> </h3>
          <div class="breadcrumb-wrapper">
            <span class="label">You are here:</span>
            <ol class="breadcrumb">
              <li> <a href="<?php echo DOMAIN; ?>/admin"> Home </a> </li>
              <li class="active"> <?php echo $PageName; ?> </li>
            </ol>
          </div>
        </div>
        <div id="page-content">
          <!--====start content===============================================-->

          <div class="panel">
            <div class="panel-heading">
              <div class="flex-s-b">
                <div class="btn-group btn-group-sm">
                  <a href="<?php echo DOMAIN; ?>/admin/products/index.php" class="btn btn-sm btn-success square">All Products</a>
                  <a href="<?php echo DOMAIN; ?>/admin/configurations/products/index.php" class="btn btn-sm btn-primary square">Categories</a>
                  <a href="<?php echo DOMAIN; ?>/admin/configurations/products/sub-categories.php" class="btn btn-sm btn-warning square">Subcategories</a>
                  <a href="<?php echo DOMAIN; ?>/admin/configurations/products/brands.php" class="btn btn-sm btn-danger square">Brands</a>
                </div>
              </div>
            </div>
            <div class="panel-body">
              <div class="flex-s-b">
                <h4 class="m-b-0">All Sub Categories</h4>
                <a href="#" onclick="Databar('AddSubcategories')" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Sub Categories</a>
              </div>
              <div class="row m-t-10">
                <?php
                $SqlProCategories = SELECT("SELECT * FROM pro_categories, pro_sub_categories where pro_categories.ProCategoriesId=pro_sub_categories.ProSubCategoryId ORDER BY pro_sub_categories.ProSubCategoriesId  ASC");
                while ($FetchProCategories = mysqli_fetch_array($SqlProCategories)) {
                  $ProCategoriesId = $FetchProCategories['ProCategoriesId'];
                  $ProCategoryName = $FetchProCategories['ProCategoryName'];
                  $ProSubCategoryName = $FetchProCategories['ProSubCategoryName'];
                  $ProSubCategoryImage = $FetchProCategories['ProSubCategoryImage'];
                  $ProSubCategoryStatus = $FetchProCategories['ProSubCategoryStatus'];
                  $ProCategoryImage = $FetchProCategories['ProCategoryImage'];
                  $ProCategoryStatus = $FetchProCategories['ProCategoryStatus'];
                  $ProCategoryCreatedAt = ReturnValue($FetchProCategories['ProSubCategoryCreatedAt']);
                  $ProCategoryUpdatedAt = ReturnValue($FetchProCategories['ProSubCategoryUpdatedAt']);
                  $StatusView = StatusView($ProSubCategoryStatus); ?>
                  <div class="col-lg-4 col-md-4 col-sm-6 col-12">
                    <div class="shadow-lg br10">
                      <div class="flex-s-b">
                        <div class="img-section">
                          <img src="<?php echo STORAGE_URL; ?>/products/subcategory/<?php echo $ProSubCategoryImage; ?>" class="w-100">
                        </div>
                        <div class="item-details p-1">
                          <p class="lh-1-2 m-b-1">
                            <span class="fs-15 bold"><?php echo $ProSubCategoryName; ?></span><br>
                            <span class="fs-13">
                              <span>@ <?php echo $ProCategoryName; ?></span><br>
                              <span><?php echo $StatusView; ?></span><br>
                              <span><i class='fa fa-calendar text-primary'></i> <?php echo $ProCategoryCreatedAt; ?></span><br>
                              <span><i class="fa fa-edit text-warning"></i> <?php echo $ProCategoryUpdatedAt; ?></span><br>
                            </span>
                          </p>
                          <a href="#" class="btn-sm text-primary"><i class="fa fa-edit"></i> Edit</a>
                          <a href="#" class="btn-sm text-danger"><i class="fa fa-trash"></i> Delete</a>
                        </div>
                      </div>
                    </div>
                  </div>
                <?php } ?>
              </div>
            </div>
          </div>

          <!--End page content-->
        </div>

        <?php include '../../../include/admin/sidebar.php'; ?>
      </div>
      <?php include '../../../include/admin/footer.php'; ?>
    </div>

    <!-- add section -->
    <section class="add-section" id="AddSubcategories">
      <div class="add-data-form">
        <form class="data-form" action="../../../controller/productscontroller.php" method="POST" enctype="multipart/form-data">
          <?php FormPrimaryInputs(true); ?>
          <div class="main-data">
            <div class="main-data-header app-bg">
              <div class="flex-s-b">
                <h4 class="mt-0 mb-0">Add New Sub Categories</h4>
                <a class="btn btn-sm btn-danger sqaure" onclick="Databar('AddSubcategories')"><i class="fa fa-times fs-17"></i></a>
              </div>
            </div>
            <div class="main-data-body p-2">
              <div class="row">
                <div class="form-group col-lg-6 col-md-6 col-ms-6 col-12">
                  <label>Select Category</label>
                  <select class="form-control-2" name="ProSubCategoryId" required="">
                    <?php
                    $SqlProCategories2 = SELECT("SELECT * FROM pro_categories ORDER BY ProCategoryName ASC");
                    while ($FetchProCategories2 = mysqli_fetch_array($SqlProCategories2)) { ?>
                      <option value="<?php echo $FetchProCategories2['ProCategoriesId']; ?>"><?php echo $FetchProCategories2['ProCategoryName']; ?></option>
                    <?php } ?>
                  </select>
                </div>
                <div class="form-group col-lg-6 col-md-6 col-ms-6 col-12">
                  <label>Enter Sub Category Name</label>
                  <input type="text" name="ProSubCategoryName" class="form-control-2" required="">
                </div>
                <div class="form-group col-lg-6 col-md-6 col-ms-6 col-12">
                  <label>Upload Sub Category Image</label>
                  <input type="FILE" name="ProSubCategoryImage" id="uploadimage" accept="image/png, image/gif, image/jpeg" class="form-control-2" required="" />
                </div>
                <div class="col-md-12">
                  <div class="flex-c mb-2-pr">
                    <img src="" id="ImgPreview">
                  </div>
                </div>
              </div>
              <br><br><br><br><br><br>
            </div>
            <div class="main-data-footer">
              <button type="Submit" onclick="form.submit()" value="null" name="CreateProductSubCategories" class="btn btn-md app-bg">Create Sub Categories</button>
              <a onclick="Databar('AddSubcategories')" class="btn btn-md btn-danger">Cancel</a>
            </div>

          </div>
        </form>
      </div>
    </section>
    <!-- end of add section -->

    <?php include '../../../include/admin/footer_files.php'; ?>
</body>

</html>