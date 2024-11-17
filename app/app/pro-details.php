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

  <div class="slider w-100 flex-s-b">
    <img id="sliderImage" onclick="nextSlide()" class='img-fluid w-100 no-round img-bdr ' src="" alt="Slider Image">
  </div>


  <section class="container">
    <div class="row">
      <div class="col-md-12">
        <h5 class="pt-4 bold">Chicken leg pieces - Large peices</h5>
        <p class="text-secondary">best quality and fresh chicken leg pieces.</p>
        <p class="flex-s-b">
          <span class="btn btn-sm app-bg"><i class='fa fa-analytics'></i> 300 G</span>
          <span class="btn btn-sm app-bg"><i class='fa fa-analytics'></i> 9-12 Pieces</span>
          <span class="btn btn-sm app-bg"><i class='fa fa-analytics'></i> 4 Serving</span>
        </p>
        <p class="small">
          <i class='fa fa-check text-danger'></i> Gauranteed Freshness <br>
          <i class='fa fa-check text-danger'></i> Quality non-veg food provider
        </p>
      </div>

      <div class="col-md-12">
        <div class="bg-white">
          <div class="flex-s-b">
            <div>
              <p class="mb-0">
                <span class="bold app-text h4 mr-1">Rs.349</span>
                <strike class='text-secondary mr-1'>Rs.490</strike>
                <span class="text-success">10% Off</span>
              </p>
            </div>
            <div>
              <?php if (isset($_GET['continue'])) {
              ?>
                <form class='pull-right'>
                  <button class="btn btn-sm btn-danger h4"><i class="fa fa-minus"></i></button>
                  <span class="btn btn-sm btn-default h4 bold shadow-sm pl-3 pr-3">1</span>
                  <button name='continue' class="btn btn-sm btn-danger h4"><i class="fa fa-plus"></i></button>
                </form>
              <?php
              } else {
              ?>
                <form class='pull-right'>
                  <button name="continue" class="btn btn-sm btn-danger h4 mb-0">ADD <i class='fa fa-plus btn-md btn text-white'></i></button>
                </form>
              <?php
              } ?>
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-12">
        <h5 class="bold small mt-3">More Info:</h5>
        <hr>
      </div>
      <div class="pro-intro">
        <h2>Introduction:</h2>
        <p>Chicken leg piece, also known as chicken drumstick, is one of the most popular and widely consumed parts of the chicken. It is a flavorful and versatile cut that can be prepared in various ways, making it a favorite among meat lovers. Whether grilled, fried, roasted, or stewed, chicken leg pieces offer a delicious and satisfying eating experience.</p>

        <h2>Quality of Chicken Leg Piece:</h2>
        <p>The quality of chicken leg pieces largely depends on the source and how the chickens are raised and processed. When choosing chicken leg pieces, it is essential to look for the following qualities:</p>
        <ul>
          <li>Freshness: Opt for fresh chicken leg pieces that have a bright, pinkish color and a clean smell. Avoid those with a sour or off odor, as it may indicate spoilage.</li>
          <li>Texture: Quality chicken leg pieces should have a firm and plump texture. Avoid pieces that appear slimy or overly soft.</li>
          <li>Appearance: Look for leg pieces with smooth and intact skin, free from bruises or discolorations.</li>
          <li>Safety: Ensure that the chicken has been properly handled and stored to reduce the risk of foodborne illnesses.</li>
        </ul>

        <h2>Benefits of Chicken Leg Piece:</h2>
        <p>Chicken leg pieces offer several benefits:</p>
        <ul>
          <li>Nutrient-Rich: Chicken leg pieces provide essential nutrients like protein, vitamins (B6, B12), and minerals (selenium, phosphorus). Protein is vital for muscle growth and repair, while B vitamins play a crucial role in metabolism and overall health.</li>
          <li>Flavorful: Chicken leg pieces contain more fat and connective tissue than other cuts, which contributes to their rich flavor and juiciness when cooked. The bone-in and skin-on aspects add extra taste and texture to various dishes.</li>
          <li>Versatility: Chicken leg pieces can be cooked in numerous ways, such as grilling, frying, baking, stewing, or slow-cooking. Their versatility allows for a wide range of recipes and flavor combinations.</li>
          <li>Satiety: Due to their higher fat content and presence of protein, chicken leg pieces can provide a satisfying and filling meal, helping to curb hunger and prevent overeating.</li>
          <li>Affordable: Compared to some other cuts of chicken, leg pieces are often more affordable, making them a budget-friendly option for individuals and families.</li>
          <li>Culinary Applications: The dark meat of chicken leg pieces tends to stay moist and tender during cooking, making them ideal for recipes that require longer cooking times, like stews and braises.</li>
          <li>Bone Broth: The bones and cartilage in chicken leg pieces can be used to make nutritious and flavorful bone broth, which is a great base for soups and sauces.</li>
        </ul>

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