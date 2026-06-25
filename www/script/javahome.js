const logar = document.getElementById("idform");

logar.addEventListener("submit", function(event){
    event.preventDefault();
    alert("Palpite feito");
    logar.reset();
});