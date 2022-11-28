
    // var cnt=3;  //탭메뉴 개수 ***
    var cnt=$('.tab_menu li').size();
    $('.contlist:eq(0)').fadeIn('slow'); // 첫번째 탭 내용만 열어라
    $('.tab1').css('background','#e71e10').css('color','#fff'); //첫번째 탭메뉴 활성화
               //자바스크립트의 상대 경로의 기준은 => 스크립트 파일을 불러들인 html파일이 저장된 경로 기준***
    
    $('.tab').each(function (index) {  // index=0 1 2
      $(this).click(function(e){
          e.preventDefault();   // <a> href="#" 값을 강제로 막는다    

          $(".contlist").hide(); //모든 탭내용을 안보이게...
          $(".contlist:eq("+index+")").fadeIn('slow'); //클릭한 해당 탭내용만 보여라
          $('.tab').css('background','#fff').css('color','#333'); //모든 탭메뉴를 비활성화
          $(this).css('background','#e71e10').css('color','#fff'); // 클릭한 해당 탭메뉴만 활성화

     });
    });


