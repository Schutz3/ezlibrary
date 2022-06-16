// var container = document.getElementById('container');
// var cari = document.getElementById('cari');
// var keyword = document.getElementById('keyword');

// cari.style.display = 'none';

// keyword.addEventListener('keyup', function() {
// 	var xhr = new XMLHttpRequest();
// 	xhr.onreadystatechange = function() {
// 		if( xhr.readyState == 4 && xhr.status == 200 ) {
// 			container.innerHTML = xhr.responseText;
// 			spinner.style.display = 'none';
// 		}
// 	}
// 	xhr.open('get', 'cari.php?keyword=' + keyword.value, true);
// 	xhr.send();
// });

var myAudio = document.getElementById("myAudio");
var isPlaying = false;

function togglePlay() {
  myAudio.volume = 0.1;
  isPlaying ? myAudio.pause() : myAudio.play();
};

myAudio.onplaying = function() {
  isPlaying = true;
};
myAudio.onpause = function() {
  isPlaying = false;
};


function backToHome(){
  document.location.href = 'index.php?';
}