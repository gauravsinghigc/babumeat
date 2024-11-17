<form class="data-form" action="<?php echo DOMAIN; ?>/controller/doctorcontroller.php" method="POST" enctype="multipart/form-data">
 <?php FormPrimaryInputs(true); ?>
 <div class="row">
  <div class="form-group col-lg-4 col-md-4 col-ms-4 col-12">
   <label>Doctor Name</label>
   <input type="text" name="DoctorName" class="form-control-2" required="" />
  </div>
  <div class="form-group col-lg-4 col-md-4 col-ms-4 col-12">
   <label>Phone Number</label>
   <input type="text" min="10" max="12" name="DoctorMobileNumber" placeholder="+91" class="form-control-2" required="" />
  </div>

  <div class="form-group col-lg-4 col-md-4 col-ms-4 col-12">
   <label>WhatsApp Number</label>
   <input type="text" name="DoctorWhatsappNumber" placeholder="+91" class="form-control-2" required="" />
  </div>

  <div class="form-group col-lg-4 col-md-4 col-ms-4 col-12">
   <label>Telegram Number</label>
   <input type="text" name="DoctorTelegramNumber" placeholder="+91" class="form-control-2" required="" />
  </div>

  <div class="form-group col-lg-4 col-md-4 col-ms-4 col-12">
   <label>Email-Id</label>
   <input type="email" name="DoctorEmailId" placeholder="abc@domain.ext" class="form-control-2" required="" />
  </div>

  <div class="form-group col-lg-12 col-md-12 col-ms-12 col-12">
   <label>Doctor Bio / Description</label>
   <textarea type="text" style="height:auto !important;" name="DoctorBio" rows="5" class="form-control-2" placeholder="Small Introduction" required=""></textarea>
  </div>

  <div class="col-md-12 m-t-10">
   <h4 class="app-sub-heading">Address</h4>
  </div>

  <div class="form-group col-lg-4 col-md-4 col-ms-4 col-12">
   <label>Street Address</label>
   <input type="text" name="DoctorStreetAddress" class="form-control-2" required="" />
  </div>
  <div class="form-group col-lg-4 col-md-4 col-ms-4 col-12">
   <label>Shop/Clinic No</label>
   <input type="text" name="DoctorAddressShopNo" class="form-control-2" required="" />
  </div>
  <div class="form-group col-lg-4 col-md-4 col-ms-4 col-12">
   <label>City</label>
   <input type="text" name="DoctorAddressCity" class="form-control-2" required="" />
  </div>
  <div class="form-group col-lg-4 col-md-4 col-ms-4 col-12">
   <label>District</label>
   <input type="text" name="DoctorAddressDistrict" class="form-control-2" required="" />
  </div>
  <div class="form-group col-lg-4 col-md-4 col-ms-4 col-12">
   <label>State</label>
   <input type="text" name="DoctorAddressState" class="form-control-2" required="" />
  </div>
  <div class="form-group col-lg-4 col-md-4 col-ms-4 col-12">
   <label>Pincode</label>
   <input type="text" name="DoctorAddressPincode" class="form-control-2" required="" />
  </div>

  <div class="col-md-12 m-t-10">
   <h4 class="app-sub-heading">Qualifications & Expertise</h4>
  </div>
  <div class="form-group col-lg-4 col-md-4 col-ms-4 col-12">
   <label>Doctor Qualifications</label>
   <input type="phone" name="DoctorQualifications" class="form-control-2" required="" />
  </div>
  <div class="form-group col-lg-4 col-md-4 col-ms-4 col-12">
   <label>Doctor Work Experience</label>
   <input type="phone" name="DoctorWorkExperience" class="form-control-2" required="" />
  </div>
  <div class="form-group col-lg-6 col-md-6 col-ms-6 col-12">
   <label>Expertise In Animals</label>
   <textarea type="text" style="height:auto !important;" name="DoctorExpertiseInAnimals" rows="5" class="form-control-2" placeholder="Enter animal name separated by commas" required=""></textarea>
  </div>
  <div class="form-group col-lg-6 col-md-6 col-ms-6 col-12">
   <label>Doctor Specilisation</label>
   <textarea type="text" style="height:auto !important;" name="DoctorSpecilisation" rows="5" class="form-control-2" required=""></textarea>
  </div>

  <div class="col-md-12 m-t-10">
   <h4 class="app-sub-heading">Payment & Fees</h4>
  </div>
  <div class="form-group col-lg-4 col-md-4 col-ms-4 col-12">
   <label>Doctor Consultanct Fee In Clinic</label>
   <input type="text" placeholder="Rs." name="DoctorConsultanctFeeInClinic" class="form-control-2" required="" />
  </div>

  <div class="form-group col-lg-4 col-md-4 col-ms-4 col-12">
   <label>Doctor Visiting Fee</label>
   <input type="text" placeholder="Rs." name="DoctorVisitingFee" class="form-control-2" required="" />
  </div>

  <div class="form-group col-lg-4 col-md-4 col-ms-4 col-12">
   <label>Doctor Fee For Phone Consultaning</label>
   <input type="text" placeholder="Rs." name="DoctorFeeForPhoneConsultaning" class="form-control-2" required="" />
  </div>
  <div class="col-md-12 m-t-10">
   <h4 class="app-sub-heading">Photos</h4>
  </div>
  <div class="form-group col-lg-4 col-md-4 col-ms-4 col-12">
   <label>Doctor Profile Image</label>
   <input type="FILE" name="DoctorProfileImage" class="form-control-2" required="" />
  </div>

  <div class="form-group col-lg-4 col-md-4 col-ms-4 col-12">
   <label>Doctor Profile Background Image</label>
   <input type="FILE" name="DoctorProfileBGImage" class="form-control-2" required="" />
  </div>

 </div>

 <br>
 <button type="Submit" onclick="form.submit()" value="null" name="SaveNewDoctors" class="btn btn-lg btn-success">Register</button>
 <a href="index.php" class="btn btn-lg btn-danger">Back to All</a>
</form>