
$(document).ready(function () {
 	
    
    $(function(){
        $("#myList li").slice(0, 3).show(); 
        $("#loadMore").click(function(e){ 
        e.preventDefault();
        $("#myList li:hidden").slice(0, 5).show(); 
            
            
        
        if($("#myList li:hidden").length == 0){
           $(".mr_moreview").addClass("none");
          }
            
            
        });
        
        
    });
    
});