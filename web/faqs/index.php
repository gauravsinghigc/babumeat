<?php
//include required files here
require '../../require/modules.php';
require '../../require/web-modules.php';

//page varibale
$PageName  = "Frequently asked Questions for " . APP_NAME;

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
        <h3 class="account-header text-center p-5"><?php echo $PageName; ?></h3>
      </div>
    </div>
  </section>
  <br>
  <section class="container">
    <div class="row">
      <?php
      $FetchListings = FetchConvertIntoArray("SELECT * FROM faqs ORDER BY FaqsId  ASC", true);
      if ($FetchListings != null) {
        $Sno = 0;
        foreach ($FetchListings as $Fields) {
          $Sno++; ?>
          <div class="col-md-12">
            <div class="listing-blocks">
              <h4 class="listing-title">
                <?php echo SECURE($Fields->FAQsName, "d"); ?>
              </h4>
              <p class="listing-desc">
                <?php echo html_entity_decode(SECURE($Fields->FAQSDescriptions, "d")); ?>
              </p>
            </div>
            <hr>
          </div>
      <?php }
      }
      ?>
    </div>
  </section>
  <br>
  <?php include '../../include/web/footer.php'; ?>
  <?php include '../../include/web/footer_files.php'; ?>
</body>

</html>