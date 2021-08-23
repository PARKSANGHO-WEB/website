

$(document).ready(function(){
    $(".off-item").on("mouseover",function(){
        $('header').addClass('on');
        
    });
    
    $(".off-item").on("mouseout",function(){
        $('header').removeClass('on');
    });
});




$(document).ready(function() {
        $('.goTop').bind('click', function() {
        $('html, body').animate({scrollTop: '0'});
    });

});

$(document).ready(function(){
    $(function() {

      var link = $('#navbar a.dot');

      // Move to specific section when click on menu link
      link.on('click', function(e) {
        var target = $($(this).attr('href'));
        $('html, body').animate({
          scrollTop: target.offset().top
        }, 300);
        $(this).addClass('active');
        e.preventDefault();
      });

      // Run the scrNav when scroll
      $(window).on('scroll', function(){
        scrNav();
      });

      // scrNav function 
      // Change active dot according to the active section in the window
      function scrNav() {
        var sTop = $(window).scrollTop();
        $('.page-section').each(function() {
          var id = $(this).attr('id'),
              offset = $(this).offset().top-1,
              height = $(this).height();
          if(sTop >= offset && sTop < offset + height) {
            link.removeClass('active');
            $('.at-wrap').find('[data-scroll="' + id + '"]').addClass('active');
          }
        });
      }
      scrNav();
    });
});









$(document).ready(function(){
   $('.remem_r button').on('click',function(){
       $('.pop-pass').css("display","block");
   }); 
   $('.pclose').on('click',function(){
       $('.pop-pass').css("display","none");
   }); 
});


            
    function myFunction(e) {
        document.getElementById("mymail").value = e.target.value
    }

$(document).ready(function(){

    $("#pnumber").change(function() {
      if ($(this).val() != "") {
        $("#mymail").attr("disabled", "disabled");
      } else {
        $("#mymail").removeAttr("disabled");
      }
    }).trigger("change");


});






