<?php
      $FetchSliders = FetchConvertIntoArray("SELECT * FROM sliders where SliderStatus='1' and SliderType='Website' and SliderLocations='HomePageWebsite' ORDER BY SliderId ASC", true);
      if ($FetchSliders != null) {
       foreach ($FetchSliders as $data) {
        if ($data->SliderOpenAt == "Same Page") {
         $target = "";
        } else {
         $target = "target='_blank'";
        } ?>
        <li>
         <div class="seq-model"><img data-seq src="<?php echo STORAGE_URL; ?>/sliders/<?php echo $data->SliderType; ?>/img/<?php echo $data->SliderImage; ?>" title="<?php echo $data->SliderName; ?>" alt="<?php echo $data->SliderName; ?>"></div>
         <div class="seq-title"><span data-seq><?php echo $data->SliderOfferText; ?></span>
          <h2 data-seq><?php echo $data->SliderName; ?></h2>
          <p data-seq><?php echo SECURE($data->SliderDescriptions, "d"); ?></p>
          <a data-seq href="<?php echo $data->SliderTargetUrl; ?>" <?php echo $target; ?> class="aa-shop-now-btn aa-secondary-btn">SHOP NOW</a>
         </div>
        </li>
      <?php }
      } ?>