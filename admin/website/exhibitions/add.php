<?php

//required files
require '../../../require/modules.php';
require '../../../require/admin/access-control.php';
require '../../../require/admin/sessionvariables.php';

//page variables
$PageName = "Add New Exhibitions";
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
                  <form action="../../../controller/exhibitioncontroller.php" method="POST" enctype="multipart/form-data">
                    <?php FormPrimaryInputs(true); ?>
                    <div class="row">
                      <div class="form-group col-lg-12 col-sm-12 col-md-12 col-6">
                        <label>Exhibitions Title</label>
                        <input type="text" name="ExhibitionsName" value="" placeholder="" class="form-control-2" required="">
                      </div>
                      <div class="form-group col-lg-4 col-sm-4 col-md-4 col-6">
                        <label>Exhibitions Category</label>
                        <select name="ExhibitionsCategory" class="form-control" required="">
                          <option value="Past Exhitions">Past Exhibitions</option>
                          <option value="Current Exhitions" selected>Current Exhibitions</option>
                          <option value="Upcoming Exhitions">Upcoming Exhibitions</option>
                        </select>
                      </div>
                      <div class="form-group col-lg-4 col-md-4 col-sm-4 col-6">
                        <label>Exhibition date</label>
                        <input type="date" name="ExhibitionDate" class="form-control-2" required="" value="<?php echo date("Y-m-d"); ?>">
                      </div>
                      <div class="form-group col-lg-4 col-md-4 col-sm-4 col-6">
                        <label>Exhibitions Listing</label>
                        <select class="form-control-2" name="ExhibitionsStatus" required="">
                          <option value="0">Inactive</option>
                          <option value="1">Active</option>
                        </select>
                      </div>
                      <div class="col-md-12 form-group">
                        <label>Exhibitions Descriptions</label>
                        <textarea name="ExhibitionsDescriptions" id="editor" class="form-control-2" rows="8"></textarea>
                      </div>
                      <div class="col-md-12">
                        <?php UploadImageInput("ExhibitionsFeatureImage", "ExhibitionsFeatureImage1", "image/*", true, ""); ?>
                      </div>
                      <div class="col-md-12">
                        <br>
                        <button type="submit" name="CreateExhibitions" class="btn btn-md app-btn">Save</button>
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