<?php
session_start();
require_once 'jogo.php'; 

// 1. Barreira de segurança: Apenas o ADM pode acessar este arquivo
if (!isset($_SESSION['adm']) || $_SESSION['adm'] != 1) {
    header("Location: ../index.php");
    exit;
}

// 2. Verifica se a requisição veio do formulário via POST
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id_jogo'])) {
    
    $id_jogo = $_POST['id_jogo'];

    // 3. Inclui a classe e instancia
    // Lembre-se de ajustar o nome do arquivo e da classe para os seus corretos!

    // 4. Executa a função de deletar
    $sucesso = $class_jogos->deletar($id_jogo);

    // 5. Redireciona o ADM de volta para a página de gerenciamento
    header("Location: ../pages/ADMPage.php");
    exit;
} else {
    // Se tentarem acessar a URL direto, chuta de volta
    header("Location: ../pages/ADMPage.php");
    exit;
}
?>