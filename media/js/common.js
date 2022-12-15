/* 헤더 on 추가 */
var visHeight, screenHeight;

// 사이즈 받아오기
function reSize() {
  visHeight = $(".videoBox").height();
  screenHeight = $(window).height(); //스크린의 높이
}
reSize();

// 창 사이즈 변경 시 사이즈 다시 받아오기
$(window).resize(function () {
  reSize();
});

$(document).scroll(function () {
  var windowTop = $(window).scrollTop();
  if (windowTop > visHeight - 150) {
    $("#headerArea").addClass("on");
  } else {
    $("#headerArea").removeClass("on");
  }
});

// move top
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

//menu open
$(document).on("click", ".menuOpen", function (e) {
  e.preventDefault();

  if ($("#headerArea").hasClass("active")) {
    // 닫아라

    $("#headerArea").removeClass("active");
  } else {
    $("#headerArea").addClass("active");
  }
});

//스크롤 이벤트

$(document).on("scroll", function () {
  //스크롤 값의 변화가 생기면

  var winScrollTop = $(window).scrollTop();
  var winScrollGap = $(window).height() / 2;
  var item = [];
  var num = Number($("#content").find(".scroll").length) - 1; // 0부터 index값 뽑기

  for (var i = 0; i <= num; i++) {
    item[i] = $(".scroll:eq(" + i + ")").offset().top - winScrollGap - 100;

    if (winScrollTop > item[i]) {
      $(".scroll:eq(" + i + ")").addClass("scroll_move");
    }
  }
});
