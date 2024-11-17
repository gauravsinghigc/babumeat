<?php

//required files
require '../../../require/modules.php';
require '../../../require/admin/access-control.php';
require '../../../require/admin/sessionvariables.php';

//page variables
$PageName = "All Reviews";
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
              <div class="row">
                <div class="col-md-12">
                  <h4 class="app-heading"><?php echo $PageName; ?></h4>
                </div>
                <div class="col-md-12">
                  <div class="btn-group btn-group-sm">
                    <a href="add.php" class="btn btn-sm btn-danger square">ADD Reviews</a>
                  </div>
                </div>
                <div class="col-md-12">
                  <table class="table table-striped">
                    <thead>
                      <tr>
                        <th>Sno</th>
                        <th>Stars</th>
                        <th>ReviewBy</th>
                        <th>ReviewTitle</th>
                        <th>CreatedAt</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <?php
                    $FetchListings = FetchConvertIntoArray("SELECT * FROM reviews ORDER BY ReviewsId ASC", true);
                    if ($FetchListings != null) {
                      $Sno = 0;
                      foreach ($FetchListings as $Fields) {
                        $Sno++; ?>
                        <tbody>
                          <tr>
                            <td><?php echo $Sno; ?></td>
                            <td class="text-warning">
                              <?php
                              $StarCounts = 0;
                              while ($StarCounts < (int)SECURE($Fields->ReviewStarCount, "d")) {
                                $StarCounts++;
                                echo "<i class='fa fa-star text-warning'></i>";
                              } ?>
                              </th>
                            <td><?php echo FETCH("SELECT * FROM customers where CustomerId='" . SECURE($Fields->ReviewedCustomerId, "d") . "'", "CustomerName"); ?></td>
                            <td><?php echo SECURE($Fields->ReviewTitle, "d"); ?></td>
                            <td><?php echo DATE_FORMATE2("d M, Y", $Fields->ReviewCreatedAt); ?></td>
                            <td><?php echo StatusViewWithText($Fields->ReviewStatus); ?></td>
                            <td>
                              <?php CONFIRM_DELETE_POPUP(
                                "delete_reviews",
                                $Requests = [
                                  "delete_reviews_records" => true,
                                  "control_id" => $Fields->ReviewsId
                                ],
                                "reviewcontroller",
                                "<i class='fa fa-trash'></i>",
                                "btn btn-sm btn-danger"
                              ); ?>
                            </td>
                          </tr>
                        </tbody>
                    <?php }
                    }
                    ?>
                  </table>
                </div>
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