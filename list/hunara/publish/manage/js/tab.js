
$(document).ready(function(){

	var tabBtn = $(".tab-btn > ul > li");  
	var tabCont = $(".tab-con");   
	var modalCont = $(".mo-con");   

	tabCont.hide().eq(2).show();
	modalCont.hide().eq(0).show();

	tabBtn.click(function(){
		  var target = $(this);      
		  var index = target.index();  

		  tabBtn.removeClass("active");  
		  target.addClass("active");  
		  tabCont.css("display","none");
		  tabCont.eq(index).css("display","block");
		
		
		  modalCont.css("display","none");
		  modalCont.eq(index).css("display","block");
	});
});   
