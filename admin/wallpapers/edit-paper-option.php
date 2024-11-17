<?php

//required files
require '../../require/modules.php';
require '../../require/admin/access-control.php';
require '../../require/admin/sessionvariables.php';

//page variables
$PageName = "Edit Paper Options";

if (isset($_GET['id'])) {
   $WallPaperOptionId = $_GET['id'];
   $_SESSION['WallPaperOptionId'] = $WallPaperOptionId;
} else {
   $WallPaperOptionId = $_SESSION['WallPaperOptionId'];
}
$PageSql = "SELECT * FROM wallpaper_paper_options where WallPaperOptionId='$WallPaperOptionId'";
?>
<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=0.9">
   <title><?php echo $PageName; ?> | <?php echo APP_NAME; ?></title>
   <?php include '../../include/admin/header_files.php'; ?>
   <style>
      table.table tr th,
      table.table tr td {
         font-size: 0.9rem !important;
         padding: 0.2rem !important;
      }
   </style>
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
                        <div class="col-md-12 mb-4">
                           <h4 class="app-heading"><?php echo $PageName; ?></h4>
                        </div>
                        <div class="col-md-12 m-t-10">
                           <?php include "common.php"; ?>
                        </div>
                     </div>


                     <div class="row">
                        <div class="col-md-12">
                           <div class="row">
                              <div class="col-md-4">
                                 <form action="../../controller/WallPaperController.php" method="POST" enctype="multipart/form-data">
                                    <?php FormPrimaryInputs(true); ?>
                                    <div class="form-group">
                                       <label>Paper name</label>
                                       <input type="text" class="form-control-2" value="<?php echo FETCH($PageSql, "WallPaperPaperName"); ?>" name="WallPaperPaperName" placeholder="" required>
                                    </div>
                                    <div class="form-group">
                                       <label>Paper Price</label>
                                       <input type="text" class="form-control-2" value="<?php echo FETCH($PageSql, "WallPaperPaperPrice"); ?>" name="WallPaperPaperPrice" placeholder="" required>
                                    </div>
                                    <div class="form-group">
                                       <label>Paper Image</label>
                                       <?php CurrentFile(FETCH($PageSql, "WallPaperImage")); ?>
                                       <input type="file" accept="image/*" class="form-control-2" value="null" name="WallPaperImage" placeholder="">
                                    </div>
                                    <div class="m-t-10">
                                       <a href="customize.php" class="btn btn-lg btn-default">Back to All</a>
                                       <button type="Submit" name="UpdateWallPaperPaperOptions" value="<?php echo $WallPaperOptionId; ?>" class="btn btn-lg btn-primary">Update Paper Options</button>
                                    </div>
                                 </form>
                              </div>

                           </div>
                           <hr>
                        </div>
                     </div>

                  </div>

                  <!--End page content-->
               </div>

               <?php include '../../include/admin/sidebar.php'; ?>
            </div>
            <?php include '../../include/admin/footer.php'; ?>
         </div>
         <script>
            function CheckCat() {
               var cats = document.getElementById("cats");
               if (cats.value == "NEW") {
                  document.getElementById("add_cat").style.display = "block";
               } else {
                  document.getElementById("add_cat").style.display = "none";
               }
            }
         </script>

         <script>
            function CheckBrand() {
               var brands = document.getElementById("brands");
               if (brands.value == "NEW") {
                  document.getElementById("add_brand").style.display = "block";
               } else {
                  document.getElementById("add_brand").style.display = "none";
               }
            }
         </script>
         <?php include '../../include/admin/footer_files.php'; ?>
</body>

</html>