
$(document).ready(function(){
 
    $(document).ready(function() {
      $('input').click(function() {
        $('input:not(:checked)').parent().removeClass("checked");
        $('input:checked').parent().addClass("checked");
      });
    });
    
});