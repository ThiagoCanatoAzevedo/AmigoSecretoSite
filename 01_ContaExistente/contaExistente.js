function mostrarOcultarSenha(){
    var senha = document.getElementById("senhaUsuario");

    if(senha.type == "password"){
        senha.type="text";

    }
    else{
        senha.type="password";

    }

}