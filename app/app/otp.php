<?php
include "../config.php";

if (isset($_GET['phone'])) {
  $phone = $_GET['phone'];
} else {
  $phone = "";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=0.9">
  <title><?php echo APP_NAME; ?></title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js" integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.2.1/css/fontawesome.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/solid.min.css" integrity="sha512-6mc0R607di/biCutMUtU9K7NtNewiGQzrvWX4bWTeqmljZdJrwYvKJtnhgR+Ryvj+NRJ8+NnnCM/biGqMe/iRA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="<?php echo DOMAIN; ?>/assets/app/css/app.css">
</head>

<body>
  <section class="container">
    <div class="row">
      <div class="col-md-12 mt-5">
        <img src="<?php echo APP_LOGO; ?>" class="w-50 img-bdr">
      </div>
      <div class="col-md-12 mt-5">
        <h4>Enter OTP sent on </h4>
        <p>+91<?php echo $phone; ?></p>
      </div>
      <div class="col-md-12">
        <form action='home.php'>
          <div>
            <input type='password' class="form-control form-control-lg app-form-control" placeholder="000000">
          </div>
          <div class="fixed-bottom mb-3 bg-white">
            <button class="btn btn-sm app-btn">Continue <i class="fa fa-angle-right"></i></button>
          </div>
        </form>
        <h6 class="mt-2"><i class='fa fa-check text-success'></i> OTP Sent Successfully!</h6>
      </div>
    </div>
  </section>
</body>

</html>