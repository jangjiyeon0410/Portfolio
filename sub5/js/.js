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
          
      getParams();  //함수호출
      
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
