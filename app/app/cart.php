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
  <div class='fixed-top'>
    <section class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="flex-start">
            <a href="home.php" class="btn btn-lg mr-3 bold h3 mt-1 back-btn"><i class="fa fa-angle-left"></i></a>
            <div class="page-title">
              <h5>Checkout</h5>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

  <section class="container page-section">
    <div class="row">
      <div class="col-md-12">
        <h5 class="mb-0">Item Details</h5>
        <p class="text-secondary small">purchasing item details are as follows,</p>
      </div>
    </div>

    <div class="row">
      <div class="col-md-4 col-12 mb-2">
        <div class="app-bg rounded-1 p-2">
          <div class="flex-s-b">
            <div class="w-30 p-1">
              <img src="../storage/img/orders.png">
            </div>
            <div class="w-70 p-1 pt-3">
              <a href="" class="btn btn-xs pull-right mt--1"><i class="fa fa-times"></i></a>
              <h6 class="bold mb-0">Chicken leg pieces</h6>
              <p class="small mb-0">
                <span class="small">
                  <span class="text-black">450 g</span> |
                  <span class="text-secondary mb-1">9-12 pieces</span> |
                  <span class="text-secondary mb-1">4 Serves</span>
                </span>
              </p>
              <p class="mb-0 mt-0 small">
                <span class="flex-s-b w-100">
                  <span class="w-50">
                    <span>Rs.350</span>
                    <span class="text-secondary">x 1</span><br>
                    <span class="h4 bold">Rs.350</span>
                  </span>
                  <span class="w-50">
                    <form class='pull-right cart-mt'>
                      <button class="btn btn-sm btn-danger h4 mb-0"><i class="fa fa-minus"></i></button>
                      <span class="btn btn-sm btn-default h4 bold shadow-sm bg-white pl-3 mb-0 pr-3">1</span>
                      <button name='continue' class="btn btn-sm btn-danger h4 mb-0"><i class="fa fa-plus"></i></button>
                    </form>
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
            <div class="w-30 p-1">
              <img src="../storage/img/orders.png">
            </div>
            <div class="w-70 p-1 pt-3">
              <a href="" class="btn btn-xs pull-right mt--1"><i class="fa fa-times"></i></a>
              <h6 class="bold mb-0">Chicken leg pieces</h6>
              <p class="small mb-0">
                <span class="small">
                  <span class="text-black">450 g</span> |
                  <span class="text-secondary mb-1">9-12 pieces</span> |
                  <span class="text-secondary mb-1">4 Serves</span>
                </span>
              </p>
              <p class="mb-0 mt-0 small">
                <span class="flex-s-b w-100">
                  <span class="w-50">
                    <span>Rs.350</span>
                    <span class="text-secondary">x 1</span><br>
                    <span class="h4 bold">Rs.350</span>
                  </span>
                  <span class="w-50">
                    <form class='pull-right cart-mt'>
                      <button class="btn btn-sm btn-danger h4 mb-0"><i class="fa fa-minus"></i></button>
                      <span class="btn btn-sm btn-default h4 bold shadow-sm bg-white pl-3 mb-0 pr-3">1</span>
                      <button name='continue' class="btn btn-sm btn-danger h4 mb-0"><i class="fa fa-plus"></i></button>
                    </form>
                  </span>
                </span>
              </p>
            </div>
          </div>
        </div>
      </div>

    </div>
  </section>

  <section class="container pb-5 mb-5">
    <div class="row">
      <div class="col-md-12 mt-5">
        <h5 class="mb-0">Payment details</h5>
        <p class="text-secondary small mb-0">total, taxes, and net payable</p>
      </div>
      <div class="col-md-12">
        <table class="table">
          <tr>
            <td>Sub-Total</th>
            <th class="text-right">Rs.1150</th>
          </tr>
          <tr>
            <td>Taxes (GST 18%)</th>
            <th class="text-right">Rs.230</th>
          </tr>
          <tr>
            <td>Delivery Charges</th>
            <th class="text-right">Rs.60</th>
          </tr>
          <tr>
            <th class='bold h4'>Net Payable</th>
            <th class="text-right bold text-success h4">Rs.1440</th>
          </tr>

          <tr>
            <th class='h6 text-secondary'>Have Coupons? Enter Coupon Code</th>
            <th class="text-right">
              <input type="text" class="form-control">
            </th>
          </tr>
        </table>
      </div>

      <div class="col-md-12 mt-5 mb-5 pb-5">
        <h5 class="mb-0">Delivery Type</h5>
        <p class="text-secondary small mb-0">select delivery type as per your need.</p>

        <div class="flex-s-b mt-3">
          <div class="w-50 mr-2 text-left">
            <div class="shadow-sm p-2 rounded-1 app-bdr">
              <h6 class="bold mt-1"><i class="fa fa-star fa-spin text-warning"></i> Express</h6>
              <p class="mb-0 small"> Instant delivery in 60 mins</p>
            </div>
          </div>
          <div class="w-75 ml-2 text-left">
            <div class="shadow-sm p-2 rounded-1">
              <h6 class="bold mt-1 mb-1"><i class="fa fa-clock text-warning"></i> Scheduled</h6>
              <div class="mb-0 flex-s-b">
                <div class="w-75 mr-2">
                  <small><i class="fa fa-calendar text-secondary small"></i> Date</small>
                  <input type="date" class="form-control-sm form-control" value='<?php echo date('Y-m-d'); ?>'>
                </div>
                <div class="w-50">
                  <small><i class="fa fa-clock text-secondary small"></i> Time</small>
                  <input type="time" class="form-control-sm form-control" value='<?php echo date('h:i'); ?>'>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
  </section>

  <section class="fixed-bottom">
    <div class="row bg-white">
      <?php if (isset($_GET['delivery_address'])) {
      ?>
        <div class="col-md-12 mb-0 text-left">
          <form action="" class="p-3">
            <input type='hidden' name='address'>
            <h5 class='bold'><i class="fa fa-map-marker text-success"></i> Add Delivery Address:</h5>
            <div class="flex-s-b">
              <div class="form-group w-50 mr-2">
                <label>House no/Flat No</label>
                <input type="text" class="form-control form-control-sm">
              </div>
              <div class="form-group w-50 ml-2">
                <label>Gali/Floor/Apart. No</label>
                <input type="text" class="form-control form-control-sm">
              </div>
            </div>

            <div class="flex-s-b">
              <div class="form-group w-50 mr-2">
                <label>Sector/Area locality</label>
                <input type="text" class="form-control form-control-sm">
              </div>
              <div class="form-group w-50 ml-2">
                <label>Landmark/near by</label>
                <input type="text" class="form-control form-control-sm">
              </div>
            </div>

            <div class="flex-s-b">
              <div class="form-group w-50 mr-2">
                <label>City</label>
                <input type="text" class="form-control form-control-sm">
              </div>
              <div class="form-group w-50 ml-2">
                <label>State</label>
                <input type="text" class="form-control form-control-sm">
              </div>
            </div>

            <div class="flex-s-b">
              <div class="form-group w-50 mr-2">
                <label>Pincode</label>
                <input type="text" class="form-control form-control-sm">
              </div>
              <div class="form-group w-50 ml-2">
                <label>Receiver Name</label>
                <input type="text" class="form-control form-control-sm">
              </div>
            </div>

            <div class="flex-start mt-3">
              <a href="" class="btn btn-md bg-white shadow-sm m-1 app-bdr">Home</a>
              <a href="" class="btn btn-md bg-white shadow-sm m-1 app-bdr">Work</a>
              <a href="" class="btn btn-md bg-white shadow-sm m-1 app-bdr">Other</a>
            </div>

            <div class="w-100 mt-2 text-right">
              <button name='address_confirmed' class="btn btn-sm btn-success text-white"><i class="fa fa-check btn btn-sm text-white"></i> Confirm Address</button>
            </div>
            <hr class="mb-0">
          </form>
        </div>
      <?php
      } ?>
      <?php if (isset($_GET['address'])) { ?>
        <div class="col-md-12 text-left">
          <p class="mb-0 text-left p-2 pr-3">
            <a href="?delivery_address=true" class="text-black">
              <i class="fa fa-map-marker text-success"></i>
              <span class="bold">B-11, Sector 64, Near By SBI, NOIDA-201301.</span>
              <span class="bold pull-right"><i class='fa fa-angle-right'></i></span>
            </a>
          </p>
        </div>
      <?php } ?>
      <?php if (isset($_GET['mode_selected'])) { ?>
        <div class="col-md-12 mb-0">
          <div class="flex-s-b">
            <div class="w-50">
              <a href="?pay_method=Online&mode=ONLINE&address=true" class="btn btn-block btn-md shadow-sm text-info"><i class='fa fa-globe app-text'></i> Pay Online</a>
            </div>
            <div class="w-75 ml-2">
              <a href="?pay_method=Pay on delivery&mode=COD&address=true" class="btn btn-block btn-md shadow-sm text-success"><i class='fa fa-money app-text'></i> Pay on Delivery</a>
            </div>
          </div>
          <p class="text-secondary mt-1 mb-0 small">Rs.10 additional charged in Pay on delivery!.</p>
        </div>
      <?php } ?>
      <div class="col-md-12 bg-white">
        <div class="flex-s-b p-2">
          <div class="w-50 text-left">
            <p class="text-secondary small mb-0">Net Payable <i class="fa fa-angle-down"></i></p>
            <h3 class="bold mt-0">Rs.1440</h3>
          </div>
          <div class="w-50 text-right">
            <?php if (isset($_GET['pay_mode'])) { ?>
              <a href="?pay_mode=true&mode_selected=true&address=true" class="btn btn-sm btn-info text-white mt-2">Pay Method <i class="fa fa-angle-up btn btn-sm text-white"></i></a>
            <?php } elseif (isset($_GET['pay_method'])) { ?>
              <a href="pay.php?mode=<?php echo $_GET['mode']; ?>&address=true" class="btn btn-sm btn-info text-white mt-2"><?php echo $_GET['pay_method']; ?><i class="fa text-white fa-angle-right btn btn-sm"></i></a>
            <?php } elseif (isset($_GET['address_confirmed'])) { ?>
              <a href="?pay_mode=true&mode_selected=true&address=true" class="btn btn-sm btn-info text-white mt-2">Select Pay method <i class="fa fa-angle-down btn btn-sm text-white"></i></a>
            <?php } else { ?>
              <a href="?delivery_address=true" class="btn btn-sm btn-info text-white mt-2">Delivery address <i class="fa fa-plus btn btn-sm text-white"></i></a>
            <?php } ?>
          </div>
        </div>
      </div>
    </div>
  </section>
</body>

</html>