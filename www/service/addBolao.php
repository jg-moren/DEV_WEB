<?php
require_once 'bolao.php'; 
session_start();

// 1. Barreira de Segurança: O usuário tem que estar logado para palpitar
if (!isset($_SESSION['usuario_id'])) {
    header("Location: ../index.php");
    exit;
}

// 2. Verifica se os dados chegaram via POST (se o usuário clicou no botão)
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    // Captura os dados enviados pelo formulário
    $jogo_id = $_POST['jogo_id'];
    $palpite1 = $_POST['palpite1'];
    $palpite2 = $_POST['palpite2'];
    
    // Pega o ID do usuário diretamente da sessão gerada no login
    $usuario_id = $_SESSION['usuario_id'];

    // 3. Inclui e Instancia a classe que contém a função insert()
    // Ajuste o nome do arquivo abaixo para o nome real do seu arquivo de classe
    

    // 4. CHAMA A FUNÇÃO INSERT QUE CORRIGIMOS
    $sucesso = $class_bolao->insert($jogo_id, $usuario_id, $palpite1, $palpite2);

    // 5. Redireciona o usuário de volta com uma mensagem de sucesso ou erro
    if ($sucesso) {
        $_SESSION['mensagem'] = "Palpite registrado com sucesso!";
    } else {
        $_SESSION['erro'] = "Não foi possível salvar o palpite. Tente novamente.";
    }
    //echo "<script>alert('Erro ao registrar palpite: "  . "');</script>";

    // Devolve o usuário para a página do Bolão
    header("Location: ../pages/BolãodaCopa.php");
    exit;
}
?>