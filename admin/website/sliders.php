<?php
$FetchSliders = FetchConvertIntoArray("SELECT * FROM sliders ORDER BY SliderId ASC", true);
if ($FetchSliders != null) {
  foreach ($FetchSliders as $data) { ?>
    <div class="col-lg-3 col-md-3 col-sm-6 col-12">
      <div class="shadow-lg br10 p-1">
        <img src="<?php echo STORAGE_URL; ?>/sliders/<?php echo $data->SliderType; ?>/img/<?php echo $data->SliderImage; ?>" title="<?php echo $data->SliderName; ?>" alt="<?php echo $data->SliderName; ?>" class="w-100 br10 slider-admin-view">
        <div class="p-1">
          <h5 class="m-t-3 m-b-3 fs-14"><?php echo StatusView($data->SliderStatus); ?> <?php echo $data->SliderName; ?></h5>
          <p class="lh-1-2 fs-12">
            <span class="text-grey">Offer Text:</span> <?php echo $data->SliderOfferText; ?><br>
            <span class="text-grey">Slider Type:</span> <?php echo $data->SliderType; ?> Slider<br>
            <span class="text-grey">Location: </span> <?php echo $data->SliderLocations; ?><br>
            <span class="flex-s-b">
              <span><span class="text-grey">Open At:</span> <?php echo $data->SliderOpenAt; ?></span>
              <span><span class="text-grey">View Url:</span> <a href=" <?php echo $data->SliderTargetUrl; ?>" target="_blank" class="text-primary">View</a></span>
            </span>
            <span><span class="text-grey">Description:</span> <?php echo SECURE($data->SliderDescriptions, "d"); ?></span>
            <span class="flex-s-b">
              <span><span class="text-grey">CreatedAt: </span> <?php echo $data->SliderCreatedAt; ?></span>
              <span><span class="text-grey"></span> <?php echo ReturnValue($data->SliderUpdatedAt); ?></span>
            </span>
          </p>
          <div class="flex-s-b">
            <a href="edit-slider.php?viewid=<?php echo SECURE($data->SliderId, "e"); ?>" class="btn btn-info btn-sm">Edit</a>
            <a href="<?php echo DOMAIN; ?>/controller/slidercontroller.php?delete_sliders=<?php echo SECURE(true, "e"); ?>&access_url=<?php echo SECURE(RUNNING_URL, "e"); ?>&control_id=<?php echo SECURE($data->SliderId, "e"); ?>" class="btn btn-danger btn-sm">Delete</a>
          </div>
        </div>
      </div>
    </div>
<?php   }
} ?>