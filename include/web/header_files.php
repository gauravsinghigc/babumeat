<?php if (DEVICE_TYPE == "Computer") { ?>
  <link href="<?php echo ASSETS_URL; ?>/web/css/bootstrap.css" rel='stylesheet' type='text/css' />
  <link href="<?php echo ASSETS_URL; ?>/web/css/login_overlay.css" rel='stylesheet' type='text/css' />
  <link href="<?php echo ASSETS_URL; ?>/web/css/style6.css" rel='stylesheet' type='text/css' />
  <link rel="stylesheet" href="<?php echo ASSETS_URL; ?>/web/css/shop.css" type="text/css" />
  <link rel="stylesheet" href="<?php echo ASSETS_URL; ?>/web/css/owl.carousel.css" type="text/css" media="all">
  <link rel="stylesheet" href="<?php echo ASSETS_URL; ?>/web/css/owl.theme.css" type="text/css" media="all">
  <link href="<?php echo ASSETS_URL; ?>/web/css/style.css" rel='stylesheet' type='text/css' />
  <link href="<?php echo ASSETS_URL; ?>/web/css/app.css" rel='stylesheet' type='text/css' />
  <link href="<?php echo ASSETS_URL; ?>/web/css/responsive.css" rel='stylesheet' type='text/css' />
  <link href="<?php echo ASSETS_URL; ?>/web/css/fontawesome-all.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="<?php echo ASSETS_URL; ?>/web/css/jquery-ui1.css">
  <link href="<?php echo ASSETS_URL; ?>/web/css/easy-responsive-tabs.css" rel='stylesheet' type='text/css' />
  <link rel="stylesheet" href="<?php echo ASSETS_URL; ?>/web/css/flexslider.css" type="text/css" media="screen" />
  <link href="//fonts.googleapis.com/css?family=Inconsolata:400,700" rel="stylesheet">
  <link href="//fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800" rel="stylesheet">
  <script src="<?php echo ASSETS_URL; ?>/web/js/textarea.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://cdn.jsdelivr.net/npm/lazyload@2.0.0-rc.2/lazyload.js"></script>
<?php } else { ?>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js" integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.2.1/css/fontawesome.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/solid.min.css" integrity="sha512-6mc0R607di/biCutMUtU9K7NtNewiGQzrvWX4bWTeqmljZdJrwYvKJtnhgR+Ryvj+NRJ8+NnnCM/biGqMe/iRA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="<?php echo ASSETS_URL; ?>/web/css/mobile.css" rel='stylesheet' type='text/css' />
<?php } ?>
<script>
  tinymce.init({
    selector: 'textarea#editor',
    menubar: false
  });
</script>