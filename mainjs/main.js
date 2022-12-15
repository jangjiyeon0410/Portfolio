// business 영역

var timeonoff; // 타이머
var pcnt = 1; // 카운터=순서
var totalcnt = $(".business_inner ul").size(); // 총 개수   ****

$(".RightBtn").click(function (e) {
  e.preventDefault();

  pcnt++;
  if (pcnt > totalcnt) {
    pcnt = 1; //카운터를 1로 바꾼다
  }
  $(".num strong").text(pcnt); //해당 카운터를 표시

  clearInterval(timeonoff);
  $(".business .business_inner").hide().fadeIn("fast");
  $(".business_inner ul").first().appendTo(".business .business_inner");
});

$(".leftBtn").click(function (e) {
  e.preventDefault();
  pcnt--; //카운트 1씩 감소
  if (pcnt < 1) {
    //1보다 작아지면 0
    pcnt = totalcnt; //3으로 바꾼다 총개수
  }
  $(".num strong").text(pcnt); //해당 카운트 출력

  clearInterval(timeonoff);
  $(".business .business_inner").hide().fadeIn("fast");
  $(".business_inner ul").last().prependTo(".business .business_inner"); //prependTo 가장 위로 보낸다
});

function change() {
  pcnt++;
  if (pcnt > totalcnt) {
    pcnt = 1;
  }
  $(".num strong").text(pcnt);
  $(".business .business_inner").hide().fadeIn("fast");
  $(".business_inner ul").first().appendTo(".business .business_inner"); // 첫번째 ul 의 첫번째 ul (appendTo 가장 밑으로)
}

//helpdesk 영역

var position = 0; //최초위치
var movesize = 390;
//var cnt = 0;

//이미지 하나의 너비
// var timeonoff;

$(".slide_video ul").after($(".slide_video ul").clone());

//슬라이드 겔러리를 한번 복제
$(".button").click(function (e) {
  e.preventDefault();


  if ($(this).is(".m2")) {
    //이전버튼 클릭

    position -= movesize;
    $(".slide_video").animate({ left: position }, "fast", function () {
      if (position <= -2340) {
        $(".slide_video").css("left", 0);
        position = 0;
      }
    });

  } else if ($(this).is(".m1")) {
    //다음버튼 클릭

    if (position >= 0) {
      $(".slide_video").css("left", -2340);
      position = -2340;
    }

    position += movesize; // 150씩 증가
    $(".slide_video").animate({ left: position }, "fast ", function () {
      if (position == 0) {
        $(".slide_video").css("left", -2340);
        position = -2340;
      }
    });

  }
});

//스크롤 이벤트

$(window).on("scroll", function () {
  var scroll = $(window).scrollTop();
  //스크롤top의 좌표를 담는다
  var businessHeight = $("#content .business").offset().top - 800;
  var clasterHeight = $("#content .claster").offset().top - 800;
  var helpdeskHeight = $("#content .helpdesk").offset().top - 500;
  var toonHeight = $("#content .toon").offset().top - 500;
  var noticeHeight = $("#content .notice").offset().top - 500;
  //스크롤 좌표의 값을 찍는다.

  if (scroll > noticeHeight) {
    $("#content .notice").addClass("scroll_move");
  } else if (scroll > toonHeight) {
    $("#content .toon").addClass("scroll_move");
  } else if (scroll > helpdeskHeight) {
    $("#content .helpdesk").addClass("scroll_move");
  } else if (scroll > clasterHeight) {
    $("#content .claster").addClass("scroll_move");
  } else if (scroll > businessHeight) {
    $("#content .business").addClass("scroll_move") + 500;
  }

  //내용 콘텐츠 애니메이션
});
