
$(document).on('scroll',function(){ //스크롤 값의 변화가 생기면

    var winScrollTop = $(window).scrollTop();
    var winScrollGap = $(window).height() / 2;
    var item = [];
    var num = Number($('.contentArea').find('.scroll').length) - 1; // 0부터 index값 뽑기

    for (var i=0; i<=num; i++){
        
        item[i] = $('.scroll:eq('+i+')').offset().top - winScrollGap - 100;


        if(winScrollTop > item[i]){
            $('.scroll:eq('+i+')').addClass('scroll_move');
        }
    }
});