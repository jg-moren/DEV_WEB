<?php
session_start();
require_once 'jogo.php'; 

if (!isset($_SESSION['adm']) || $_SESSION['adm'] != 1) {
    header("Location: ../index.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id_jogo'])) {
    
    $id_jogo = $_POST['id_jogo'];

    $sucesso = $class_jogos->deletar($id_jogo);

    header("Location: ../pages/ADMPage.php");
    exit;
} else {
    header("Location: ../pages/ADMPage.php");
    exit;
}
?>