<!DOCTYPE html>
<!--==========LINKS-JS-CSS==========-->
<link href="contaExistente.css" rel="stylesheet" type="text/css" />
<script src="contaExistente.js"> </script>  

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
    <h1 id="firstTitle">Conta existente</h1>
    </center>
            <form action="../00_General/testeLogin.php" method="POST">
                <input class="input" type="text" placeholder="Nome já cadastrado" name="nomeUsuario" id="nomeUsuario">
                <br><br>

                <input class="input" type="email" placeholder="Email já cadastrado" name="emailUsuario" id="emailUsuario">
                <br><br>

                <input class="input" type="password" placeholder="Senha já cadastrada" name="senhaUsuario" id="senhaUsuario"><input type="checkbox" id="mostrarSenha" onclick="mostrarOcultarSenha()">
                <br><br>
    

                <center>

                        <button name="submitContaExistente" id="submitContaExistente">Enviar</button>
                        <button name="contaExistente" id="contaExistente">Cadastre-se</button>
                    </form>
                </center>
            
    </div>

</body>
</html>