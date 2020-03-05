$(document).ready(function(){
    var h1s = $('span[id^="glow-"]').hide(),
    i = 0;

    (function cycle() { 

        h1s.eq(i).fadeIn(400)
                  .delay(1000)
                  .fadeOut(400, cycle);

        i = ++i % h1s.length;

    })();
    
    
    
    
    $('#portwrap').change(function () {
        var select=$(this).find(':selected').val();        
             $(".hide").hide();
             $('#' + select).show();

        }).change();

    
    $(".bar").on("click",function(){
        $(this).toggleClass("change");
        $(".mo_nav").slideToggle(500);
    });
});