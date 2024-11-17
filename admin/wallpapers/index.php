<?php

//required files
require '../../require/modules.php';
require '../../require/admin/access-control.php';
require '../../require/admin/sessionvariables.php';

//page variables
$PageName = "All Wallpapers";
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
                <div class="col-md-12 p-t-10">
                  <?php include 'common.php'; ?>
                </div>
                <div class="col-md-12 p-t-5">
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
                          <th>RefCode</th>
                          <th>Category</th>
                          <th>StartPrice</th>
                          <th>CreatedAt</th>
                          <th>Status</th>
                          <th>UpdatedAt</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <?php
                      if (isset($_GET['search']) == true) {
                        $searchvalue = $_GET['search_value'];
                        $search_type = $_GET['search_type'];
                        $search_type = str_replace(" ", "", $search_type);
                        $SQLproducts = FetchConvertIntoArray("SELECT * FROM wallpapers, wallpaper_category where wallpapers.$search_type='$searchvalue' and wallpapers.WallPaperCategoryId=wallpaper_category.WallPaperCategoryId ORDER BY wallpapers.WallPapersId DESC", true);
                      } else {
                        $SQLproducts = FetchConvertIntoArray("SELECT * FROM wallpapers, wallpaper_category where wallpapers.WallPaperCategoryId=wallpaper_category.WallPaperCategoryId ORDER BY wallpapers.WallPapersId DESC", true);
                      }
                      $Sno = 0;
                      if ($SQLproducts != null) {
                        foreach ($SQLproducts as $WallPapers) {
                          $Sno++;
                      ?>
                          <tr>
                            <td><?php echo $Sno; ?></td>
                            <td class="text-primary">
                              <img class="list-icon" src="<?php echo STORAGE_URL; ?>/wallpapers/pro-img/<?php echo $WallPapers->WallPapersId; ?>/<?php echo FETCH("SELECT * FROM wallpaper_images where WallPaperMainId='" . $WallPapers->WallPapersId . "'", "WallPaperImageFile"); ?>">
                              <?php echo $WallPapers->WallPaperName; ?>
                            </td>
                            <td><?php echo $WallPapers->WallPaperCode; ?></td>
                            <td><?php echo FETCH("SELECT * FROM wallpaper_category where WallPaperCategoryId='" . $WallPapers->WallPaperCategoryId . "'", "WallPaperCategoryName"); ?></td>
                            <td><?php echo Price($WallPapers->WallPaperStartPrice, "text-success"); ?></td>
                            <td><?php echo DATE_FORMATE2("d M, Y", $WallPapers->WallPaperCreatedAt); ?></td>
                            <td><?php echo StatusViewWithText($WallPapers->WallPaperStatus); ?></td>
                            <td><?php echo DATE_FORMATE2("d M, Y", $WallPapers->WallPaperUpdatedAt); ?></td>
                            <td>
                              <a href="edit.php?productid=<?php echo SECURE($WallPapers->WallPapersId, "e"); ?>" class="btn btn-sm btn-info">Edit Details</a>
                              <?php CONFIRM_DELETE_POPUP(
                                "wallpapers",
                                [
                                  "delete_wallpapers" => true,
                                  "control_id" => $WallPapers->WallPapersId
                                ],
                                "WallPaperController",
                                "Remove",
                                "btn btn-sm btn-danger"
                              ); ?>
                            </td>
                          </tr>
                      <?php
                        }
                      } ?>
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