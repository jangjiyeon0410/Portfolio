var onoff3 = [false, false, false, false, false, false];
  var arrcount3 = onoff3.length;

  $(".click a").click(function (e) {
    e.preventDefault();
    var ind3 = $(this).parents(".click").index();

    if (onoff3[ind3] == false) {
      $(".click").find("ul").slideUp("fast")
      $(".click a").find("i").removeClass('fa-angle-up').addClass('fa-angle-down');

      $(this).parents(".click").find("ul").slideDown("fast");
      for (var i = 0; i < arrcount3; i++) onoff3[i] = false;
      onoff3[ind3] = true;

      $(this).find("i").removeClass('fa-angle-down').addClass('fa-angle-up');
      
    } else {
      $(this).parents(".click").find("ul").slideUp("fast");
      onoff3[ind3] = false;

      $(this).find("i").removeClass('fa-angle-up').addClass('fa-angle-down');
    }
  });


  //파라미터 링크 넘기기
var key, value;
  
function getParams() {

// 현재 페이지의 url   ex2.html?num=1
var url = decodeURIComponent(location.href);
// url이 encodeURIComponent 로 인코딩 되었을때는 다시 디코딩 해준다.
url = decodeURIComponent(url);  //  ex2.html?num=1

var params='';
// url에서 '?' 문자 이후의 파라미터 문자열까지 자르기
params = url.substring( url.indexOf('?')+1, url.length );   
// 'abcdefg'.substring(2(인덱스번호 2->c),4(c부터 4글자));=> 'cdef'
// params = "num=1" 

key = params.split("=")[0];  //'num'    =을 기준으로 왼오(0,1)
value = params.split("=")[1];  // '1'

key = Number(value);    //key=1;
 
  //alert(key);
  //alert(typeof(key));
}
    
getParams();
  //함수호출
//key=1, key=2, key=3


window.onload =function(){
if(key==1){
  $('html').animate({
    scrollTop: $('.con2').offset().top- 60
}, 'slow');
}else if(key==2){
  $('html').animate({
    scrollTop: $('.con3').offset().top -60
}, 'slow');
}else if(key==3){
  $('html').animate({
    scrollTop: $('.con4').offset().top -60
}, 'slow');
}else{
  $('html').animate({
    scrollTop: $('body').offset().top
}, 'fast'); 
};
};