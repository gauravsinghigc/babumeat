<?php

//required files
require '../../../require/modules.php';
require '../../../require/admin/access-control.php';
require '../../../require/admin/sessionvariables.php';

//page variables
$PageName = "Edit Blogs";

if (isset($_GET['id'])) {
  $BlogsId = SECURE($_GET['id'], "d");
  $_SESSION['BlogsId'] = $BlogsId;
} else {
  $BlogsId = $_SESSION['BlogsId'];
}

//page variables
$PageSqls = "SELECT * FROM blogs WHERE BlogsId='$BlogsId'";
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=0.9">
  <title><?php echo SECURE(GET_DATA("BlogsTitle"), "d"); ?> | <?php echo APP_NAME; ?></title>
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
                  <form action="../../../controller/blogscontroller.php" method="POST" enctype="multipart/form-data">
                    <?php FormPrimaryInputs(true); ?>
                    <div class="row">
                      <div class="form-group col-lg-12 col-sm-12 col-md-12 col-6">
                        <label>Blog Title</label>
                        <input type="text" name="BlogsTitle" value="<?php echo SECURE(GET_DATA("BlogsTitle"), "d"); ?>" placeholder="" class="form-control-2" required="">
                      </div>
                      <div class="col-md-12 form-group">
                        <label>Blog Descriptions</label>
                        <textarea name="BlogsDescriptions" id="editor" class="form-control-2" rows="8"><?php echo SECURE(GET_DATA("BlogsDescriptions"), "d"); ?></textarea>
                      </div>
                      <div class="col-md-12">
                        <img src="<?php echo STORAGE_URL; ?>/blogs/<?php echo GET_DATA("BlogsFeatureImage"); ?>" class="w-25">
                        <input type="text" name="BlogsFeatureImage1" value="<?php echo GET_DATA("BlogsFeatureImage"); ?>" hidden="">
                        <?php UploadImageInput("BlogsFeatureImage", "BlogsFeatureImage1", "image/*", false, ""); ?>
                      </div>
                      <div class="col-md-12">
                        <div class="row">
                          <div class="col-lg-3 col-md-3 col-sm-12 col-12">
                            <div class="form-group">
                              <label>Blogs Status</label>
                              <?php if (GET_DATA("BlogsStatus") == "0") { ?>
                                <select name="BlogsStatus" class="form-control-2" required="">
                                  <option value="1">Active</option>
                                  <option value="0" selected="">Inactive</option>
                                </select>
                              <?php } else { ?>
                                <select name="BlogsStatus" class="form-control-2" required="">
                                  <option value="0">Inactive</option>
                                  <option value="1" selected="">Active</option>
                                </select>
                              <?php } ?>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-12">
                        <br>
                        <button type="submit" name="UpdateBlogs" value="<?php echo SECURE($BlogsId, "e"); ?>" class="btn btn-md app-btn">Save</button>
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