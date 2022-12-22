const TIME_OUT = 600;
const body = document.querySelector('body');
const sectionsQty = document.querySelectorAll('section').length;
const sections = document.querySelectorAll('section');
const menu = document.querySelector('.menu');

let startFlag = true;
let initialScroll = sections[1].scrollY;
let qty = 1,
    main = null,
    next = null;



window.onscroll = (e) => {
    e.preventDefault;
    
    if (startFlag) {
    const scrollDown = this.scrollY >= initialScroll;
    const scrollLimit = qty >= 1 && qty <= sectionsQty;


    if (scrollLimit) {
        body.style.overflowY = 'hidden';

        if (scrollDown && qty < sectionsQty) {
        main = sections[qty-1];
        next = sections[qty];

        main.style.transform = 'translateY(-100vh)';
        next.style.transform = 'translateY(0)';

        qty++;



        } else if (!scrollDown && qty > 1) {
            main = sections[qty-2];
            next = sections[qty-1];

        main.style.transform = 'translateY(0)';
        next.style.transform = 'translateY(100vh)';

        qty--;
        }
        // if(qty == 3 || qty == 5){
        //     sections[qty].style.background = 'black';
        // }
    }



    setTimeout(() => {
        initialScroll = this.scrollY;
        startFlag = true;
        body.style.overflowY = 'scroll' ;
    }, TIME_OUT);

    startFlag = false;
    }

}