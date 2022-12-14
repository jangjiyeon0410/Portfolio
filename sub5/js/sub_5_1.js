

    var cnt=$('.tab_menu li').size();
    $('.contlist:eq(0)').fadeIn('slow'); 
    $('.tab1').css('background','#e71e10').css('color','#fff'); 
  
    
    $('.tab').each(function (index) {
      $(this).click(function(e){
          e.preventDefault(); 

          $(".contlist").hide(); 
          $(".contlist:eq("+index+")").fadeIn('slow');
          $('.tab').css('background','#fff').css('color','#333'); 
          $(this).css('background','#e71e10').css('color','#fff'); 
    });
    });


