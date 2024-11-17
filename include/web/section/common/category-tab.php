<div class="col-lg-3 col-ms-3 col-sm-2 col-3 col-xs-2 text_maintain">
  <a href="<?php echo DOMAIN; ?>/web/products/?categoryid=<?php echo SECURE($Data->ProCategoriesId, "e"); ?>">
    <div class="category-box">
      <img loading="lazy" src="<?php echo STORAGE_URL; ?>/products/category/<?php echo $Data->ProCategoryImage; ?>" class="category-img lazyload">
      <h4><?php echo $Data->ProCategoryName;  ?></h4>
    </div>
  </a>
</div>