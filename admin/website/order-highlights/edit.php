<?php

//required files
require '../../../require/modules.php';
require '../../../require/admin/access-control.php';
require '../../../require/admin/sessionvariables.php';

//page variables
$PageName = "Edit High Lights";

if (isset($_GET['id'])) {
  $OrderHiglightsId = SECURE($_GET['id'], "d");
  $_SESSION['OrderHiglightsId'] = $OrderHiglightsId;
} else {
  $OrderHiglightsId = $_SESSION['OrderHiglightsId'];
}

$PageSqls = "SELECT * FROM orderhighlights WHERE OrderHiglightsId='$OrderHiglightsId'";
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=0.9">
  <title><?php echo SECURE(GET_DATA("OrderHighlightsTitle"), "d"); ?> | <?php echo APP_NAME; ?></title>
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
                <div class="col-md-12">
                  <form action="../../../controller/highlightcontroller.php" method="POST">
                    <div class="row">
                      <div class="form-group col-lg-12 col-sm-12 col-md-12 col-sm-12 col-12">
                        <?php FormPrimaryInputs(true); ?>
                        <label>Enter Highlight Title</label>
                        <input type="text" name="OrderHighlightsTitle" value="<?php echo SECURE(GET_DATA("OrderHighlightsTitle"), "d"); ?>" placeholder="Enter title" class="form-control-2" required="">
                      </div>
                      <div class="form-group col-lg-6 col-md-6 col-sm-6 col-12">
                        <label>Enter Highlight Icon Code</label>
                        <input type="text" name="OrderHighLighIcons" list="icons" value="<?php echo GET_DATA("OrderHighLighIcons"); ?>" class="form-control-2" required="" placeholder="eg fa-user, fa-grid, fa-eye">
                        <datalist id="icons">
                          <?php echo SelectIcons(GET_DATA("OrderHighLighIcons")); ?>
                        </datalist>
                      </div>
                      <div class="form-group col-lg-12 col-sm-12 col-md-12 col-sm-12 col-12">
                        <label>Enter Highlight Descriptions</label>
                        <textarea name="OrderHighLightDesc" rows="10" id="editor" placeholder="Enter descriptions" class="form-control-2 height-auto"><?php echo SECURE(GET_DATA("OrderHighLightDesc"), "d"); ?></textarea>
                      </div>
                      <div class="col-md-12">
                        <br>
                        <button type="submit" name="UpdateHighlights" value="<?php echo SECURE($OrderHiglightsId, "e"); ?>" class="btn btn-md app-btn">Update Details</button>
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
  </div>

  <?php include '../../../include/admin/footer_files.php'; ?>
</body>

</html>