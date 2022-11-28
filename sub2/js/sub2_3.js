var xhr = new XMLHttpRequest(); // XMLHttpRequest 객체를 생성한다.
var responseObject;
var ind=0;
var newContent = "";
xhr.onload = function () {
  // When readystate changes

  responseObject = JSON.parse(xhr.responseText); //서버로 부터 전달된 json 데이터를 responseText 속성을 통해 가져올 수 있다.
  // parse() 메소드를 호출하여 자바스크립트 객체로 변환한다.
};

xhr.open("GET", "./js/sub2_3.json", true); // 요청을 준비한다.
xhr.send(null); // 요청을 전송한다

function popchange(){
  newContent = "";
  newContent +=
    '<img src="' + responseObject.prize[ind].path + '" ' + 'alt="">';
  newContent +=
    "<strong><i class='fa-solid fa-award'></i></i>" +
    responseObject.prize[ind].prize +
    "</strong>";
  newContent += "<strong>" + responseObject.prize[ind].title + "</strong>";
  newContent +=
    "<strong>글/그림 " + responseObject.prize[ind].writer + "</strong>";

  newContent += "<p>" + responseObject.prize[ind].description + "</p>";

  $(".int").html(newContent);
 }


var $morebtn=$(".more_btn").click(function (e) {
  e.preventDefault();
  
  ind = $morebtn.index(this);


  
  $(".modal_box").fadeIn("fast");
  $(".popup").fadeIn("slow");
  

 popchange();

});

$(".close_btn, .modal_box").click(function (e) {
  e.preventDefault();
  $(".modal_box").hide();
  $(".popup").hide();
});

$('.pop_btn a').click(function(e){
  e.preventDefault();

  var prizeLength=responseObject.prize.length;
  

  $('.popup').hide().fadeIn('slow'); 
 
 if($(this).hasClass('pre')){      //3 2 1 0 3 2 1 0 ...
     if(ind==0)ind=prizeLength;
     ind--;
     popchange();
 }else if($(this).hasClass('next')){       //0 1 2 3 0 1 2 3 ...
     if(ind==prizeLength-1)ind=-1;
     ind++;
     popchange();
 }
});
