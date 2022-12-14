$(document).ready(function () {
  var op = false;

  $(".menu_ham").click(function () {

    var documentHeight = $(document).height();
    $("#gnb").css("height", documentHeight);

    if (op == false) {
      $("#gnb").animate({ right: 0, opacity: 1 }, "fast");
      $("#headerArea").addClass("mn_open");
      op = true;
    } else {
      $("#gnb").animate({ right: "-100%", opacity: 0 }, "fast");
      $("#headerArea").removeClass("mn_open");
      op = false;
    }
  });


  var onoff = [false, false, false, false];
  var arrcount = onoff.length;


  $("#gnb .depth1 h3 a").click(function () {
    var ind = $(this).parents(".depth1").index();

    console.log(ind);

    if (onoff[ind] == false) {
      $(this).parents(".depth1").find("ul").slideDown("fast");
      $(this).parents(".depth1").siblings("li").find("ul").slideUp("fast");
      for (var i = 0; i < arrcount; i++) onoff[i] = false;
      onoff[ind] = true;

      $(this).find("span").html('<i class="fa-solid fa-angle-down"></i>');
    } else {
      $(this).parents(".depth1").find("ul").slideUp("fast");
      onoff[ind] = false;

      $(this).find("span").html('<i class="fa-solid fa-angle-right"></i>');
    }
  });
});

//패밀리 사이트 토글
$(".family .arrow").toggle(
  function () {
    $(".family .aList").fadeIn("slow");
    $(this).children("span").html('<i class="fa-solid fa-angle-up"></i>');
  },
  function () {
    $(".family .aList").fadeOut("fast");
    $(this).children("span").html('<i class="fa-solid fa-angle-down"></i>');
  }
);

//맨위로 이동

$(".topMove").hide();
$(window).on("scroll", function () {
  var scroll = $(window).scrollTop();

  $(".text").text(Math.floor(scroll));
  if (scroll > 300) {
    $(".topMove").fadeIn("slow");
  } else {
    $(".topMove").fadeOut("fast");
  }
});

$(".topMove").click(function (e) {
  e.preventDefault();
  $("html,body").stop().animate({ scrollTop: 0 }, 1000);
});
