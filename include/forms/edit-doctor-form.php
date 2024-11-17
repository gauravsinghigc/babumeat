<form class="data-form" action="<?php echo DOMAIN; ?>/controller/doctorcontroller.php" method="POST" enctype="multipart/form-data">
 <?php FormPrimaryInputs(true); ?>
 <div class="row">
  <div class="form-group col-lg-4 col-md-4 col-ms-4 col-12">
   <label>Doctor Name</label>
   <input type="text" name="DoctorName" value="<?php echo GET_DATA('DoctorName'); ?>" class="form-control-2" required="" />
  </div>
  <div class="form-group col-lg-4 col-md-4 col-ms-4 col-12">
   <label>Phone Number</label>
   <input type="text" min="10" max="12" name="DoctorMobileNumber" value="<?php echo GET_DATA('DoctorMobileNumber'); ?>" placeholder="+91" class="form-control-2" required="" />
  </div>

  <div class="form-group col-lg-4 col-md-4 col-ms-4 col-12">
   <label>WhatsApp Number</label>
   <input type="text" name="DoctorWhatsappNumber" value="<?php echo GET_DATA('DoctorWhatsappNumber'); ?>" placeholder="+91" class="form-control-2" required="" />
  </div>

  <div class="form-group col-lg-4 col-md-4 col-ms-4 col-12">
   <label>Telegram Number</label>
   <input type="text" name="DoctorTelegramNumber" value="<?php echo GET_DATA('DoctorTelegramNumber'); ?>" placeholder="+91" class="form-control-2" required="" />
  </div>

  <div class="form-group col-lg-4 col-md-4 col-ms-4 col-12">
   <label>Email-Id</label>
   <input type="email" name="DoctorEmailId" value="<?php echo GET_DATA('DoctorEmailId'); ?>" placeholder="abc@domain.ext" class="form-control-2" required="" />
  </div>

  <div class="form-group col-lg-12 col-md-12 col-ms-12 col-12">
   <label>Doctor Bio / Description</label>
   <textarea type="text" style="height:auto !important;" name="DoctorBio" rows="5" class="form-control-2" placeholder="Small Introduction" required=""><?php echo SECURE(GET_DATA('DoctorBio'), "d"); ?></textarea>
  </div>

  <div class="col-md-12 m-t-10">
   <h4 class="app-sub-heading">Address</h4>
  </div>

  <div class="form-group col-lg-4 col-md-4 col-ms-4 col-12">
   <label>Street Address</label>
   <input type="text" name="DoctorStreetAddress" value="<?php echo SECURE(GET_DATA('DoctorStreetAddress'), "d"); ?>" class="form-control-2" required="" />
  </div>
  <div class="form-group col-lg-4 col-md-4 col-ms-4 col-12">
   <label>Shop/Clinic No</label>
   <input type="text" name="DoctorAddressShopNo" value="<?php echo SECURE(GET_DATA('DoctorAddressShopNo'), "d"); ?>" class="form-control-2" required="" />
  </div>
  <div class="form-group col-lg-4 col-md-4 col-ms-4 col-12">
   <label>City</label>
   <input type="text" name="DoctorAddressCity" value="<?php echo GET_DATA('DoctorAddressCity'); ?>" class="form-control-2" required="" />
  </div>
  <div class="form-group col-lg-4 col-md-4 col-ms-4 col-12">
   <label>District</label>
   <input type="text" name="DoctorAddressDistrict" value="<?php echo GET_DATA('DoctorAddressCity'); ?>" class="form-control-2" required="" />
  </div>
  <div class="form-group col-lg-4 col-md-4 col-ms-4 col-12">
   <label>State</label>
   <input type="text" name="DoctorAddressState" value="<?php echo GET_DATA('DoctorAddressState'); ?>" class="form-control-2" required="" />
  </div>
  <div class="form-group col-lg-4 col-md-4 col-ms-4 col-12">
   <label>Pincode</label>
   <input type="text" name="DoctorAddressPincode" value="<?php echo GET_DATA('DoctorAddressPincode'); ?>" class="form-control-2" required="" />
  </div>

  <div class="col-md-12 m-t-10">
   <h4 class="app-sub-heading">Qualifications & Expertise</h4>
  </div>
  <div class="form-group col-lg-4 col-md-4 col-ms-4 col-12">
   <label>Doctor Qualifications</label>
   <input type="phone" name="DoctorQualifications" value="<?php echo GET_DATA('DoctorQualifications'); ?>" class="form-control-2" required="" />
  </div>
  <div class="form-group col-lg-4 col-md-4 col-ms-4 col-12">
   <label>Doctor Work Experience</label>
   <input type="phone" name="DoctorWorkExperience" value="<?php echo GET_DATA('DoctorWorkExperience'); ?>" class="form-control-2" required="" />
  </div>
  <div class="form-group col-lg-6 col-md-6 col-ms-6 col-12">
   <label>Expertise In Animals</label>
   <textarea type="text" style="height:auto !important;" name="DoctorExpertiseInAnimals" rows="5" class="form-control-2" placeholder="Enter animal name separated by commas" required=""><?php echo SECURE(GET_DATA('DoctorExpertiseInAnimals'), 'd'); ?></textarea>
  </div>
  <div class="form-group col-lg-6 col-md-6 col-ms-6 col-12">
   <label>Doctor Specilisation</label>
   <textarea type="text" style="height:auto !important;" name="DoctorSpecilisation" rows="5" class="form-control-2" required=""><?php echo SECURE(GET_DATA('DoctorSpecilisation'), 'd'); ?></textarea>
  </div>

  <div class="col-md-12 m-t-10">
   <h4 class="app-sub-heading">Payment & Fees</h4>
  </div>
  <div class="form-group col-lg-4 col-md-4 col-ms-4 col-12">
   <label>Doctor Consultanct Fee In Clinic</label>
   <input type="text" placeholder="Rs." name="DoctorConsultanctFeeInClinic" value="<?php echo GET_DATA('DoctorConsultanctFeeInClinic'); ?>" class="form-control-2" required="" />
  </div>

  <div class="form-group col-lg-4 col-md-4 col-ms-4 col-12">
   <label>Doctor Visiting Fee</label>
   <input type="text" placeholder="Rs." name="DoctorVisitingFee" value="<?php echo GET_DATA('DoctorVisitingFee'); ?>" class="form-control-2" required="" />
  </div>

  <div class="form-group col-lg-4 col-md-4 col-ms-4 col-12">
   <label>Doctor Fee For Phone Consultaning</label>
   <input type="text" placeholder="Rs." name="DoctorFeeForPhoneConsultaning" value="<?php echo GET_DATA('DoctorFeeForPhoneConsultaning'); ?>" class="form-control-2" required="" />
  </div>
  <div class="col-md-12 m-t-10">
   <h4 class="app-sub-heading">Photos</h4>
  </div>
  <div class="form-group col-lg-4 col-md-4 col-ms-4 col-12">
   <label>Doctor Profile Image</label>
   <input type="text" name="DoctorProfileImage_CURRENT" value="<?php echo SECURE(GET_DATA('DoctorProfileImage'), 'e'); ?>" hidden>
   <input type="FILE" name="DoctorProfileImage" value="null" class="form-control-2" />
   <img src="<?php echo STORAGE_URL; ?>/doctors/images/profile/<?php echo GET_DATA("DoctorProfileImage"); ?>" class="imgrpreview">
  </div>

  <div class="form-group col-lg-4 col-md-4 col-ms-4 col-12">
   <label>Doctor Profile Background Image</label>
   <input type="text" name="DoctorProfileBGImage_CURRENT" value="<?php echo SECURE(GET_DATA('DoctorProfileBGImage'), 'e'); ?>" hidden>
   <input type="FILE" name="DoctorProfileBGImage" value="null" class="form-control-2" />
   <img src="<?php echo STORAGE_URL; ?>/doctors/images/bg/<?php echo GET_DATA("DoctorProfileBGImage"); ?>" class="imgrpreview">
  </div>

  <div class="form-group col-md-6 col-lg-6 col-sm-6 col-12">
   <label>Doctor Listing Status</label>
   <select class="form-control-2" name="DoctorStatus" required="">
    <?php
    if (GET_DATA("DoctorStatus") == 1) { ?>
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
 <button type="Submit" name="UpdateDoctorProfile" valye="<?php echo SECURE($Requested_Doctorsid, "e"); ?>" class="btn btn-lg btn-success">Update Details</button>
 <a href="index.php" class="btn btn-lg btn-danger">Back</a>
</form>