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
      document.getElementById("shop").classList.add("active");
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
              <h5>Shop by Categories</h5>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

  <section class='container mb-2 page-section'>
    <div class='row'>
      <div class="col-xs-4 col-4 text-center col-sm-4 mb-4">
        <a href="list.php">
          <div class="w-100 bx-sh p-1">
            <img src="../storage/cats/chicken.webp" class="img-fluid img-bdr">
            <a href="" class='cat-name'>Chicken</a>
          </div>
        </a>
      </div>

      <div class="col-xs-4 col-4 text-center col-sm-4 mb-4">
        <div class="w-100 bx-sh p-1">
          <img src="../storage/cats/mutton.jpg" class="img-fluid img-bdr">
          <a href="" class='cat-name'>Mutton</a>
        </div>
      </div>

      <div class="col-xs-4 col-4 text-center col-sm-4 mb-4">
        <div class="w-100 bx-sh p-1">
          <img src="../storage/cats/sea-food.jpg" class="img-fluid img-bdr">
          <a href="" class='cat-name'>Sea Foods</a>
        </div>
      </div>

      <div class="col-xs-4 col-4 text-center col-sm-4 mb-4">
        <div class="w-100 bx-sh p-1">
          <img src="../storage/cats/prawns.jpg" class="img-fluid img-bdr">
          <a href="" class='cat-name'>Prawns</a>
        </div>
      </div>

      <div class="col-xs-4 col-4 text-center col-sm-4 mb-4">
        <div class="w-100 bx-sh p-1">
          <img src="../storage/cats/eggs.webp" class="img-fluid img-bdr">
          <a href="" class='cat-name'>Eggs</a>
        </div>
      </div>

      <div class="col-xs-4 col-4 text-center col-sm-4 mb-4">
        <div class="w-100 bx-sh p-1">
          <img src="../storage/cats/kababs.webp" class="img-fluid img-bdr">
          <a href="" class='cat-name'>Kababs</a>
        </div>
      </div>
      <div class="col-xs-4 col-4 text-center col-sm-4 mb-4">
        <div class="w-100 bx-sh p-1">
          <img src="../storage/cats/meat-masala.png" class="img-fluid img-bdr">
          <a href="" class='cat-name'>Spices</a>
        </div>
      </div>
    </div>
  </section>


  <?php include "include/navbar.php"; ?>
</body>

</html>