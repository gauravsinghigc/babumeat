<?php

//required files
require '../../require/modules.php';
require '../../require/admin/access-control.php';
require '../../require/admin/sessionvariables.php';

//page variables
$PageName = "All Products";
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=0.9">
  <title><?php echo $PageName; ?> | <?php echo APP_NAME; ?></title>
  <?php include '../../include/admin/header_files.php'; ?>
</head>

<body>
  <div id="container" class="effect mainnav-lg navbar-fixed mainnav-fixed">
    <?php include '../../include/admin/header.php'; ?>

    <div class="boxed">
      <!--CONTENT CONTAINER-->
      <!--===================================================-->
      <div id="content-container">
        <div id="page-content">
          <!--====start content===============================================-->

          <div class="panel">
            <div class="panel-body">
              <div class="row">
                <div class="col-md-12">
                  <h4 class="app-heading"><i class="fa fa-list-ul"></i> <?php echo $PageName; ?></h4>
                </div>
                <div class="col-md-7 p-t-10">
                  <?php include 'common.php'; ?>
                </div>
                <div class="col-md-5 p-t-5">
                  <div class="search-form m-t-0">
                    <form action="" method="get">
                      <div class="flex-s-b p-0 m-b-0">
                        <input type="text" name="search" value="true" hidden="">
                        <select name="search_type" class="form-control-2" id="searchoptions" onchange="CheckSearchOptions()">
                          <option value="Product Id">Product Id</option>
                          <option value="Product Name">Product Name</option>
                          <option value="Product RefernceCode" selected>Item Code</option>
                          <option value="Product Size">Product Size</option>
                          <option value="Product Status">Product Status</option>
                          <option value="Product New Arrival Status">New Arrival Status</option>
                        </select>
                        <input type="text" class="form-control-2" id="searchplaceholder" placeholder="Search By Item Code" onchange="form.submit()" list="available_details" name="search_value">
                        <datalist id="available_details">
                          <?php SelectOptions("SELECT * FROM products", "ProductName", "ProductName", "ASC", false); ?>
                          <?php SelectOptions("SELECT * FROM products", "ProductId", "ProductId", "ASC", false); ?>
                          <?php SelectOptions("SELECT * FROM products", "ProductRefernceCode", "ProductRefernceCode", "ASC", false); ?>
                          <?php SelectOptions("SELECT * FROM products", "ProductSize", "ProductSize", "ASC", false); ?>
                          <?php SelectOptions("SELECT * FROM products GROUP BY ProductStatus", "ProductStatus", "ProductStatus", "ASC", false); ?>
                          <?php SelectOptions("SELECT * FROM products GROUP BY ProductNewArrivalStatus", "ProductNewArrivalStatus", "ProductNewArrivalStatus", "ASC", false); ?>
                        </datalist>
                      </div>
                    </form>
                  </div>
                </div>
                <script>
                  function CheckSearchOptions() {
                    var searchoptions = document.getElementById("searchoptions");
                    var searchplaceholder = document.getElementById("searchplaceholder");
                    searchplaceholder.placeholder = "Search By " + searchoptions.value;
                  }
                </script>
                <?php CLEAR_SEARCH(); ?>
                <div class="col-md-12 m-t-10">
                  <div class="table-responsive">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Name</th>
                          <th>WorkType</th>
                          <th>Medium</th>
                          <th>SortOrder</th>
                          <th>NewArrival</th>
                          <th>Status</th>
                          <th>CreatedAt</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <?php
                      if (isset($_GET['search']) == true) {
                        $searchvalue = $_GET['search_value'];
                        $search_type = $_GET['search_type'];
                        $search_type = str_replace(" ", "", $search_type);
                        $SQLproducts = SELECT("SELECT * FROM products, pro_categories, pro_sub_categories where products.$search_type='$searchvalue' and products.ProductCategoryId=pro_categories.ProCategoriesId and products.ProductSubCategoryId=pro_sub_categories.ProSubCategoriesId ORDER BY products.ProductId DESC");
                      } else {
                        $SQLproducts = SELECT("SELECT * FROM products, pro_categories, pro_sub_categories where products.ProductCategoryId=pro_categories.ProCategoriesId and products.ProductSubCategoryId=pro_sub_categories.ProSubCategoriesId ORDER BY products.ProductId DESC");
                      }
                      while ($fetchpro_brands = mysqli_fetch_array($SQLproducts)) {
                        $ProductName = $fetchpro_brands['ProductName'];
                        $ProCategoryName = $fetchpro_brands['ProCategoryName'];
                        $ProSubCategoryName = $fetchpro_brands['ProSubCategoryName'];
                        $ProductRefernceCode = $fetchpro_brands['ProductRefernceCode'];
                        $ProductImage = $fetchpro_brands['ProductImage'];
                        $ProductCategoryId = $fetchpro_brands['ProductCategoryId'];
                        $ProductSubCategoryId = $fetchpro_brands['ProductSubCategoryId'];
                        $ProductSellPrice = $fetchpro_brands['ProductSellPrice'];
                        $ProductMrpPrice = $fetchpro_brands['ProductMrpPrice'];
                        $ProductDescriptions = SECURE($fetchpro_brands['ProductDescriptions'], "e");
                        $ProductWeight = $fetchpro_brands['ProductWeight'];
                        $ProductStatus = StatusViewWithText($fetchpro_brands['ProductStatus']);
                        $ProductCreatedAt = $fetchpro_brands['ProductCreatedAt'];
                        $ProductUpdatedAt = ReturnValue($fetchpro_brands['ProductUpdatedAt']);
                        $ProductCreatedBy = $fetchpro_brands['ProductCreatedBy'];
                        $ProductId = $fetchpro_brands['ProductId'];
                        $ProductAvailibility = $fetchpro_brands['ProductStatus'];
                        $ProductWorkType = $fetchpro_brands['ProductWorkType'];
                        $ProductMedium = $fetchpro_brands['ProductMedium'];
                        $ProductNewArrivalStatus = $fetchpro_brands['ProductNewArrivalStatus'];
                        $ProductPageOrder = $fetchpro_brands['ProductPageOrder']; ?>
                        <tr>
                          <td>
                            <img src="<?php echo STORAGE_URL; ?>/products/pro-img/<?php echo $ProductImage; ?>" alt="<?php echo $ProductName; ?>" title="<?php echo $ProductName; ?>" class="w-10 pro-img">
                          </td>
                          <td class="lh-1-1 p-t-2">
                            <a href="<?php echo DOMAIN; ?>/admin/products/edit-products.php?productid=<?php echo SECURE($ProductId, "e"); ?>" class="p-t-2"><span class="text-primary"><span class="text-grey"><i>ID<?php echo $ProductId; ?></i></span> :<?php echo $ProductName; ?></span><br>
                              <span class="text-grey fs-12">
                                <?php echo $ProductRefernceCode; ?> | <?php echo $ProCategoryName; ?> |
                                <?php echo $ProSubCategoryName; ?> |
                              </span>
                            </a>
                          </td>
                          <td>
                            <?php echo $ProductWorkType; ?>
                          </td>
                          <td><?php echo $ProductMedium; ?></td>
                          <td><?php echo $ProductPageOrder; ?></td>
                          <td><?php echo $ProductNewArrivalStatus; ?></td>
                          <td>
                            <?php if ($ProductAvailibility == 3) { ?>
                              <a href="<?php echo DOMAIN; ?>/controller/productscontroller.php?delete_products=<?php echo SECURE('true', 'e'); ?>&access_url=<?php echo SECURE(RUNNING_URL, "e"); ?>&control_id=<?php echo SECURE($ProductId, "e"); ?>" class="btn-danger btn-sm btn"><i class="fa fa-trash"></i> Delete</a>
                              <a href="<?php echo DOMAIN; ?>/controller/productscontroller.php?restore_products=<?php echo SECURE('true', 'e'); ?>&access_url=<?php echo SECURE(DOMAIN . "/admin/products", "e"); ?>&control_id=<?php echo SECURE($ProductId, "e"); ?>" class="btn-success btn-sm btn"><i class="fa fa-refresh"></i> Restore</a>
                            <?php } else {
                              echo $ProductStatus;
                            } ?>
                          </td>
                          <td>
                            <?php echo $ProductCreatedAt; ?>
                          </td>
                          <td>
                            <a href="<?php echo DOMAIN; ?>/admin/products/edit-products.php?productid=<?php echo SECURE($ProductId, "e"); ?>" class="btn btn-sm btn-info"><i class="fa fa-edit"></i></a>
                          </td>
                        </tr>
                      <?php } ?>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!--End page content-->
      </div>

      <?php include '../../include/admin/sidebar.php'; ?>
    </div>
    <?php include '../../include/admin/footer.php'; ?>
  </div>

  <?php include '../../include/admin/footer_files.php'; ?>
</body>

</html>