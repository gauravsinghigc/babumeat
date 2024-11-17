<?php
include "../config.php";

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
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.2.1/css/fontawesome.min.css" integrity="sha384-QYIZto+st3yW+o8+5OHfT6S482Zsvz2WfOzpFSXMF9zqeLcFV0/wlZpMtyFcZALm" crossorigin="anonymous">
  <script>
    window.onload = function() {
      document.getElementById("shop").classList.add("active");
    }
  </script>
</head>

<body>
  <?php if (isset($_GET['mode'])) {
    if ($_GET['mode'] == "ONLINE") { ?>
      <div class="fixed-bottom bg-white mb-5">
        <div class="row">
          <div class="col-md-12 text-center">
            <img src="https://cdn.dribbble.com/users/374833/screenshots/1843957/loader.gif" class='w-100'>
          </div>
          <div class="col-md-12 text-center">
            Please wait! processing online payment...
            <br><br><br>
            <a href="orders.php" class="btn btn-md btn-success text-white">Order Placed <i class="fa fa-check btn btn-md text-white"></i></a>
          </div>
        </div>
      </div>
    <?php } elseif ($_GET['mode'] == "COD") { ?>
      <div class="fixed-bottom bg-white mb-5">
        <div class="row">
          <div class="col-md-12 text-center">
            <img src="https://media0.giphy.com/media/v1.Y2lkPTc5MGI3NjExaGo4ZXFiNGR4cXRyNnZ3bmxleTA2NmI4djR4YnRxb2ExOTNkNmR0MSZlcD12MV9naWZzX3NlYXJjaCZjdD1n/etKSrsbbKbqwW6vzOg/giphy.gif" class='w-50'>
          </div>
          <div class="col-md-12 text-center">
            <h2 class="mt-4">Order Placed!</h2>
            <p>Thanking you for placing an order with us!</p>
            <p>Your order is on the way and reach at you shortly!</p>
            <a href="orders.php" class="btn btn-md btn-success text-white">View Order Details <i class="fa fa-angle-right btn btn-md text-white"></i></a>
          </div>
        </div>
      </div>
  <?php } else {
      header("location: cart.php");
    }
  } else {
    header("location: cart.php");
  } ?>
</body>

</html>