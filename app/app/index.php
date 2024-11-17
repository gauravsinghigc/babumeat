<?php
include "../config.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=0.9">
  <title><?php echo APP_NAME; ?></title>
</head>

<body>
  <section class="container">
    <div class="row">
      <div class="col-md-12 mt-2">
        <img src="<?php echo APP_LOGO; ?>" class="w-50 img-bdr">
      </div>
      <div class="col-md-12 mt-5">
        <h4>Enter your Phone Number</h4>
      </div>
      <div class="col-md-12">
        <form action='otp.php'>
          <div>
            <span>+91</span>
            <input type='tel' name='phone' class="form-control form-control-lg app-form-control" placeholder="000000000">
          </div>
          <div class="fixed-bottom mb-3 bg-white">
            <p><i class='fa fa-check text-success'></i> By continue this you agrees our <a href=''>Privacy Policy</a> and <a href="">Terms and conditions</a></p>
            <button class="btn btn-sm app-btn mb-3">Continue <i class="fa fa-angle-right"></i></button><br>
            <a href="home.php" class="bold h6 mt-3">Skip & Browse App</a>
          </div>
        </form>
      </div>
    </div>
  </section>
</body>

</html>