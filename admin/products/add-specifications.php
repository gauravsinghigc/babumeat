<?php

//required files
require '../../require/modules.php';
require '../../require/admin/access-control.php';
require '../../require/admin/sessionvariables.php';

//page variables
$PageName = "ADD Product Specifications";

if (isset($_GET['proid'])) {
  $ViewProductId = SECURE($_GET['proid'], "d");
  $_SESSION['ViewProductId'] = $ViewProductId;
} else {
  $ViewProductId = $_SESSION['ViewProductId'];
}
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
              <div class="row">
                <div class="col-md-12">
                  <h3 class="app-heading"><?php echo $PageName; ?> : <?php echo FETCH("SELECT * FROM products where ProductId='$ViewProductId'", "ProductName"); ?></h3>
                </div>
                <br><br>
                <form class="data-form" action="../../controller/productscontroller.php" method="POST" enctype="multipart/form-data">
                  <?php FormPrimaryInputs(true); ?>
                  <div class="row p-2">
                    <div class="col-md-4 col-lg-4 text-right">
                      <label>Specification Name</label>
                    </div>
                    <div class="col-md-8">
                      <input type="text" name="ProSpecificationName" value="" class="form-control-2" required="">
                    </div>
                  </div>
                  <div class="row p-2">
                    <div class="col-md-4 col-lg-4 text-right">
                      <label>Specification Descriptions</label>
                    </div>
                    <div class="col-md-8">
                      <textarea class="form-control-2" name="ProSpecificationValue" rows="5" id="editor"></textarea>
                    </div>
                  </div>
                  <div class="row p-2">
                    <div class="col-md-12 text-center">
                      <button class="app-btn" value="<?php echo SECURE($_SESSION['ViewProductId'], "e"); ?>" name="createproductspecifications" type="submit">Save Details</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
          <!--End page content-->
        </div>

        <?php include '../../include/admin/sidebar.php'; ?>
      </div>
      <?php include '../../include/admin/footer.php'; ?>
    </div>

    <?php include '../../include/admin/footer_files.php'; ?>
</body>

</html>