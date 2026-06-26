<?php
require_once 'bolao.php'; 
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header("Location: ../index.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $jogo_id = $_POST['jogo_id'];
    $palpite1 = $_POST['palpite1'];
    $palpite2 = $_POST['palpite2'];
    
    $usuario_id = $_SESSION['usuario_id'];

    $sucesso = $class_bolao->insert($jogo_id, $usuario_id, $palpite1, $palpite2);

    if ($sucesso) {
        $_SESSION['mensagem'] = "Palpite registrado com sucesso!";
    } else {
        $_SESSION['erro'] = "Não foi possível salvar o palpite. Tente novamente.";
    }

    header("Location: ../pages/BolãodaCopa.php");
    exit;
}
?>