<?php

//required files
require '../../../require/modules.php';
require '../../../require/admin/access-control.php';
require '../../../require/admin/sessionvariables.php';

//page variables
$PageName = "Edit Blogs";

if (isset($_GET['id'])) {
  $ExhibitionsId = SECURE($_GET['id'], "d");
  $_SESSION['BlogsId'] = $ExhibitionsId;
} else {
  $ExhibitionsId = $_SESSION['ExhibitionsId'];
}

//page variables
$PageSqls = "SELECT * FROM exhibitions WHERE ExhibitionsId='$ExhibitionsId'";
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=0.9">
  <title><?php echo GET_DATA("ExhibitionsName"); ?> | <?php echo APP_NAME; ?></title>
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
                        <input type="text" name="ExhibitionsName" value="<?php echo GET_DATA('ExhibitionsName'); ?>" placeholder="" class="form-control-2" required="">
                      </div>
                      <div class="form-group col-lg-4 col-sm-4 col-md-4 col-6">
                        <label>Exhibitions Category</label>
                        <?php if (GET_DATA("ExhibitionsCategory") == "Past Exhibitions") { ?>
                          <select name="ExhibitionsCategory" class="form-control-2" required="">
                            <option value="Past Exhibitions" selected="">Past Exhibitions</option>
                            <option value="Current Exhibitions">Current Exhibitions</option>
                            <option value="Upcoming Exhibitions">Upcoming Exhibitions</option>
                          </select>
                        <?php } elseif (GET_DATA("ExhibitionsCategory") == "Current Exhibitions") { ?>
                          <select name="ExhibitionsCategory" class="form-control-2" required="">
                            <option value="Past Exhibitions">Past Exhibitions</option>
                            <option value="Current Exhibitions" selected="">Current Exhibitions</option>
                            <option value="Upcoming Exhibitions">Upcoming Exhibitions</option>
                          </select>
                        <?php } else if (GET_DATA("ExhibitionsCategory") == "Upcoming Exhibitions") { ?>
                          <select name="ExhibitionsCategory" class="form-control-2" required="">
                            <option value="Past Exhibitions">Past Exhibitions</option>
                            <option value="Current Exhibitions">Current Exhibitions</option>
                            <option value="Upcoming Exhibitions" selected="">Upcoming Exhibitions</option>
                          </select>
                        <?php } else { ?>
                          <select name="ExhibitionsCategory" class="form-control-2" required="">
                            <option value="Past Exhibitions">Past Exhibitions</option>
                            <option value="Current Exhibitions">Current Exhibitions</option>
                            <option value="Upcoming Exhibitions">Upcoming Exhibitions</option>
                          </select>
                        <?php } ?>
                      </div>
                      <div class="form-group col-lg-4 col-md-4 col-sm-4 col-6">
                        <label>Exhibition date</label>
                        <input type="date" name="ExhibitionDate" class="form-control-2" required="" value="<?php echo GET_DATA("ExhibitionDate"); ?>">
                      </div>
                      <div class="form-group col-lg-4 col-md-4 col-sm-4 col-6">
                        <label>Blogs Status</label>
                        <?php if (GET_DATA("ExhibitionsStatus") == "0") { ?>
                          <select name="ExhibitionsStatus" class="form-control-2" required="">
                            <option value="1">Active</option>
                            <option value="0" selected="">Inactive</option>
                          </select>
                        <?php } else { ?>
                          <select name="ExhibitionsStatus" class="form-control-2" required="">
                            <option value="0">Inactive</option>
                            <option value="1" selected="">Active</option>
                          </select>
                        <?php } ?>
                      </div>
                      <div class="col-md-12 form-group">
                        <label>Exhibitions Descriptions</label>
                        <textarea name="ExhibitionsDescriptions" id="editor" class="form-control-2" rows="8"><?php echo html_entity_decode(SECURE(GET_DATA("ExhibitionsDescriptions"), "d")); ?></textarea>
                      </div>
                      <div class="col-md-12">
                        <img src="<?php echo STORAGE_URL; ?>/exhibitions/<?php echo GET_DATA("ExhibitionsFeatureImage"); ?>" class="w-25">
                        <input type="text" name="ExhibitionsFeatureImage1" value="<?php echo GET_DATA("ExhibitionsFeatureImage"); ?>" hidden="">
                        <?php UploadImageInput("ExhibitionsFeatureImage", "ExhibitionsFeatureImage", "image/*", false, ""); ?>
                      </div>
                      <div class="col-md-12">
                        <br>
                        <button type="submit" name="UpdateExhitions" value="<?php echo SECURE($ExhibitionsId, "e"); ?>" class="btn btn-md app-btn">Save</button>
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