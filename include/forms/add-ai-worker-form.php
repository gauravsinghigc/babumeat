<form class="data-form" action="<?php echo DOMAIN; ?>/controller/aiworkercontrollers.php" method="POST" enctype="multipart/form-data">
 <?php FormPrimaryInputs(true); ?>
 <div class="row">
  <div class="col-md-12">
   <h4 class="m-b-0 m-t-0">AI Worker Details</h4>
  </div>
  <div class="form-group col-lg-4 col-md-4 col-ms-4 col-12">
   <label>AI Worker Name</label>
   <input type="text" name="AIWorkerName" class="form-control-2" required="" />
  </div>
  <div class="form-group col-lg-4 col-md-4 col-ms-4 col-12">
   <label>Phone Number</label>
   <input type="text" min="10" max="12" name="AIWorkerMobileNumber" placeholder="+91" class="form-control-2" required="" />
  </div>

  <div class="form-group col-lg-4 col-md-4 col-ms-4 col-12">
   <label>WhatsApp Number</label>
   <input type="text" name="AIWorkerWhatsappNumber" placeholder="+91" class="form-control-2" required="" />
  </div>

  <div class="form-group col-lg-4 col-md-4 col-ms-4 col-12">
   <label>Telegram Number</label>
   <input type="text" name="AIWorkerTelegramNumber" placeholder="+91" class="form-control-2" required="" />
  </div>

  <div class="form-group col-lg-4 col-md-4 col-ms-4 col-12">
   <label>Email-Id</label>
   <input type="email" name="AIWorkerEmail" placeholder="abc@domain.ext" class="form-control-2" required="" />
  </div>

  <div class="form-group col-lg-12 col-md-12 col-ms-12 col-12">
   <label>Worker Bio / Description</label>
   <textarea type="text" style="height:auto !important;" name="AIWorkerDescriptions" rows="5" class="form-control-2" placeholder="Small Introduction" required=""></textarea>
  </div>

  <div class="col-md-12">
   <h4 class="m-b-0 m-t-0">Address</h4>
  </div>

  <div class="form-group col-lg-4 col-md-4 col-ms-4 col-12">
   <label>Street Address</label>
   <input type="text" name="AIWorkerStreetAddress" class="form-control-2" required="" />
  </div>
  <div class="form-group col-lg-4 col-md-4 col-ms-4 col-12">
   <label>Area</label>
   <input type="text" name="AIWorkerArea" class="form-control-2" required="" />
  </div>
  <div class="form-group col-lg-4 col-md-4 col-ms-4 col-12">
   <label>Village</label>
   <input type="text" name="AIWorkerVillage" class="form-control-2" required="" />
  </div>
  <div class="form-group col-lg-4 col-md-4 col-ms-4 col-12">
   <label>tehsil</label>
   <input type="text" name="AIWorkerTehsil" class="form-control-2" required="" />
  </div>
  <div class="form-group col-lg-4 col-md-4 col-ms-4 col-12">
   <label>District</label>
   <input type="text" name="AIWorkerDistrict" class="form-control-2" required="" />
  </div>
  <div class="form-group col-lg-4 col-md-4 col-ms-4 col-12">
   <label>city</label>
   <input type="text" name="AIWorkerCity" class="form-control-2" required="" />
  </div>
  <div class="form-group col-lg-4 col-md-4 col-ms-4 col-12">
   <label>state</label>
   <input type="text" name="AIWorkerState" class="form-control-2" required="" />
  </div>
  <div class="form-group col-lg-4 col-md-4 col-ms-4 col-12">
   <label>Pincode</label>
   <input type="text" name="AIWorkerPincode" class="form-control-2" required="" />
  </div>

  <div class="col-md-12">
   <h4 class="m-b-0 m-t-0">Qualifications & Expertise</h4>
  </div>
  <div class="form-group col-lg-4 col-md-4 col-ms-4 col-12">
   <label>Qualifications</label>
   <input type="text" name="AIWorkerQualification" class="form-control-2" required="" />
  </div>
  <div class="form-group col-lg-4 col-md-4 col-ms-4 col-12">
   <label>Work Experience</label>
   <input type="text" name="AIWorkerExperience" class="form-control-2" required="" />
  </div>
  <div class="form-group col-lg-6 col-md-6 col-ms-6 col-12">
   <label>Expertise In Animals</label>
   <textarea type="text" style="height:auto !important;" name="AIWorkerExpertiseIn" rows="5" class="form-control-2" placeholder="Enter animal name separated by commas" required=""></textarea>
  </div>
  <div class="form-group col-lg-6 col-md-6 col-ms-6 col-12">
   <label>Specilisation</label>
   <textarea type="text" style="height:auto !important;" name="AIWorkerSpecilization" rows="5" class="form-control-2" required=""></textarea>
  </div>

  <div class="col-md-12">
   <h4 class="m-b-0 m-t-0">Payment & Fees</h4>
  </div>
  <div class="form-group col-lg-4 col-md-4 col-ms-4 col-12">
   <label>Consultanct Fee</label>
   <input type="text" placeholder="Rs." name="AIWorkerConsultaningFee" class="form-control-2" required="" />
  </div>

  <div class="col-md-12">
   <h4 class="m-b-0 m-t-0">Photos</h4>
  </div>
  <div class="form-group col-lg-4 col-md-4 col-ms-4 col-12">
   <label>Profile Image</label>
   <input type="FILE" name="AIWorkerProfile" class="form-control-2" required="" />
  </div>

  <div class="form-group col-lg-4 col-md-4 col-ms-4 col-12">
   <label>Background Image</label>
   <input type="FILE" name="AIWorkerBGImage" class="form-control-2" required="" />
  </div>

 </div>


 <button type="Submit" onclick="form.submit()" value="null" name="SaveNewAIWsorker" class="btn btn-lg btn-success">Register</button>

</form>