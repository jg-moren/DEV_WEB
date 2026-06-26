<?php
session_start();

require_once 'jogo.php'; 

if (!isset($_SESSION['adm']) || $_SESSION['adm'] != 1) {
    header("Location: ../index.php");
    exit;
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_jogo = $_POST['jogo_id'];
    $resultado_selecao1 = $_POST['resultado_selecao1'];
    $resultado_selecao2 = $_POST['resultado_selecao2'];

    $class_jogos->atualizar($id_jogo, $resultado_selecao1, $resultado_selecao2);

    header("Location: ../pages/ADMPage.php");
    exit;
}
?>