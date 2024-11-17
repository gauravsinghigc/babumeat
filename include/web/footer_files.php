<?php
//view msg
include(__DIR__ . "/message.php");
BacktoPrevious($access = true); ?>

<!--search jQuery-->
<script src="<?php echo ASSETS_URL; ?>/web/js/modernizr-2.6.2.min.js"></script>
<script src="<?php echo ASSETS_URL; ?>/web/js/classie-search.js"></script>
<script src="<?php echo ASSETS_URL; ?>/web/js/demo1-search.js"></script>
<!--//search jQuery-->
<!-- cart-js -->
<script src="<?php echo ASSETS_URL; ?>/web/js/minicart.js"></script>
<script src="<?php echo ASSETS_URL; ?>/web/js/jquery-2.2.3.min.js"></script>
<script src="<?php echo ASSETS_URL; ?>/web/js/jquery-ui1.js"></script>
<script src="<?php echo ASSETS_URL; ?>/web/js/imagezoom.js"></script>
<script src="<?php echo ASSETS_URL; ?>/web/js/easy-responsive-tabs.js"></script>
<script src="<?php echo ASSETS_URL; ?>/web/js/jquery.flexslider.js"></script>

<script>
  googles.render();

  googles.cart.on('googles_checkout', function(evt) {
    var items, len, i;

    if (this.subtotal() > 0) {
      items = this.items();

      for (i = 0, len = items.length; i < len; i++) {}
    }
  });
</script>
<!-- //cart-js -->
<script>
  $(document).ready(function() {
    $(".button-log a").click(function() {
      $(".overlay-login").fadeToggle(200);
      $(this).toggleClass('btn-open').toggleClass('btn-close');
    });
  });
  $('.overlay-close1').on('click', function() {
    $(".overlay-login").fadeToggle(200);
    $(".button-log a").toggleClass('btn-open').toggleClass('btn-close');
    open = false;
  });
</script>
<!-- carousel -->
<!-- Count-down -->
<script>
  var d = new Date();
  simplyCountdown('simply-countdown-custom', {
    year: d.getFullYear(),
    month: d.getMonth() + 2,
    day: 25
  });
</script>
<script src="<?php echo ASSETS_URL; ?>/web/js/owl.carousel.js">
</script>
<script>
  $(document).ready(function() {
    $('.owl-carousel').owlCarousel({
      loop: true,
      margin: 10,
      responsiveClass: true,

      responsive: {
        0: {
          items: 2,
          nav: true
        },
        600: {
          items: 2,
          nav: false
        },
        900: {
          items: 3,
          nav: false
        },
        1000: {
          items: 4,
          nav: true,
          loop: true,
          margin: 20
        }
      }
    })
  })
</script>

<script>
  $(document).ready(function() {
    $(".dropdown").hover(
      function() {
        $('.dropdown-menu', this).stop(true, true).slideDown("fast");
        $(this).toggleClass('open');
      },
      function() {
        $('.dropdown-menu', this).stop(true, true).slideUp("fast");
        $(this).toggleClass('open');
      }
    );
  });
</script>
<script src="<?php echo ASSETS_URL; ?>/web/js/move-top.js"></script>
<script src="<?php echo ASSETS_URL; ?>/web/js/easing.js"></script>
<script>
  jQuery(document).ready(function($) {
    $(".scroll").click(function(event) {
      event.preventDefault();
      $('html,body').animate({
        scrollTop: $(this.hash).offset().top
      }, 900);
    });
  });
</script>
<script>
  $(document).ready(function() {

    var defaults = {
      containerID: 'toTop', // fading element id
      containerHoverID: 'toTopHover', // fading element hover id
      scrollSpeed: 1200,
      easingType: 'linear'
    };

    $().UItoTop({
      easingType: 'easeOutQuart'
    });

  });
</script>

<script src="<?php echo ASSETS_URL; ?>/web/js/bootstrap.js"></script>
<script>
  //scroll acitivity
  window.onscroll = function() {
    myFunction();
  };
  var header2 = document.getElementById("app-top-header");
  var sticky = header2.offsetTop;

  function myFunction() {
    if (window.pageYOffset > sticky) {
      header2.classList.add("fixed-top");
    } else {
      header2.classList.remove("fixed-top");
    }
  }
</script>
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
  function AuthAccess() {
    var SignupArea = document.getElementById("SignupArea");
    var LoginArea = document.getElementById("LoginArea");
    if (LoginArea.style.display === "none") {
      LoginArea.style.display = "block";
      SignupArea.style.display = "none";
    } else {
      LoginArea.style.display = "none";
      SignupArea.style.display = "block";
    }
  }
</script>
<script>
  function checkpass() {
    var pass1 = document.getElementById("pass1");
    var pass2 = document.getElementById("pass2");
    if (pass1.value === "") {

    } else {
      if (pass1.value === pass2.value) {
        document.getElementById("passbtn").classList.remove("disabled");
        document.getElementById("passmsg").classList.add("text-success");
        document.getElementById("passmsg").classList.remove("text-danger");
        document.getElementById("passmsg").innerHTML = "<i class='fa fa-check-circle-o'></i> Password Matched!";
      } else {
        document.getElementById("passmsg").classList.remove("text-success");
        document.getElementById("passmsg").classList.add("text-danger");
        document.getElementById("passbtn").classList.add("disabled");
        document.getElementById("passmsg").innerHTML = "<i class='fa fa-warning'></i> Password do not matched!";
      }
    }
  }
</script>
<script>
  window.addEventListener("load", function() {
    var formviewstatus = sessionStorage.getItem("formstatus");
    if (formviewstatus === "true") {
      document.getElementById("ViewForm2").style.display = "none";
      document.getElementById("Authformlogo").style.display = "none";
    } else {
      document.getElementById("ViewForm2").style.display = "block";
      document.getElementById("Authformlogo").style.display = "block";
    }
  });
</script>
<script>
  function hideform() {
    document.getElementById("ViewForm2").style.display = "none";
    document.getElementById("Authformlogo").style.display = "none";
    sessionStorage.setItem("formstatus", "true");
  }

  function showform() {
    document.getElementById("ViewForm2").style.display = "block";
    document.getElementById("Authformlogo").style.display = "block";
    sessionStorage.setItem("formstatus", "false");
  }
</script>
<script>
  uploadimage.onchange = evt => {
    const [file] = uploadimage.files
    if (file) {
      ImgPreview.src = URL.createObjectURL(file);
    }
  }
</script>

<script>
  uploadfile.onchange = evt => {
    const [file] = uploadfile.files
    if (file) {
      FilePreview.src = URL.createObjectURL(file);
    }
  }
</script>
<script>
  //<![CDATA[
  $(window).load(function() {
    $("#slider-range").slider({
      range: true,
      min: 0,
      max: 9000,
      values: [50, 6000],
      slide: function(event, ui) {
        $("#amount").val("$" + ui.values[0] + " - $" + ui.values[1]);
      }
    });
    $("#amount").val("$" + $("#slider-range").slider("values", 0) + " - $" + $("#slider-range").slider("values", 1));

  }); //]]>
</script>
<script>
  $(document).ready(function() {
    $('#horizontalTab').easyResponsiveTabs({
      type: 'default', //Types: default, vertical, accordion
      width: 'auto', //auto or any width like 600px
      fit: true, // 100% fit in a container
      closed: 'accordion', // Start closed if in accordion view
      activate: function(event) { // Callback function if tab is switched
        var $tab = $(this);
        var $info = $('#tabInfo');
        var $name = $('span', $info);
        $name.text($tab.text());
        $info.show();
      }
    });
    $('#verticalTab').easyResponsiveTabs({
      type: 'vertical',
      width: 'auto',
      fit: true
    });
  });
</script>
<script>
  // Can also be used with $(document).ready()
  $(window).load(function() {
    $('.flexslider1').flexslider({
      animation: "slide",
      controlNav: "thumbnails"
    });
  });
</script>