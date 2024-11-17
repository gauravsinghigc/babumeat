<?php
//include required files here
require '../../require/modules.php';
require '../../require/web-modules.php';

//page varibale
$PageName  = "Artists";
$PageAccess = "Artists";
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
        <h3 class="account-header p-5 mb-3 text-center"><?php echo $PageName; ?></h3>
      </div>
    </div>
  </section>

  <section class="container section">
    <div class="row">
      <?php
      $SQLpro_brands = SELECT("SELECT * FROM pro_brands ORDER BY ProBrandId ASC");
      while ($fetchpro_brands = mysqli_fetch_array($SQLpro_brands)) {
        $ProBrandId = $fetchpro_brands['ProBrandId'];
        $ProBrandName = $fetchpro_brands['ProBrandName'];
        $ProBrandStatus = $fetchpro_brands['ProBrandStatus'];
        $ProBrandImage = $fetchpro_brands['ProBrandImage'];
        $ProBrandCreatedAt = ReturnValue($fetchpro_brands['ProBrandCreatedAt']);
        $ProBrandUpdatedAt = ReturnValue($fetchpro_brands['ProBrandUpdatedAt']);
        $StatusView = StatusViewWithText($ProBrandStatus);
        $CountProducts = TOTAL("SELECT * FROM products where ProductBrandId='$ProBrandId'");
        $ProBrandDescriptions = $fetchpro_brands['ProBrandDescriptions']; ?>
        <div class="col-md-3">
          <div class="artist-block">
            <img src="<?php echo STORAGE_URL; ?>/products/brands/<?php echo $ProBrandImage; ?>" class="img-fluid">
            <h6><?php echo $ProBrandName; ?></h6>
            <p><?php echo html_entity_decode(SECURE($ProBrandDescriptions, "d")); ?></p>
          </div>
        </div>
      <?php } ?>
    </div>
  </section>

  <br>
  <?php include '../../include/web/footer.php'; ?>
  <?php include '../../include/web/footer_files.php'; ?>
</body>

</html>