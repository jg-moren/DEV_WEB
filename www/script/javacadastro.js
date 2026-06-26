let formulario = document.getElementById("idform");

formulario.addEventListener("submit", function(event){
    //event.preventDefault();
    let senha = document.getElementById("se").value;
    let confirmarSenha = document.getElementById("se2").value;
    if(senha === confirmarSenha){
        //alert("Cadastro enviada!");
        //window.location.href = "Login.html";
    }
    else{
        event.preventDefault();
        alert("Senhas são diferentes! Confira elas novamente");
    }
});