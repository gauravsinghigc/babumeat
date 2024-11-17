<?php

//required files
require '../../require/modules.php';
require '../../require/admin/access-control.php';
require '../../require/admin/sessionvariables.php';

//page variables
$PageName = "ADD Wallpepers";
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=0.9">
  <title><?php echo $PageName; ?> | <?php echo APP_NAME; ?></title>
  <?php include '../../include/admin/header_files.php'; ?>
  <style>
    table.table tr th,
    table.table tr td {
      font-size: 0.9rem !important;
      padding: 0.2rem !important;
    }
  </style>
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
                  <h4 class="app-heading">Add Wallpapers</h4>
                </div>
              </div>
              <form class="data-form" action="../../controller/WallPaperController.php" method="POST" enctype="multipart/form-data">
                <?php FormPrimaryInputs(true); ?>
                <div class="row mb-2">
                  <div class="col-md-4 form-group">
                    <label>Wallpaper Name</label>
                    <input type="text" name="WallPaperName" class="form-control-2">
                  </div>
                  <div class="col-md-4 form-group">
                    <label>Wallpaper Code/Item Code</label>
                    <input type="text" name="WallPaperCode" class="form-control-2">
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
                        foreach ($Category as $Cat) { ?>
                          <option value="<?php echo $Cat->WallPaperCategoryId; ?>"><?php echo $Cat->WallPaperCategoryName; ?></option>
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
                        foreach ($Brands as $Brand) { ?>
                          <option value="<?php echo $Brand->WallPaperBrandId; ?>"><?php echo $Brand->WallPaperBrandName; ?></option>
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
                    <input type="text" name="WallPaperStartPrice" class="form-control-2" required="">
                  </div>
                  <div class="col-md-3 form-group">
                    <label>Display Status</label>
                    <select name="WallPaperStatus" class="form-control-2">
                      <?php InputOptions(["Active", "Inactive"]); ?>
                    </select>
                  </div>
                </div>
                <div class="row mb-2">
                  <div class="col-md-7">
                    <label>WallPaper description</label>
                    <textarea name="WallPaperDescriptions" class="form-control-2" id="editor" rows="3"></textarea>
                  </div>
                  <div class="col-md-5">
                    <label>Upload Wallpaper Images</label>
                    <input type="file" name="WallPaperImageFile[]" class="form-control-2" multiple="">
                    <p>You can select multiple files in jpg, jpeg, png only.</p>
                  </div>
                </div>
                <hr>
                <div class="row">
                  <div class="col-md-12">
                    <a href="index.php" class="btn btn-md btn-default"><i class="fa fa-angle-double-left"></i> Back to All</a>
                    <button type="submit" name="CreateWallPapers" class="btn btn-md btn-success">Save WallPaper</button>
                  </div>
                </div>
                <hr>
              </form>
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