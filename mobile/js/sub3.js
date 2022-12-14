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

var url = decodeURIComponent(location.href);
url = decodeURIComponent(url);

var params='';
params = url.substring( url.indexOf('?')+1, url.length );   

key = params.split("=")[0];
value = params.split("=")[1];

key = Number(value);

}
    
getParams();


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