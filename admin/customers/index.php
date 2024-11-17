<?php

//required files
require '../../require/modules.php';
require '../../require/admin/access-control.php';
require '../../require/admin/sessionvariables.php';

//page variables
$PageName = "All Customers";
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
                  <div class="flex-s-b app-heading">
                    <h3 class="m-t-0 m-b-0"><?php echo $PageName; ?></h3>
                    <a href="add.php" class="btn btn-sm btn-default"><i class="fa fa-plus"></i> <?php echo $PageName ?></a>
                  </div>
                </div>
              </div>
              <div class="row m-t-10">
                <div class="col-md-12">
                  <table class="table table-striped">
                    <thead>
                      <tr>
                        <th>SNo</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Phone</th>
                        <th>EmailId</th>
                        <th>RegDate</th>
                        <th>UpdateDate</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $fetchcustomers = FetchConvertIntoArray("SELECT * FROM customers ORDER BY CustomerId ASC", true);
                      if ($fetchcustomers != null) {
                        $Count = 0;
                        foreach ($fetchcustomers as $data) {
                          $Count++;
                      ?>
                          <tr>
                            <td><?php echo $Count; ?></td>
                            <td>
                              <img src="<?php echo STORAGE_URL; ?>/customers/img/profile/<?php echo $data->CustomerProfileImage; ?>" title="<?php echo $data->CustomerName; ?>" alt="<?php echo $data->CustomerName; ?>" class="pro-img">
                            </td>
                            <td class="text-primary">
                              <?php echo $data->CustomerName; ?>
                            </td>
                            <td>
                              <?php echo $data->CustomerPhoneNumber; ?>
                            </td>
                            <td>
                              <?php echo ReturnValue($data->CustomerEmailid); ?>
                            </td>
                            <td>
                              <?php echo ReturnValue($data->CustomerCreatedAt); ?>
                            </td>
                            <td>
                              <?php echo ReturnValue($data->CustomerUpdatedAt); ?>
                            </td>
                            <td>
                              <?php echo StatusViewWithText($data->CustomerStatus); ?>
                            </td>
                            <td>
                              <a href="#" data-target="#view_details_<?php echo $data->CustomerId; ?>" data-toggle="modal" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a>
                            </td>
                          </tr>

                          <div id="view_details_<?php echo $data->CustomerId; ?>" class="modal fade" tabindex="-1">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h4 class="modal-title app-heading" id="mySmallModalLabel">
                                    <img src="<?php echo STORAGE_URL; ?>/customers/img/profile/<?php echo $data->CustomerProfileImage; ?>" class="list-icon"><?php echo $data->CustomerName; ?>
                                  </h4>
                                </div>
                                <div class="modal-body">
                                  <form class="data-form" action="../../controller/customercontroller.php" method="POST" enctype="multipart/form-data">
                                    <?php FormPrimaryInputs(true); ?>
                                    <div class="row">
                                      <div class="col-md-12">
                                        <h4 class="m-b-0 m-t-0">Customer Details</h4>
                                      </div>
                                      <div class="form-group col-lg-4 col-md-4 col-ms-4 col-12">
                                        <label>Full Name</label>
                                        <input type="text" name="CustomerName" value="<?php echo $data->CustomerName; ?>" class="form-control-2" required="" />
                                      </div>
                                      <div class="form-group col-lg-4 col-md-4 col-ms-4 col-12">
                                        <label>Phone Number</label>
                                        <input type="text" name="CustomerPhoneNumber" value="<?php echo $data->CustomerPhoneNumber; ?>" placeholder="+91" class="form-control-2" required="" />
                                      </div>

                                      <div class="form-group col-lg-4 col-md-4 col-ms-4 col-12">
                                        <label>Email-Id</label>
                                        <input type="email" name="CustomerEmailid" value="<?php echo $data->CustomerEmailid; ?>" placeholder="abc@domain.ext" class="form-control-2" required="" />
                                      </div>

                                      <div class="col-md-12 m-t-10">
                                        <h4 class="app-sub-heading">Address</h4>
                                      </div>

                                      <div class="form-group col-lg-4 col-md-4 col-ms-4 col-12">
                                        <label>Street Address</label>
                                        <input type="text" name="CustomerStreetAddress" value="<?php echo SECURE($data->CustomerStreetAddress, "d"); ?>" class="form-control-2" required="" />
                                      </div>
                                      <div class="form-group col-lg-4 col-md-4 col-ms-4 col-12">
                                        <label>Area</label>
                                        <input type="text" name="CustomerArea" value="<?php echo $data->CustomerArea; ?>" class="form-control-2" required="" />
                                      </div>
                                      <div class="form-group col-lg-4 col-md-4 col-ms-4 col-12">
                                        <label>Village</label>
                                        <input type="text" name="CustomerVillageBlock" value="<?php echo $data->CustomerVillageBlock; ?>" class="form-control-2" required="" />
                                      </div>
                                      <div class="form-group col-lg-4 col-md-4 col-ms-4 col-12">
                                        <label>City</label>
                                        <input type="text" name="CustomerCity" value="<?php echo $data->CustomerCity; ?>" class="form-control-2" required="" />
                                      </div>
                                      <div class="form-group col-lg-4 col-md-4 col-ms-4 col-12">
                                        <label>State</label>
                                        <input type="text" name="CustomerState" value="<?php echo $data->CustomerState; ?>" class="form-control-2" required="" />
                                      </div>
                                      <div class="form-group col-lg-4 col-md-4 col-ms-4 col-12">
                                        <label>Pincode</label>
                                        <input type="text" name="CustomerPincode" value="<?php echo $data->CustomerPincode; ?>" class="form-control-2" required="" />
                                      </div>
                                      <div class="form-group col-md-4 col-lg-4 col-sm-4 col-12">
                                        <label>Customer Status</label>
                                        <select class="form-control-2" name="CustomerStatus" required="">
                                          <?php
                                          if ($data->CustomerStatus == 1) { ?>
                                            <option value="1" selected="">Active</option>
                                            <option value="2">Inactive</option>
                                          <?php } else { ?>
                                            <option value="1">Active</option>
                                            <option value="2" selected="">Inactive</option>
                                          <?php } ?>
                                        </select>
                                      </div>
                                      <div class="col-md-12">
                                        <h4 class="app-sub-heading">Photos</h4>
                                      </div>
                                      <div class="form-group col-lg-4 col-md-4 col-ms-4 col-12">
                                        <label>Profile Image</label>
                                        <input type="FILE" name="CustomerProfileImage" value="null" class="form-control-2" />
                                        <input type="hidden" name="CustomerProfileImage_CURRENT" value="<?php echo SECURE($data->CustomerProfileImage, "e"); ?>" class="form-control-2" />
                                        <br>
                                        <img src="<?php echo STORAGE_URL; ?>/customers/img/profile/<?php echo $data->CustomerProfileImage; ?>" class="imgrpreview">
                                      </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                  <button type="submit" name="UpdateCustomerProfile" value="<?php echo SECURE($data->CustomerId, "e"); ?>" class="btn btn-success">Update Profile</button>
                                  <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                  </form>
                                </div>
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

          <!--End page content-->
        </div>

        <?php include '../../include/admin/sidebar.php'; ?>
      </div>
      <?php include '../../include/admin/footer.php'; ?>
    </div>


    <?php include '../../include/admin/footer_files.php'; ?>
</body>

</html>