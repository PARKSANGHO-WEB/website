$(document).ready(function(){
    
    
    var z=0;
    
    var x=0;
    
    
    
    
    $('.average').each(function(){
        z++;
        var d='average'+z;
        $(this).addClass(d);
    });
        
    
    $('.starin').each(function(){
        x++;
        var c='starin'+x;
        $(this).addClass(c);
    });
    
    
    
     var i = $(".average").val();

     $(".starin").attr('style','width:'+ i * 20 +'%');
   
});