<?php

//required files
require '../../require/modules.php';
require '../../require/admin/access-control.php';
require '../../require/admin/sessionvariables.php';

//page variables
$PageName = "Customize Options";

$StandardSql = "SELECT * FROM wallpaper_customise_options where WallPaperCustomOptionType='STANDARD'";
$CustomSql = "SELECT * FROM wallpaper_customise_options where WallPaperCustomOptionType='CUSTOM'";
$SampleSql = "SELECT * FROM wallpaper_customise_options where WallPaperCustomOptionType='SAMPLE'";
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

                     <div class="row m-t-10">
                        <div class="col-md-4">
                           <h5 class="app-sub-heading">Standard Roll Size Settings</h5>
                           <form action="../../controller/WallPaperController.php" method="post">
                              <?php FormPrimaryInputs(true); ?>
                              <div class="form-group">
                                 <label>Standard Roll Size Name</label>
                                 <input type="text" class="form-control-2" value="<?php echo FETCH($StandardSql, "WallPaperCustomOptionName"); ?>" name="WallPaperCustomOptionName" placeholder="Standard Roll">
                              </div>

                              <div class="form-group">
                                 <label>Standard Roll Size (in : WxH)</label>
                                 <input type="text" class="form-control-2" value="<?php echo FETCH($StandardSql, "WallPaperCustomOptionSize"); ?>" name="WallPaperCustomOptionSize" placeholder="10x6 inch">
                              </div>

                              <div class="form-group">
                                 <label>Standard Roll Price (Rs.)</label>
                                 <input type="text" class="form-control-2" value="<?php echo FETCH($StandardSql, "WallPaperCustomOptionPrice"); ?>" name="WallPaperCustomOptionPrice" placeholder="Rs.45000">
                              </div>

                              <div class="form-group">
                                 <label>Standard Roll Descriptions</label>
                                 <textarea class="form-control-2" rows="3" style="height:100% !important;" name="WallPaperCustomOptionDesc" placeholder=""><?php echo SECURE(FETCH($StandardSql, "WallPaperCustomOptionDesc"), "d"); ?></textarea>
                              </div>

                              <button name="UpdateStandardOptionDetails" type="submit" value="<?php echo FETCH($StandardSql, "WallPaperCustomOptionId"); ?>" class="btn btn-lg btn-primary">Save Details</button>
                           </form>
                           <hr>
                        </div>

                        <div class="col-md-4">
                           <h5 class="app-sub-heading">Custom Roll Size Price Settings</h5>
                           <form action="../../controller/WallPaperController.php" method="post">
                              <?php FormPrimaryInputs(true); ?>
                              <div class="form-group">
                                 <label>Custom Roll Size Name</label>
                                 <input type="text" class="form-control-2" value="<?php echo FETCH($CustomSql, "WallPaperCustomOptionName"); ?>" name="WallPaperCustomOptionName" placeholder="Standard Roll">
                              </div>

                              <div class="form-group">
                                 <label>Custom Roll Size (sq. ft.)</label>
                                 <input type="text" class="form-control-2" value="<?php echo FETCH($CustomSql, "WallPaperCustomOptionSize"); ?>" name="WallPaperCustomOptionSize" placeholder="10x6 inch">
                              </div>

                              <div class="form-group">
                                 <div class="row">
                                    <div class="col-md-6">
                                       <label>Custom Roll Price (Rs.)</label>
                                       <input type="text" class="form-control-2" value="<?php echo FETCH($CustomSql, "WallPaperCustomOptionPrice"); ?>" name="WallPaperCustomOptionPrice" placeholder="Rs.45000">
                                    </div>
                                    <div class="col-md-6">
                                       <label>Resizing Fee (Rs.)</label>
                                       <input type="text" class="form-control-2" value="<?php echo CONFIG("RESIZING_FEE"); ?>" name="RESIZING_FEE" placeholder="Rs.45000">
                                    </div>
                                 </div>
                              </div>

                              <div class="form-group">
                                 <label>Custom Roll Descriptions</label>
                                 <textarea class="form-control-2" style="height:100% !important;" rows="3" name="WallPaperCustomOptionDesc" placeholder=""><?php echo SECURE(FETCH($CustomSql, "WallPaperCustomOptionDesc"), "d"); ?></textarea>
                              </div>

                              <button name="UpdateCustomOptionDetails" type="submit" value="<?php echo FETCH($CustomSql, "WallPaperCustomOptionId"); ?>" class="btn btn-lg btn-primary">Save Details</button>
                           </form>
                           <hr>
                        </div>

                        <div class="col-md-4">
                           <h5 class="app-sub-heading">Sample Roll Size Settings</h5>
                           <form action="../../controller/WallPaperController.php" method="post">
                              <?php FormPrimaryInputs(true); ?>
                              <div class="form-group">
                                 <label>Sample Roll Size Name</label>
                                 <input type="text" class="form-control-2" value="<?php echo FETCH($SampleSql, "WallPaperCustomOptionName"); ?>" name="WallPaperCustomOptionName" placeholder="Standard Roll">
                              </div>

                              <div class="form-group">
                                 <label>Sample Roll Size</label>
                                 <input type="text" class="form-control-2" value="<?php echo FETCH($SampleSql, "WallPaperCustomOptionSize"); ?>" name="WallPaperCustomOptionSize" placeholder="10x6 inch">
                              </div>

                              <div class="form-group">
                                 <label>Sample Roll Price (Rs.)</label>
                                 <input type="text" class="form-control-2" value="<?php echo FETCH($SampleSql, "WallPaperCustomOptionPrice"); ?>" name="WallPaperCustomOptionPrice" placeholder="Rs.45000">
                              </div>

                              <div class="form-group">
                                 <label>Sample Roll Descriptions</label>
                                 <textarea class="form-control-2" rows="3" style="height:100% !important;" name="WallPaperCustomOptionDesc" placeholder=""><?php echo SECURE(FETCH($SampleSql, "WallPaperCustomOptionDesc"), "d"); ?></textarea>
                              </div>

                              <button name="UpdateSampleOptionDetails" type="submit" value="<?php echo FETCH($SampleSql, "WallPaperCustomOptionId"); ?>" class="btn btn-lg btn-primary">Save Details</button>
                           </form>
                           <hr>
                        </div>

                        <div class="col-md-12">
                           <h4 class="app-heading m-b-10">Paper Options</h4>
                           <div class="row">
                              <div class="col-md-3">
                                 <h5 class="app-sub-heading">Add Paper Options</h5>
                                 <form action="../../controller/WallPaperController.php" method="POST" enctype="multipart/form-data">
                                    <?php FormPrimaryInputs(true); ?>
                                    <div class="form-group">
                                       <label>Paper name</label>
                                       <input type="text" class="form-control-2" name="WallPaperPaperName" placeholder="" required>
                                    </div>
                                    <div class="form-group">
                                       <label>Paper Price</label>
                                       <input type="text" class="form-control-2" name="WallPaperPaperPrice" placeholder="" required>
                                    </div>
                                    <div class="form-group">
                                       <label>Paper Image</label>
                                       <input type="file" accept="image/*" class="form-control-2" name="WallPaperImage" placeholder="" required>
                                    </div>
                                    <div class="m-t-10">
                                       <button type="Submit" name="UploadPaperOptions" class="btn btn-lg btn-primary">Add Paper Options</button>
                                    </div>
                                 </form>
                              </div>
                              <div class="col-md-9">
                                 <h5 class="app-sub-heading">Available Paper options</h5>
                                 <table class="table table-striped">
                                    <thead>
                                       <tr>
                                          <th>Sno</th>
                                          <th>PaperName</th>
                                          <th>PaperPrice</th>
                                          <th>Image</th>
                                          <th>Action</th>
                                       </tr>
                                    </thead>
                                    <tbody>
                                       <?php
                                       $GetPapers = FetchConvertIntoArray("SELECT * FROM wallpaper_paper_options order by WallPaperOptionId DESC", true);
                                       if ($GetPapers == null) {
                                          NoDataTableView("No Paper Option Found!", 5);
                                       } else {
                                          $Sno = 0;
                                          foreach ($GetPapers as $Papers) {
                                             $Sno++; ?>
                                             <tr>
                                                <td><?php echo $Sno; ?></td>
                                                <td><?php echo $Papers->WallPaperPaperName; ?></td>
                                                <td><?php echo Price($Papers->WallPaperPaperPrice, "text-success"); ?></td>
                                                <td><img src="<?php echo STORAGE_URL . "/wallpapers/paper-options/" . $Papers->WallPaperImage; ?>" class="list-icon"></td>
                                                <td>
                                                   <a href="edit-paper-option.php?id=<?php echo $Papers->WallPaperOptionId; ?>" class="btn btn-sm btn-info">Edit Details</a>
                                                   <?php CONFIRM_DELETE_POPUP(
                                                      "wallpapers",
                                                      [
                                                         "delete_paper_options" => true,
                                                         "control_id" => $Papers->WallPaperOptionId
                                                      ],
                                                      "WallPaperController",
                                                      "Remove",
                                                      "btn btn-sm btn-danger"
                                                   ); ?>
                                                </td>
                                             </tr>
                                       <?php }
                                       } ?>
                                    </tbody>
                                 </table>
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