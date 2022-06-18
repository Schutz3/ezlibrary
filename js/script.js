let myAudio = document.getElementById("myAudio");
let isPlaying = false;
const playPause = document.getElementById("sickle");

function togglePlay() {
  myAudio.volume = 0.1;
  isPlaying ? myAudio.pause() : myAudio.play();
};

myAudio.onplaying = function() {
  isPlaying = true;
  playPause.innerHTML = `<i class="bi bi-pause"></i>`;
};
myAudio.onpause = function() {
  isPlaying = false;
  playPause.innerHTML = `<i class="bi bi-play"></i>`;
};