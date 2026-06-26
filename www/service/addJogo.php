<?php
session_start();

require_once 'jogo.php'; 

// 1. Verificação de segurança: só deixa atualizar se for o ADM
if (!isset($_SESSION['adm']) || $_SESSION['adm'] != 1) {
    header("Location: ../index.php");
    exit;
}

// 2. Verifica se os dados chegaram via POST (se o usuário clicou no botão)
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    // Captura os dados enviados pelo formulário
    $selecao1 = $_POST['selecao1'];
    $selecao2 = $_POST['selecao2'];

    // 4. CHAMA A FUNÇÃO INSERT QUE CORRIGIMOS
    $sucesso = $class_jogos->insert($selecao1, $selecao2);

    // 5. Redireciona o usuário de volta com uma mensagem de sucesso ou erro
    if ($sucesso) {
        $_SESSION['mensagem'] = "Partida registrado com sucesso!";
    } else {
        $_SESSION['erro'] = "Não foi possível salvar a partida. Tente novamente.";
    }
    //echo "<script>alert('Erro ao registrar palpite: "  . "');</script>";

    // Devolve o usuário para a página do Bolão
    header("Location: ../pages/ADMPage.php");
    exit;
}
?>