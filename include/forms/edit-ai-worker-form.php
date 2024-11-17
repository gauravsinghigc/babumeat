<form class="data-form" action="<?php echo DOMAIN; ?>/controller/aiworkercontrollers.php" method="POST" enctype="multipart/form-data">
 <?php FormPrimaryInputs(true); ?>
 <div class="row">
  <div class="col-md-12">
   <h4 class="app-sub-heading">AI Worker Details</h4>
  </div>
  <div class="form-group col-lg-4 col-md-4 col-ms-4 col-12">
   <label>AI Worker Name</label>
   <input type="text" name="AIWorkerName" class="form-control-2" value="<?php echo GET_DATA('AIWorkerName'); ?>" required="" />
  </div>
  <div class="form-group col-lg-4 col-md-4 col-ms-4 col-12">
   <label>Phone Number</label>
   <input type="text" min="10" max="12" name="AIWorkerMobileNumber" placeholder="+91" value="<?php echo GET_DATA('AIWorkerMobileNumber'); ?>" class="form-control-2" required="" />
  </div>

  <div class="form-group col-lg-4 col-md-4 col-ms-4 col-12">
   <label>WhatsApp Number</label>
   <input type="text" name="AIWorkerWhatsappNumber" placeholder="+91" value="<?php echo GET_DATA('AIWorkerWhatsappNumber'); ?>" class="form-control-2" required="" />
  </div>

  <div class="form-group col-lg-4 col-md-4 col-ms-4 col-12">
   <label>Telegram Number</label>
   <input type="text" name="AIWorkerTelegramNumber" placeholder="+91" class="form-control-2" value="<?php echo GET_DATA('AIWorkerTelegramNumber'); ?>" required="" />
  </div>

  <div class="form-group col-lg-4 col-md-4 col-ms-4 col-12">
   <label>Email-Id</label>
   <input type="email" name="AIWorkerEmail" placeholder="abc@domain.ext" class="form-control-2" value="<?php echo GET_DATA('AIWorkerEmail'); ?>" required="" />
  </div>

  <div class="form-group col-lg-12 col-md-12 col-ms-12 col-12">
   <label>Worker Bio / Description</label>
   <textarea type="text" style="height:auto !important;" name="AIWorkerDescriptions" rows="5" class="form-control-2" placeholder="Small Introduction" required=""><?php echo SECURE(GET_DATA('AIWorkerDescriptions'), "d"); ?></textarea>
  </div>

  <div class="col-md-12 m-t-10">
   <h4 class="app-sub-heading">Address</h4>
  </div>

  <div class="form-group col-lg-4 col-md-4 col-ms-4 col-12">
   <label>Street Address</label>
   <input type="text" name="AIWorkerStreetAddress" class="form-control-2" value="<?php echo SECURE(GET_DATA('AIWorkerStreetAddress'), "d"); ?>" required="" />
  </div>
  <div class="form-group col-lg-4 col-md-4 col-ms-4 col-12">
   <label>Area</label>
   <input type="text" name="AIWorkerArea" class="form-control-2" value="<?php echo GET_DATA('AIWorkerArea'); ?>" required="" />
  </div>
  <div class="form-group col-lg-4 col-md-4 col-ms-4 col-12">
   <label>Village</label>
   <input type="text" name="AIWorkerVillage" class="form-control-2" value="<?php echo GET_DATA('AIWorkerVillage'); ?>" required="" />
  </div>
  <div class="form-group col-lg-4 col-md-4 col-ms-4 col-12">
   <label>tehsil</label>
   <input type="text" name="AIWorkerTehsil" class="form-control-2" value="<?php echo GET_DATA('AIWorkerTehsil'); ?>" required="" />
  </div>
  <div class="form-group col-lg-4 col-md-4 col-ms-4 col-12">
   <label>District</label>
   <input type="text" name="AIWorkerDistrict" class="form-control-2" value="<?php echo GET_DATA('AIWorkerDistrict'); ?>" required="" />
  </div>
  <div class="form-group col-lg-4 col-md-4 col-ms-4 col-12">
   <label>city</label>
   <input type="text" name="AIWorkerCity" class="form-control-2" value="<?php echo GET_DATA('AIWorkerCity'); ?>" required="" />
  </div>
  <div class="form-group col-lg-4 col-md-4 col-ms-4 col-12">
   <label>state</label>
   <input type="text" name="AIWorkerState" class="form-control-2" value="<?php echo GET_DATA('AIWorkerState'); ?>" required="" />
  </div>
  <div class="form-group col-lg-4 col-md-4 col-ms-4 col-12">
   <label>Pincode</label>
   <input type="text" name="AIWorkerPincode" class="form-control-2" value="<?php echo GET_DATA('AIWorkerPincode'); ?>" required="" />
  </div>

  <div class="col-md-12 m-t-10">
   <h4 class="app-sub-heading">Qualifications & Expertise</h4>
  </div>
  <div class="form-group col-lg-4 col-md-4 col-ms-4 col-12">
   <label>Qualifications</label>
   <input type="text" name="AIWorkerQualification" class="form-control-2" value="<?php echo GET_DATA('AIWorkerQualification'); ?>" required="" />
  </div>
  <div class="form-group col-lg-4 col-md-4 col-ms-4 col-12">
   <label>Work Experience</label>
   <input type="text" name="AIWorkerExperience" class="form-control-2" value="<?php echo GET_DATA('AIWorkerExperience'); ?>" required="" />
  </div>
  <div class="form-group col-lg-6 col-md-6 col-ms-6 col-12">
   <label>Expertise In Animals</label>
   <textarea type="text" style="height:auto !important;" name="AIWorkerExpertiseIn" rows="5" class="form-control-2" placeholder="Enter animal name separated by commas" required=""><?php echo SECURE(GET_DATA('AIWorkerExpertiseIn'), "d"); ?></textarea>
  </div>
  <div class="form-group col-lg-6 col-md-6 col-ms-6 col-12">
   <label>Specilisation</label>
   <textarea type="text" style="height:auto !important;" name="AIWorkerSpecilization" rows="5" class="form-control-2" required=""><?php echo SECURE(GET_DATA('AIWorkerSpecilization'), "d"); ?></textarea>
  </div>

  <div class="col-md-12 m-t-10">
   <h4 class="app-sub-heading">Payment & Fees</h4>
  </div>
  <div class="form-group col-lg-4 col-md-4 col-ms-4 col-12">
   <label>Consultanct Fee</label>
   <input type="text" placeholder="Rs." name="AIWorkerConsultaningFee" value="<?php echo GET_DATA('AIWorkerConsultaningFee'); ?>" class="form-control-2" required="" />
  </div>

  <div class="col-md-12 m-t-10">
   <h4 class="app-sub-heading">Photos</h4>
  </div>

  <div class="form-group col-lg-4 col-md-4 col-ms-4 col-12">
   <label>Profile Image</label>
   <input type="text" name="AIWorkerProfile_CURRENT" value="<?php echo SECURE(GET_DATA('AIWorkerProfile'), 'e'); ?>" hidden>
   <input type="FILE" name="AIWorkerProfile" value="null" class="form-control-2" />
   <img src="<?php echo STORAGE_URL; ?>/workers/images/profile/<?php echo GET_DATA("AIWorkerProfile"); ?>" class="imgrpreview m-t-10">
  </div>

  <div class="form-group col-lg-4 col-md-4 col-ms-4 col-12">
   <label>Profile Background Image</label>
   <input type="text" name="AIWorkerBGImage_CURRENT" value="<?php echo SECURE(GET_DATA('AIWorkerBGImage'), 'e'); ?>" hidden>
   <input type="FILE" name="AIWorkerBGImage" value="null" class="form-control-2" />
   <img src="<?php echo STORAGE_URL; ?>/workers/images/bg/<?php echo GET_DATA("AIWorkerBGImage"); ?>" class="imgrpreview m-t-10">
  </div>
 </div>
 <div class="row">
  <div class="form-group col-md-4 col-lg-4 col-sm-4 col-12">
   <label>Listing Status</label>
   <select class="form-control-2" name="AIWorkerStatus" required="">
    <?php
    if (GET_DATA("AIWorkerStatus") == 1) { ?>
     <option value="1" selected="">Active</option>
     <option value="2">Inactive</option>
    <?php } else { ?>
     <option value="1">Active</option>
     <option value="2" selected="">Inactive</option>
    <?php } ?>
   </select>
  </div>

 </div>

 <br>
 <button type="Submit" value="<?php echo SECURE(GET_DATA("Aiworkersid"), "e"); ?>" name="UpdateAIWsorker" class="btn btn-lg btn-success">Update</button>
 <a href="index.php" class="btn btn-lg btn-danger">Back</a>
 <br><br>
</form>