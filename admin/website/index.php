<?php

//required files
require '../../require/modules.php';
require '../../require/admin/access-control.php';
require '../../require/admin/sessionvariables.php';

//page variables
$PageName = "Sliders";
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
                <div class="col-md-12 m-b-10">
                  <div class="flex-s-b app-heading">
                    <h4 class="m-b-0 m-t-5"><?php echo $PageName; ?></h4>
                    <a href="add-slider.php" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Add Sliders</a>
                  </div>
                </div>
              </div>
              <div class="row m-t-10">
                <div class="col-md-12">
                  <table class="table table-striped">
                    <thead>
                      <tr>
                        <th>Sno</th>
                        <th>Image</th>
                        <th>Slidername</th>
                        <th>Type</th>
                        <th>CreatedAt</th>
                        <th>UpdateAt</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <?php
                    $FetchSliders = FetchConvertIntoArray("SELECT * FROM sliders ORDER BY SliderId ASC", true);
                    if ($FetchSliders != null) {
                      $Count = 0;
                      foreach ($FetchSliders as $data) {
                        $Count++; ?>

                        <tr>
                          <td><?php echo $Count; ?></td>
                          <td>
                            <img src="<?php echo STORAGE_URL; ?>/sliders/<?php echo $data->SliderImage; ?>" title="<?php echo $data->SliderName; ?>" alt="<?php echo $data->SliderName; ?>" class="w-100 pro-img">
                          </td>
                          <td>
                            <?php echo $data->SliderName; ?>
                          </td>
                          <td>
                            <?php echo $data->SliderType; ?>
                          </td>
                          <td>
                            <?php echo $data->SliderCreatedAt; ?>
                          </td>
                          <td>
                            <?php echo ReturnValue($data->SliderUpdatedAt); ?>
                          </td>
                          <td>
                            <?php echo StatusViewWithText($data->SliderStatus); ?>
                          </td>
                          <td>
                            <a href="edit-slider.php?viewid=<?php echo SECURE($data->SliderId, "e"); ?>" class="btn btn-info btn-sm">Edit</a>
                            <a href="<?php echo DOMAIN; ?>/controller/slidercontroller.php?delete_sliders=<?php echo SECURE(true, "e"); ?>&access_url=<?php echo SECURE(RUNNING_URL, "e"); ?>&control_id=<?php echo SECURE($data->SliderId, "e"); ?>" class="btn btn-danger btn-sm">Delete</a>
                          </td>
                        </tr>
                    <?php   }
                    } ?>
                  </table>
                </div>
              </div>
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