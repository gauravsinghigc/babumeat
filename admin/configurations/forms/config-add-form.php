<!-- add section -->
<section class="add-section" id="AddConfigValues">
  <div class="add-data-form">
    <form class="data-form" action="../../controller/configcontroller.php" method="POST">
      <?php FormPrimaryInputs(true); ?>
      <div class="main-data">
        <div class="main-data-header app-bg">
          <div class="flex-s-b">
            <h4 class="mt-0 mb-0">Add Configurations Values</h4>
            <a class="btn btn-sm btn-danger sqaure" onclick="Databar('AddConfigValues')"><i class="fa fa-times fs-17"></i></a>
          </div>
        </div>
        <div class="main-data-body">
          <?php
          SELECT_OPTION_DB("Select Configuration Value", false, "SELECT * FROM configurations", "configurationname", ["name" => "configurationid"], "col-md-6 col-lg-6 col-sm-12");
          INPUT("Configuration Name", false, ["name" => "configurationdata", "class" => "form-control"], "col-md-6 col-lg-6 col-sm-12");
          SELECT_OPTIONS("Value Type", false, ["ShortText", "LongText", "Number", "EmailID", "PhoneNumber", "Address", "Url", "Image", "File", "MultipleOptions", "Date", "Datetime", "Time"], ["name" => "configdatatype", "class" => "form-control", "onchange" => "EnableInputFields()", "id" => "feildtype"], "col-md-6 col-lg-6 col-sm-12");
          ?>
          <div class="col-md-12">
          </div>
          <div class="col-md-6 col-lg-6 col-sm-12 form-group" id='shorttext2'>
            <label>Enter Text <span class="text-danger">*</span> </label>
            <input type='text' name='APP_shorttext' class='form-control'>
          </div>
          <div class="col-md-6 col-lg-6 col-sm-12 form-group hidden" id='emailid2'>
            <label>Enter Email-ID <span class="text-danger">*</span> </label>
            <input type='email' name='APP_emailid' class='form-control'>
          </div>
          <div class="col-md-12 col-lg-12 col-sm-12 form-group hidden" id='url2'>
            <label>Enter URL <span class="text-danger">*</span> </label>
            <input type='url' value="http://" name='APP_url' class='form-control'>
          </div>
          <div class="col-md-12 col-lg-12 col-sm-12 mb-2 form-group hidden" id='image2'>
            <div class="flex-c mb-2-pr">
              <img src="" id="ImgPreview">
            </div>
            <br>
            <label>Upload Image <span class="text-danger">*</span> </label>
            <input type='FILE' value="" name='APP_image' id="uploadimage" accept="image/png, image/gif, image/jpeg" class='form-control'>
          </div>
          <div class="col-md-12 col-lg-12 col-sm-12 mb-2 form-group hidden" id='file2'>
            <div class="flex-c mb-2-pr">
              <iframe src="" id="FilePreview"></iframe>
            </div>
            <br>
            <label>Upload File <span class="text-danger">*</span> </label>
            <input type='FILE' value="" name='APP_files' id="uploadfile" accept=".pdf,.doc" class='form-control'>
          </div>
          <div class="col-md-12 col-lg-12 col-sm-12 form-group hidden" id='options2'>
            <label>Enter Values <span class="text-danger">*</span> </label>
            <p class="text-grey">Enter value seperated by commas, like abc, xyz, mno, def</p>
            <textarea type='text' data-role="tagsinput" id="inputdata" rows="3" name='APP_options' class='form-control'></textarea>
          </div>
          <div class="col-md-6 col-lg-6 col-sm-12 form-group hidden" id='date2'>
            <label>Select Date <span class="text-danger">*</span> </label>
            <input type='date' value="<?php echo date('Y-m-d'); ?>" name='APP_date' class='form-control'>
          </div>
          <div class="col-md-6 col-lg-6 col-sm-12 form-group hidden" id='datetime2'>
            <label>Select DateTime <span class="text-danger">*</span> </label>
            <input type='datetime' value="<?php echo date('Y-m-d'); ?>" name='APP_datetime' class='form-control'>
          </div>
          <div class="col-md-6 col-lg-6 col-sm-12 form-group hidden" id='time2'>
            <label>Select Time <span class="text-danger">*</span> </label>
            <input type='time' value="<?php echo date('h:m A'); ?>" name='APP_time' class='form-control'>
          </div>
          <div class="col-md-6 col-lg-6 col-sm-12 form-group hidden" id='number2'>
            <label>Enter Number <span class="text-danger">*</span> </label>
            <input type='number' min=1 value=1 name='APP_number' class='form-control'>
          </div>
          <div class="col-md-6 col-lg-6 col-sm-12 form-group hidden" id='phonenumber2'>
            <label>Enter Phone Number <span class="text-danger">*</span> </label>
            <input type='phone' value=+91 name='APP_phonenumber' class='form-control'>
          </div>
          <div class="col-md-12 col-lg-12 col-sm-12 form-group hidden" id='longtext2'>
            <label>Enter Text <span class="text-danger">*</span> </label>
            <textarea name='APP_longtext' class='form-control' rows="3" style="height:100% !important;"></textarea>
          </div>
          <div class="col-md-12 col-lg-12 col-sm-12 form-group hidden" id='address2'>
            <label>Enter Address <span class="text-danger">*</span> </label>
            <textarea name='APP_address' class='form-control'></textarea>
          </div>
          <br><br><br><br><br><br>
        </div>
        <div class="main-data-footer">
          <button type="Submit" onclick="form.submit()" value="null" name="CreateConfigurationsValues" class="btn btn-md app-bg">Create Configurations</button>
          <a onclick="Databar('AddConfigValues')" class="btn btn-md btn-danger">Cancel</a>
        </div>

      </div>
  </div>
  </form>
  </div>
</section>
<!-- end of add section -->
















<!-- add section -->
<section class="add-section" id="Addcategories">
  <div class="add-data-form">
    <form class="data-form" action="../../controller/productcontroller.php" method="POST">
      <?php FormPrimaryInputs(true); ?>
      <div class="main-data">
        <div class="main-data-header app-bg">
          <div class="flex-s-b">
            <h4 class="mt-0 mb-0">Add New Categories</h4>
            <a class="btn btn-sm btn-danger sqaure" onclick="Databar('Addcategories')"><i class="fa fa-times fs-17"></i></a>
          </div>
        </div>
        <div class="main-data-body">

          <br><br><br><br><br><br>
        </div>
        <div class="main-data-footer">
          <button type="Submit" onclick="form.submit()" value="null" name="CreateProductCategories" class="btn btn-md app-bg">Create Configurations</button>
          <a onclick="Databar('Addcategories')" class="btn btn-md btn-danger">Cancel</a>
        </div>

      </div>
    </form>
  </div>
</section>