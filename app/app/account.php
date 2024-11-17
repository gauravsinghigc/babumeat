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
  <script>
    window.onload = function() {
      document.getElementById("account").classList.add("active");
    }
  </script>
</head>

<body>
  <div class='fixed-top'>
    <section class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="flex-start">

            <div class="page-title">
              <h5>My Account</h5>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

  <section class="page-section">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="flex-start">
            <div class="w-25">
              <img src="https://icon-library.com/images/person-icon-red/person-icon-red-14.jpg" class='user-icon'>
            </div>
            <div class="w-75 text-left pl-3">
              <h5 class="mt-2 bold">Gaurav Singh</h5>
              <h6><i class="fa fa-phone app-text"></i> +919876543210</h6>
              <h6><i class="fa fa-envelope app-text"></i> navix365@gmail.com</h6>
            </div>
          </div>
        </div>

        <div class="col-md-12 mt-4">
          <ul class="account-menus">
            <li><a href=""><i class="fa fa-user"></i> Update Account Details</a></li>
            <li><a href=""><i class="fa fa-truck"></i> My Orders</a></li>
            <li><a href=""><i class="fa fa-exchange"></i> All Transactions</a></li>
            <li><a href=""><i class="fa fa-gear"></i> Account Settings</a></li>
            <li><a href=""><i class="fa fa-info"></i> About Us</a></li>
            <li><a href=""><i class="fa fa-list"></i> Privacy Policy</a></li>
            <li><a href=""><i class="fa fa-refresh"></i> Refund & Cancellation</a></li>
            <li><a href=""><i class="fa fa-info-circle"></i> Contact & Support</a></li>
            <li><a href=""><i class="fa fa-sign-out"></i> logout</a></li>
          </ul>
        </div>
      </div>
    </div>
  </section>

  <?php include "include/navbar.php"; ?>
</body>

</html>