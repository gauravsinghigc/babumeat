<?php

//required files
require '../../require/modules.php';
require '../../require/admin/access-control.php';
require '../../require/admin/sessionvariables.php';

//page variables
$PageName = "Sub Categories";
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
              <div class="flex-s-b app-heading">
                <h4 class="m-b-0 m-t-5"><?php echo $PageName; ?></h4>
                <a href="#" onclick="Databar('AddSubcategories')" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Add Sub Categories</a>
              </div>
              <div class="row m-t-10">
                <div class="col-md-12">
                  <div class="flex-s-b">
                    <?php include 'common.php'; ?>
                  </div>
                </div>
                <div class="col-md-12">
                  <table class="table table-striped">
                    <thead>
                      <tr>
                        <th>RefId</th>
                        <th>Name</th>
                        <th>Category</th>
                        <th>CreatedAt</th>
                        <th>UpdatedAt</th>
                        <th>Status</th>
                        <th>Items</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <?php
                    $SqlProCategories = SELECT("SELECT * FROM pro_categories, pro_sub_categories where pro_categories.ProCategoriesId=pro_sub_categories.ProSubCategoryId ORDER BY pro_sub_categories.ProSubCategoriesId  ASC");
                    $count = 0;
                    while ($FetchProCategories = mysqli_fetch_array($SqlProCategories)) {
                      $count++;
                      $ProCategoriesId = $FetchProCategories['ProCategoriesId'];
                      $ProCategoryName = $FetchProCategories['ProCategoryName'];
                      $ProSubCategoryName = $FetchProCategories['ProSubCategoryName'];
                      $ProSubCategoryImage = $FetchProCategories['ProSubCategoryImage'];
                      $ProSubCategoryStatus = $FetchProCategories['ProSubCategoryStatus'];
                      $ProCategoryImage = $FetchProCategories['ProCategoryImage'];
                      $ProCategoryStatus = $FetchProCategories['ProCategoryStatus'];
                      $ProCategoryCreatedAt = ReturnValue($FetchProCategories['ProSubCategoryCreatedAt']);
                      $ProCategoryUpdatedAt = ReturnValue($FetchProCategories['ProSubCategoryUpdatedAt']);
                      $StatusView = StatusViewWithText($ProSubCategoryStatus);
                      $ProSubCategoriesId = $FetchProCategories['ProSubCategoriesId'];

                      $CountProducts = TOTAL("SELECT * FROM products where ProductSubCategoryId='$ProSubCategoriesId'"); ?>
                      <tr>
                        <td><?php echo $count; ?></td>
                        <td>
                          <a onclick="Databar('edit_<?php echo $ProSubCategoriesId; ?>')" class="text-primary">
                            <img src="<?php echo STORAGE_URL; ?>/products/subcategory/<?php echo $ProSubCategoryImage; ?>" class="list-icon">
                            <?php echo $ProSubCategoryName; ?>
                          </a>
                        </td>
                        <td><?php echo $ProCategoryName; ?></td>
                        <td><?php echo $ProCategoryCreatedAt; ?></td>
                        <td><?php echo $ProCategoryUpdatedAt; ?></td>
                        <td><?php echo $StatusView; ?></td>
                        <td><?php echo $CountProducts; ?> Item</td>
                        <td>
                          <div class="btn-group-sm">
                            <a onclick="Databar('edit_<?php echo $ProSubCategoriesId; ?>')" class="btn-sm text-primary"><i class="fa fa-edit"></i> Edit</a>
                            <?php if ($CountProducts == 0) { ?>
                              <a href="<?php echo DOMAIN; ?>/controller/productscontroller.php?delete_sub_categories=<?php echo SECURE($ProSubCategoriesId, 'e'); ?>&access_url=<?php echo SECURE(RUNNING_URL, 'e'); ?>&control_id=<?php echo SECURE($ProSubCategoriesId, 'e'); ?>" class="btn-sm text-danger"><i class="fa fa-trash"></i> Delete</a>
                            <?php } ?>
                          </div>
                        </td>
                      </tr>

                      <section class="add-section" id="edit_<?php echo $ProSubCategoriesId; ?>">
                        <div class="add-data-form">
                          <form class="data-form" action="../../controller/productscontroller.php" method="POST" enctype="multipart/form-data">
                            <?php
                            FormPrimaryInputs(true);
                            CurrentFile($ProSubCategoryImage); ?>
                            <div class="main-data">
                              <div class="main-data-header app-bg">
                                <div class="flex-s-b app-heading">
                                  <h4 class="mt-0 mb-0">Update Subcategory Details</h4>
                                  <a class="btn btn-sm btn-danger sqaure" onclick="Databar('edit_<?php echo $ProSubCategoriesId; ?>')"><i class="fa fa-times fs-17"></i></a>
                                </div>
                              </div>
                              <div class="main-data-body p-2">
                                <div class="row">
                                  <div class="form-group col-lg-6 col-md-6 col-ms-6 col-12">
                                    <label>Select Category</label>
                                    <select class="form-control-2" name="ProSubCategoryId" required="">
                                      <?php
                                      $SqlProCategories2 = SELECT("SELECT * FROM pro_categories ORDER BY ProCategoryName ASC");
                                      while ($FetchProCategories2 = mysqli_fetch_array($SqlProCategories2)) {
                                        if ($FetchProCategories2['ProCategoriesId'] == $ProCategoriesId) {
                                          $selected = "selected=''";
                                        } else {
                                          $selected = "";
                                        } ?>
                                        <option value="<?php echo $FetchProCategories2['ProCategoriesId']; ?>" <?php echo $selected; ?>><?php echo $FetchProCategories2['ProCategoryName']; ?></option>
                                      <?php } ?>
                                    </select>
                                  </div>
                                  <div class="form-group col-lg-6 col-md-6 col-ms-6 col-12">
                                    <label>Enter Sub Category Name</label>
                                    <input type="text" name="ProSubCategoryName" value="<?php echo $ProSubCategoryName; ?>" class="form-control-2" required="">
                                  </div>
                                  <div class="form-group col-md-6 col-lg-6 col-sm-6 col-12">
                                    <label>Sub Category Status</label>
                                    <select class="form-control-2" name="ProSubCategoryStatus" required="">
                                      <?php
                                      if ($ProSubCategoryStatus == 1) { ?>
                                        <option value="1" selected="">Active</option>
                                        <option value="2">Inactive</option>
                                      <?php } else { ?>
                                        <option value="1">Active</option>
                                        <option value="2" selected="">Inactive</option>
                                      <?php } ?>
                                    </select>
                                  </div>
                                  <div class="form-group col-lg-6 col-md-6 col-ms-6 col-12">
                                    <label>Upload Sub Category Image</label>
                                    <input type="FILE" name="ProSubCategoryImage" value="null" id="uploadimage" accept="image/png, image/gif, image/jpeg" class="form-control-2" />
                                  </div>
                                  <div class="col-md-12 m-t-10">
                                    <div class="flex-c mb-2-pr">
                                      <img src="<?php echo STORAGE_URL; ?>/products/subcategory/<?php echo $ProSubCategoryImage; ?>" id="ImgPreview">
                                    </div>
                                  </div>
                                </div>
                                <br><br><br><br><br><br>
                              </div>
                              <div class="main-data-footer">
                                <button type="Submit" value="<?php echo SECURE($ProSubCategoriesId, 'e'); ?>" name="UpdateSubCategories" class="btn btn-md app-btn">Update Sub Categories</button>
                                <a onclick="Databar('edit_<?php echo $ProSubCategoriesId; ?>')" class="btn btn-md btn-danger">Cancel</a>
                              </div>

                            </div>
                          </form>
                        </div>
                      </section>
                    <?php } ?>
                  </table>
                </div>
              </div>
            </div>
          </div>

          <!--End page content-->
        </div>

        <?php include '../../include/admin/sidebar.php'; ?>
      </div>
      <?php include '../../include/admin/footer.php'; ?>
    </div>

    <!-- add section -->
    <section class="add-section" id="AddSubcategories">
      <div class="add-data-form">
        <form class="data-form" action="../../controller/productscontroller.php" method="POST" enctype="multipart/form-data">
          <?php FormPrimaryInputs(true); ?>
          <div class="main-data">
            <div class="main-data-header app-bg">
              <div class="flex-s-b app-heading">
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
              <button type="Submit" value="null" name="CreateProductSubCategories" class="btn btn-md app-btn">Create Sub Categories</button>
              <a onclick="Databar('AddSubcategories')" class="btn btn-md btn-danger">Cancel</a>
            </div>

          </div>
        </form>
      </div>
    </section>
    <!-- end of add section -->

    <?php include '../../include/admin/footer_files.php'; ?>
</body>

</html>