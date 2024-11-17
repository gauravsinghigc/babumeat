<?php

//required files
require '../../require/modules.php';
require '../../require/admin/access-control.php';
require '../../require/admin/sessionvariables.php';

//page variables
$PageName = "Edit Product Details";

if (isset($_GET['productid'])) {
  $WallPapersId = SECURE($_GET['productid'], "d");
  $_SESSION['VIEW_PRODUCT_ID'] = $WallPapersId;
} else {
  $WallPapersId = $_SESSION['VIEW_PRODUCT_ID'];
}

$PageSqls = "SELECT * FROM wallpapers where WallPapersId='$WallPapersId'";
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=0.9">
  <title><?php echo $PageName . " -> " . FETCH($PageSqls, "WallPaperName"); ?> | <?php echo APP_NAME; ?></title>
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
                  <h4 class="app-heading"><?php echo $PageName; ?></h4>
                </div>
              </div>
              <form class="data-form" action="../../controller/WallPaperController.php" method="POST" enctype="multipart/form-data">
                <?php FormPrimaryInputs(true); ?>
                <div class="row mb-2">
                  <div class="col-md-4 form-group">
                    <label>Wallpaper Name</label>
                    <input type="text" name="WallPaperName" value="<?php echo FETCH($PageSqls, "WallPaperName"); ?>" class="form-control-2">
                  </div>
                  <div class="col-md-4 form-group">
                    <label>Wallpaper Code/Item Code</label>
                    <input type="text" name="WallPaperCode" value="<?php echo FETCH($PageSqls, "WallPaperCode"); ?>" class="form-control-2">
                  </div>
                </div>

                <div class="row mb-3">
                  <div class="col-md-3 form-group">
                    <label>Wallpaper Category</label>
                    <select name="WallPaperCategoryId" onchange="CheckCat()" id="cats" class="form-control-2" required="">
                      <option value="0">Select Wallpaper Category</option>
                      <?php $Category = FetchConvertIntoArray("SELECT * FROM wallpaper_category ORDER BY WallPaperCategoryName ASC", true);
                      if ($Category == null) { ?>
                        <?php } else {
                        foreach ($Category as $Cat) {
                          if ($Cat->WallPaperCategoryId == FETCH($PageSqls, "WallPaperCategoryId")) {
                            $selected = "selected";
                          } else {
                            $selected = "";
                          } ?>
                          <option value="<?php echo $Cat->WallPaperCategoryId; ?>" <?php echo $selected; ?>><?php echo $Cat->WallPaperCategoryName; ?></option>
                      <?php
                        }
                      } ?>
                      <option value="NEW">Add New Category</option>
                    </select>
                  </div>
                  <div class="col-md-3" style="display:none;" id="add_cat">
                    <label>Add New Category</label>
                    <input type="text" name="WallPaperCategoryName" class="form-control-2">
                  </div>
                  <div class="col-md-3 form-group">
                    <label>Wallpaper Brand</label>
                    <select name="WallPaperBrandId" onchange="CheckBrand()" id="brands" class="form-control-2" required="">
                      <option value="0">Select Wallpaper Brand</option>
                      <?php $Brands = FetchConvertIntoArray("SELECT * FROM wallpaper_brands ORDER BY WallPaperBrandName ASC", true);
                      if ($Brands == null) { ?>
                        <?php } else {
                        foreach ($Brands as $Brand) {
                          if ($Brand->WallPaperBrandId == FETCH($PageSqls, "WallPaperBrandId")) {
                            $selected = "selected";
                          } else {
                            $selected = "";
                          } ?>
                          <option value="<?php echo $Brand->WallPaperBrandId; ?>" <?php echo $selected; ?>><?php echo $Brand->WallPaperBrandName; ?></option>
                      <?php
                        }
                      } ?>
                      <option value="NEW">Add New Brand</option>
                    </select>
                  </div>
                  <div class="col-md-3" style="display:none;" id="add_brand">
                    <label>Add New Brand</label>
                    <input type="text" name="WallPaperBrandName" class="form-control-2">
                  </div>
                </div>
                <div class="row mb-3">
                  <div class="col-md-3 form-group">
                    <label>Start Price</label>
                    <input type="text" name="WallPaperStartPrice" value="<?php echo FETCH($PageSqls, "WallPaperStartPrice"); ?>" class="form-control-2" required="">
                  </div>
                  <div class="col-md-3 form-group">
                    <label>Display Status</label>
                    <select name="WallPaperStatus" class="form-control-2">
                      <?php InputOptions(["Active", "Inactive"], FETCH($PageSqls, "WallPaperStatus")); ?>
                    </select>
                  </div>
                </div>
                <div class="row mb-2">
                  <div class="col-md-7">
                    <label>WallPaper description</label>
                    <textarea name="WallPaperDescriptions" class="form-control-2" id="editor" rows="3"><?php echo html_entity_decode(SECURE(FETCH($PageSqls, "WallPaperDescriptions"), "d")); ?></textarea>
                  </div>
                </div>
                <hr>
                <div class="row">
                  <div class="col-md-12">
                    <a href="index.php" class="btn btn-md btn-default"><i class="fa fa-angle-double-left"></i> Back to All</a>
                    <button type="submit" name="UpdateWallPapers" value="<?php echo SECURE($WallPapersId, "e"); ?>" class="btn btn-md btn-success">Update WallPaper</button>
                  </div>
                </div>
                <hr>
              </form>

              <div class="row">
                <div class="col-md-12">
                  <h4 class="app-heading">Wall Paper Images</h4>
                  <form action="../../controller/WallPaperController.php" method="POST" enctype="multipart/form-data">
                    <?php FormPrimaryInputs(true); ?>
                    <div class="row">
                      <div class="col-md-8">
                        <label>Upload Wallpaper Images</label>
                        <input type="file" name="WallPaperImageFile[]" class="form-control-2" multiple="">
                        <p>You can select multiple files in jpg, jpeg, png only.</p>
                      </div>
                      <div class="col-md-4">
                        <div class="p-3r">
                          <button type="submit" name="UploadImages" class="btn btn-md btn-success" value="<?php echo $WallPapersId; ?>"><i class="fa fa-upload"></i> Upload Images</button>
                        </div>
                      </div>
                    </div>
                  </form>
                </div>
                <div class="col-md-12">
                  <h5 class="app-sub-heading">Current Images</h5>
                </div>
              </div>

              <div class="row">
                <div class="col-md-12">
                  <div class="pro-image">
                    <?php $Images = FetchConvertIntoArray("SELECT * FROM wallpaper_images where WallPaperMainId='$WallPapersId'", true);
                    if ($Images != null) {
                      foreach ($Images as $Image) { ?> <a href=" <?php echo STORAGE_URL; ?>/wallpapers/pro-img/<?php echo $WallPapersId; ?>/<?php echo $Image->WallPaperImageFile; ?>" target="_blank">
                          <img src="<?php echo STORAGE_URL; ?>/wallpapers/pro-img/<?php echo $WallPapersId; ?>/<?php echo $Image->WallPaperImageFile; ?>" class="img-fluid">
                        </a>
                    <?php
                        CONFIRM_DELETE_POPUP(
                          "wallpaper_images",
                          $Requests = [
                            "delete_wallpaper_images" => "true",
                            "control_id" => $Image->WallPaperImagesId,
                          ],
                          "WallPaperController",
                          "<i class='fa fa-trash'></i>",
                          "btn-danger pro-img-del-btn"
                        );
                      }
                    } ?>
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
      <script>
        function CheckCat() {
          var cats = document.getElementById("cats");
          if (cats.value == "NEW") {
            document.getElementById("add_cat").style.display = "block";
          } else {
            document.getElementById("add_cat").style.display = "none";
          }
        }
      </script>

      <script>
        function CheckBrand() {
          var brands = document.getElementById("brands");
          if (brands.value == "NEW") {
            document.getElementById("add_brand").style.display = "block";
          } else {
            document.getElementById("add_brand").style.display = "none";
          }
        }
      </script>
      <?php include '../../include/admin/footer_files.php'; ?>
</body>

</html>