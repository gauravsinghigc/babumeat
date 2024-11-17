<?php
//require modules;
require '../../require/modules.php';
require '../../require/web-modules.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>Collection of <?php echo APP_NAME; ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=0.9">
  <meta charset="utf-8">
  <meta name="keywords" content="" />
  <script>
    addEventListener("load", function() {
      setTimeout(hideURLbar, 0);
    }, false);

    function hideURLbar() {
      window.scrollTo(0, 1);
    }
  </script>
  <?php include '../../include/web/header_files.php'; ?>
  <script>
    window.onload = function() {
      document.getElementById("shop").classList.add("active");
    }
  </script>
</head>

<body>
  <?php if (DEVICE_TYPE == "Computer") { ?>
    <div class="banner-top container-fluid" id="home">
      <?php
      include '../../include/web/header.php';
      ?>
    </div>
    <section class="banner-bottom-wthreelayouts">
      <div class="container">
        <div class="col-md-12">
          <div class="page-heading ml-0">
            <h3 class="text-center">Collection of <?php echo APP_NAME; ?></h3>
            <p class="text-center"><?php echo APP_NAME; ?> have a large number of food Items & Collections.</p>
          </div>
        </div>
        <div class="inner-sec-shop px-lg-4 px-3">
          <div class="row">
            <?php
            $FetchCategories = FetchConvertIntoArray("SELECT * FROM pro_categories where ProCategoryStatus='1' ORDER BY ProCategoriesId DESC", true);
            if ($FetchCategories !=  null) {
              foreach ($FetchCategories as $Data) {
                include '../../include/web/section/common/category-tab.php';
              }
            } ?>
          </div>
        </div>
      </div>
    </section>
    <!-- about -->


    <?php include '../../include/web/footer.php'; ?>

    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">

            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body text-center p-5 mx-auto mw-100">
            <h6>Join our newsletter and get</h6>
            <h3>50% Off for your first Pair of Eye wear</h3>
            <div class="login newsletter">
              <form action="#" method="post">
                <div class="form-group">
                  <label class="mb-2">Email address</label>
                  <input type="email" class="form-control" id="exampleInputEmail2" aria-describedby="emailHelp" placeholder="" required="">
                </div>
                <button type="submit" class="btn btn-primary submit mb-4">Get 50% Off</button>
              </form>
              <p class="text-center">
                <a href="#">No thanks I want to pay full Price</a>
              </p>
            </div>
          </div>

        </div>
      </div>
    </div>

    <script>
      $(document).ready(function() {
        $("#myModal").modal();
      });
    </script>
    <!-- // modal -->
    <?php include '../../include/web/footer_files.php'; ?>
  <?php } else { ?>
    <div class='fixed-top'>
      <section class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="flex-start">
              <a href="<?php echo WEB_URL; ?>" class="btn btn-lg mr-3 bold h3 mt-1 back-btn"><i class="fa fa-angle-left"></i></a>
              <div class="page-title">
                <h5>Shop By Categories</h5>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>

    <div class="container">
      <div class='row mt-5 pt-5'>
        <?php
        $FetchCategories = FetchConvertIntoArray("SELECT * FROM pro_categories where ProCategoryStatus='1' ORDER BY ProCategoriesId DESC Limit 0, 8", true);
        if ($FetchCategories !=  null) {
          foreach ($FetchCategories as $Data) {
        ?>
            <div class="col-xs-4 col-4 text-center col-sm-4 mb-4">
              <a href="<?php echo DOMAIN; ?>/web/products/?categoryid=<?php echo SECURE($Data->ProCategoriesId, "e"); ?>">
                <div class="w-100 p-1">
                  <img loading="lazy" src="<?php echo STORAGE_URL; ?>/products/category/<?php echo $Data->ProCategoryImage; ?>" class="img-fluid img-bdr">
                  <a class='cat-name'><?php echo $Data->ProCategoryName;  ?></a>
                </div>
              </a>
            </div>
        <?php
          }
        } ?>
      </div>
    </div>
  <?php
    include "../../include/web/header.php";
  } ?>

</body>

</html>