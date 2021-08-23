//Web Audio API
	
//Web API audio Context
	let context;

//tableau des sources sonores
  let bufferLoader;

//Définition du context Audio
	function initContext(){
	let contextClass = (window.AudioContext || window.webkitAudioContext ||window.oAudioContext ||window.msAudioContext || window.mozAudioContext);
	if(contextClass){
		console.log("Web Audio API disponible");
	//L'API Web Audio est disponible
	 	context = new contextClass();
		return context;
	}else{
		console.log("Web Audio API n'est pas disponible dans votre navigateur");
		return null;
	}
}

//Classe Buffer Loader
function BufferLoader(context, urlList, callback) {
  this.context = context;
  this.urlList = urlList;
  this.onload = callback;
  this.bufferList = new Array();
  this.loadCount = 0;
}

//Chargement des fichiers audios de maniére asynchrone
BufferLoader.prototype.loadBuffer = function(url, index) {
  let request = new XMLHttpRequest();
  request.open("GET", url, true);
  request.responseType = "arraybuffer";

  let loader = this;
  
	//Decodage des fichiers de maniére asynchrone 
  request.onload = function() {
    loader.context.decodeAudioData(
      request.response,
      function(buffer) {
        if (!buffer) {
          alert('error decoding file data: ' + url);
          return;
        }
        loader.bufferList[index] = buffer;
        if (++loader.loadCount == loader.urlList.length)
          loader.onload(loader.bufferList);
      },
      function(error) {
        console.error('decodeAudioData error', error);
      }
    );
  }
 request.onerror = function() {
    alert('BufferLoader: XHR error');
  }
  request.send();
}

BufferLoader.prototype.load = function() {
  for (var i = 0; i < this.urlList.length; ++i)
  this.loadBuffer(this.urlList[i], i);
}

//Fin Classe Buffer Loader

function finishedLoading(bufferList){
	//crée 2 sources et les lis ensemble
	let source1 = context.createBufferSource();
	let source2 = context.createBufferSource();
	
	source1.buffer=bufferList[0];
	source2.buffer=bufferList[1];
	
	source1.connect(context.destination);
	source2.connect(context.destination);
	source1.start(0);
	source2.start(0);
}


/*Fin Web Audio API*/








/*************/



	
	
	//Creation de la source
	//let source = context.createBufferSource();
	
	//Creation du noeud Gain
	//let gain = context.createGain();
	
	//Connection de la source au filtre 
	//et du filtre à la destination.
//	source.connect(gain);
//	gain.connect(context.destination);
	




//Variable globales

//Récupération de la balise video dans la variable player
let player = document.querySelector("#player");

//Bouton Play - Pause
let playpauseBtn = document.querySelector("#play-pause");

//Bouton Stop 
let stopBtn = document.querySelector("#stop");

//Affichage duree de la video
let duration = document.querySelector("#info");

//Barre de lecture video
let seekBar = document.querySelector("#track");

//Bouton retour en arriére 
let rewind = document.querySelector("#rewind");

//Bouton avance rapide
let forward = document.querySelector("#forward");

//Bouton mute
let mute = document.querySelector("#mute");

//Slider pour le volume
let volume = document.querySelector("#volume");

//Bouton repeat
let repeat = document.querySelector("#repeat");







//Initialisation du player
function initialiseMediaPlayer(){
	player.controls=false;
	//Rafraichissement du temps de lecture 
   player.ontimeupdate=displayTimeWhileVideoIsPlaying;
	
	//Initialisation du context Web Audio
	 context = initContext();
	 bufferLoader = new BufferLoader(context,['https://s3-us-west-2.amazonaws.com/s.cdpn.io/2100754/break28.wav','https://s3-us-west-2.amazonaws.com/s.cdpn.io/2100754/coolloop7.wav'],finishedLoading);
	bufferLoader.load();

}







//Affichage du temps durant la lecture de la video
function displayTimeWhileVideoIsPlaying(evt){
  duration.innerHTML = (formatSecondsAsTime(player.currentTime,"m:ss") + "/"+ formatSecondsAsTime(player.duration,"m:ss"));
}

//Formatage du temps de lecture
 function formatSecondsAsTime(secs, format) {
		var hr  = Math.floor(secs / 3600);
		var min = Math.floor((secs - (hr * 3600))/60);
		var sec = Math.floor(secs - (hr * 3600) -  (min * 60));

		if (hr < 10)   { hr    = "0" + hr; }
		if (min < 10) { min = "0" + min; }
		if (sec < 10)  { sec  = "0" + sec; }
		if (hr)            { hr   = "00"; }

		if (format != null) {
			var formatted_time = format.replace('hh', hr);
			formatted_time = formatted_time.replace('h', hr*1+""); // check for single hour formatting
			formatted_time = formatted_time.replace('mm', min);
			formatted_time = formatted_time.replace('m', min*1+""); // check for single minute formatting
			formatted_time = formatted_time.replace('ss', sec);
			formatted_time = formatted_time.replace('s', sec*1+""); // check for single second formatting
			return formatted_time;
		} else {
			return hr + ':' + min + ':' + sec;
		}
	}

//Fonction executee par le gestionnaire de l'evenement click sur le bouton Play/Pause du player
function togglePlayPauseBtn(){
	//Si la lecturer est en pause
	if(player.paused){
		//chargement de l'image bouton pause
    playpauseBtn.src="https://png.icons8.com/nolan/40/000000/circled-pause.png";
    playpauseBtn.title = "pause";
    playpauseBtn.alt = "button pause";
    //Lancement de la video
    player.play();    
	}else{
		//chargement de l'image bouton play
     playpauseBtn.src="https://png.icons8.com/nolan/40/000000/circled-play.png";
     playpauseBtn.title= "play"; 
     playpauseBtn.alt = "button play";
     playpauseBtn.className = "btn";
     //Mise en pause de la video
     player.pause();    
	}
}

//Fonction executee par le gestionnaire d'evenement lors du click sur le bouton Stop du player
  function toggleStopBtn() {
 //Mise en pause du player
   player.pause();
 //Remise a 0 du temps de lecture
   player.currentTime = 0;
 //Changement de l'image du bouton 
   playpauseBtn.src="https://png.icons8.com/nolan/40/000000/circled-play.png";
}

//Fonction executee par le gestionnaire d'evenement lors d'un click sur le bouton rewind
 function toggleRewind(){
  // retour en arriere de 10 secondes 
  player.currentTime -= 10;
}

//Fonction executee par le gestionnaire d'evenement lors d'un click sur le bouton forward
function toggleForward(){
  //avance rapide de 10 secondes
  player.currentTime += 10;
}

 
//Evénement levé lorsque le DOM est complétement chargé 
document.addEventListener("DOMContentLoaded", function() {
	
  initialiseMediaPlayer(); }, false);

//Gestion du click sur le bouton play/pause
playpauseBtn.addEventListener("click",function(){
  togglePlayPauseBtn();
});

//Gestion du click sur le bouton stop
stopBtn.addEventListener("click",function(){
  toggleStopBtn();
});

//Evenement leve lorsque la valeur du slider de la video change
seekBar.addEventListener("change",function(){
        // Calcul du nouveau temps
        let time = player.duration * (seekBar.value / 100);
    
        // Mise a jour du temps de lecture de la video
        player.currentTime = time;
   });

//Mise a jour du temps de la video
player.addEventListener("timeupdate",function(){
  // Calcule de la valeur du slider
  let value = (100 / player.duration) * player.currentTime;

  // Mise a jour de la valeur du slider
  seekBar.value = value;
});

//Gestion de l'evenement click sur le bouton rewind
rewind.addEventListener("click",function(){
  toggleRewind();
});

//Gestion de l'evenement click sur le bouton forward
forward.addEventListener("click",function(){
  toggleForward();
});

//Fonction executee par le gestionnaire de l'evenement click du bouton mute
  mute.addEventListener("click",function(){
   if(player.muted==true){
      player.muted=false;
      mute.src= "https://png.icons8.com/nolan/40/000000/high-volume.png";
     //On remet le volume a 80
      volume.value=80;
   } else {
     player.muted=true;
     mute.src="https://png.icons8.com/nolan/40/000000/mute.png";
     //Remise a 0 du volume
     volume.value=0;
   }
 });

//Gestion du changement de volume
volume.addEventListener("change",function(){
   player.volume=(volume.value)/100;
 });

repeat.addEventListener("click",function(){
	if(player.hasAttribute("loop")){
		  player.removeAttribute("loop");
		 } else{
			 player.setAttribute("loop","");
		 }
});






  
