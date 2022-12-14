var xhr = new XMLHttpRequest();
var responseObject;
var ind=0;
var newContent = "";
xhr.onload = function () {

  responseObject = JSON.parse(xhr.responseText);
};

xhr.open("GET", "./js/sub2_3.json", true);
xhr.send(null);

function popchange(){
  newContent = "";
  newContent +=
    '<div><img src="' + responseObject.prize[ind].path + '" ' + 'alt="">';
  newContent +=
    "<p><strong><i class='fa-solid fa-award'></i></i>" +
    responseObject.prize[ind].prize +
    "</strong>";
  newContent += "<strong>" + responseObject.prize[ind].title + "</strong>";
  newContent +=
    "<strong>글/그림 " + responseObject.prize[ind].writer + "</strong></p></div>";

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
 
 if($(this).hasClass('pre')){
     if(ind==0)ind=prizeLength;
     ind--;
     popchange();
 }else if($(this).hasClass('next')){
     if(ind==prizeLength-1)ind=-1;
     ind++;
     popchange();
 }
});
