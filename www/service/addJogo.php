<?php
session_start();

require_once 'jogo.php'; 

if (!isset($_SESSION['adm']) || $_SESSION['adm'] != 1) {
    header("Location: ../index.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $selecao1 = $_POST['selecao1'];
    $selecao2 = $_POST['selecao2'];

    $sucesso = $class_jogos->insert($selecao1, $selecao2);

    if ($sucesso) {
        $_SESSION['mensagem'] = "Partida registrado com sucesso!";
    } else {
        $_SESSION['erro'] = "Não foi possível salvar a partida. Tente novamente.";
    }

    header("Location: ../pages/ADMPage.php");
    exit;
}
?>