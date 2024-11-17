<?php
//include required files here
require '../../require/modules.php';
require '../../require/web-modules.php';

//page varibale
$PageName  = "Blogs " . APP_NAME;

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
    <div class="row">
      <?php
      $FetchListings = FetchConvertIntoArray("SELECT * FROM blogs ORDER BY BlogsId ASC", true);
      if ($FetchListings != null) {
        $Sno = 0;
        foreach ($FetchListings as $Fields) {
          $Sno++; ?>
          <div class="listing-blocks">
            <div class="img-block">
              <img src="<?php echo STORAGE_URL; ?>/blogs/<?php echo $Fields->BlogsFeatureImage; ?>">
            </div>
            <div class="listing-details">
              <h4 class="listing-title">
                <?php echo SECURE($Fields->BlogsTitle, "d"); ?>
              </h4>
              <p class="flex-start">
                <span><i class="fa fa-user"></i> <?php echo FETCH("SELECT * FROM users where UserId='" . $Fields->BlogsPostedBy . "'", "UserName"); ?></span>
                <span class="ml-5"><i class="fa fa-calendar"></i> <?php echo DATE_FORMATE2("d M, Y", $Fields->BlogsCreatedAt); ?></span>
              </p>
              <p class="listing-desc">
                <?php echo html_entity_decode(SECURE($Fields->BlogsDescriptions, "d")); ?>
              </p>
              <a href="details/?blogid=<?php echo SECURE($Fields->BlogsId, "e"); ?>" class="btn btn-sm app-btn">Read More</a>
            </div>
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