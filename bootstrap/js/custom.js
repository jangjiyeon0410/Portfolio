// JavaScript Document

$(window).load(function () {
  "use strict";
  // makes sure the whole site is loaded
  $("#status").fadeOut(); // will first fade out the loading animation
  $("#preloader").delay(3000).fadeOut("slow"); // will fade out the white DIV that covers the website.
  $("body").delay(3000).css({
    overflow: "visible",
  });
});

$(document).ready(function () {
  "use strict";

  // scroll menu
  var sections = $(".section"),
    nav = $(".navbar-fixed-top"),
    nav_height = nav.outerHeight();

  $(window).on("scroll", function () {
    var cur_pos = $(this).scrollTop();

    sections.each(function () {
      var top = $(this).offset().top - nav_height-100,
        bottom = top + $(this).outerHeight();

      if (cur_pos >= top && cur_pos <= bottom) {
        nav.find("a").removeClass("active");
        sections.removeClass("active");

        $(this).addClass("active");
        nav.find('a[href="#' + $(this).attr("id") + '"]').addClass("active");
      }
    });
  });

  nav.find("a").on("click", function () {
    var $el = $(this),
      id = $el.attr("href");

    $("html, body").animate(
      {
        scrollTop: $(id).offset().top - nav_height + 2,
      },
      600
    );

    return false;
  });

  $(".topMove").click(function (e) {
    e.preventDefault();
    $("html,body").stop().animate({ scrollTop: 0 }, 1000);
  });



  // Menu opacity
  if ($(window).scrollTop() > 80) {
    $(".navbar-fixed-top").addClass("bg-nav");
  } else {
    $(".navbar-fixed-top").removeClass("bg-nav");
  }
  $(window).scroll(function () {
    if ($(window).scrollTop() > 80) {
      $(".navbar-fixed-top").addClass("bg-nav");
    } else {
      $(".navbar-fixed-top").removeClass("bg-nav");
    }
  });

  // Parallax
  var parallax = function () {
    $(window).stellar();
  };

  $(function () {
    parallax();
  });

  // AOS
  AOS.init({
    duration: 1200,
    once: true,
    disable: "mobile",
  });

  //  isotope
  $("#albums").waitForImages(function () {
    var $container = $(".portfolio_container");
    $container.isotope({
      filter: "*",
    });

    $(".portfolio_filter a").click(function () {
      $(".portfolio_filter .active").removeClass("active");
      $(this).addClass("active");

      var selector = $(this).attr("data-filter");
      $container.isotope({
        filter: selector,
        animationOptions: {
          duration: 500,
          animationEngine: "jquery",
        },
      });
      return false;
    });
  });

  //animatedModal
  $(
    "#demo01,#demo02,#demo03,#demo04,#demo05,#demo06,#demo07,#demo08,#demo09"
  ).animatedModal();
});

//Modal contents
let ind = 0;

$.ajax({
  url: "./js/albums.json",
  dataType: "json",
  success: function (data) {
    let useAlbums = data.albums;

    function albums_func(ind) {
      let albumsTxt = "";
      albumsTxt +=
        `<div class="container"><div class="portfolio-padding"><div class="col-md-8 col-md-offset-2">
          <strong>${useAlbums[ind].title}</strong>
          <span>${useAlbums[ind].songTitle}</span>
          <div class="video-container">
            <iframe src="${useAlbums[ind].url}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen>
          </iframe>
          </div>
          ${useAlbums[ind].text}
          </div>
          </div>
      </div>`

      $(".modal-content").html(albumsTxt);
    }
    $(document).on("click", "#albums .portfolio .portfolio_container div", function (e) {
      e.preventDefault();
    
      ind = $(this).index();
    
      albums_func(ind);
    });
  }
});



/*--------------------------------------------------
    Open video modal
    ---------------------------------------------------*/
$("#popup-youtube").magnificPopup({
  disableOn: 700,
  type: "iframe",
  mainClass: "mfp-fade",
  removalDelay: 160,
  preloader: false,
  fixedContentPos: false,
});


// merchandise swiper

var swiper = new Swiper(".mySwiper", {
  slidesPerView: 4,
  spaceBetween: 30,
  slidesPerGroup: 1,
  loop: true,
  loopFillGroupWithBlank: true,
  autoplay: {
    delay: 2500,
    disableOnInteraction: false,
  },
  navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev",
  },
  breakpoints: {
      0: {
          slidesPerView: 2,
          spaceBetween: 20,
          slidesPerGroup: 1,
      },
      640: {
          slidesPerView: 2,
          spaceBetween: 50,
          slidesPerGroup: 1,
      },
      1024: {
          slidesPerView: 3,
          spaceBetween: 40,
          slidesPerGroup: 1,
      },
      1280: {
          slidesPerView: 4,
          spaceBetween: 50,
          slidesPerGroup: 1,
      },
  },
});



