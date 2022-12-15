var on_off = false;

$("#headerArea").mouseenter(function () {
  $(this)
    .css("background", "#fff")
    .css("border-radius", "0 0 50px 50px")
    .css("box-shadow", "0px 0px 5px 0 rgba(0, 0, 0, 10%");

  on_off = true;
});

$("#headerArea").mouseleave(function () {
  var scroll = $(window).scrollTop();

  if (scroll < 50) {
    $(this)
      .css("background", "none")
      .css("border-radius", "none")
      .css("box-shadow", "none");
  } else {
    $(this)
      .css("background", "#fff")
      .css("border-radius", "0 0 50px 50px")
      .css("box-shadow", "0px 0px 5px 0 rgba(0, 0, 0, 10%");
  }
  on_off = false;
});

$(window).on("scroll", function () {
  var scroll = $(window).scrollTop();

  if (scroll > 50) {
    $("#headerArea")
      .css("background", "#fff")
      .css("border-radius", "0 0 50px 50px")
      .css("box-shadow", "0px 0px 5px 0 rgba(0, 0, 0, 10%");
  } else {
    if (on_off == false) {
      $("#headerArea")
        .css("background", "transparent")
        .css("border-radius", "none")
        .css("box-shadow", "none");
    }
  }
});

//2depth 열기/닫기
$("ul.dropdownmenu").hover(
  function () {
    $("ul.dropdownmenu li.menu ul").fadeIn("normal", function () {
      $(this).stop();
    });
    $("#headerArea")
      .animate({ height: 350 }, "fast")
      .css("background", "#fff")
      .css("border-radius", "0 0 50px 50px")
      .css("box-shadow", "0px 0px 5px 0 rgba(0, 0, 0, 10%")
      .clearQueue();
  },
  function () {
    $("ul.dropdownmenu li.menu ul").hide();
    $("#headerArea")
      .animate({ height: 120 }, "fast")
      .css("background", "transparent")
      .css("border-radius", "none")
      .css("box-shadow", "none")
      .clearQueue();
  }
);

//1depth 효과
$("ul.dropdownmenu li.menu").hover(
  function () {
    $(".depth1", this).css("color", "#e71e10");
  },
  function () {
    $(".depth1", this).css("color", "#333");
  }
);

//tab 처리
$("ul.dropdownmenu li.menu .depth1").on("focus", function () {
  $("ul.dropdownmenu li.menu ul").slideDown("normal");
  $("#headerArea").animate({ height: 350 }, "fast").clearQueue();
});

$("ul.dropdownmenu li.m6 li:last")
  .find("a")
  .on("blur", function () {
    $("ul.dropdownmenu li.menu ul").slideUp("fast");
    $("#headerArea").animate({ height: 120 }, "normal").clearQueue();
  });

//맨위로 이동

$(".topMove").hide();
$(window).on("scroll", function () {
  var scroll = $(window).scrollTop();

  $(".text").text(Math.floor(scroll));
  if (scroll > 500) {
    $(".topMove").fadeIn("slow");
  } else {
    $(".topMove").fadeOut("fast");
  }
});

$(".topMove").click(function (e) {
  e.preventDefault();
  $("html,body").stop().animate({ scrollTop: 0 }, 1000);
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

//tab키 처리
$(".family .arrow").on("focus", function () {
  $(".family .aList").fadeIn("slow");
});
$(".family .aList li:last a").on("blur", function () {
  $(".family .aList").fadeOut("fast");
});
