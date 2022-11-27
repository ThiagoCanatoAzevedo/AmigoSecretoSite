<?php

    session_start();
    include_once('config.php');
    // include_once('./01_ContaExistente/contaExistente.php');
    // include_once('./02_CadastrarConta/cadastrarConta.php');

    if(isset($_POST['contaCriada'])){
        header(('Location: ../01_ContaExistente/contaExistente.php'));
    }

    if(isset($_POST['contaExistente'])){
        header(('Location: ../02_CadastrarConta/cadastrarConta.php'));
    }

    $email  = addslashes ($_POST['emailUsuario']);
    $nome   = addslashes ($_POST['nomeUsuario']);
    $senha = password_hash($_POST['senhaUsuario'], PASSWORD_DEFAULT);

    if(isset($_POST['submitCadastrarConta'])){
        $sql    = "INSERT INTO loginusuarios (nome, email, senha) VALUES ('$nome', '$email', '$senha')"; //--> Colocar email aqui
        mysqli_query($conexao, $sql);
        
        header('Location: ../01_ContaExistente/contaExistente.php');
    }

    if(isset($_POST['submitContaExistente'])){ 
        $senha2 = $_POST['senhaUsuario'];
        $nome = $_POST['nomeUsuario'];
        
        $sql = mysqli_query($conexao, "SELECT * FROM loginusuarios WHERE email = '{$email}'");
        $sql2 = "SELECT * FROM loginusuarios WHERE email='$email' LIMIT 1";

        $sql_exec = $conexao->query($sql2);
        $usuario = $sql_exec->fetch_assoc();
        
        $idPessoas = $usuario['idlogin'];

        $sqlInsertIdGrupo = "INSERT INTO grupo (id_pessoa_criador) VALUES ('$idPessoas')"; //--> Colocar email aqui
        mysqli_query($conexao, $sqlInsertIdGrupo);

        // $sqlInsertIdFamilia = "INSERT INTO familia (id_pessoa_criador) VALUES ('$idPessoas')"; //--> Colocar email aqui
        // mysqli_query($conexao, $sqlInsertIdFamilia);

        if(mysqli_num_rows($sql)>0 and password_verify($senha2, $usuario['senha'])  ){
            $_SESSION['senhaUsuario'] = $email;
            $_SESSION['emailUsuario'] = $senha;
            $_SESSION['nomeUsuario'] = $nome;

            header('Location: ../03_PáginaPrincipal/paginaPrincipal.php');
        }
        else{
            unset($_SESSION['emailUsuario']);
            unset($_SESSION['senhaUsuario']);
            
            header('Location: ../02_CadastrarConta/cadastrarConta.php');

        }
        
}

?>