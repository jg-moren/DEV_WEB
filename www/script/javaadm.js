const criar = document.getElementById("formCriar");
const atualizar = document.getElementById("formAtualizar");
criar.addEventListener("submit", function(event){
    //event.preventDefault();
    //alert("Partida criada!");
    criar.reset();

});

atualizar.addEventListener("submit", function(event){
    //event.preventDefault();
    //alert("Resultado definido!");
    atualizar.reset();
});