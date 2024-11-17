<?php

//required files
require '../../require/modules.php';
require '../../require/admin/access-control.php';
require '../../require/admin/sessionvariables.php';

//page variables
$PageName = "All Enquiries";
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
                <div class="col-md-12">
                  <h4 class="app-heading"><i class="fa fa-file-pdf-o"></i> <?php echo $PageName; ?></h4>
                </div>
              </div>
              <br>
              <div class="row">
                <div class="col-md-12">
                  <table id="demo-dt-basic" class="table table-striped">
                    <thead>
                      <tr>
                        <th>Sno</th>
                        <th>EnquiryID</th>
                        <th>Subject</th>
                        <th>Name</th>
                        <th>Phone</th>
                        <th>ReceiveDate</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $FetchEnquiries = FetchConvertIntoArray("SELECT * FROM enquiries ORDER BY EnquiryStatus DESC", true);
                      if ($FetchEnquiries != null) {
                        $Count = 0;
                        foreach ($FetchEnquiries as $Enquiry) {
                          $Count++; ?>
                          <tr>
                            <td><?php echo $Count; ?></td>
                            <td>
                              <span class="text-primary"><i class="fa fa-hashtag"></i><?php echo $Enquiry->EnquiriesId; ?>/<?php echo date("d-m-Y", strtotime($Enquiry->EnquiryDate)); ?></span>
                            </td>
                            <td>
                              <?php echo $Enquiry->Subject; ?>
                            </td>
                            <td>
                              <?php echo $Enquiry->FullName; ?>
                            </td>
                            <td>
                              <?php echo $Enquiry->PhoneNumber; ?>
                            </td>
                            <td>
                              <?php echo $Enquiry->EnquiryDate; ?>
                            </td>
                            <td>
                              <?php echo EnquiryStatus($Enquiry->EnquiryStatus); ?>
                            </td>
                            <td>
                              <a href="#" class="btn btn-sm btn-primary" data-target="#view_details_<?php echo $Enquiry->EnquiriesId; ?>" data-toggle="modal" class="btn btn-default">View Details</a>
                            </td>
                          </tr>

                          <div id="view_details_<?php echo $Enquiry->EnquiriesId; ?>" class="modal fade" tabindex="-1">
                            <div class="modal-dialog modal-md">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h4 class="modal-title app-heading" id="mySmallModalLabel">Enquiry Details</h4>
                                </div>
                                <div class="modal-body">
                                  <p class="flex-s-b m-b-0">
                                    <span>EnquiryID</span>
                                    <span class="text-primary"><i class="fa fa-hashtag"></i> <?php echo $Enquiry->EnquiriesId; ?>/<?php echo date("d-m-Y", strtotime($Enquiry->EnquiryDate)); ?></span>
                                  </p>
                                  <p class="flex-s-b m-b-0">
                                    <span>FullName</span>
                                    <span class="text-primary"><?php echo $Enquiry->FullName; ?></span>
                                  </p>
                                  <p class="flex-s-b m-b-0">
                                    <span>Phone number</span>
                                    <span class="text-primary"><?php echo $Enquiry->PhoneNumber; ?></span>
                                  </p>
                                  <p class="flex-s-b m-b-0">
                                    <span>Email number</span>
                                    <span class="text-primary"><?php echo $Enquiry->EnquiryPhoto; ?></span>
                                  </p>
                                  <p class="flex-s-b m-b-0">
                                    <span>Subject</span>
                                    <span class="text-primary"><?php echo $Enquiry->Subject; ?></span>
                                  </p>
                                  <p class="flex-s-b m-b-0">
                                    <span>Status</span>
                                    <span class="text-primary"><?php echo EnquiryStatus($Enquiry->EnquiryStatus); ?></span>
                                  </p>
                                  <p class="m-b-0">
                                    <span class="fs-15 bold">Message Details</span><br>
                                    <span class="text-primary"><?php echo html_entity_decode(SECURE($Enquiry->Message, "d")); ?></span>
                                  </p>

                                </div>
                                <div class="modal-footer">
                                  <a href="<?php echo DOMAIN; ?>/controller/enquirycontroller.php?update_enquiry=<?php echo SECURE($Enquiry->EnquiriesId, 'e'); ?>&access_url=<?php echo SECURE(RUNNING_URL, 'e'); ?>&update_to=<?php echo SECURE('1', 'e'); ?>" class="btn btn-success">Mark as Read</a>
                                  <a href="<?php echo DOMAIN; ?>/controller/enquirycontroller.php?update_enquiry=<?php echo SECURE($Enquiry->EnquiriesId, 'e'); ?>&access_url=<?php echo SECURE(RUNNING_URL, 'e'); ?>&update_to=<?php echo SECURE('0', 'e'); ?>" class="btn btn-default">Mark as UnRead</a>
                                  <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                </div>
                              </div>
                            </div>
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

      <?php include '../../include/admin/sidebar.php'; ?>
    </div>
    <?php include '../../include/admin/footer.php'; ?>
  </div>

  <?php include '../../include/admin/footer_files.php'; ?>
</body>

</html>