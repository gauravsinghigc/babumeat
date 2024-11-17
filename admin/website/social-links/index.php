<?php

//required files
require '../../../require/modules.php';
require '../../../require/admin/access-control.php';
require '../../../require/admin/sessionvariables.php';

//page variables
$PageName = "Social Links";
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
              <div class="row flex-s-b">
                <div class="col-md-12 col-12 w-75">
                  <h4 class="app-heading"><?php echo $PageName; ?></h4>
                </div>
                <div class="col-md-12 text-right w-25">
                  <a href="<?php echo DOMAIN; ?>/admin/website/social-links/add.php" class="btn btn-md btn-danger">ADD Links</a>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <table class="table table-striped">
                    <thead>
                      <tr>
                        <th>SNo</th>
                        <th>Name</th>
                        <th>Icon</th>
                        <th>OpenAt</th>
                        <th>Status</th>
                        <th>CreatedAt</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $FetchSocialAccounts = FetchConvertIntoArray("SELECT * FROM socialaccounts ORDER BY socialaccountid DESC", true);
                      if ($FetchSocialAccounts != NULL) {
                        $Sno = 0;
                        foreach ($FetchSocialAccounts as $Requests) {
                          $Sno++; ?>
                          <tr>
                            <td><?php echo $Sno; ?></td>
                            <td><?php echo $Requests->socialaccountname; ?></td>
                            <td><i class="fa <?php echo $Requests->socialaccounticon; ?>"></i></td>
                            <td><?php echo $Requests->socialaccountopenat; ?></td>
                            <td><?php echo StatusViewWithText($Requests->socialaccountstatus); ?></td>
                            <td><?php echo DATE_FORMATE2("d M, Y", $Requests->socialaccountcreatedat); ?></td>
                            <td>
                              <a href="edit.php?id=<?php echo SECURE($Requests->socialaccountid, "e"); ?>" class="btn btn-sm btn-info"><i class="fa fa-edit"></i> Edit</a>
                              <?php CONFIRM_DELETE_POPUP(
                                "links_" . $Requests->socialaccountid,
                                [
                                  "delete_social_accounts" => true,
                                  "control_id" => $Requests->socialaccountid
                                ],
                                "socialaccountcontroller",
                                "",
                                "btn-sm"
                              ); ?>
                            </td>
                          </tr>
                      <?php }
                      } ?>
                    </tbody>
                  </table>
                </div>
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