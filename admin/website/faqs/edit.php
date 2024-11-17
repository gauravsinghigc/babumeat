<?php

//required files
require '../../../require/modules.php';
require '../../../require/admin/access-control.php';
require '../../../require/admin/sessionvariables.php';

//page variables
$PageName = "Edit FAQs";

if (isset($_GET['id'])) {
  $FaqsId = SECURE($_GET['id'], "d");
  $_SESSION['FaqsId'] = $FaqsId;
} else {
  $FaqsId = $_SESSION['FaqsId'];
}

$PageSqls = "SELECT * FROM faqs WHERE FaqsId='$FaqsId'";
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=0.9">
  <title><?php echo SECURE(GET_DATA("FAQsName"), "d"); ?> | <?php echo APP_NAME; ?></title>
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
                  <form action="../../../controller/faqcontroller.php" method="POST">
                    <div class="row">
                      <div class="form-group col-lg-12 col-sm-12 col-md-12 col-sm-12 col-12">
                        <?php FormPrimaryInputs(true); ?>
                        <label>FAQ Title/Name/Questions</label>
                        <input type="text" name="FAQsName" value="<?php echo SECURE(GET_DATA("FAQsName"), "d"); ?>" placeholder="Enter questions" class="form-control-2" required="">
                      </div>
                      <div class="form-group col-lg-12 col-sm-12 col-md-12 col-sm-12 col-12">
                        <label>FAQ Answer/Descriptions/Details</label>
                        <textarea name="FAQSDescriptions" rows="10" id="editor" placeholder="Enter questions" class="form-control-2 height-auto"><?php echo html_entity_decode(SECURE(GET_DATA("FAQSDescriptions"), "d")); ?></textarea>
                      </div>
                      <div class="form-group col-lg-12 col-md-12 col-sm-12 col-12">
                        <label>FAQ Status</label>
                        <select class="form-control-2" name="FAQsStatus">
                          <?php if (GET_DATA("FAQsStatus") == 1) { ?>
                            <option value="1" selected>Active</option>
                            <option value="0">Inactive</option>
                          <?php } else { ?>
                            <option value="1">Active</option>
                            <option value="0" selected>Inactive</option>
                          <?php } ?>
                        </select>
                      </div>
                      <br><br>
                      <div class="col-md-12 m-t-10">

                        <button type="submit" name="UpdateFaqs" value="<?php echo SECURE($FaqsId, "e"); ?>" class="app-btn">Update</button>
                        <a href="<?php echo DOMAIN; ?>/admin/website/faqs/" class="btn btn-md btn-primary">Back to All</a>
                        <br><br>
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