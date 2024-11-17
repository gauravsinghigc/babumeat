<?php

//required files
require '../../../require/modules.php';
require '../../../require/admin/access-control.php';
require '../../../require/admin/sessionvariables.php';

//page variables
$PageName = "All Brands";
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=0.9">
  <title><?php echo $PageName; ?> | <?php echo APP_NAME; ?></title>
  <?php include '../../../include/admin/header_files.php'; ?>

</head>

<body>
  <div id="container" class="effect mainnav-lg navbar-fixed mainnav-fixed">
    <?php include '../../../include/admin/header.php'; ?>

    <div class="boxed">
      <!--CONTENT CONTAINER-->
      <!--===================================================-->
      <div id="content-container">
        <div class="pageheader hidden-xs">
          <h3><i class="fa fa-refresh"></i> <?php echo $PageName; ?> </h3>
          <div class="breadcrumb-wrapper">
            <span class="label">You are here:</span>
            <ol class="breadcrumb">
              <li> <a href="<?php echo DOMAIN; ?>/admin"> Home </a> </li>
              <li class="active"> <?php echo $PageName; ?> </li>
            </ol>
          </div>
        </div>
        <div id="page-content">
          <!--====start content===============================================-->

          <div class="panel">
            <div class="panel-heading">
              <div class="flex-s-b">
                <div class="btn-group btn-group-sm">
                  <a href="<?php echo DOMAIN; ?>/admin/products/index.php" class="btn btn-sm btn-success square">All Products</a>
                  <a href="<?php echo DOMAIN; ?>/admin/configurations/products/index.php" class="btn btn-sm btn-primary square">Categories</a>
                  <a href="<?php echo DOMAIN; ?>/admin/configurations/products/sub-categories.php" class="btn btn-sm btn-warning square">Subcategories</a>
                  <a href="<?php echo DOMAIN; ?>/admin/configurations/products/brands.php" class="btn btn-sm btn-danger square">Brands</a>
                </div>
              </div>
            </div>
            <div class="panel-body">
              <div class="flex-s-b">
                <h4 class="m-b-0">All Brands</h4>
                <a href="#" onclick="Databar('Addbrands')" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Brands</a>
              </div>
              <div class="row m-t-10">
                <?php
                $SQLpro_brands = SELECT("SELECT * FROM pro_brands ORDER BY ProBrandId ASC");
                while ($fetchpro_brands = mysqli_fetch_array($SQLpro_brands)) {
                  $ProBrandId = $fetchpro_brands['ProBrandId'];
                  $ProBrandName = $fetchpro_brands['ProBrandName'];
                  $ProBrandStatus = $fetchpro_brands['ProBrandStatus'];
                  $ProBrandImage = $fetchpro_brands['ProBrandImage'];
                  $ProBrandCreatedAt = ReturnValue($fetchpro_brands['ProBrandCreatedAt']);
                  $ProBrandUpdatedAt = ReturnValue($fetchpro_brands['ProBrandUpdatedAt']);
                  $StatusView = StatusView($ProBrandStatus); ?>
                  <div class="col-lg-4 col-md-4 col-sm-6 col-12">
                    <div class="shadow-lg br10">
                      <div class="flex-s-b">
                        <div class="img-section">
                          <img src="<?php echo STORAGE_URL; ?>/products/brands/<?php echo $ProBrandImage; ?>" class="w-100">
                        </div>
                        <div class="item-details p-1">
                          <p class="lh-1-2 m-b-1">
                            <span class="fs-15 bold"><?php echo $ProBrandName; ?></span><br>
                            <span class="fs-13">
                              <span><?php echo $StatusView; ?></span><br>
                              <span><i class='fa fa-calendar text-primary'></i> <?php echo $ProBrandCreatedAt; ?></span><br>
                              <span><i class="fa fa-edit text-warning"></i> <?php echo $ProBrandUpdatedAt; ?></span><br>
                            </span>
                          </p>
                          <a href="#" class="btn-sm text-primary"><i class="fa fa-edit"></i> Edit</a>
                          <a href="#" class="btn-sm text-danger"><i class="fa fa-trash"></i> Delete</a>
                        </div>
                      </div>
                    </div>
                  </div>
                <?php } ?>
              </div>
            </div>
          </div>

          <!--End page content-->
        </div>

        <?php include '../../../include/admin/sidebar.php'; ?>
      </div>
      <?php include '../../../include/admin/footer.php'; ?>
    </div>

    <!-- add section -->
    <section class="add-section" id="Addbrands">
      <div class="add-data-form">
        <form class="data-form" action="../../../controller/productscontroller.php" method="POST" enctype="multipart/form-data">
          <?php FormPrimaryInputs(true); ?>
          <div class="main-data">
            <div class="main-data-header app-bg">
              <div class="flex-s-b">
                <h4 class="mt-0 mb-0">Add New Brand</h4>
                <a class="btn btn-sm btn-danger sqaure" onclick="Databar('Addbrands')"><i class="fa fa-times fs-17"></i></a>
              </div>
            </div>
            <div class="main-data-body p-2">
              <div class="row">
                <div class="form-group col-lg-6 col-md-6 col-ms-6 col-12">
                  <label>Enter New Brand Name</label>
                  <input type="text" name="ProBrandName" class="form-control-2" required="" />
                </div>
                <div class="form-group col-lg-6 col-md-6 col-ms-6 col-12">
                  <label>Upload Category Image</label>
                  <input type="FILE" name="ProBrandImage" id="uploadimage" accept="image/png, image/gif, image/jpeg" class="form-control-2" required="" />
                </div>
                <div class="col-md-12">
                  <div class="flex-c mb-2-pr">
                    <img src="" id="ImgPreview">
                  </div>
                </div>
              </div>
              <br><br><br><br><br><br>
            </div>
            <div class="main-data-footer">
              <button type="Submit" onclick="form.submit()" value="null" name="CreateProductbrands" class="btn btn-md app-bg">Create Brands</button>
              <a onclick="Databar('Addbrands')" class="btn btn-md btn-danger">Cancel</a>
            </div>

          </div>
        </form>
      </div>
    </section>
    <!-- end of add section -->

    <?php include '../../../include/admin/footer_files.php'; ?>
</body>

</html>