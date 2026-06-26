<?php
session_start();

require_once 'jogo.php'; 

// 1. Verificação de segurança: só deixa atualizar se for o ADM
if (!isset($_SESSION['adm']) || $_SESSION['adm'] != 1) {
    header("Location: ../index.php");
    exit;
}

// 2. Inclua o arquivo onde está a sua classe de jogos
// require_once 'caminho/para/sua/ClasseJogos.php';
// $class_jogos = new ClasseJogos();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // 3. Pega os dados enviados pelo formulário
    $id_jogo = $_POST['jogo_id'];
    $resultado_selecao1 = $_POST['resultado_selecao1'];
    $resultado_selecao2 = $_POST['resultado_selecao2'];

    // 4. Chama a sua função de atualizar
    $class_jogos->atualizar($id_jogo, $resultado_selecao1, $resultado_selecao2);

    // 5. Devolve o administrador para a página, para ele ver a mudança
    header("Location: ../pages/ADMPage.php");
    exit;
}
?>