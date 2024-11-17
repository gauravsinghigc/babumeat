<?php
//require modules;
require '../../require/modules.php';
require '../../require/web-modules.php';

//page variable and activity
if (isset($_GET['categoryid'])) {
  $ProCategoriesId = SECURE($_GET['categoryid'], "d");
  $PageName = FETCH("SELECT * FROM pro_categories where ProCategoriesId='$ProCategoriesId'", "ProCategoryName");
  $Pagesubname = "Wallpaper Collection of $PageName by " . APP_NAME;
} elseif (isset($_GET['subcategoryid'])) {
  $ProSubCategoriesId = SECURE($_GET['subcategoryid'], "d");
  $PageName = FETCH("SELECT * FROM pro_sub_categories where ProSubCategoriesId='$ProSubCategoriesId'", "ProSubCategoryName");
  $Pagesubname = "Wallpaper Collection of $PageName by " . APP_NAME;
} else {
  $PageName = "All WallPapers";
  $Pagesubname = "Wallpaper Collection of " . APP_NAME;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title><?php echo $PageName; ?> By <?php echo APP_NAME; ?></title>
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
</head>

<body>
  <div class="banner-top container-fluid" id="home">
    <?php
    include '../../include/web/header.php';
    ?>
  </div>
  <section class="banner-bottom-wthreelayouts">
    <div class="container-fluid">
      <div class="col-md-12">
        <div class="page-heading">
          <h3 class="tittle-w3layouts text-center"><?php echo $PageName; ?></h3>
          <p><?php echo $Pagesubname; ?></p>
        </div>
      </div>
    </div>
    <div class="container">
      <div class="inner-sec-shop px-lg-4 px-3">
        <div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12 col-12 text-center pb-3">
            <form class="w-25 d-flex mx-auto">
              <select class="form-control" name="sortby" onchange="form.submit()">
                <option value="">Sort By</option>
                <?php SuggestOptions(
                  [
                    "Relevance" => "Relevance",
                    "LatestFirst" => "Newly Uploaded",
                    "NameASC" => "By Name ASC",
                    "NameDESC" => "By Name DESC",
                    "PriceHighToLow" => "Price High to Low",
                    "PriceLowToHigh" => "Price Low to High",
                  ]
                ); ?>
              </select>
            </form>
          </div>
        </div>

        <div class="row">
          <?php
          $FetchWallPapers = FetchConvertIntoArray("SELECT * FROM wallpapers ORDER BY WallPapersId DESC", true);
          if ($FetchWallPapers != null) {
            foreach ($FetchWallPapers as $WallPaper) {
              $WallPaperImageFile = FETCH("SELECT * FROM wallpaper_images where  WallPaperMainId='" . $WallPaper->WallPapersId . "'", "WallPaperImageFile"); ?>
              <div class="col-md-3 col-lg-3 col-sm-6 col-xs-6 col-6">
                <div class="wallpaper-list-tab">
                  <a href="details/?wallpaperid=<?php echo SECURE($WallPaper->WallPapersId, "e"); ?>">
                    <img src="<?php echo STORAGE_URL; ?>/wallpapers/pro-img/<?php echo $WallPaper->WallPapersId; ?>/<?php echo $WallPaperImageFile; ?>" loading="lazy">
                    <?php
                    tags(
                      "h5",
                      $WallPaper->WallPaperName,
                      [
                        "class" => "bold"
                      ]
                    );
                    tags(
                      "p",
                      "" . FETCH("SELECT * FROM wallpaper_category where WallPaperCategoryId='" . $WallPaper->WallPaperCategoryId . "'", "WallPaperCategoryName") . "",
                      [
                        "class" => "text-grey"
                      ]
                    );
                    Price($WallPaper->WallPaperStartPrice, "text-danger h4");
                    ?>
                  </a>
                </div>
              </div>
          <?php }
          } ?>
        </div>
      </div>
    </div>
  </section>
  <!-- about -->


  <?php include '../../include/web/footer.php'; ?>
  <script>
    (function() {

      var parent = document.querySelector(".price-slider");
      if (!parent) return;

      var
        rangeS = parent.querySelectorAll("input[type=range]"),
        numberS = parent.querySelectorAll("input[type=number]");

      rangeS.forEach(function(el) {
        el.oninput = function() {
          var slide1 = parseFloat(rangeS[0].value),
            slide2 = parseFloat(rangeS[1].value);

          if (slide1 > slide2) {
            [slide1, slide2] = [slide2, slide1];
          }

          numberS[0].value = slide1;
          numberS[1].value = slide2;

          document.getElementById("from").innerHTML = "Rs." + slide1;
          document.getElementById("to").innerHTML = "Rs." + slide2;
        }
      });

      numberS.forEach(function(el) {
        el.oninput = function() {
          var number1 = parseFloat(numberS[0].value),
            number2 = parseFloat(numberS[1].value);

          if (number1 > number2) {
            var tmp = number1;
            numberS[0].value = number2;
            numberS[1].value = tmp;

            document.getElementById("from").innerHTML = "Rs." + number2;
            document.getElementById("to").innerHTML = "Rs." + number1;
          }

          rangeS[0].value = number1;
          rangeS[1].value = number2;

          document.getElementById("from").innerHTML = "Rs." + number1;
          document.getElementById("to").innerHTML = "Rs." + number2;

        }
      });

    })();
  </script>
  <script src="<?php echo ASSETS_URL; ?>/web/js/jquery-ui.js"></script>
  <?php include '../../include/web/footer_files.php'; ?>

</body>

</html>