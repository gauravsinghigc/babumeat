<?php

//required files
require '../../require/modules.php';
require '../../require/admin/access-control.php';
require '../../require/admin/sessionvariables.php';

//page variables
$PageName = "All F&Q's";
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
              <div class="flex-s-b app-heading">
                <h4 class="m-b-0 m-t-5"><?php echo $PageName; ?></h4>
                <a href="#" onclick="Databar('Addbrands')" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> FAQ's</a>
              </div>
              <div class="row m-t-10">
                <div class="col-md-12">
                  <div class="flex-s-b">
                    <?php include 'common.php'; ?>
                  </div>
                </div>
              </div>

              <div class="row m-t-10">
                <?php $Data = FetchConvertIntoArray("SELECT * FROM wallpaper_faqs ORDER BY WallPaperFaqsId DESC", true);
                if ($Data == null) {
                  NoData("No FAQ found!");
                } else {
                  foreach ($Data as $List) { ?>
                    <div class="col-md-6">
                      <div class="shadow-lg p-1" style="border-radius:0.5rem !important;">
                        <h4 class="m-b-0 app-sub-heading" onclick="Databar('view_<?php echo $List->WallPaperFaqsId; ?>')"><?php echo $List->WallPaperFaqQuestions; ?>?
                          <i class="fa fa-angle-right pull-right btn-sm btn-dark btn" style="margin-top:-0.3rem !important;"></i>
                        </h4>
                        <div id="view_<?php echo $List->WallPaperFaqsId; ?>" style="display:none;">
                          <p><?php echo $List->WallPaperFaqAnswer; ?></p>

                          <a href="edit-faq.php?id=<?php echo $List->WallPaperFaqsId; ?>" class="btn btn-sm btn-info">Edit Details</a>
                          <?php CONFIRM_DELETE_POPUP(
                            "remove_faq",
                            [
                              "remove_faq_record" => true,
                              "control_id" => $List->WallPaperFaqsId
                            ],
                            "WallPaperController",
                            "Remove",
                            "btn btn-danger btn-sm"
                          ); ?>
                        </div>

                      </div>
                    </div>
                <?php
                  }
                } ?>
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

  <!-- add section -->
  <section class="add-section" id="Addbrands">
    <div class="add-data-form">
      <form class="data-form" action="../../controller/WallPaperController.php" method="POST">
        <?php FormPrimaryInputs(true); ?>
        <div class="main-data">
          <div class="main-data-header app-bg">
            <div class="flex-s-b app-heading">
              <h4 class="mt-0 mb-0">Add New FAQ</h4>
              <a class="btn btn-sm btn-danger sqaure" onclick="Databar('Addbrands')"><i class="fa fa-times fs-17"></i></a>
            </div>
          </div>
          <div class="main-data-body p-2">
            <div class="row">
              <div class="form-group col-lg-12 col-md-12 col-ms-12 col-12">
                <label>Enter Question</label>
                <input type="text" name="WallPaperFaqQuestions" class="form-control-2" required="" />
              </div>
              <div class="form-group col-lg-12 col-md-12">
                <label>Enter Answer</label>
                <textarea name="WallPaperFaqAnswer" class="form-control-2" rows="4" style="height:100% !important;"></textarea>
              </div>
              <br><br><br><br><br><br>
            </div>
            <div class="main-data-footer">
              <button type="Submit" onclick="form.submit()" value="null" name="CreateFaqs" class="btn btn-md app-btn">Save FAQ</button>
              <a onclick="Databar('Addbrands')" class="btn btn-md btn-danger">Cancel</a>
            </div>

          </div>
      </form>
    </div>
  </section>
  <!-- end of add section -->

  <?php include '../../include/admin/footer_files.php'; ?>
</body>

</html>