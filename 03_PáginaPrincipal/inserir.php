<?php
    include_once('../00_General/config.php');
    // include_once('paginaPrincipal.php');
    session_start();
    // include_once('../03_PáginaPrincipal/paginaPrincipal.php');
    $logado = $_SESSION['nomeUsuario'];

    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $presente = $_POST['presente'];
    $familia = $_POST['familia'];
    $grupo = $_POST['grupo'];

    $_SESSION['grupo'] = $_POST['grupo']; 
    $_SESSION['familia'] = $_POST['familia'];
    $_SESSION['nome'] = $_POST['nome'];

    $grupoAtual = $_SESSION['grupos'];

    $nomeCriador = "SELECT * FROM loginusuarios WHERE nome='$logado' LIMIT 1";
    $sql_exec = $conexao->query($nomeCriador);
    $usuario = $sql_exec->fetch_assoc();
    $idCriador = $usuario['idlogin'];

    $gruposBD  = mysqli_query($conexao, "INSERT INTO grupo (nomegrupo, id_pessoa_criador)  
    VALUES ('$grupo', '$idCriador')");   

    $idGrupo = "SELECT * FROM grupo WHERE nomegrupo='$grupo' LIMIT 1";
    $sql_exec = $conexao->query($idGrupo);
    $usuario = $sql_exec->fetch_assoc();
    $idGrupoBD = $usuario['idgrupo'];

    $familiaBD = mysqli_query($conexao, "INSERT INTO familia (nomefamilia, id_pessoa_criador)  
    VALUES ('$familia', '$idCriador')");

    $pessoasBD  = mysqli_query($conexao, "INSERT INTO pessoas (nome, email, familia, id_pessoa_criador, presente)           
    VALUES ('$nome', '$email', '$familia', '$idCriador', '$presente')");    

    $idPessoas = "SELECT * FROM pessoas WHERE nome='$nome' AND id_pessoa_criador='$idCriador' LIMIT 1";
    $sql_exec = $conexao->query($idPessoas);
    $usuario = $sql_exec->fetch_assoc();
    $idPessoasBD = $usuario['idpessoas'];

    if(empty($grupo)){
        $grupoPessoasBD2 = mysqli_query($conexao, "INSERT INTO grupopessoas (idGrupo, idPessoa, presente, id_pessoa_criador, familia, email)
        VALUES ('$grupoAtual', '$idPessoasBD' ,'$presente', '$idCriador', '$familia', '$email')");

    }    

?>