<?php

//required files
require '../../require/modules.php';
require '../../require/admin/access-control.php';
require '../../require/admin/sessionvariables.php';

//page variables
$PageName = "Product Settings";
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
                <a href="#" onclick="Databar('Addcategories')" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Add Collection</a>
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
                        <th>CreatedAt</th>
                        <th>UpdatedAt</th>
                        <th>Status</th>
                        <th>Items</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <?php
                    $SqlProCategories = SELECT("SELECT * FROM pro_categories ORDER BY ProCategoriesId ASC");
                    $CountNo = 0;
                    while ($FetchProCategories = mysqli_fetch_array($SqlProCategories)) {
                      $CountNo++;
                      $ProCategoriesId = $FetchProCategories['ProCategoriesId'];
                      $ProCategoryName = $FetchProCategories['ProCategoryName'];
                      $ProCategoryImage = $FetchProCategories['ProCategoryImage'];
                      $ProCategoryStatus = $FetchProCategories['ProCategoryStatus'];
                      $ProCategoryCreatedAt = ReturnValue($FetchProCategories['ProCategoryCreatedAt']);
                      $ProCategoryUpdatedAt = ReturnValue($FetchProCategories['ProCategoryUpdatedAt']);
                      $StatusView = StatusViewWithText($ProCategoryStatus);

                      $Countproducts  = TOTAL("SELECT * FROM products where ProductCategoryId='$ProCategoriesId'"); ?>
                      <tr>
                        <td><?php echo $CountNo; ?></td>
                        <td>
                          <a onclick="Databar('edit_<?php echo $ProCategoriesId; ?>')" class="text-primary">
                            <img src="<?php echo STORAGE_URL; ?>/products/category/<?php echo $ProCategoryImage; ?>" class="list-icon">
                            <?php echo $ProCategoryName; ?>
                          </a>
                        </td>
                        <td><?php echo $ProCategoryCreatedAt; ?></td>
                        <td><?php echo $ProCategoryUpdatedAt; ?></td>
                        <td><?php echo $StatusView; ?></td>
                        <td><?php echo $Countproducts; ?> Item</td>
                        <td>
                          <div class="btn-group-sm">
                            <a href="#" onclick="Databar('edit_<?php echo $ProCategoriesId; ?>')" class="btn-sm text-primary"><i class="fa fa-edit"></i> Edit</a>
                            <?php if ($Countproducts == 0) { ?>
                              <a href="<?php echo DOMAIN; ?>/controller/productscontroller.php?delete_product_categories=<?php echo SECURE("true", "e"); ?>&access_url=<?php echo SECURE(RUNNING_URL, "e"); ?>&control_id=<?php echo SECURE($ProCategoriesId, 'e'); ?>" class="btn-sm text-danger"><i class="fa fa-trash"></i> Delete</a>
                            <?php } ?>
                          </div>
                        </td>
                      </tr>

                      <section class="add-section" id="edit_<?php echo $ProCategoriesId; ?>">
                        <div class="add-data-form">
                          <form class="data-form" action="../../controller/productscontroller.php" method="POST" enctype="multipart/form-data">
                            <?php
                            FormPrimaryInputs(true);
                            CurrentFile($ProCategoryImage); ?>
                            <div class="main-data">
                              <div class="main-data-header app-bg">
                                <div class="flex-s-b app-heading">
                                  <h4 class="mt-0 mb-0">Update Collection Details</h4>
                                  <a class="btn btn-sm btn-danger sqaure" onclick="Databar('edit_<?php echo $ProCategoriesId; ?>')"><i class="fa fa-times fs-17"></i></a>
                                </div>
                              </div>
                              <div class="main-data-body p-2">
                                <div class="row">
                                  <div class="form-group col-lg-6 col-md-6 col-ms-6 col-12">
                                    <label>Enter New Collection Name</label>
                                    <input type="text" name="ProCategoryName" value="<?php echo $ProCategoryName; ?>" class="form-control-2" required="" />
                                  </div>
                                  <div class="form-group col-md-6 col-lg-6 col-sm-6 col-12">
                                    <label>Category Status</label>
                                    <select class="form-control-2" name="ProCategoryStatus" required="">
                                      <?php
                                      if ($ProCategoryStatus == 1) { ?>
                                        <option value="1" selected="">Active</option>
                                        <option value="2">Inactive</option>
                                      <?php } else { ?>
                                        <option value="1">Active</option>
                                        <option value="2" selected="">Inactive</option>
                                      <?php } ?>
                                    </select>
                                  </div>
                                  <div class="form-group col-lg-6 col-md-6 col-ms-6 col-12">
                                    <label>Upload Collection Image</label>
                                    <input type="FILE" name="ProCategoryImage" value="null" id="uploadimage" accept="image/png, image/gif, image/jpeg" class="form-control-2" />
                                  </div>
                                  <div class="col-md-12 m-t-10">
                                    <div class="flex-c mb-2-pr">
                                      <img src="<?php echo STORAGE_URL; ?>/products/category/<?php echo $ProCategoryImage; ?>" id="ImgPreview">
                                    </div>
                                  </div>
                                </div>
                                <br><br><br><br><br><br>
                              </div>
                              <div class="main-data-footer">
                                <button type="Submit" name="UpdateCategories" value="<?php echo SECURE($ProCategoriesId, 'e'); ?>" class="btn btn-md app-btn">Update Details</button>
                                <a onclick="Databar('edit_<?php echo $ProCategoriesId; ?>')" class="btn btn-md btn-danger">Cancel</a>
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
    <section class="add-section" id="Addcategories">
      <div class="add-data-form">
        <form class="data-form" action="../../controller/productscontroller.php" method="POST" enctype="multipart/form-data">
          <?php FormPrimaryInputs(true); ?>
          <div class="main-data">
            <div class="main-data-header app-bg">
              <div class="flex-s-b app-heading">
                <h4 class="mt-0 mb-0">Add New Collection</h4>
                <a class="btn btn-sm btn-danger sqaure" onclick="Databar('Addcategories')"><i class="fa fa-times fs-17"></i></a>
              </div>
            </div>
            <div class="main-data-body p-2">
              <div class="row">
                <div class="form-group col-lg-6 col-md-6 col-ms-6 col-12">
                  <label>Enter New Collection Name</label>
                  <input type="text" name="ProCategoryName" class="form-control-2" required="" />
                </div>
                <div class="form-group col-lg-6 col-md-6 col-ms-6 col-12">
                  <label>Upload Collection Image</label>
                  <input type="FILE" name="ProCategoryImage" id="uploadimage" accept="image/png, image/gif, image/jpeg" class="form-control-2" required="" />
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
              <button type="Submit" onclick="form.submit()" value="null" name="CreateProductCategories" class="btn btn-md app-btn">Create Collection</button>
              <a onclick="Databar('Addcategories')" class="btn btn-md btn-danger">Cancel</a>
            </div>

          </div>
        </form>
      </div>
    </section>
    <!-- end of add section -->

    <?php include '../../include/admin/footer_files.php'; ?>
</body>

</html>