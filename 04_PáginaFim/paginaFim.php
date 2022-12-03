<?php

include_once('../00_General/config.php');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';
session_start();
error_reporting(0);

$cont = 0;

$pegaTodosValores = "SELECT * FROM pessoas";

$arrayTodosNomes = array();
$arrayTodasFamilias = array();
$arrayTodosEmails = array();
$arrayTodosPresentes = array();

$numerosSorteados = array();

$logado = $_SESSION['nomeUsuario'];
$grupoAtual = $_SESSION['grupos'];

$nomeCriador = "SELECT * FROM loginusuarios WHERE nome='$logado'";
$sql_exec = $conexao->query($nomeCriador);
$usuario = $sql_exec->fetch_assoc();
$idCriador = $usuario['idlogin'];

$valoresGruposAtual = "SELECT * FROM grupopessoas WHERE idGrupo='$grupoAtual' AND id_pessoa_criador='$idCriador'";
$sql_exec5 = $conexao->query($valoresGruposAtual);

$lenght_participante = "SELECT * FROM grupopessoas WHERE idGrupo='$grupoAtual' AND id_pessoa_criador='$idCriador'";
$lenghtParticipantes = $conexao->query($lenght_participante);
$numeroRowsParticipantes = mysqli_num_rows($lenghtParticipantes);

$cont = 0;

if(isset($_POST['send'])){
    // echo "Send";
    while($cont < $numeroRowsParticipantes){
        $rows = $sql_exec5->fetch_assoc() ;
    
        $nomeAtual = $rows['idPessoa'];
    
        $nomeAlgumaCoisa = "SELECT * FROM pessoas WHERE idpessoas='$nomeAtual'";
        $sql_execNomeAtual = $conexao->query($nomeAlgumaCoisa);
        $usuario = $sql_execNomeAtual->fetch_assoc();
    
        array_push($arrayTodosNomes, $usuario['nome']);
        array_push($arrayTodasFamilias, $usuario['familia']);
        array_push($arrayTodosEmails, $usuario['email']);
        array_push($arrayTodosPresentes, $usuario['presente']);

    
        $randomizacao = rand(0, $numeroRowsParticipantes-1);

        $arrayFamiliasCont = $arrayTodasFamilias[$cont];
        $arrayFamiliasRandomizacao = $arrayTodasFamilias[$randomizacao];

        $cont2 = 0;
        while($cont2 < 3 and (in_array($randomizacao, $numerosSorteados) or $arrayFamiliasCont == $arrayFamiliasRandomizacao)){
            $randomizacao = rand(0, $numeroRowsParticipantes-1);
            $cont2+=1;
        }
    
        if($cont2 == 3){
            $numerosSorteados = array();
            $cont = 0;
            continue;
        }

        array_push($numerosSorteados, $randomizacao);
        
        $cont+=1;
    }

    $quantidadesNomes = 0;
    $lenght_participante = "SELECT * FROM grupopessoas WHERE idGrupo='$grupoAtual' AND id_pessoa_criador='$idCriador'";
    $lenghtParticipantes = $conexao->query($lenght_participante);
    $quantidadesNomes =  mysqli_num_rows($lenghtParticipantes);

    $cont3 = 0;
    
    while($cont3 < $quantidadesNomes){
        $todosValores = $numerosSorteados[$cont3];
        $todosNomes = $arrayTodosNomes[$todosValores];
        $todosPresentes = $arrayTodosPresentes[$todosValores];

        $quemSorteouSorteados = mysqli_query($conexao, "INSERT INTO grupopessoasorteio (idpessoagrupo_amigo, idpessoagrupo_sorteado)  
        VALUES ('$arrayTodosNomes[$cont3]', '$todosNomes')");
        
        $mail = new PHPMailer(true);
    
        $mail->isSMTP();
        $mail->CharSet = "utf-8";
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = 'tls';
    
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = 587;
        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );
        $mail->isHTML(true);
    
        $mail->Username = 'amigosecretojogos@gmail.com';
        $mail->Password = 'biqyfvicntgdiniv';
        $mail->Subject = "Amigo secreto do grupo "  .  $grupoAtual ;
        $mail->MsgHTML("<div style='border: solid 1px #2D2D2A;'id='mensagemAmigoSecreto'>
        <p style='font-size: 18px; color: #3C3C3C; margin-left: 10px;' class='informacoesMensagemAmigoSecreto'> Olá! Obrigado por utilizar o nosso programa para o seu amigo secreto. Esperamos ter ajudado você e todo o seu grupo a fazer um jogo mais legal e funcional!</p>
        <br> 
        <h2 style='font-size: 20px; color: #353831; margin-left: 10px;' class='tirouPresenteMensagemAmigoSecreto' >Você infelizmente (ou felizmente) tirou: " . $todosNomes  ."</h2>
        <br>
        <h2 style='font-size: 20px; color: #353831; margin-left: 10px;' class='tirouPresenteMensagemAmigoSecreto'>Essa pessoa gostaria de receber: " . $todosPresentes  ."</h2>
        <br>
        <p style='font-size: 18px; color: #3C3C3C; margin-left: 10px;' class='informacoesMensagemAmigoSecreto'>Do seu amigo Thiago Canato e de toda equipe do AmigoSecreto.
        Até um próximo jogo!</p>
        </div>");
        $mail->addAddress($arrayTodosEmails[$cont3]);
    
        $mail->send();

        $cont3+=1;
    }


}


?> 

<DOCTYPE html>
<html>
<head>
<meta charset="UTF-8"/>
<title>AmigoSecreto</title>
</head>
<body id = "fullBody">  
<!-- <link rel="icon" href="../Imagens/icone.jpeg"> -->
    <link href="paginaFim.css" rel="stylesheet" type="text/css" /> 
    <script type="text/javascript" src="paginaFim.js"> </script>

    <center><h1 id="titleOne">
        O sorteio será realizado após apertar esse botão!
    </h1>
    <form method="post" action=''>
        <button type='submit' name='send' id='enviaEmails'>Enviar</button>
    </form>
    <h1 id='titleOne'> Peça para os participantes olharem os emails deles após a página terminar de carregar.</h1>
</center>


</body>
</html>


