$(document).ready(function(){
    var modal = document.getElementById('addModal');
    
    var mymodal = document.getElementById('myModal');
    
    var lvmodal = document.getElementById('leavemodal');
    
    var psmodal = document.getElementById('personmodal');
    
    var stmodal = document.getElementById('static');
    
    var bgmodal = document.getElementById('beginmodal');
    
    var itmodal = document.getElementById('intermodal');
    
    var avmodal = document.getElementById('advanmodal');
    
    var mdmodal = document.getElementById('modify');
    

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
      if (event.target == modal) {
        modal.style.display = "none";
      }
      if (event.target == mymodal) {
        mymodal.style.display = "none";
      }
      if (event.target == lvmodal) {
        lvmodal.style.display = "none";
          
        $(".star2_input").val(0);
        $(".star2 a").attr("class","fa-star-o");
        $(".star2 a").addClass("fa");
      }
      if (event.target == psmodal) {
        psmodal.style.display = "none";
      }
      if (event.target == stmodal) {
        stmodal.style.display = "none";
      }
      if (event.target == bgmodal) {
        bgmodal.style.display = "none";
      }
      if (event.target == itmodal) {
        itmodal.style.display = "none";
      }
      if (event.target == avmodal) {
        avmodal.style.display = "none";
      }
      if (event.target == mdmodal) {
        mdmodal.style.display = "none";
      }
    }
});