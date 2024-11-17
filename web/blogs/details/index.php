<?php
//include required files here
require '../../../require/modules.php';
require '../../../require/web-modules.php';

//page varibale
$PageName  = "Blogs " . APP_NAME;
if (isset($_GET['blogid'])) {
  $BlogsId = SECURE($_GET['blogid'], "d");
  $_SESSION['BlogsId'] = $BlogsId;
} else {
  $BlogsId = $_SESSION['BlogsId'];
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=0.9">
  <title><?php echo SECURE(FETCH("SELECT * FROM blogs where BlogsId='$BlogsId'", "BlogsTitle"), "d"); ?> | <?php echo APP_NAME; ?></title>
  <?php include '../../../include/web/header_files.php'; ?>
</head>

<body>

  <?php
  include '../../../include/web/header.php'; ?>

  <section class="container">
    <div class="row">
      <?php

      $FetchListings = FetchConvertIntoArray("SELECT * FROM blogs where BlogsId='$BlogsId' ORDER BY BlogsId ASC", true);
      if ($FetchListings != null) {
        $Sno = 0;
        foreach ($FetchListings as $Fields) {
          $Sno++; ?>
          <div class="col-md-12 text-center mt-2">
            <img src="<?php echo STORAGE_URL; ?>/blogs/<?php echo $Fields->BlogsFeatureImage; ?>" class="img-fluid" alt="<?php echo SECURE($Fields->BlogsTitle, "d"); ?>" title="<?php echo SECURE($Fields->BlogsTitle, "d"); ?>">
          </div>
          <div class="col-md-12 mt-2">
            <h3 class="listing-title">
              <?php echo SECURE($Fields->BlogsTitle, "d"); ?>
            </h3>
            <p class="flex-start">
              <span><i class="fa fa-user"></i> <?php echo FETCH("SELECT * FROM users where UserId='" . $Fields->BlogsPostedBy . "'", "UserName"); ?></span>
              <span class="ml-5"><i class="fa fa-calendar"></i> <?php echo DATE_FORMATE2("d M, Y", $Fields->BlogsCreatedAt); ?></span>
            </p>
            <p class="listing-desc">
              <?php echo html_entity_decode(SECURE($Fields->BlogsDescriptions, "d")); ?>
            </p>
          </div>

      <?php }
      }
      ?>
    </div>
  </section>
  <br>
  <?php include '../../../include/web/footer.php'; ?>
  <?php include '../../../include/web/footer_files.php'; ?>
</body>

</html>