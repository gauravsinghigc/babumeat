<div class="col-lg-3 col-md-3 col-sm-12 col-12 product-men women_two">
 <a href="<?php echo DOMAIN; ?>/web/products/details/?productid=<?php echo SECURE($ProductId, "e"); ?>">
  <div class="product-googles-info googles">
   <div class="men-pro-item">
    <div class="men-thumb-item">
     <a href="<?php echo DOMAIN; ?>/web/products/details/?productid=<?php echo SECURE($ProductId, "e"); ?>">
      <img loading="lazy" onmouseout="ChangeImage_<?php echo $ProductId; ?>()" onmouseenter="ChangeImage_<?php echo $ProductId; ?>()" id="secimg_<?php echo $ProductId; ?>" src="<?php echo STORAGE_URL; ?>/products/pro-img/<?php echo $ProductImage; ?>" alt="<?php echo $ProductName; ?>" title="<?php echo $ProductName; ?>" class=" img-fluid" alt="">
      <script>
       function ChangeImage_<?php echo $ProductId; ?>() {
        var img_<?php echo $ProductId; ?> = document.getElementById("secimg_<?php echo $ProductId; ?>");
        if (img_<?php echo $ProductId; ?>.src ==
         "<?php echo STORAGE_URL; ?>/products/pro-img/<?php echo $ProductImage; ?>") {
         img_<?php echo $ProductId; ?>.src = "<?php echo STORAGE_URL; ?>/products/pro-img/<?php echo $ProductImage2; ?>";
        } else {
         img_<?php echo $ProductId; ?>.src = "<?php echo STORAGE_URL; ?>/products/pro-img/<?php echo $ProductImage; ?>";
        }
       }
      </script>
     </a>
     <span class="product-new-top">New</span>
    </div>
    <div class="item-info-product">
     <div class="info-product-price">
      <div class="grid_meta">
       <div class="product_price">
        <h4 class="mt-2">
         <a href="<?php echo DOMAIN; ?>/web/products/details/?productid=<?php echo SECURE($ProductId, "e"); ?>"><?php echo $ProductName; ?></a><br>
         <span class="category-name"><?php echo $ProCategoryName; ?></span>
        </h4>
        <div class="grid-price mt-2">
         <span class="money">
          <?php
          $ProductSellPrice = FETCH("SELECT MIN(ProOptionCharges) AS ProOptionCharges FROM pro_options where ProOptionProductId='$ProductId' and ProOptionCharges!='0'", "ProOptionCharges");
          echo RequestPrice($ProductSellPrice, $ProductName, $ProductRefernceCode, $ProductId); ?>
         </span>
        </div>
       </div>
       <ul class="stars">
        <li>
         <a href="#">
          <i class="fa fa-star" aria-hidden="true"></i>
         </a>
        </li>
        <li>
         <a href="#">
          <i class="fa fa-star" aria-hidden="true"></i>
         </a>
        </li>
        <li>
         <a href="#">
          <i class="fa fa-star" aria-hidden="true"></i>
         </a>
        </li>
        <li>
         <a href="#">
          <i class="fa fa-star" aria-hidden="true"></i>
         </a>
        </li>
        <li>
         <a href="#">
          <i class="fa fa-star-half-o" aria-hidden="true"></i>
         </a>
        </li>
       </ul>
      </div>
     </div>
     <div class="clearfix"></div>
    </div>
   </div>
  </div>
 </a>
</div>