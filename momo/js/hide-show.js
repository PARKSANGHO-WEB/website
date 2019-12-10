$(document).ready(function() {
  $(window).scroll(function() {
    if ($(this).scrollTop() >50) {
      $('.hide1').css('opacity', 1);
      $('.hide2').css('opacity', 1);
    } else {
      $('.hide1').css('opacity', 0);
      $('.hide2').css('opacity', 0);
    }
  });
    
    
  $(window).scroll(function() {
    if ($(this).scrollTop() >200) {
      $('.hide3').css('opacity', 1);
      $('.hide4').css('opacity', 1);
    } else {
      $('.hide3').css('opacity', 0);
      $('.hide4').css('opacity', 0);
    }
  });
    
    
  $(window).scroll(function() {
    if ($(this).scrollTop() > 300) {
      $('.hide5').css('opacity', 1);
    } else {
      $('.hide5').css('opacity', 0);
    }
  });
    
    
});


$(document).ready(function(){
    
    
      $(".fadowrap1").click(function(){
      $(".faddepth1").slideToggle(300);
      $(".fadown1").toggleClass("fa-angle-up");
        
});
    
      $(".fadowrap2").click(function(){
      $(".faddepth2").slideToggle(300);
      $(".fadown2").toggleClass("fa-angle-up");
        
});
    
      $(".fadowrap3").click(function(){
      $(".faddepth3").slideToggle(300);
      $(".fadown3").toggleClass("fa-angle-up");
        
});
    
      $(".fadowrap4").click(function(){
      $(".faddepth4").slideToggle(300);
      $(".fadown4").toggleClass("fa-angle-up");
        
});
    
      $(".fadowrap5").click(function(){
      $(".faddepth5").slideToggle(300);
      $(".fadown5").toggleClass("fa-angle-up");
        
});
    
      $(".fadowrap6").click(function(){
      $(".faddepth6").slideToggle(300);
      $(".fadown6").toggleClass("fa-angle-up");
        
});
    
      $(".fadowrap7").click(function(){
      $(".faddepth7").slideToggle(300);
      $(".fadown7").toggleClass("fa-angle-up");
        
});
    
      $(".fadowrap8").click(function(){
      $(".faddepth8").slideToggle(300);
      $(".fadown8").toggleClass("fa-angle-up");
        
});
    
      $(".fadowrap9").click(function(){
      $(".faddepth9").slideToggle(300);
      $(".fadown9").toggleClass("fa-angle-up");
        
});
    
      $(".fadowrap10").click(function(){
      $(".faddepth10").slideToggle(300);
      $(".fadown10").toggleClass("fa-angle-up");
        
});
});
