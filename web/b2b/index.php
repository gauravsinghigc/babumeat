<?php
//include required files here
require '../../require/modules.php';
require '../../require/web-modules.php';

//page varibale
$PageName  = "B2B";
$PageAccess = "B2B";
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=0.9">
  <title><?php echo $PageName; ?> | <?php echo APP_NAME; ?></title>
  <?php include '../../include/web/header_files.php'; ?>
</head>

<body>

  <?php
  include '../../include/web/header.php'; ?>

  <section class="container-fluid section">
    <div class="row">
      <div class="col-md-12">
        <h3 class="account-header p-4 text-center">B2B</h3>
      </div>
    </div>
  </section>

  <section class="container-fluid section mt-3">
    <div class="row">
      <div class="col-md-6">
        <img src="<?php echo STORAGE_URL; ?>/pages/<?php echo FETCH("SELECT * FROM pages where PageName='$PageAccess'", "PageFeatureImage"); ?>" class="img-fluid">
      </div>

      <div class="col-md-6">
        <h3><b><?php echo FETCH("SELECT * FROM pages where PageName='$PageAccess'", "PageDisplayName"); ?></b></h3>
        <hr>
        <?php echo SECURE(FETCH("SELECT * FROM pages where PageName='$PageAccess'", "PageContent"), "d"); ?>
      </div>
    </div>
  </section>

  <br>
  <?php include '../../include/web/footer.php'; ?>
  <?php include '../../include/web/footer_files.php'; ?>
</body>

</html>