<?php

//required files
require '../../require/modules.php';
require '../../require/admin/access-control.php';
require '../../require/admin/sessionvariables.php';

//page variables
$PageName = "All Artists";
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
                <h4 class="m-b-0 m-t-5">All Artists</h4>
                <a href="#" onclick="Databar('Addbrands')" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Artists</a>
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
                    $SQLpro_brands = SELECT("SELECT * FROM pro_brands ORDER BY ProBrandId ASC");
                    while ($fetchpro_brands = mysqli_fetch_array($SQLpro_brands)) {
                      $ProBrandId = $fetchpro_brands['ProBrandId'];
                      $ProBrandName = $fetchpro_brands['ProBrandName'];
                      $ProBrandStatus = $fetchpro_brands['ProBrandStatus'];
                      $ProBrandImage = $fetchpro_brands['ProBrandImage'];
                      $ProBrandCreatedAt = ReturnValue($fetchpro_brands['ProBrandCreatedAt']);
                      $ProBrandUpdatedAt = ReturnValue($fetchpro_brands['ProBrandUpdatedAt']);
                      $StatusView = StatusViewWithText($ProBrandStatus);
                      $CountProducts = TOTAL("SELECT * FROM products where ProductBrandId='$ProBrandId'");
                      $ProBrandDescriptions = $fetchpro_brands['ProBrandDescriptions']; ?>
                      <tr>
                        <td><?php echo $ProBrandId; ?></td>
                        <td>
                          <a onclick="Databar('edit_<?php echo $ProBrandId; ?>')" class="text-primary">
                            <img src="<?php echo STORAGE_URL; ?>/products/brands/<?php echo $ProBrandImage; ?>" class="list-icon">
                            <?php echo $ProBrandName; ?>
                          </a>
                        </td>
                        <td><?php echo $ProBrandCreatedAt; ?></td>
                        <td><?php echo $ProBrandUpdatedAt; ?></td>
                        <td><?php echo $StatusView; ?></td>
                        <td><?php echo $CountProducts; ?> Items</td>
                        <td>
                          <div class="btn-group-sm">
                            <a onclick="Databar('edit_<?php echo $ProBrandId; ?>')" class="btn-sm text-primary"><i class="fa fa-edit"></i> Edit</a>
                            <?php if ($CountProducts == 0) { ?>
                              <a href="<?php echo DOMAIN; ?>/controller/productscontroller.php?delete_brands=<?php echo SECURE("true", 'e'); ?>&access_url=<?php echo SECURE(RUNNING_URL, 'e'); ?>&control_id=<?php echo SECURE($ProBrandId, "e"); ?>" class="btn-sm text-danger"><i class="fa fa-trash"></i> Delete</a>
                            <?php } ?>
                          </div>
                        </td>
                      </tr>

                      <section class="add-section" id="edit_<?php echo $ProBrandId; ?>">
                        <div class="add-data-form">
                          <form class="data-form" action="../../controller/productscontroller.php" method="POST" enctype="multipart/form-data">
                            <?php FormPrimaryInputs(true);
                            CurrentFile($ProBrandImage); ?>
                            <div class="main-data">
                              <div class="main-data-header app-bg">
                                <div class="flex-s-b app-heading">
                                  <h4 class="mt-0 mb-0">Update Artist Details</h4>
                                  <a class="btn btn-sm btn-danger sqaure" onclick="Databar('edit_<?php echo $ProBrandId; ?>')"><i class="fa fa-times fs-17"></i></a>
                                </div>
                              </div>
                              <div class="main-data-body p-2">
                                <div class="row">
                                  <div class="form-group col-lg-6 col-md-6 col-ms-6 col-12">
                                    <label>Enter New Artists Name</label>
                                    <input type="text" name="ProBrandName" value="<?php echo $ProBrandName; ?>" class="form-control-2" required="" />
                                  </div>
                                  <div class="form-group col-md-6 col-lg-6 col-sm-6 col-12">
                                    <label>Artists Status</label>
                                    <select class="form-control-2" name="ProBrandStatus" required="">
                                      <?php
                                      if ($ProBrandStatus == 1) { ?>
                                        <option value="1" selected="">Active</option>
                                        <option value="2">Inactive</option>
                                      <?php } else { ?>
                                        <option value="1">Active</option>
                                        <option value="2" selected="">Inactive</option>
                                      <?php } ?>
                                    </select>
                                  </div>
                                  <div class="form-group col-lg-6 col-md-6 col-ms-6 col-12">
                                    <label>Upload Artists Image</label>
                                    <input type="FILE" name="ProBrandImage" value="null" id="uploadimage" accept="image/png, image/gif, image/jpeg" class="form-control-2" />
                                  </div>
                                  <script>
                                    tinymce.init({
                                      selector: 'textarea#editor_<?php echo $ProBrandId; ?>',
                                      menubar: false
                                    });
                                  </script>
                                  <div class="form-group col-md-12">
                                    <label>Edit Artist Info</label>
                                    <textarea name="ProBrandDescriptions" class="form-control-2" rows="4" style="height:100% !important;" id="editor_<?php echo $ProBrandId; ?>"><?php echo html_entity_decode(SECURE($ProBrandDescriptions, "d")); ?></textarea>
                                  </div>
                                  <div class="col-md-12">
                                    <div class="flex-c mb-2-pr">
                                      <img src="<?php echo STORAGE_URL; ?>/products/brands/<?php echo $ProBrandImage; ?>" id="ImgPreview">
                                    </div>
                                  </div>
                                </div>
                                <br><br><br><br><br><br>
                              </div>
                              <div class="main-data-footer">
                                <button type="Submit" name="UpdateProductbrands" value="<?php echo SECURE($ProBrandId, 'e'); ?>" class="btn btn-md app-btn">Update Artists</button>
                                <a onclick="Databar('edit_<?php echo $ProBrandId; ?>')" class="btn btn-md btn-danger">Cancel</a>
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
    <section class="add-section" id="Addbrands">
      <div class="add-data-form">
        <form class="data-form" action="../../controller/productscontroller.php" method="POST" enctype="multipart/form-data">
          <?php FormPrimaryInputs(true); ?>
          <div class="main-data">
            <div class="main-data-header app-bg">
              <div class="flex-s-b app-heading">
                <h4 class="mt-0 mb-0">Add New Artists</h4>
                <a class="btn btn-sm btn-danger sqaure" onclick="Databar('Addbrands')"><i class="fa fa-times fs-17"></i></a>
              </div>
            </div>
            <div class="main-data-body p-2">
              <div class="row">
                <div class="form-group col-lg-6 col-md-6 col-ms-6 col-12">
                  <label>Enter New Artist Name</label>
                  <input type="text" name="ProBrandName" class="form-control-2" required="" />
                </div>
                <div class="form-group col-lg-12 col-md-12">
                  <label>Enter Some info</label>
                  <textarea name="ProBrandDescriptions" class="form-control-2" rows="4" style="height:100% !important;" id="editor"></textarea>
                </div>
                <div class="form-group col-lg-6 col-md-6 col-ms-6 col-12">
                  <label>Upload Artist Image</label>
                  <input type="FILE" name="ProBrandImage" id="uploadimage" accept="image/png, image/gif, image/jpeg" class="form-control-2" required="" />
                </div>
                <div class="col-md-12 m-t-10">
                  <div class="flex-c mb-2-pr">
                    <img src="" id="ImgPreview">
                  </div>
                </div>
              </div>
              <br><br><br><br><br><br>
            </div>
            <div class="main-data-footer">
              <button type="Submit" onclick="form.submit()" value="null" name="CreateProductbrands" class="btn btn-md app-btn">Create Artist</button>
              <a onclick="Databar('Addbrands')" class="btn btn-md btn-danger">Cancel</a>
            </div>

          </div>
        </form>
      </div>
    </section>
    <!-- end of add section -->

    <?php include '../../include/admin/footer_files.php'; ?>
</body>

</html>