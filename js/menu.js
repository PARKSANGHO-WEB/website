document.addEventListener("DOMContentLoaded", function() {
    let myNav = document.querySelector("#myNav");
    let container = document.querySelector(".containerN");
    let html = document.querySelector("html")
    let body = document.querySelector("body")
    
    
    
    container.addEventListener("click", function() {
        myNav.classList.toggle("change");
    })
    
})

function myFunction(x) {
    x.classList.toggle("change");
    
}




$(function () {
  $(document).scroll(function () {
    var $nav = $(".mo-nav");
    $nav.toggleClass('scrolled', $(this).scrollTop() > $nav.height());
  });
});