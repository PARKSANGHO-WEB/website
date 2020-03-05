document.addEventListener("DOMContentLoaded", function() {
    let myNav = document.querySelector("#myNav");
    let container = document.querySelector(".containerN");
    let html= document.querySelector("html");
    
    container.addEventListener("click", function() {
        myNav.classList.toggle("change");
        html.classList.toggle("overflowy");
    })
    
})

function myFunction(x) {
    x.classList.toggle("change");
    
}