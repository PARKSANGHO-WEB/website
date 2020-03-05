document.addEventListener("DOMContentLoaded", function() {
    let myNav = document.querySelector("#myNav");
    let container = document.querySelector(".containerN");
    
    container.addEventListener("click", function() {
        myNav.classList.toggle("change");
    })
    
})

function myFunction(x) {
    x.classList.toggle("change");
    
}