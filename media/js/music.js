// music

var myAudio = new Audio("./In The Mood For Love  Yumejis Theme.mp3");
var vinyl = document.querySelector(".vinyl");
var play = document.querySelector(".vinyl_box");

document.querySelector(".playBtn").addEventListener("click", function (e) {
  e.preventDefault();

  myAudio.loop = true;
  myAudio.play();
  play.classList.remove("stop");
  vinyl.classList.add("play");
  play.classList.add("play");
});

document.querySelector(".stopBtn").addEventListener("click", function (e) {
  e.preventDefault();

  myAudio.pause();
  vinyl.classList.remove("play");
  play.classList.add("stop");
});
