<form class="data-form row" action="" method="GET">
  <div class="form-group col-lg-12 col-md-12 col-sm-12 col-12">
    <label>Animal Type</label>
    <select name="AnimalId" onchange="form.submit()" class="form-control-2" required="">
      <option value="0">Select Animal</option>
      <?php
      $FetchAnimalCategories = FetchConvertIntoArray("SELECT * FROM animalsname where AnimalStatus='1' ORDER BY AnimalName ASC", "AnimalName");
      if ($FetchAnimalCategories == null) {
        InputOptions(["Please Insert Categories First"]);
      } else {
        foreach ($FetchAnimalCategories as $RegAnimalCategory) { ?>
          <option value="<?php echo $RegAnimalCategory->AnimalId; ?>"><?php echo $RegAnimalCategory->AnimalName; ?></option>
      <?php }
      } ?>
    </select>
  </div>
</form>
<form class="data-form row" action="<?php echo DOMAIN; ?>/controller/animalcontroller.php" method="POST" enctype="multipart/form-data">
  <?php if (isset($_GET['AnimalId'])) { ?>
    <input type="text" hidden="" name="RegAnimalCategory" value="<?php echo $_GET['AnimalId']; ?>"> <?php } ?>
  <div class="form-group col-lg-4 col-md-4 col-ms-4 col-12">
    <label>Animal Breeds</label>
    <?php
    if (isset($_GET['AnimalId'])) {
      $AnimalId = $_GET['AnimalId'];
      $FetchAnimalCategories = FetchConvertIntoArray("SELECT * FROM animalbreeds where AnimalId='$AnimalId' and BreedStatus='1' ORDER BY BreedName ASC", "BreedName");
    } else {
      $FetchAnimalCategories = FetchConvertIntoArray("SELECT * FROM animalbreeds where BreedStatus='1' ORDER BY BreedName ASC", "BreedName");
    }
    if ($FetchAnimalCategories == null) { ?>
      <select name="RegAnimalBreed" class="form-control-2" required="">
        <?php InputOptions(["Please Insert Breed First"]); ?>
      </select>
    <?php } else { ?>
      <select name="RegAnimalBreed" class="form-control-2" required="">
        <?php foreach ($FetchAnimalCategories as $RegAnimalCategory) { ?>
          <option value="<?php echo $RegAnimalCategory->AnimalBreedId; ?>"><?php echo $RegAnimalCategory->BreedName; ?></option>
        <?php } ?>
      </select>
    <?php } ?>
  </div>
  <?php FormPrimaryInputs(true); ?>
  <div class="form-group col-lg-4 col-md-4 col-ms-4 col-12">
    <label>Enter Animal Name/Title</label>
    <input type="text" name="RegAnimalTitle" class="form-control-2" required="" />
  </div>
  <div class="form-group col-lg-4 col-md-4 col-ms-4 col-12">
    <label>Registration Type</label>
    <select name="RegAnimalRegType" onmouseover="PriceStatus()" onmouseout="PriceStatus()" id="RegType" class="form-control-2" required="">
      <?php InputOptions(["Sell", "Adoptions"]) ?>
    </select>
  </div>
  <div class="form-group col-lg-4 col-md-4 col-ms-4 col-12">
    <label>Registration Purpose</label>
    <select name="RegAnimalPurpose" onmouseover="MilkStatus()" onmouseout="MilkStatus()" id="MilkType" class="form-control-2" required="">
      <?php InputOptions(["Milking", "Non Milking"]) ?>
    </select>
  </div>
  <div class="form-group col-lg-4 col-md-4 col-ms-4 col-12">
    <label>Animal Age (in Months)</label>
    <input type="text" name="RegAnimalAge" placeholder="12 Months" class="form-control-2" required="" />
  </div>
  <div class="form-group col-lg-4 col-md-4 col-ms-4 col-12">
    <label>Animal Teeth</label>
    <input type="text" name="RegAnimalTeeth" class="form-control-2" required="" />
  </div>
  <div class="form-group col-lg-4 col-md-4 col-ms-4 col-12">
    <label>Animal Calving</label>
    <input type="text" name="RegAnimalCalving" class="form-control-2" required="" />
  </div>
  <div id="milktab">
    <div class="form-group col-lg-4 col-md-4 col-ms-4 col-12">
      <label>Milk Per Days</label>
      <input type="text" name="RegAnimalMilkQty" placeholder="1 Litre" class="form-control-2" required="" />
    </div>
    <div class="form-group col-lg-4 col-md-4 col-ms-4 col-12">
      <label>Maximum Milk</label>
      <input type="text" name="RegAnimalMaxMilk" placeholder="10 Litre" class="form-control-2" required="" />
    </div>
  </div>
  <div id="pricetab">
    <div class="form-group col-lg-4 col-md-4 col-ms-4 col-12">
      <label>Price Type</label>
      <select name="RegAnimalPriceType" class="form-control-2" required="">
        <?php InputOptions(["Fixed", "Negotiable"]); ?>
      </select>
    </div>
    <div class="form-group col-lg-4 col-md-4 col-ms-4 col-12">
      <label>Price</label>
      <input type="text" name="RegAnimalPrice" class="form-control-2" required="" />
    </div>
  </div>
  <div class="form-group col-lg-12 col-md-12 col-ms-12 col-12">
    <label>Animal Descriptions</label>
    <textarea type="text" style="height:auto !important;" id="editor" name="RegAnimalDetails" rows="5" class="form-control-2" required=""></textarea>
  </div>
  <div class="col-md-12">
    <h4 class="app-heading m-t-10">Select Images</h4>
  </div>
  <div class="form-group col-lg-3 col-md-3 col-ms-4 col-6">
    <label for="AnimalImg1">1st Image</label>
    <input type="FILE" name="AnimalImage1" id="AnimalImg1" accept="images/*" required="">
  </div>
  <div class="form-group col-lg-3 col-md-3 col-ms-4 col-6">
    <label for="AnimalImg2">2nd Image</label>
    <input type="FILE" name="AnimalImage2" id="AnimalImg2" accept="images/*" required="">
  </div>
  <div class="form-group col-lg-3 col-md-3 col-ms-4 col-6">
    <label for="AnimalImg3">3rd Image</label>
    <input type="FILE" name="AnimalImage3" id="AnimalImg3" accept="images/*" required="">
  </div>
  <div class="form-group col-lg-3 col-md-3 col-ms-4 col-6">
    <label for="AnimalImg4">4rth Image</label>
    <input type="FILE" name="AnimalImage4" id="AnimalImg4" accept="images/*" required="">
  </div>
  <div class="col-md-12">
    <h4 class="app-heading">Upload One Video</h4>
  </div>
  <div class="form-group col-lg-3 col-md-3 col-ms-4 col-6">
    <input type="FILE" name="AnimalVideo1" id="AnimalImg4" accept="video/mp4,video/x-m4v,video/*" required="">
  </div>
  <div class="col-md-12">
    <button type="Submit" onclick="form.submit()" value="null" name="RegistrerNewAnimals" class="btn btn-lg btn-success">Regsiter Animal</button>
  </div>
</form>
<script>
  function PriceStatus() {
    var RegType = document.getElementById("RegType");
    if (RegType.value === "Sell") {
      document.getElementById("pricetab").style.display = "block";
    } else {
      document.getElementById("pricetab").style.display = "none";
    }
  }

  function MilkStatus() {
    var MilkType = document.getElementById("MilkType");
    if (MilkType.value === "Milking") {
      document.getElementById("milktab").style.display = "block";
    } else {
      document.getElementById("milktab").style.display = "none";
    }
  }
</script>