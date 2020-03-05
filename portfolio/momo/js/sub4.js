$(document).ready(function(){
    
  var a = $(".dbcont2 ,.dbcont3, .dbcont4,.dbcont5,.dbcont6,.dbcont7,.dbcont8,.dbcont9");
  var b = $(".dbcont1 ,.dbcont3, .dbcont4,.dbcont5,.dbcont6,.dbcont7,.dbcont8,.dbcont9");
  var c = $(".dbcont2 ,.dbcont1, .dbcont4,.dbcont5,.dbcont6,.dbcont7,.dbcont8,.dbcont9");
  var d = $(".dbcont2 ,.dbcont3, .dbcont1,.dbcont5,.dbcont6,.dbcont7,.dbcont8,.dbcont9");
  var e = $(".dbcont2 ,.dbcont3, .dbcont4,.dbcont1,.dbcont6,.dbcont7,.dbcont8,.dbcont9");
  var f = $(".dbcont2 ,.dbcont3, .dbcont4,.dbcont5,.dbcont1,.dbcont7,.dbcont8,.dbcont9");
  var g = $(".dbcont2 ,.dbcont3, .dbcont4,.dbcont5,.dbcont6,.dbcont1,.dbcont8,.dbcont9");
  var h = $(".dbcont2 ,.dbcont3, .dbcont4,.dbcont5,.dbcont6,.dbcont7,.dbcont1,.dbcont9");
  var i = $(".dbcont2 ,.dbcont3, .dbcont4,.dbcont5,.dbcont6,.dbcont7,.dbcont8,.dbcont1");
    
  $(".btn1").click(function(){
    $(".dbcont1").css("display","block");
    $(a).css("display","none");
  });
  $(".btn2").click(function(){
    $(".dbcont2").css("display","block");
    $(b).css("display","none");
  });
  $(".btn3").click(function(){
    $(".dbcont3").css("display","block");
    $(c).css("display","none");
  });
  $(".btn4").click(function(){
    $(".dbcont4").css("display","block");
    $(d).css("display","none");
  });
  $(".btn5").click(function(){
    $(".dbcont5").css("display","block");
    $(e).css("display","none");
  });
  $(".btn6").click(function(){
    $(".dbcont6").css("display","block");
    $(f).css("display","none");
  });
  $(".btn7").click(function(){
    $(".dbcont7").css("display","block");
    $(g).css("display","none");
  });
  $(".btn8").click(function(){
    $(".dbcont8").css("display","block");
    $(h).css("display","none");
  });
  $(".btn9").click(function(){
    $(".dbcont9").css("display","block");
    $(i).css("display","none");
  });
    
});

$(function() {
  $('#sel1').change(function(){
    $('.dbcont').hide();
    $('#' + $(this).val()).show();
  });
});


$(function(){
    var imageGrad = $('.infotap'),
    image = $('.cine_img');

function resizeDiv () {
    imageGrad.height(image.height());
    imageGrad.width(image.width());
}

});