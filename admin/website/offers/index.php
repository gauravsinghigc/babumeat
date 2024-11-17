<?php

//required files
require '../../../require/modules.php';
require '../../../require/admin/access-control.php';
require '../../../require/admin/sessionvariables.php';

//page variables
$PageName = "All Offers";
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
                    <a href="<?php echo DOMAIN; ?>/admin/website/offers/add.php" class="btn btn-sm btn-danger square">ADD Offers</a>
                  </div>
                </div>
                <div class="col-md-12">
                  <table class="table table-striped">
                    <thead>
                      <tr>
                        <th>Sno</th>
                        <th>OfferName</th>
                        <th>OfferCODE</th>
                        <th>DiscountType</th>
                        <th>DiscountValue</th>
                        <th>CreatedAt</th>
                        <th>UpdatedAt</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <?php
                    $FetchListings = FetchConvertIntoArray("SELECT * FROM offers ORDER BY OffersId ASC", true);
                    if ($FetchListings != null) {
                      $Sno = 0;
                      foreach ($FetchListings as $Fields) {
                        $Sno++; ?>
                        <tbody>
                          <tr>
                            <td><?php echo $Sno; ?></td>
                            <td class="text-info"><?php echo $Fields->OffersName; ?></th>
                            <td><?php echo $Fields->OfferCouponCode; ?></td>
                            <td><?php echo $Fields->OfferDiscountType; ?></td>
                            <td><?php echo $Fields->OfferDiscountValue; ?></td>
                            <td><?php echo DATE_FORMATE2("d M, Y", $Fields->OfferCreatedAt); ?></td>
                            <td><?php echo DATE_FORMATE2("d M, Y", $Fields->OfferUpdatedAt); ?></td>
                            <td><?php echo StatusViewWithText($Fields->OfferStatus); ?></td>
                            <td>
                              <a href="edit.php?id=<?php echo SECURE($Fields->OffersId, "e"); ?>" class="btn btn-sm btn-info">Edit</a>
                              <?php CONFIRM_DELETE_POPUP(
                                "delete_offers",
                                $Requests = [
                                  "delete_offers_records" => true,
                                  "control_id" => $Fields->OffersId
                                ],
                                "offercontroller",
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