var article = $(".faq .article"); //모든 li들..(질문답변들...)

$(".faq .article .trigger").click(function (e) {
  //각각의 질문을 클릭하면
  e.preventDefault();

  var myArticle = $(this).parents(".article"); //클릭한 해당 메뉴에 li(리스트)

  if (myArticle.hasClass("hide")) {
    //클릭한 해당 리스트가 닫혀있냐??
    article.find(".a").slideUp(100); // 모든 리스트의 답변을 닫아라
    article.removeClass("show").addClass("hide"); //모든 리스트의 클래스 hide로 바꾼다

    myArticle.removeClass("hide").addClass("show"); // 클래스를 show로 바꾼다
    myArticle.find(".a").slideDown(100); //해당 리스트의 답변을 열어라~~~
    myArticle.find(".trigger span:eq(1)").html('<i class="fas fa-minus"></i>');
  } else {
    //클릭한 해당 리스트가 열려있냐?? (show)
    myArticle.removeClass("show").addClass("hide"); //클래스 hide로 바꾼다
    myArticle.find(".a").slideUp(100); //해당 리스트의 답변을 닫아라~~~
    myArticle.find(".trigger span:eq(1)").html('<i class="fas fa-plus"></i>');
  }
});

//모두여닫기
$(".all").toggle(
  function (e) {
    e.preventDefault();
    article.find(".a").slideDown(100);
    article.removeClass("hide").addClass("show");
    //$(this).text('모두닫기');
    $(this).html(
      '<span>모든 답변 닫기<i class="fas fa-angle-double-up"></i></span>'
    );
  },
  function (e) {
    e.preventDefault();
    article.find(".a").slideUp(100);
    article.removeClass("show").addClass("hide");
    //$(this).text('모두열기');
    $(this).html(
      '<span>모든 답변 열기<i class="fas fa-angle-double-down"></i></span>'
    );
  }
);

//클릭 이동
$(".slideMenu a").click(function (e) {
  e.preventDefault(); //href="#" 속성을 막아주는..메소드
  var value = 0; //이동할 스크롤의 거리
  if ($(this).hasClass("link1")) {
    //첫번째 메뉴를 클릭했냐?   if($(this).is('#link1')){
    value = $("#content .con1").offset().top; // 해당 콘테츠의 상단의 거리~~
  } else if ($(this).hasClass("link2")) {
    value = $("#content .con2").offset().top;
  } else if ($(this).hasClass("link3")) {
    value = $("#content .con3").offset().top;
  }
  $("html,body")
    .stop()
    .animate({ scrollTop: value - 80 }, 1000);
});
