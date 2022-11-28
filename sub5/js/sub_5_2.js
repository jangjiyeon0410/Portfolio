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
        }, 'slow'); 
      

      if(key==1){
        $('.main_video iframe').attr('src','https://www.youtube.com/embed/v1-AGksa5uY').attr('title','만화인헬프데스크 상담신청');
      }else if(key==2){
        $('.main_video iframe').attr('src','https://www.youtube.com/embed/IhL9dijbuj0').attr('title','만화인헬프데스크란?');
      }else if(key==3){
        $('.main_video iframe').attr('src','https://www.youtube.com/embed/iQx139Kf_84').attr('title','5분 만에 이해하는 종합소득세');
      }else if(key==4){
        $('.main_video iframe').attr('src','https://www.youtube.com/embed/2ls4MMxzQPM').attr('title','5분 만에 이해하는 상표법');
      }else if(key==5){
        $('.main_video iframe').attr('src','https://www.youtube.com/embed/_y6zZf-VbR4').attr('title','5분 만에 이해하는 저작권');
      }else if(key==6){
        $('.main_video iframe').attr('src','https://www.youtube.com/embed/e8G4ungF9Dk').attr('title','만화인 헬프데스크 이용가이드');
      }
    }else{
        $('html, body').animate({
          scrollTop: $('body').offset().top
      }, 'fast'); 
  };




var $vidList=$(".youtube li a").click(function (e) {
  e.preventDefault();

  var ind5=$vidList.index(this);

console.log(ind5);


  if(ind5==0){
    $('.main_video iframe').attr('src','https://www.youtube.com/embed/v1-AGksa5uY').attr('title','만화인헬프데스크 상담신청');
  }else if(ind5==1){
    $('.main_video iframe').attr('src','https://www.youtube.com/embed/IhL9dijbuj0').attr('title','만화인헬프데스크란?');
  }else if(ind5==2){
    $('.main_video iframe').attr('src','https://www.youtube.com/embed/iQx139Kf_84').attr('title','5분 만에 이해하는 종합소득세');
  }else if(ind5==3){
    $('.main_video iframe').attr('src','https://www.youtube.com/embed/2ls4MMxzQPM').attr('title','5분 만에 이해하는 상표법');
  }else if(ind5==4){
    $('.main_video iframe').attr('src','https://www.youtube.com/embed/_y6zZf-VbR4').attr('title','5분 만에 이해하는 저작권');
  }else if(ind5==5){
    $('.main_video iframe').attr('src','https://www.youtube.com/embed/e8G4ungF9Dk').attr('title','만화인 헬프데스크 이용가이드');
  }
});
