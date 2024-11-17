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
      document.getElementById("orders").classList.add("active");
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
              <h5>My Orders</h5>
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
          <form class="flex-s-b mb-3">
            <input type='search' name='search' class="form-control w-75 mr-1" placeholder="Order ID: #ORDxxxxxx">
            <input type="month" name='date' class="form-control w-50" value='<?php echo date('Y-m'); ?>'>
          </form>
        </div>
      </div>
      <div class="row">
        <div class="col-md-4 col-12 mb-2">
          <div class="app-bg rounded-1 p-2">
            <div class="flex-s-b">
              <div class="w-25 p-1">
                <img src="../storage/img/orders.png">
              </div>
              <div class="w-75 p-1">
                <p class="mb-0 mt-0 text-secondary small">
                  <span class="flex-s-b small">
                    <span>#ORD12879898</span>
                    <span>19 July 2023 12:30 AM</span>
                  </span>
                </p>
                <h6 class="bold mb-0">Chicken leg pieces</h6>
                <p class="small mb-0">
                  <span class="small">
                    <span class="text-black">450 g</span> |
                    <span class="text-secondary mb-1">9-12 pieces</span> |
                    <span class="text-secondary mb-1">4 Serves</span>
                  </span>
                </p>
                <p class="mb-0 mt-0 small">
                  <span class="flex-s-b">
                    <span>
                      <span>Rs.350</span>
                      <span class="text-secondary">x 1</span>
                    </span>
                    <span>
                      <span class="h6 bold">Rs.350</span>
                      <i class="fa fa-angle-right h6"></i>
                    </span>
                  </span>
                </p>
              </div>
            </div>
          </div>
        </div>

        <div class="col-md-4 col-12 mb-2">
          <div class="app-bg rounded-1 p-2">
            <div class="flex-s-b">
              <div class="w-25 p-1">
                <img src="../storage/img/orders.png">
              </div>
              <div class="w-75 p-1">
                <p class="mb-0 mt-0 text-secondary small">
                  <span class="flex-s-b small">
                    <span>#ORD12879898</span>
                    <span>19 July 2023 12:30 AM</span>
                  </span>
                </p>
                <h6 class="bold mb-0">Chicken leg pieces</h6>
                <p class="small mb-0">
                  <span class="small">
                    <span class="text-black">450 g</span> |
                    <span class="text-secondary mb-1">9-12 pieces</span> |
                    <span class="text-secondary mb-1">4 Serves</span>
                  </span>
                </p>
                <p class="mb-0 mt-0 small">
                  <span class="flex-s-b">
                    <span>
                      <span>Rs.350</span>
                      <span class="text-secondary">x 1</span>
                    </span>
                    <span>
                      <span class="h6 bold">Rs.350</span>
                      <i class="fa fa-angle-right h6"></i>
                    </span>
                  </span>
                </p>
              </div>
            </div>
          </div>
        </div>

        <div class="col-md-4 col-12 mb-2">
          <div class="app-bg rounded-1 p-2">
            <div class="flex-s-b">
              <div class="w-25 p-1">
                <img src="../storage/img/orders.png">
              </div>
              <div class="w-75 p-1">
                <p class="mb-0 mt-0 text-secondary small">
                  <span class="flex-s-b small">
                    <span>#ORD12879898</span>
                    <span>19 July 2023 12:30 AM</span>
                  </span>
                </p>
                <h6 class="bold mb-0">Chicken leg pieces</h6>
                <p class="small mb-0">
                  <span class="small">
                    <span class="text-black">450 g</span> |
                    <span class="text-secondary mb-1">9-12 pieces</span> |
                    <span class="text-secondary mb-1">4 Serves</span>
                  </span>
                </p>
                <p class="mb-0 mt-0 small">
                  <span class="flex-s-b">
                    <span>
                      <span>Rs.350</span>
                      <span class="text-secondary">x 1</span>
                    </span>
                    <span>
                      <span class="h6 bold">Rs.350</span>
                      <i class="fa fa-angle-right h6"></i>
                    </span>
                  </span>
                </p>
              </div>
            </div>
          </div>
        </div>

        <div class="col-md-4 col-12 mb-2">
          <div class="app-bg rounded-1 p-2">
            <div class="flex-s-b">
              <div class="w-25 p-1">
                <img src="../storage/img/orders.png">
              </div>
              <div class="w-75 p-1">
                <p class="mb-0 mt-0 text-secondary small">
                  <span class="flex-s-b small">
                    <span>#ORD12879898</span>
                    <span>19 July 2023 12:30 AM</span>
                  </span>
                </p>
                <h6 class="bold mb-0">Chicken leg pieces</h6>
                <p class="small mb-0">
                  <span class="small">
                    <span class="text-black">450 g</span> |
                    <span class="text-secondary mb-1">9-12 pieces</span> |
                    <span class="text-secondary mb-1">4 Serves</span>
                  </span>
                </p>
                <p class="mb-0 mt-0 small">
                  <span class="flex-s-b">
                    <span>
                      <span>Rs.350</span>
                      <span class="text-secondary">x 1</span>
                    </span>
                    <span>
                      <span class="h6 bold">Rs.350</span>
                      <i class="fa fa-angle-right h6"></i>
                    </span>
                  </span>
                </p>
              </div>
            </div>
          </div>
        </div>

        <div class="col-md-4 col-12 mb-2">
          <div class="app-bg rounded-1 p-2">
            <div class="flex-s-b">
              <div class="w-25 p-1">
                <img src="../storage/img/orders.png">
              </div>
              <div class="w-75 p-1">
                <p class="mb-0 mt-0 text-secondary small">
                  <span class="flex-s-b small">
                    <span>#ORD12879898</span>
                    <span>19 July 2023 12:30 AM</span>
                  </span>
                </p>
                <h6 class="bold mb-0">Chicken leg pieces</h6>
                <p class="small mb-0">
                  <span class="small">
                    <span class="text-black">450 g</span> |
                    <span class="text-secondary mb-1">9-12 pieces</span> |
                    <span class="text-secondary mb-1">4 Serves</span>
                  </span>
                </p>
                <p class="mb-0 mt-0 small">
                  <span class="flex-s-b">
                    <span>
                      <span>Rs.350</span>
                      <span class="text-secondary">x 1</span>
                    </span>
                    <span>
                      <span class="h6 bold">Rs.350</span>
                      <i class="fa fa-angle-right h6"></i>
                    </span>
                  </span>
                </p>
              </div>
            </div>
          </div>
        </div>

        <div class="col-md-4 col-12 mb-2">
          <div class="app-bg rounded-1 p-2">
            <div class="flex-s-b">
              <div class="w-25 p-1">
                <img src="../storage/img/orders.png">
              </div>
              <div class="w-75 p-1">
                <p class="mb-0 mt-0 text-secondary small">
                  <span class="flex-s-b small">
                    <span>#ORD12879898</span>
                    <span>19 July 2023 12:30 AM</span>
                  </span>
                </p>
                <h6 class="bold mb-0">Chicken leg pieces</h6>
                <p class="small mb-0">
                  <span class="small">
                    <span class="text-black">450 g</span> |
                    <span class="text-secondary mb-1">9-12 pieces</span> |
                    <span class="text-secondary mb-1">4 Serves</span>
                  </span>
                </p>
                <p class="mb-0 mt-0 small">
                  <span class="flex-s-b">
                    <span>
                      <span>Rs.350</span>
                      <span class="text-secondary">x 1</span>
                    </span>
                    <span>
                      <span class="h6 bold">Rs.350</span>
                      <i class="fa fa-angle-right h6"></i>
                    </span>
                  </span>
                </p>
              </div>
            </div>
          </div>
        </div>

        <div class="col-md-4 col-12 mb-2">
          <div class="app-bg rounded-1 p-2">
            <div class="flex-s-b">
              <div class="w-25 p-1">
                <img src="../storage/img/orders.png">
              </div>
              <div class="w-75 p-1">
                <p class="mb-0 mt-0 text-secondary small">
                  <span class="flex-s-b small">
                    <span>#ORD12879898</span>
                    <span>19 July 2023 12:30 AM</span>
                  </span>
                </p>
                <h6 class="bold mb-0">Chicken leg pieces</h6>
                <p class="small mb-0">
                  <span class="small">
                    <span class="text-black">450 g</span> |
                    <span class="text-secondary mb-1">9-12 pieces</span> |
                    <span class="text-secondary mb-1">4 Serves</span>
                  </span>
                </p>
                <p class="mb-0 mt-0 small">
                  <span class="flex-s-b">
                    <span>
                      <span>Rs.350</span>
                      <span class="text-secondary">x 1</span>
                    </span>
                    <span>
                      <span class="h6 bold">Rs.350</span>
                      <i class="fa fa-angle-right h6"></i>
                    </span>
                  </span>
                </p>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
  </section>

  <?php include "include/navbar.php"; ?>
</body>

</html>