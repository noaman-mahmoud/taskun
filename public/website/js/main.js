// loader
$(window).on("load", function () {
  $("#loader").delay(200).fadeOut(2000, function () {
    $("body").css("overflow", "auto");
  });
});

$(document).ready(function () {
    "use strict";
    let isRtl = $('html[lang="ar"]').length > 0;


// when click to responsive btn show ul and overlay
    $(".nav-btn").click(function() {
      $(this).addClass('active');
      $(".nav-links").addClass('active');
      $(".nav-overlay").addClass('show')
    })

    // when i click on overlay remove class show and remove ul

    $(".nav-overlay").click(function() {
      $(".nav-btn").removeClass('active');
      $(".nav-links").removeClass('active');
      $(".nav-overlay").removeClass('show')
    })

    // select-2
    $('.select-plugin').select2({
      dir: isRtl ? "rtl" : "ltr"
  });

  $('.select').select2({
      dir: isRtl ? "rtl" : "ltr"
  });

  // toggle class active by clcik on to nav-item

  $(".map-list .nav-item .nav-link").click(function() {
    $(".map-list .nav-item").removeClass('active');
    $(this).parents('.nav-item').addClass('active')
  })

  $(".nav-pills .nav-item a").click(function() {
    $(".nav-item").removeClass('active');
    $(this).parents('.nav-item').addClass('active')
  })

  $(".like i").click(function() {
    var plusN = parseInt($(".like i").siblings().html());
    $(this).parents('.like').toggleClass('active')
    if ($(this).parents('.like').hasClass('active')) {
      $(this).siblings('span').html(plusN + 1);
      console.log("aaaaaaa")
    } else {
      $(this).siblings('span').html(plusN - 1);
    }
  })

  /*====================== responsive-footer-links-collapse=======================*/
  if ($(window).width() <= 768) {
    $(".footer-section .links").stop().slideUp(0);
    $(".foot-title").click(function () {
        if ($(this).hasClass('active')) {
            $(this).removeClass('active')
            $(this).siblings(".links").stop().slideUp();
        } else {
            $(".foot-title").removeClass('active')
            $(".footer-section .links").stop().slideUp();
            $(this).addClass('active')
            $(this).siblings(".links").stop().slideDown();
        }
    });
  };

  $(':input[type="number"]').on("input", function() {
    var nonNumReg = /[^0-9]/g
    $(this).val($(this).val().replace(nonNumReg, ''));
  })

  // filter-icon / when i click it show filter-sidebar and overlay
  $(".filter-icon").click(function() {
    $(".filter-input").addClass('show');
    $(".overlay-filter-input").addClass('show');
  });

  $(".overlay-filter-input").click(function() {
    $(".filter-input").removeClass('show');
    $(this).removeClass('show');
  });

  $( ".addphonenum" ).focus(function() {
    $(this).parents('.added-another-input').addClass('show')
  });

// input range
    if($(".js-range-slider").length > 0) {
      $(".js-range-slider").ionRangeSlider({
        type: "double",
        // grid: true,
        min: 0,
        max: 1000000,
        from: 3000,
        to: 10000,
        prefix :`<span class="${ $(".js-range-slider").attr("data-curensy")}">${ $(".js-range-slider").attr("data-curensy")}</span>`
      });
    }

    if($(".js-range-slider-2").length > 0){
      $(".js-range-slider-2").ionRangeSlider({
        type: "double",
        // grid: true,
        min: 0,
        max: 1000,
        from: 200,
        to: 800,
        prefix :`<span class="${ $(".js-range-slider-2").attr("data-curensy")}">${ $(".js-range-slider-2").attr("data-curensy")}</span>`
      });
    }
    if($(".js-range-slider-3").length > 0){
      $(".js-range-slider-3").ionRangeSlider({
        type: "double",
        // grid: true,
        min: 0,
        max: 1000,
        from: 200,
        to: 800,
      });
    }
    if($(".js-range-slider-4").length > 0){
      $(".js-range-slider-4").ionRangeSlider({
        type: "double",
        // grid: true,
        min: 0,
        max: 1000,
        from: 200,
        to: 800,
        prefix :`<span class="${ $(".js-range-slider-4").attr("data-curensy")}">${ $(".js-range-slider-4").attr("data-curensy")}</span>`
      });
    }

    $('.category-box .fave, .room-banner .inner .icons .icon').click(function(e) {
      e.preventDefault();
      $(this).toggleClass('active');
    });

    $('.banner-slider').owlCarousel({
      items:1,
      loop:true,
      autoplay: true,
      rtl:isRtl,
      margin:10,
      nav:false,
      autoplaySpeed: 2000,
      autoplayTimeout: 2000,
      smartSpeed: 2000,
      responsive: {
        320: {
          // autoplay: true,
          // loop: true,
          autoplaySpeed: 3000,
          autoplayTimeout: 5000,
          smartSpeed: 2000,
      },
      //   2561: {
      //     items: 1,
      //     autoplay: true,
      //     loop: true,
      // },
    }
  });

  $(".input-select .select").change(function () {
    if ($(".input-select .select option:selected").attr('data-attr') === "real-estate-office") {
        $(".input-estate-office").removeClass('d-none');
    }
    else {
        $(".input-estate-office").addClass('d-none');
    }
});

  //    new-update-js
  $( ".info-product:odd" ).css( "background-color", "#F5F5F5" );

  var $temp = $("<input>");
  var $url = $(location).attr('href');

  $('.clipboard').on('click', function() {
    $("body").append($temp);
    $temp.val($url).select();
    document.execCommand("copy");
    $temp.remove();

  });

  $(".title-info-btn .clipboard").click(function() {
    $(".title-info-btn .clipboard").addClass('active');
    setTimeout(function() {
      $(".title-info-btn .clipboard").removeClass('active');
    }, 800);
  });

  $(document).ready(function(){
    $('.code-confirmation input').keyup(function(){
      if($(this).val().length==$(this).attr("maxlength")){
        $(this).next().focus();
      }
    });
  });

});
