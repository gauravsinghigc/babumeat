<?php

//required files
require '../../require/modules.php';
require '../../require/admin/access-control.php';
require '../../require/admin/sessionvariables.php';

//page variables
$PageName = "Update FAQ Details";

if (isset($_GET['id'])) {
  $WallPaperFaqsId = $_GET['id'];
  $_SESSION['WallPaperFaqsId'] = $WallPaperFaqsId;
} else {
  $WallPaperFaqsId  = $_SESSION['WallPaperFaqsId'];
}
$PageSqls = "SELECT  * FROM wallpaper_faqs where WallPaperFaqsId='$WallPaperFaqsId'";
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
                <a href="#" onclick="Databar('Addbrands')" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> FAQ's</a>
              </div>
              <div class="row m-t-10">
                <div class="col-md-12">
                  <div class="flex-s-b">
                    <?php include 'common.php'; ?>
                  </div>
                </div>
              </div>
              <form class="data-form" action="../../controller/WallPaperController.php" method="POST">
                <?php FormPrimaryInputs(true); ?>
                <input type="hidden" name="WallPaperFaqsId" value="<?php echo $WallPaperFaqsId; ?>">
                <div class=" row">
                  <div class="form-group col-lg-4 col-md-4 col-ms-4 col-4">
                    <label>Enter Question</label>
                    <input type="text" name="WallPaperFaqQuestions" value="<?php echo FETCH($PageSqls, "WallPaperFaqQuestions"); ?>" class="form-control-2" required="" />
                  </div>
                </div>
                <div class="row">
                  <div class="form-group col-lg-4 col-md-4">
                    <label>Enter Answer</label>
                    <textarea name="WallPaperFaqAnswer" class="form-control-2" rows="4" style="height:100% !important;"><?php echo FETCH($PageSqls, "WallPaperFaqAnswer"); ?></textarea>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-4">
                    <br>
                    <a href="faqs.php" class="btn btn-md btn-default">Back to All</a>
                    <button type="Submit" value="null" name="UpdateFaqs" class="btn btn-md app-btn">Update FAQ</button>
                  </div>
                </div>
            </div>

          </div>
          </form>
        </div>
        < <!--End page content-->
      </div>

      <?php include '../../include/admin/sidebar.php'; ?>
    </div>
    <?php include '../../include/admin/footer.php'; ?>
  </div>


  <?php include '../../include/admin/footer_files.php'; ?>
</body>

</html>