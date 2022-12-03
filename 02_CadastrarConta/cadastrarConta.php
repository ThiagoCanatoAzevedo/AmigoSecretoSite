<!DOCTYPE html>
<!--==========LINKS-JS-CSS==========-->
<link href="cadastrarConta.css" rel="stylesheet" type="text/css" />
<link rel="icon" href="../Imagens/icone.jpeg">
<script src="cadastrarConta.js"></script>  

<!--==========PAGE-START==========-->
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela de usuário</title>
</head>

<!--==========PAGE-STRUCTURE==========-->
<body id="corpoBody">
    
    <div id="blackBox">
    
    <center>
    <h1 id="firstTitle">Cadastrar conta</h1>
    </center>
                <form action="../00_General/testeLogin.php" method="POST">
                    <input class="input" type="text" placeholder="Nome" name="nomeUsuario" id="nomeUsuario">
                    <br><br>

                    <input class="input" type="email" placeholder="Email" name="emailUsuario" id="emailUsuario">
                    <br><br>

                    <input class="input" type="password" placeholder="Senha" name="senhaUsuario" id="senhaUsuario" ><input type="checkbox" id="mostrarSenha" onclick="mostrarOcultarSenha()">
                    <br><br>

                    <center>
                        <button name="submitCadastrarConta" id="submitCadastrarConta">Enviar</button>
            
                        <button name="contaCriada" id="contaCriada">Conta já criada</button>
                    </center>
                </form>

    </div>

</body>
</html>