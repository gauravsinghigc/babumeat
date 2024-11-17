<?php

//required files
require '../../require/modules.php';
require '../../require/admin/access-control.php';
require '../../require/admin/sessionvariables.php';

//page variables
$PageName = "Register New Customer";

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
                  <h3 class="app-heading"><?php echo $PageName; ?></h3>
                </div>
                <div class="col-md-12">
                  <div class="flex-s-b">
                    <div class="btn-group btn-group-sm">
                      <a href="<?php echo DOMAIN; ?>/admin/customers/index.php" class="btn btn-sm btn-primary square">Back to All Customer</a>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row m-t-10">
                <div class="col-md-12">
                  <form class="data-form" action="../../controller/customercontroller.php" method="POST" enctype="multipart/form-data">
                    <?php FormPrimaryInputs(true); ?>
                    <div class="row">
                      <div class="col-md-12 m-t-10">
                        <h4 class="app-sub-heading">Customer Details</h4>
                      </div>
                      <div class="form-group col-lg-4 col-md-4 col-ms-4 col-12">
                        <label>Full Name</label>
                        <input type="text" name="CustomerName" class="form-control-2" required="" />
                      </div>
                      <div class="form-group col-lg-4 col-md-4 col-ms-4 col-12">
                        <label>Phone Number</label>
                        <input type="text" min="10" max="12" name="CustomerPhoneNumber" placeholder="+91" class="form-control-2" required="" />
                      </div>

                      <div class="form-group col-lg-4 col-md-4 col-ms-4 col-12">
                        <label>Email-Id</label>
                        <input type="email" name="CustomerEmailid" placeholder="abc@domain.ext" class="form-control-2" required="" />
                      </div>

                      <div class="form-group col-lg-4 col-md-4 col-ms-4 col-12">
                        <label>Password</label>
                        <input type="password" id="pass1" name="CustomerPassword" placeholder="abc@domain.ext" class="form-control-2" required="" />
                      </div>

                      <div class="form-group col-lg-4 col-md-4 col-ms-4 col-12">
                        <label>Re-Enter Password <span id="passmsg"></span></label>
                        <input type="password" id="pass2" name="CustomerPassword" placeholder="abc@domain.ext" class="form-control-2" required="" />
                      </div>

                      <div class="col-md-12 m-t-10">
                        <h4 class="app-sub-heading">Address</h4>
                      </div>

                      <div class="form-group col-lg-4 col-md-4 col-ms-4 col-12">
                        <label>Street Address</label>
                        <input type="text" name="CustomerStreetAddress" class="form-control-2" required="" />
                      </div>
                      <div class="form-group col-lg-4 col-md-4 col-ms-4 col-12">
                        <label>Area</label>
                        <input type="text" name="CustomerArea" class="form-control-2" required="" />
                      </div>
                      <div class="form-group col-lg-4 col-md-4 col-ms-4 col-12">
                        <label>Village</label>
                        <input type="text" name="CustomerVillageBlock" class="form-control-2" required="" />
                      </div>
                      <div class="form-group col-lg-4 col-md-4 col-ms-4 col-12">
                        <label>city</label>
                        <input type="text" name="CustomerCity" class="form-control-2" required="" />
                      </div>
                      <div class="form-group col-lg-4 col-md-4 col-ms-4 col-12">
                        <label>state</label>
                        <input type="text" name="CustomerState" class="form-control-2" required="" />
                      </div>
                      <div class="form-group col-lg-4 col-md-4 col-ms-4 col-12">
                        <label>Pincode</label>
                        <input type="text" name="CustomerPincode" class="form-control-2" required="" />
                      </div>
                      <div class="col-md-12 m-t-10">
                        <h4 class="app-sub-heading">Photos</h4>
                      </div>
                      <div class="form-group col-lg-4 col-md-4 col-ms-4 col-12">
                        <label>Profile Image</label>
                        <input type="FILE" name="CustomerProfileImage" class="form-control-2" required="" />
                      </div>

                    </div>
                    <br>
                    <button id="passbtn" type="Submit" value="null" name="SaveNewCustomer" class="btn app-btn">Save</button>
                    <a href="index.php" class="btn btn-md btn-danger">Cancel</a>

                  </form>
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
    <script>
      function checkpass() {
        var pass1 = document.getElementById("pass1");
        var pass2 = document.getElementById("pass2");
        if (pass1.value === pass2.value) {
          document.getElementById("passbtn").classList.remove("disabled");
          document.getElementById("passmsg").classList.add("text-success");
          document.getElementById("passmsg").classList.remove("text-danger");
          document.getElementById("passmsg").innerHTML = "<i class='fa fa-check-circle-o'></i> Password Matched!";
        } else {
          document.getElementById("passmsg").classList.remove("text-success");
          document.getElementById("passmsg").classList.add("text-danger");
          document.getElementById("passbtn").classList.add("disabled");
          document.getElementById("passmsg").innerHTML = "<i class='fa fa-warning'></i> Password do not matched!";
        }
      }
    </script>
    <?php include '../../include/admin/footer_files.php'; ?>
</body>

</html>