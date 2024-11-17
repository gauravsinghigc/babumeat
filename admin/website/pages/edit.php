<?php

//required files
require '../../../require/modules.php';
require '../../../require/admin/access-control.php';
require '../../../require/admin/sessionvariables.php';

//page variables
$PageName = "Edit Page Details";

if (isset($_GET['id'])) {
  $id = $_GET['id'];
  $_SESSION['ViewId'] = $_GET['id'];
} else {
  $id = $_SESSION['ViewId'];
}
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
              <h4 class="app-heading"><?php echo $PageName; ?></h4>
              <div class="row">
                <div class="col-md-12">
                  <?php include '../common.php'; ?>
                </div>
              </div>
              <div class="row m-t-10">
                <?php
                $FetchListings = FetchConvertIntoArray("SELECT * FROM pages where PagedId='$id' ORDER BY PagedId ASC", true);
                if ($FetchListings != null) {
                  foreach ($FetchListings as $Fields) { ?>
                    <div class="col-md-12 col-lg-12 col-sm-12 col-12">
                      <div class="shadow-lg br10 p-1">
                        <h3 class="m-t-10">Page Name : <?php echo $Fields->PageName; ?></h4>
                          <label>Feature Image</label>
                          <br>
                          <img src="<?php echo STORAGE_URL; ?>/pages/<?php echo $Fields->PageFeatureImage; ?>" title="<?php echo $Fields->PageName; ?>" alt="<?php echo $Fields->PageName; ?>" class="listing-img w-100">
                          <form class="" action="../../../controller/pagecontroller.php" method="POST" enctype="multipart/form-data">
                            <?php FormPrimaryInputs(true); ?>
                            <?php CurrentFile($Fields->PageFeatureImage); ?>
                            <input type="text" name="PagedId" value="<?php echo $Fields->PagedId; ?>" hidden="">
                            <input type="text" name="UpdatePageImage" hidden="">
                            <label for="Listingimage" class="uploadicon">
                              <i class="fa fa-upload"></i>
                            </label>
                            <input name="PageFeatureImage" id="Listingimage" type="FILE" class="form-control-2 hidden" required="" placeholder="Lisiting image" onchange="form.submit()">
                          </form>
                          <br>
                          <form class="m-t-5" action="../../../controller/pagecontroller.php" method="POST">
                            <?php FormPrimaryInputs(true); ?>
                            <input type="text" name="PagedId" value="<?php echo $Fields->PagedId; ?>" hidden="">
                            <div class="form-group m-b-0">
                              <label>Page Display Name</label>
                              <input name="PageDisplayName" type="text" class="form-control-2 text-black" required="" placeholder="Listing Name" value="<?php echo $Fields->PageDisplayName; ?>">
                            </div>
                            <div class="form-group">
                              <label>Page Content</label>
                              <textarea name="PageContent" class="form-control" id="editor" rows="30" style="height:max-content !important;"><?php echo SECURE($Fields->PageContent, 'd'); ?></textarea>
                            </div>
                            <div class="m-b-0">
                              <br>
                              <button type="submit" name="UpdatePageContent" class="btn btn-md app-btn">Update</button>
                            </div>
                          </form>
                      </div>
                    </div>
                <?php }
                }
                ?>
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