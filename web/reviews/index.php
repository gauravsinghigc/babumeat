<?php
//include required files here
require '../../require/modules.php';
require '../../require/web-modules.php';

//page varibale
$PageName  = "Reviews";

if (isset($_GET['proid'])) {
  $ProductId = SECURE($_GET['proid'], "d");
  $_SESSION['VIEW_PRODUCT_ID'] = $ProductId;

  //get product details
} elseif (isset($_SESSION['VIEW_PRODUCT_ID'])) {
  $ProductId = $_SESSION['VIEW_PRODUCT_ID'];

  //get product details
} else {
  $ProductId = null;
}
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
        <h3 class="account-header text-center p-5"><?php echo $PageName; ?><br>
          <span class="fs-12">Customer feedback and Reviews <?php echo APP_NAME; ?></span>
        </h3>
        <br><br>
      </div>
    </div>
  </section>
  <section class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="single_page">
          <div class="row">
            <div class="col-lg-5 col-md-5 col-sm-6 col-12">
              <h4 class="account-header">Submit New review</h4>
              <?php if (isset($_SESSION['LOGIN_CustomerId'])) { ?>
                <div class="add-review">
                  <br>
                  <a href="<?php echo WEB_URL; ?>/collection" class="btn btn-lg btn-success">Submit Review for Products</a>
                </div>
              <?php } else { ?>
                <br><br>
                <h5>To submit new review you have to login into your account.</h5>
                <br>
                <a href="<?php echo DOMAIN; ?>/auth/web/login/?return=<?php echo SECURE(RUNNING_URL, "e"); ?>" class="btn btn-lg buy-now-btn">Login to Submit Review</a>
              <?php } ?>
            </div>
            <div class="col-lg-7 col-md-7 col-sm-6 col-12">
              <h4 class="account-header">All Reviews <span class="pull-right">(<?php echo TOTAL("SELECT * FROM reviews where ReviewedProductid='$ProductId'"); ?>) Reviews</span></h4>
              <div class="bootstrap-tab-text-grids">
                <?php
                if (isset($_GET['proid']) || isset($_SESSION['VIEW_PRODUCT_ID'])) {
                  $FetchReviews = FetchConvertIntoArray("SELECT * FROM reviews where ReviewedProductid='$ProductId' ORDER BY ReviewsId DESC LIMIT 0, 5", true);
                } else {
                  $FetchReviews = FetchConvertIntoArray("SELECT * FROM reviews ORDER BY ReviewsId DESC LIMIT 0, 5", true);
                }
                if ($FetchReviews != null) {
                  foreach ($FetchReviews as $Request) { ?>
                    <div class="bootstrap-tab-text-grid">
                      <div class="bootstrap-tab-text-grid-left">
                        <img src="<?php echo STORAGE_URL_D; ?>/tool-img/feedback.jpg" accept="image/*" alt="" class="img-fluid">
                      </div>
                      <div class="bootstrap-tab-text-grid-right">
                        <ul>
                          <li>
                            <h4><?php echo SECURE($Request->ReviewTitle, "d"); ?><h4>
                          </li>
                        </ul>
                        <style>
                          p {
                            margin-top: 0px !important;
                          }
                        </style>
                        <p><?php echo html_entity_decode(SECURE($Request->ReviewDescriptions, "d")); ?></p>
                        <a href="<?php echo STORAGE_URL; ?>/reviews/<?php echo $Request->ReviewProfileImage; ?>" target="_blank">
                          <img src="<?php echo STORAGE_URL; ?>/reviews/<?php echo $Request->ReviewProfileImage; ?>" class="w-25">
                        </a>
                      </div>
                      <div class="clearfix"> </div>
                    </div>
                    <hr>
                <?php
                  }
                }
                ?>
                <a href="<?php echo WEB_URL; ?>/reviews/" class="btn btn-md buy-now-btn pull-right">View All</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    </div>
    </div>
  </section>
  <br>
  <?php include '../../include/web/footer.php'; ?>
  <?php include '../../include/web/footer_files.php'; ?>
</body>

</html>