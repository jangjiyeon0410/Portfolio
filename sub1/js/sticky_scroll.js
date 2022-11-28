var cnt = 0;
$(".innerSubNav li:eq(0)").find("a").addClass("spy");

var h1 = $("#content .con2").offset().top - 200;
var h2 = $("#content .con3").offset().top - 300;
//스크롤의 좌표가 변하면.. 스크롤 이벤트
$(window).on("scroll", function () {
  var scroll = $(window).scrollTop();
  //스크롤top의 좌표를 담는다

  //sticky menu 처리
  if (scroll > 940) {
    $(".navBox").addClass("navOn");
    $(".history_wrap").css("margin-top", "250px");
    //스크롤의 거리가 350px 이상이면 서브메뉴 고정
    $("header").hide();
  } else {
    $(".navBox").removeClass("navOn");
    $(".history_wrap").css("margin-top", "50px");
    //스크롤의 거리가 350px 보다 작으면 서브메뉴 원래 상태로
    $("header").show();
  }
  $(".innerSubNav li").find("a").removeClass("spy");
  //모든 서브메뉴 비활성화~ 불꺼!!!
  //스크롤의 거리의 범위를 처리
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
  // //서브메뉴 활성화
  // $("#content section:eq(" + cnt + ")").addClass("boxMove");
  // //내용 콘텐츠 애니메이션
});

//원페이지 슬라이드 처리

$(".slideMenu a").click(function (e) {
  e.preventDefault(); //href="#" 속성을 막아주는..메소드
  var value = 0; //이동할 스크롤의 거리
  if ($(this).hasClass("link1")) {
    //첫번째 메뉴를 클릭했냐?   if($(this).is('#link1')){
    value = $("#content .con1").offset().top - 100; // 해당 콘테츠의 상단의 거리~~
  } else if ($(this).hasClass("link2")) {
    value = $("#content .con2").offset().top;
  } else if ($(this).hasClass("link3")) {
    value = $("#content .con3").offset().top;
  }
  $("html,body")
    .stop()
    .animate({ scrollTop: value - 80 }, 1000);
});
