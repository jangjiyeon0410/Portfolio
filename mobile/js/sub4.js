var article = $(".faq .article");

$(".faq .article .trigger").click(function (e) {

  e.preventDefault();

  var myArticle = $(this).parents(".article");

  if (myArticle.hasClass("hide")) {
    article.find(".a").slideUp(100);
    article.removeClass("show").addClass("hide");
    article.find(".trigger span:eq(0)").css('color', '#333');
    article.find(".trigger span:eq(1)").html('<i class="fas fa-plus"></i>');

    myArticle.removeClass("hide").addClass("show");
    myArticle.find(".a").slideDown(100);
    myArticle.find(".trigger span:eq(1)").html('<i class="fas fa-minus"></i>');
    myArticle.find(".trigger span:eq(0)").css('color', '#e71e10');
  } else {
    myArticle.removeClass("show").addClass("hide");
    myArticle.find(".a").slideUp(100);
    myArticle.find(".trigger span:eq(1)").html('<i class="fas fa-plus"></i>');
    myArticle.find(".trigger span:eq(0)").css('color', '#333');
  }
});

//모두여닫기
$(".all").toggle(
  function (e) {
    e.preventDefault();
    article.find(".trigger span:eq(0)").css('color', '#333');
    article.find(".trigger span:eq(1)").html('<i class="fas fa-minus"></i>');
    article.find(".a").slideDown(100);
    article.removeClass("hide").addClass("show");
    $(this).html(
      '<span>모든 답변 닫기<i class="fas fa-angle-double-up"></i></span>'
    );
  },
  function (e) {
    e.preventDefault();
    article.find(".a").slideUp(100);
    article.removeClass("show").addClass("hide");

    article.find(".trigger span:eq(1)").html('<i class="fas fa-plus"></i>');
    $(this).html(
      '<span>모든 답변 열기<i class="fas fa-angle-double-down"></i></span>'
    );
  }
);

//클릭 이동
$(".slideMenu a").click(function (e) {
  e.preventDefault();
  var value = 0;
  if ($(this).hasClass("link1")) {

    value = $("#content .con1").offset().top;
  } else if ($(this).hasClass("link2")) {
    value = $("#content .con2").offset().top;
  } else if ($(this).hasClass("link3")) {
    value = $("#content .con3").offset().top;
  }
  $("html,body")
    .stop()
    .animate({ scrollTop: value - 150 }, 1000);
});


