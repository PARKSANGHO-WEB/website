$(document).ready(function(){
    $('.mo_bar').click(function(){
        $(this).toggleClass('in');
        $('.mo_menu').slideToggle(500);
    });
    

      $(document).scroll(function () {
        var $nav = $(".mo_header");
        $nav.toggleClass('scrolled', $(this).scrollTop() > 200);
      });
});