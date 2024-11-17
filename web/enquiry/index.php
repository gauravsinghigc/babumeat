<?php
//include required files here
require '../../require/modules.php';
require '../../require/web-modules.php';

//page varibale
$PageName  = "Have an Enquiry";
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
        <h4 class="account-header text-center p-5"><?php echo $PageName; ?><br>
          <span class="fs-12">We welcome every feedback, suggestion or query, so feel free to reach at us at any time.</span>
        </h4>
      </div>
    </div>
  </section>

  <section class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <br>
        <form style="width:40%;margin: 1% auto;" action="<?php echo CONTROLLER; ?>/enquirycontroller.php" method="POST">
          <?php FormPrimaryInputs(true); ?>
          <div class="form-group">
            <label>Full Name</label>
            <input type="text" name="FullName" class="form-control" required="">
          </div>

          <div class="form-group">
            <label>Email ID</label>
            <input type="email" name="EnquiryPhoto" class="form-control" required="">
          </div>

          <div class="form-group">
            <label>Phone Number</label>
            <input type="text" name="PhoneNumber" class="form-control" required="">
          </div>

          <div class="form-group">
            <label>Subject</label>
            <input type="text" name="Subject" class="form-control" required="">
          </div>

          <div class="form-group">
            <label>Message</label>
            <textarea class="form-control" name="Message" rows="4" required=""></textarea>
          </div>

          <div class="form-group">
            <button class="btn btn-md btn-success" name="SubmitEnquiry" type="Submit">Send Details</button>
          </div>
        </form>
      </div>
    </div>
  </section>
  <br><br>

  <?php include '../../include/web/footer.php'; ?>
  <?php include '../../include/web/footer_files.php'; ?>
</body>

</html>