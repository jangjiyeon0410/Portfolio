//charater img animation

const canv = document.getElementById("canvas"),
  ctx = canv.getContext("2d"),
  img = new Image(),
  imgMask = new Image();

// imgMask.src = "http://res.cloudinary.com/dkcygpizo/image/upload/v1505176018/codepen/watercolor-effect-2.png";
imgMask.src =
  "https://res.cloudinary.com/dkcygpizo/image/upload/v1505176017/codepen/cloud-texture.png";
img.src = "./images/maggie.png";

let speed = 0;
let requestId;

function draw() {
  speed += 20;

  const maskX = (canv.width - (70 + speed)) / 2,
    maskY = (canv.height - (40 + speed)) / 2;

  ctx.clearRect(0, 0, canv.width, canv.height);
  ctx.globalCompositeOperation = "source-over";

  ctx.drawImage(imgMask, maskX, maskY, 70 + speed, 40 + speed);

  ctx.globalCompositeOperation = "source-in";
  ctx.drawImage(img, 0, 0, img.naturalWidth, img.naturalHeight);

  requestId = window.requestAnimationFrame(draw);
}

img.onload = () => {
  canv.width = img.naturalWidth;
  canv.height = img.naturalHeight;
  canv.style.display = "block";
  
  setTimeout(() => {
    draw();
  }, 1000);
};



// let winScrollTop =  $(window).scrollTop();
// var winScrollGap = $(window).height() / 2;
// let characterHeight = $('.character').offset().top - winScrollGap- 100;
// document.onscroll = () => {
//   canv.width = img.naturalWidth;
//   canv.height = img.naturalHeight;
//   canv.style.display = "block";

//   setTimeout(() => {
//     draw();
//   }, 1000);
// };


canv.onmouseover = () => {
  if($(window).width()>=1024){
  speed = 0;
  draw();
  window.cancelAnimationFrame(requestId);
  };
};

const canv2 = document.getElementById("canvas2"),
  ctx2 = canv2.getContext("2d"),
  img2 = new Image(),
  imgMask2 = new Image();

// imgMask2.src = "http://res.cloudinary.com/dkcygpizo/image/upload/v1505176018/codepen/watercolor-effect-2.png";
imgMask2.src =
  "https://res.cloudinary.com/dkcygpizo/image/upload/v1505176017/codepen/cloud-texture.png";
img2.src = "./images/tony.png";

let speed2 = 0;
let requestId2;

function draw2() {
  speed2 += 20;

  const maskX = (canv2.width - (40 + speed2)) / 2,
    maskY = (canv2.height - (70 + speed2)) / 2;

  ctx2.clearRect(0, 0, canv2.width, canv2.height);
  ctx2.globalCompositeOperation = "source-over";

  ctx2.drawImage(imgMask2, maskX, maskY, 40 + speed2, 70 + speed2);

  ctx2.globalCompositeOperation = "source-in";
  ctx2.drawImage(img2, 0, 0, img2.naturalWidth, img2.naturalHeight);

  requestId2 = window.requestAnimationFrame(draw2);
}

img2.onload = () => {
  canv2.width = img2.naturalWidth;
  canv2.height = img2.naturalHeight;

  setTimeout(() => {
    canv2.style.display = "block";
    draw2();
  }, 1000);
};


// document.onscroll = () => {
//   if (winScrollTop > characterHeight) {
//     canv2.width = img.naturalWidth;
//     canv2.height = img.naturalHeight;
//     canv2.style.display = "block";
  
    
//       setTimeout(() => {
//         draw2();
//       }, 5000);
    
//   };
// };

canv2.onmouseover = () => {
  if($(window).width()>=1024){
  speed2 = 0;
  draw2();
  window.cancelAnimationFrame(requestId2);
  };
};

// title scroll

let move = false;
document.addEventListener("wheel", function (e) {
  e.preventDefault;
  screenHeight = window.innerHeight;

  if (move == false && e.deltaY > 0) {
    document.querySelector(".title").classList.add("effectOn");
    $("html,body").stop().animate({ scrollTop: screenHeight }, 500);
    move = true;
  }
  return false;
  // else if (e.deltaY < 0 && move == true) {
  //   // $("html,body").animate({ scrollTop: 0 }, 1000);
  //   move = false;
  // }
});
