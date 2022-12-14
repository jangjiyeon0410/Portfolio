//파라미터 링크 넘기기

var key, value;
  
      function getParams() {

      var url = decodeURIComponent(location.href);
      url = decodeURIComponent(url); 

      var params='';
      params = url.substring( url.indexOf('?')+1, url.length );   

      value = params.split("=")[1]; 

      key = Number(value); 

      }
          
      getParams();
      
      //key=1, key=2, key=3
      
    if(location.href.match("num")){
        $('html, body').animate({
            scrollTop: $('#content .contentArea').offset().top
        }, 'fast'); 
      ;
      if(key==1){
        $(".main_video").html(
          '<iframe src="https://www.youtube.com/embed/IhL9dijbuj0"></iframe>'
        );
      }else if(key==2){
        $(".main_video").html(
          '<iframe src="https://www.youtube.com/embed/iQx139Kf_84"></iframe>'
        );
      }else if(key==3){
        $(".main_video").html(
      '<iframe src="https://www.youtube.com/embed/2ls4MMxzQPM"></iframe>'
        );
      }else if(key==4){
      $(".main_video").html(
        '<iframe src="https://www.youtube.com/embed/_y6zZf-VbR4"></iframe>'
        );
      }else if(key==5){
      $(".main_video").html(
      '<iframe src="https://www.youtube.com/embed/e8G4ungF9Dk"></iframe>'
      );
      }
    }else{
        $('html, body').animate({
          scrollTop: $('body').offset().top
      }, 'fast'); 
  };

  console.log(key);

$(".youtube li a:eq("+(key-1)+")").click(function (e) {
  e.preventDefault();

  $(".main_video").html(
    '<iframe src="https://www.youtube.com/embed/IhL9dijbuj0"></iframe>'
  );
});

$(".youtube li a:eq("+(key)+")").click(function (e) {
  e.preventDefault();

  $(".main_video").html(
    '<iframe src="https://www.youtube.com/embed/iQx139Kf_84"></iframe>'
  );
});

$(".youtube li a:eq("+(key+1)+")").click(function (e) {
  e.preventDefault();

  $(".main_video").html(
    '<iframe src="https://www.youtube.com/embed/2ls4MMxzQPM"></iframe>'
  );
});

$(".youtube li a:eq("+(key+2)+")").click(function (e) {
  e.preventDefault();

  $(".main_video").html(
    '<iframe src="https://www.youtube.com/embed/_y6zZf-VbR4"></iframe>'
  );
});

$(".youtube li a:eq("+(key+3)+")").click(function (e) {
  e.preventDefault();

  $(".main_video").html(
    '<iframe src="https://www.youtube.com/embed/e8G4ungF9Dk"></iframe>'
  );
});
