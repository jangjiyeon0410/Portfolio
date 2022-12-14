var cnt = 0;
$(".innerSubNav li:eq(0)").find("a").addClass("spy");

var h1 = $("#content .con2").offset().top - 200;
var h2 = $("#content .con3").offset().top - 300;

$(window).on("scroll", function () {
  var scroll = $(window).scrollTop();

//scticky menu
  if (scroll > 940) {
    $(".navBox").addClass("navOn");
    $(".history_wrap").css("margin-top", "250px");

    $("header").hide();
  } else {
    $(".navBox").removeClass("navOn");
    $(".history_wrap").css("margin-top", "50px");

    $("header").show();
  }
  $(".innerSubNav li").find("a").removeClass("spy");

  if (scroll >= 0 && scroll < h1) {
    cnt = 0;
  } else if (scroll >= h1 && scroll < h2) {
    cnt = 1;
  } else if (scroll >= h2) {
    cnt = 2;
  }
  $(".innerSubNav li:eq(" + cnt + ")")
    .find("a")
    .addClass("spy");

});

//one page slide

$(".slideMenu a").click(function (e) {
  e.preventDefault(); 
  var value = 0; 
  if ($(this).hasClass("link1")) {
 
    value = $("#content .con1").offset().top - 100; 
  } else if ($(this).hasClass("link2")) {
    value = $("#content .con2").offset().top;
  } else if ($(this).hasClass("link3")) {
    value = $("#content .con3").offset().top;
  }
  $("html,body")
    .stop()
    .animate({ scrollTop: value - 80 }, 1000);
});
