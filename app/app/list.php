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
          <div class="flex-s-b">
            <div class="flex-start">
              <div class="page-title" onclick="MoreAction('BrowseCategories')">
                <h5 id='iconBtn'>
                  <img src="../storage/cats/chicken.webp">
                  Chicken <i class='fa fa-angle-down ml-1'></i>
                </h5>
              </div>
            </div>
            <div class="search-icon">
              <a href="" class="btn btn-md"><i class="fa fa-search"></i></a>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

  <section class="container mt-5">
    <div class="row">
      <div class="col-md-12 mt-4 pt-2 pb-2">
        <div class="cat-list">

          <div class="item">
            <img src="../storage/sub-cats/chicken.jpg">
            <p>All </p>
          </div>

          <div class="item">
            <img src="../storage/sub-cats/legs.webp">
            <p>Leg Pieces</p>
          </div>

          <div class="item">
            <img src="../storage/sub-cats/bone.webp">
            <p>Bone Less</p>
          </div>

          <div class="item">
            <img src="../storage/sub-cats/wings.jpg">
            <p>Chicken Wings</p>
          </div>

          <div class="item">
            <img src="../storage/sub-cats/curry.webp">
            <p>Curry Cuts</p>
          </div>

          <div class="item">
            <img src="../storage/sub-cats/curry.webp">
            <p>Curry Cuts</p>
          </div>

          <div class="item">
            <img src="../storage/sub-cats/curry.webp">
            <p>Curry Cuts</p>
          </div>

        </div>
      </div>
    </div>
  </section>


  <section class="container app-bg pb-5">
    <div class="row">
      <div class="col-md-12">
        <div class="flex-s-b">
          <h5 class="pt-1 mt-1"><b>40</b> items found!</h5>
          <a class="btn btn-md btn-default bg-white rounded text-black bold"><i class="fa fa-filter text-danger"></i> Filters</a>
        </div>
      </div>
    </div>

    <div class="row mt-3">
      <div class="col-md-4 col-12 mb-3">
        <a href="pro-details.php">
          <div class="shadow-sm bg-white p-2 rounded-1">
            <img src='../storage/products/product1.webp' class='img-fluid w-100'>
            <div class='p-1'>
              <h5 class="text-black bold mt-2 mb-0">Chicken leg pieces</h5>
              <p class="text-secondary small mt-0 mb-2"> fresh chicken leg pieces.</p>
              <form class='pull-right'>
                <button class="btn btn-sm btn-danger">ADD <i class='fa fa-plus btn-sm btn text-white'></i></button>
              </form>
              <p class="mb-1 small">
                <span class="text-black">450 g</span> |
                <span class="text-secondary mb-1">9-12 pieces</span> |
                <span class="text-secondary mb-1">4 Serves</span>
              </p>

              <p>
                <span class="bold app-text h5 mr-1">Rs.349</span>
                <strike class='text-secondary mr-1'>Rs.290</strike>
                <span class="text-success">10% Off</span>
              </p>
            </div>
          </div>
        </a>
      </div>

      <div class="col-md-4 col-12 mb-3">
        <a href="pro-details.php">
          <div class="shadow-sm bg-white p-2 rounded-1">
            <img src='../storage/products/product1.webp' class='img-fluid w-100'>
            <div class='p-1'>
              <h5 class="text-black bold mt-2 mb-0">Chicken leg pieces</h5>
              <p class="text-secondary small mt-0 mb-2"> fresh chicken leg pieces.</p>
              <form class='pull-right'>
                <button class="btn btn-sm btn-danger">ADD <i class='fa fa-plus btn-sm btn text-white'></i></button>
              </form>
              <p class="mb-1 small">
                <span class="text-black">450 g</span> |
                <span class="text-secondary mb-1">9-12 pieces</span> |
                <span class="text-secondary mb-1">4 Serves</span>
              </p>

              <p>
                <span class="bold app-text h5 mr-1">Rs.349</span>
                <strike class='text-secondary mr-1'>Rs.290</strike>
                <span class="text-success">10% Off</span>
              </p>
            </div>
          </div>
        </a>
      </div>

      <div class="col-md-4 col-12 mb-3">
        <a href="pro-details.php">
          <div class="shadow-sm bg-white p-2 rounded-1">
            <img src='../storage/products/product1.webp' class='img-fluid w-100'>
            <div class='p-1'>
              <h5 class="text-black bold mt-2 mb-0">Chicken leg pieces</h5>
              <p class="text-secondary small mt-0 mb-2"> fresh chicken leg pieces.</p>
              <form class='pull-right'>
                <button class="btn btn-sm btn-danger">ADD <i class='fa fa-plus btn-sm btn text-white'></i></button>
              </form>
              <p class="mb-1 small">
                <span class="text-black">450 g</span> |
                <span class="text-secondary mb-1">9-12 pieces</span> |
                <span class="text-secondary mb-1">4 Serves</span>
              </p>

              <p>
                <span class="bold app-text h5 mr-1">Rs.349</span>
                <strike class='text-secondary mr-1'>Rs.290</strike>
                <span class="text-success">10% Off</span>
              </p>
            </div>
          </div>
        </a>
      </div>

      <div class="col-md-4 col-12 mb-3">
        <a href="pro-details.php">
          <div class="shadow-sm bg-white p-2 rounded-1">
            <img src='../storage/products/product1.webp' class='img-fluid w-100'>
            <div class='p-1'>
              <h5 class="text-black bold mt-2 mb-0">Chicken leg pieces</h5>
              <p class="text-secondary small mt-0 mb-2"> fresh chicken leg pieces.</p>
              <form class='pull-right'>
                <button class="btn btn-sm btn-danger">ADD <i class='fa fa-plus btn-sm btn text-white'></i></button>
              </form>
              <p class="mb-1 small">
                <span class="text-black">450 g</span> |
                <span class="text-secondary mb-1">9-12 pieces</span> |
                <span class="text-secondary mb-1">4 Serves</span>
              </p>

              <p>
                <span class="bold app-text h5 mr-1">Rs.349</span>
                <strike class='text-secondary mr-1'>Rs.290</strike>
                <span class="text-success">10% Off</span>
              </p>
            </div>
          </div>
        </a>
      </div>

      <div class="col-md-4 col-12 mb-3">
        <a href="pro-details.php">
          <div class="shadow-sm bg-white p-2 rounded-1">
            <img src='../storage/products/product1.webp' class='img-fluid w-100'>
            <div class='p-1'>
              <h5 class="text-black bold mt-2 mb-0">Chicken leg pieces</h5>
              <p class="text-secondary small mt-0 mb-2"> fresh chicken leg pieces.</p>
              <form class='pull-right'>
                <button class="btn btn-sm btn-danger">ADD <i class='fa fa-plus btn-sm btn text-white'></i></button>
              </form>
              <p class="mb-1 small">
                <span class="text-black">450 g</span> |
                <span class="text-secondary mb-1">9-12 pieces</span> |
                <span class="text-secondary mb-1">4 Serves</span>
              </p>

              <p>
                <span class="bold app-text h5 mr-1">Rs.349</span>
                <strike class='text-secondary mr-1'>Rs.290</strike>
                <span class="text-success">10% Off</span>
              </p>
            </div>
          </div>
        </a>
      </div>

      <div class="col-md-4 col-12 mb-3">
        <a href="pro-details.php">
          <div class="shadow-sm bg-white p-2 rounded-1">
            <img src='../storage/products/product1.webp' class='img-fluid w-100'>
            <div class='p-1'>
              <h5 class="text-black bold mt-2 mb-0">Chicken leg pieces</h5>
              <p class="text-secondary small mt-0 mb-2"> fresh chicken leg pieces.</p>
              <form class='pull-right'>
                <button class="btn btn-sm btn-danger">ADD <i class='fa fa-plus btn-sm btn text-white'></i></button>
              </form>
              <p class="mb-1 small">
                <span class="text-black">450 g</span> |
                <span class="text-secondary mb-1">9-12 pieces</span> |
                <span class="text-secondary mb-1">4 Serves</span>
              </p>

              <p>
                <span class="bold app-text h5 mr-1">Rs.349</span>
                <strike class='text-secondary mr-1'>Rs.290</strike>
                <span class="text-success">10% Off</span>
              </p>
            </div>
          </div>
        </a>
      </div>
  </section>


  <div class='shadow-sm rounded-1 mt-6 fixed-top bg-white height-60 hidden' id='BrowseCategories'>
    <section class='container mb-2 mt-3'>
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
  </div>

  <?php include "include/navbar.php"; ?>

  <script>
    function MoreAction(data) {
      var Data = document.getElementById(data);

      if (Data.style.display == "block") {
        Data.style.display = "none";
      } else {
        Data.style.display = "block";
      }
    }

    document.getElementById("iconBtn").addEventListener("click", function() {
      var iconElement = this.querySelector("i");
      if (iconElement.classList.contains("fa-angle-down")) {
        iconElement.classList.remove("fa-angle-down");
        iconElement.classList.add("fa-angle-up");
      } else {
        iconElement.classList.remove("fa-angle-up");
        iconElement.classList.add("fa-angle-down");
      }
    });
  </script>
</body>

</html>