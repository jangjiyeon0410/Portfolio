
$(document).ready(function () {
  var timeonoff;
  var imageCount = $(".gallery ul li").size();
  var cnt = 1;
  var onoff = true;

  $(".dock").delay(450).animate({ opacity: 1 }, "slow");

  $(".btn1").css("background", "#e71e10");
  $(".btn1").css("width", "30");

  $(".gallery .link1").fadeIn("slow");
  $(".gallery .link1 dl").delay(450).animate({ top: 415, opacity: 1 }, "slow");

  function moveg() {
    if (cnt == imageCount + 1) cnt = 1;
    if (cnt == imageCount) cnt = 0;

    cnt++;

    $(".gallery li").hide();
    $(".gallery .link" + cnt).fadeIn("slow");

    $(".mbutton").css("background", "rgba(51, 51, 51, .5)");
    $(".mbutton").css("width", "16");
    $(".btn" + cnt).css("background", "#e71e10");
    $(".btn" + cnt).css("width", "30");

    $(".gallery li dl").css("top", 500).css("opacity", 0);
    $(".gallery .link" + cnt)
      .find("dl")
      .delay(450)
      .animate({ top: 415, opacity: 1 }, "slow");

    if (cnt == imageCount) cnt = 0;
  }

  timeonoff = setInterval(moveg, 4000);


  $(".mbutton").click(function (event) {

    var $target = $(event.target);
    clearInterval(timeonoff);

    $(".gallery li").hide();

    if ($target.is(".btn1")) {
      cnt = 1;
    } else if ($target.is(".btn2")) {

      cnt = 2;
    } else if ($target.is(".btn3")) {
      cnt = 3;
    }

    $(".gallery .link" + cnt).fadeIn("slow");

    $(".mbutton").css("background", "rgba(51, 51, 51, .5)");
    $(".mbutton").css("width", "16");
    $(".btn" + cnt).css("background", "#e71e10");
    $(".btn" + cnt).css("width", "30");

    $(".gallery li dl").css("top", 500).css("opacity", 0);
    $(".gallery .link" + cnt)
      .find("dl")
      .delay(450)
      .animate({ top: 415, opacity: 1 }, "slow");

    if (cnt == imageCount) cnt = 0;

    timeonoff = setInterval(moveg, 4000);

    if (onoff == false) {

      onoff = true;
      $(".ps").html('<i class="fa-solid fa-pause"></i>');
    }
  });

  //stop/play 버튼 클릭시 타이머 동작/중지
  $(".ps").click(function () {
    if (onoff == true) {

      clearInterval(timeonoff);
      $(this).html('<i class="fas fa-play"></i>');
      onoff = false;
    } else {

      timeonoff = setInterval(moveg, 4000);
      $(this).html('<i class="fa-solid fa-pause"></i>');
      onoff = true;
    }
  });

  //왼쪽/오른쪽 버튼 처리
  $(".left_right .btn").click(function () {
    clearInterval(timeonoff);

    if ($(this).is(".btnRight")) {

      if (cnt == imageCount) cnt = 0; 

      cnt++;
    } else if ($(this).is(".btnLeft")) {

      if (cnt == 1) cnt = imageCount + 1;
      if (cnt == 0) cnt = imageCount;
      cnt--; 
    }


    $(".gallery li").hide();
    $(".gallery .link" + cnt).fadeIn("slow");

    $(".mbutton").css("background", "rgba(51, 51, 51, .5)");
    $(".mbutton").css("width", "16");
    $(".btn" + cnt).css("background", "#e71e10");
    $(".btn" + cnt).css("width", "30");

    $(".gallery li dl").css("top", 500).css("opacity", 0);
    $(".gallery .link" + cnt)
      .find("dl")
      .delay(450)
      .animate({ top: 415, opacity: 1 }, "slow");


    timeonoff = setInterval(moveg, 4000);

    if (onoff == false) {
      onoff = true;
      $(".ps").html('<i class="fa-solid fa-pause"></i>');
    }
  });
});
