
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











$(document).ready(function(){

	var tabBtn2 = $(".tab-btn2 > ul > li");  
	var modalCont2 = $(".mo-con2");   

	modalCont2.hide().eq(0).show();

	tabBtn2.click(function(){
		  var target = $(this);      
		  var index = target.index();  

		  tabBtn2.removeClass("active");  
		  target.addClass("active");  
		  modalCont2.css("display","none");
		  modalCont2.eq(index).css("display","block");
		
		
		  modalCont2.css("display","none");
		  modalCont2.eq(index).css("display","block");
	});
});   
