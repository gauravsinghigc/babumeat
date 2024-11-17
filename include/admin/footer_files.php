<?php include(__DIR__ . "/message.php"); ?>

<script src="<?php echo ASSETS_URL; ?>/admin-assets/js/jquery-2.1.1.min.js"></script>
<script src="<?php echo ASSETS_URL; ?>/admin-assets/js/bootstrap.min.js"></script>
<script src="<?php echo ASSETS_URL; ?>/admin-assets/plugins/fast-click/fastclick.min.js"></script>
<script src="<?php echo ASSETS_URL; ?>/admin-assets/plugins/switchery/switchery.min.js"></script>
<script src="<?php echo ASSETS_URL; ?>/admin-assets/plugins/bootstrap-select/bootstrap-select.min.js"></script>
<script src="<?php echo ASSETS_URL; ?>/admin-assets/plugins/nanoscrollerjs/jquery.nanoscroller.min.js"></script>
<script src="<?php echo ASSETS_URL; ?>/admin-assets/plugins/metismenu/metismenu.min.js"></script>
<script src="<?php echo ASSETS_URL; ?>/admin-assets/js/scripts.js"></script>
<script src="<?php echo ASSETS_URL; ?>/admin-assets/plugins/parsley/parsley.min.js"></script>
<script src="<?php echo ASSETS_URL; ?>/admin-assets/plugins/jquery-steps/jquery-steps.min.js"></script>
<script src="<?php echo ASSETS_URL; ?>/admin-assets/plugins/bootstrap-wizard/jquery.bootstrap.wizard.min.js"></script>
<script src="<?php echo ASSETS_URL; ?>/admin-assets/plugins/masked-input/bootstrap-inputmask.min.js"></script>
<script src="<?php echo ASSETS_URL; ?>/admin-assets/plugins/bootstrap-validator/bootstrapValidator.min.js"></script>
<script src="<?php echo ASSETS_URL; ?>/admin-assets/plugins/moment/moment.min.js"></script>
<script src="<?php echo ASSETS_URL; ?>/admin-assets/plugins/moment-range/moment-range.js"></script>
<script src="<?php echo ASSETS_URL; ?>/admin-assets/plugins/jquery-ricksaw-chart/js/raphael-min.js"></script>
<script src="<?php echo ASSETS_URL; ?>/admin-assets/plugins/jquery-ricksaw-chart/js/d3.v2.js"></script>
<script src="<?php echo ASSETS_URL; ?>/admin-assets/plugins/summernote/summernote.min.js"></script>
<script src="<?php echo ASSETS_URL; ?>/admin-assets/plugins/screenfull/screenfull.js"></script>
<script src="<?php echo ASSETS_URL; ?>/admin-assets/js/demo/wizard.js"></script>
<script src="<?php echo ASSETS_URL; ?>/admin-assets/js/demo/form-wizard.js"></script>
<script src="<?php echo ASSETS_URL; ?>/admin-assets/js/toggler.js"></script>
<script src="<?php echo ASSETS_URL; ?>/admin-assets/plugins/tag-it/tag-it.min.js"></script>
<script src="<?php echo ASSETS_URL; ?>/admin-assets/plugins/chosen/chosen.jquery.min.js"></script>
<script src="<?php echo ASSETS_URL; ?>/admin-assets/js/demo/form-component.js"></script>
<script src="<?php echo ASSETS_URL; ?>/admin-assets/plugins/datatables/media/js/jquery.dataTables.js"></script>
<script src="<?php echo ASSETS_URL; ?>/admin-assets/plugins/datatables/media/js/dataTables.bootstrap.js"></script>
<script src="<?php echo ASSETS_URL; ?>/admin-assets/plugins/datatables/extensions/Responsive/js/dataTables.responsive.min.js"></script>
<script src="<?php echo ASSETS_URL; ?>/admin-assets/js/demo/tables-datatables.js"></script>
<script>
  function Databar(data) {
    databar = document.getElementById("" + data + "");
    if (databar.style.display === "block") {
      databar.style.display = "none";
    } else {
      databar.style.display = "block";
    }
  }
</script>

<script>
  tagger(document.querySelector('[name="options"]'), {});
</script>
<script>
  uploadimage.onchange = evt => {
    const [file] = uploadimage.files
    if (file) {
      ImgPreview.src = URL.createObjectURL(file);
    }
  }
  uploadfile.onchange = evt => {
    const [file] = uploadfile.files
    if (file) {
      FilePreview.src = URL.createObjectURL(file);
    }
  }
</script>