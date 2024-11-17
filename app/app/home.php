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
      document.getElementById("home").classList.add("active");
    }
  </script>
</head>

<body>
  <section class="container">
    <div class="row">
      <div class="col-7 mt-3">
        <div class='user-d'>
          <a>
            <span class="flex-s-b">
              <span class="p-2"><i class="fa fa-user"></i></span>
              <span class="p-2 text-left w-100">
                <span class="sal">Hey,</span><br>
                <span class='name'>Navix Consultancy Services <i class="fa fa-angle-down"></i></span>
              </span>
            </span>
          </a>
        </div>
      </div>
      <div class="col-5 mt-3">
        <div class='user-d'>
          <a>
            <span class="flex-s-b">
              <span class="p-2 text-right w-100">
                <span class="sal">I am at,</span><br>
                <span class='name'>121004 <i class="fa fa-angle-down"></i></span>
              </span>
              <span class="p-2"><i class="fa fa-map-marker text-success"></i></span>
            </span>
          </a>
        </div>
      </div>
    </div>
  </section>

  <section class="container">
    <div class='row'>
      <div class='col-md-12'>
        <form class="mt-3">
          <input type='search' placeholder="Search Chicken, meat, fish, egg...." class='form-control form-control-md'>
        </form>
      </div>
    </div>
  </section>

  <section class="container">
    <div class="row">
      <div class='col-md-12 mt-3'>
        <div class="slider w-100 flex-s-b">
          <img id="sliderImage" onclick="nextSlide()" class='img-fluid w-100 img-bdr' src="" alt="Slider Image">
        </div>
      </div>
    </div>
  </section>

  <section class='container mb-2'>
    <div class='row'>
      <div class='col-md-12 text-left mt-4 mb-3'>
        <h4 class='mb-0'>Shop by categories</h4>
        <small class='mt-0 text-secondary mb-3 small'><span class='small'>Fresh meat and much more</span></small>
      </div>
    </div>

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

  <section class='container'>
    <div class='row'>
      <div class='col-md-12 text-left mt-2 mb-3'>
        <h4 class='mb-0'>Trending Items</h4>
        <small class='mt-0 text-secondary mb-3 small'><span class='small'>most popular items near by you</span></small>
      </div>
    </div>

    <div class='row'>
      <div class="col-md-12">
        <div class="trending-item">
          <div class='item'>
            <div class='w-100 bx-sh p-1'>
              <img src='../storage/products/product1.webp' class='img-fluid w-100'>
              <div class='p-1'>
                <h6 class="app-text">Chicken leg pieces</h6>
                <p>
                  <span class="text-secondary">2 pieces</span>
                </p>
                <form class='pull-right'>
                  <button class="btn btn-sm btn-danger"><i class='fa fa-plus'></i></button>
                </form>
                <a class='price'>Rs.250 <span class='mrp'>Rs.290</span></a>
              </div>
            </div>
          </div>

          <div class='item'>
            <div class='w-100 bx-sh p-1'>
              <img src='../storage/products/product2.jpg' class='img-fluid w-100'>
              <div class='p-1'>
                <h6 class="app-text">Bone less chicken</h6>
                <p>
                  <span class="text-secondary">500 g</span>
                </p>
                <form class='pull-right'>
                  <button class="btn btn-sm btn-danger"><i class='fa fa-plus'></i></button>
                </form>
                <a class='price'>Rs.149 <span class='mrp'>Rs.189</span></a>
              </div>
            </div>
          </div>

          <div class='item'>
            <div class='w-100 bx-sh p-1'>
              <img src='../storage/products/product3.webp' class='img-fluid w-100'>
              <div class='p-1'>
                <h6 class="app-text">Mutton without bones</h6>
                <p>
                  <span class="text-secondary">250 g</span>
                </p>
                <form class='pull-right'>
                  <button class="btn btn-sm btn-danger"><i class='fa fa-plus'></i></button>
                </form>
                <a class='price'>Rs.279 <span class='mrp'>Rs.349</span></a>
              </div>
            </div>
          </div>

          <div class='item'>
            <div class='w-100 bx-sh p-1'>
              <img src='../storage/products/product4.jpg' class='img-fluid w-100'>
              <div class='p-1'>
                <h6 class="app-text">Fish for frying</h6>
                <p>
                  <span class="text-secondary">750 g</span>
                </p>
                <form class='pull-right'>
                  <button class="btn btn-sm btn-danger"><i class='fa fa-plus'></i></button>
                </form>
                <a class='price'>Rs.450 <span class='mrp'>Rs.560</span></a>
              </div>
            </div>
          </div>


        </div>
      </div>
    </div>
  </section>




  <script>
    var images = [
      "../storage/slider/1.jpeg",
      "../storage/slider/2.jpeg",
      "../storage/slider/3.jpeg",
    ];
    var currentSlide = 0;

    function showSlide() {
      var sliderImage = document.getElementById("sliderImage");
      sliderImage.src = images[currentSlide];
    }

    function prevSlide() {
      currentSlide--;
      if (currentSlide < 0) {
        currentSlide = images.length - 1;
      }
      showSlide();
    }

    function nextSlide() {
      currentSlide++;
      if (currentSlide >= images.length) {
        currentSlide = 0;
      }
      showSlide();
    }

    showSlide();
  </script>
  <?php include "include/navbar.php"; ?>
</body>

</html>