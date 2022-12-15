//연혁

var cnt = $(".tabMenu li").size();
$(".history_inner:eq(0)").fadeIn("slow");
$(".tab1").css("background", "#e71e10").css("color", "#fff");
$(".tab1 h3").css("opacity", 1);


$(".tab").each(function (index) {
  $(this).click(function (e) {
    e.preventDefault();

    $(".history_inner").hide();
    $(".history_inner:eq(" + index + ")").fadeIn("slow");
    $(".tab").css("background", "#fff").css("color", "#333");
    $(".tab h3").css("opacity", 0.6);
    $(this).css("background", "#e71e10").css("color", "#fff");
    $(this).find("h3").css("opacity", 1);
  });
});

//비전 및 경영목표
var contents = $(".goal .view_contents");

$(".goal .view_contents .trigger").click(function (e) {
  e.preventDefault();

  var mycontents = $(this).parents(".view_contents");

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
