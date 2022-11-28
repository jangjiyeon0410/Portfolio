//연혁
// var cnt=3;  //탭메뉴 개수 ***
var cnt = $(".tabMenu li").size();
$(".history_inner:eq(0)").fadeIn("slow"); // 첫번째 탭 내용만 열어라
$(".tab1").css("background", "#e71e10").css("color", "#fff");
$(".tab1 h3").css("opacity", 1); //첫번째 탭메뉴 활성화
//자바스크립트의 상대 경로의 기준은 => 스크립트 파일을 불러들인 html파일이 저장된 경로 기준***

$(".tab").each(function (index) {
  // index=0 1 2
  $(this).click(function (e) {
    e.preventDefault(); // <a> href="#" 값을 강제로 막는다

    $(".history_inner").hide(); //모든 탭내용을 안보이게...
    $(".history_inner:eq(" + index + ")").fadeIn("slow"); //클릭한 해당 탭내용만 보여라
    $(".tab").css("background", "#fff").css("color", "#333");
    $(".tab h3").css("opacity", 0.6); //모든 탭메뉴를 비활성화
    $(this).css("background", "#e71e10").css("color", "#fff");
    $(this).find("h3").css("opacity", 1); // 클릭한 해당 탭메뉴만 활성화
  });
});

//비전 및 경영목표
var contents = $(".goal .view_contents");

$(".goal .view_contents .trigger").click(function (e) {
  e.preventDefault();

  var mycontents = $(this).parents(".view_contents"); //클릭한 해당 메뉴에 li(리스트)

  if (mycontents.hasClass("hide")) {
    contents.find(".inner_contents").slideUp('fast');
    contents.removeClass("show").addClass("hide");

    mycontents.removeClass("hide").addClass("show");
    mycontents.find(".inner_contents").slideDown('fast');
    mycontents.find(".trigger span:eq(1)").html('<i class="fas fa-minus"></i>');
  } else {
    mycontents.removeClass("show").addClass("hide");
    mycontents.find(".inner_contents").slideUp('fast');
    mycontents.find(".trigger span:eq(1)").html('<i class="fas fa-plus"></i>');
  }
});
