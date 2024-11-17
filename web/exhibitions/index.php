<?php
//include required files here
require '../../require/modules.php';
require '../../require/web-modules.php';

//page varibale
$PageName  = "Exhibitions " . APP_NAME;

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

  <section class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <h3 class="account-header text-center p-4"><?php echo $PageName; ?></h3>
      </div>
    </div>
  </section>

  <section class="container">
    <?php
    $FetchListings = FetchConvertIntoArray("SELECT * FROM exhibitions", true);
    if ($FetchListings != null) {
      $Sno = 0;
      foreach ($FetchListings as $Fields) {
        $Sno++; ?>
        <div class="row">
          <div class="col-md-4 media-list span4 text-center">
            <a href="<?php echo WEB_URL; ?>/exhibitions/details/?view=<?php echo SECURE($Fields->ExhibitionsCategory, "e"); ?>">
              <div class="ex-img">
                <img src="<?php echo STORAGE_URL; ?>/exhibitions/<?php echo $Fields->ExhibitionsFeatureImage; ?>" class="img-fluid list-icon">
              </div>
            </a>
          </div>
          <div class="col-md-8 media-list span8 text-left">
            <div class="ex-details p-2">
              <h3 class="mt-2"><?php echo $Fields->ExhibitionsName; ?></h3>
              <hr>
              <?php echo html_entity_decode(SECURE($Fields->ExhibitionsDescriptions, "d")); ?>
              <a href="<?php echo WEB_URL; ?>/exhibitions/details/?view=<?php echo SECURE($Fields->ExhibitionsCategory, "e"); ?>" class="btn btn-md app-btn">View Details</a>
            </div>
          </div>
        </div>
    <?php }
    }
    ?>
  </section>
  <br>
  <?php include '../../include/web/footer.php'; ?>
  <?php include '../../include/web/footer_files.php'; ?>
</body>

</html>