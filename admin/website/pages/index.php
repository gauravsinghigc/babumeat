<?php
//required files
require '../../../require/modules.php';
require '../../../require/admin/access-control.php';
require '../../../require/admin/sessionvariables.php';

//page variables
$PageName = "Pages";
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
              <div class="row m-t-10">
                <div class="col-md-12 col-ms-12 col-lg-12">
                  <h4 class="app-heading"><?php echo $PageName; ?></h4>
                </div>
              </div>
              <div class="row m-t-10">
                <?php
                $FetchListings = FetchConvertIntoArray("SELECT * FROM pages ORDER BY PagedId ASC", true);
                if ($FetchListings != null) {
                  foreach ($FetchListings as $Fields) { ?>
                    <div class="col-md-6 col-lg-6 col-sm-6 col-6">
                      <div class="shadow-lg br10 p-1">
                        <img src="<?php echo STORAGE_URL; ?>/pages/<?php echo $Fields->PageFeatureImage; ?>" title="<?php echo $Fields->PageName; ?>" alt="<?php echo $Fields->PageName; ?>" class="featured-image w-100">
                        <h4 class="m-b-0 m-t-10 app-sub-heading"><?php echo $Fields->PageDisplayName; ?></h4>
                        <div class="details p-1r content-area-scroll-y app-page-details">
                          <?php echo SECURE($Fields->PageContent, "d"); ?>
                        </div>
                        <div class="p-1 m-t-10 shadow-sm text-right">
                          <a href="edit.php?id=<?php echo $Fields->PagedId; ?>" class="btn btn-primary btn-sm">Edit</a>
                        </div>
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