<?php
session_start();
require 'conexao.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = trim($_POST['email']);
    $senha = trim($_POST['senha']);

    // Busca o usuário pelo email
    $consulta = $pdo->prepare("SELECT id, nome, senha FROM usuarios WHERE email = :email");
    $consulta->execute(['email' => $email]);
    $usuario = $consulta->fetch(PDO::FETCH_ASSOC);

    // Valida se achou o usuário e se a senha criptografada confere
    if ($usuario && password_verify($senha, $usuario['senha'])) {
        
        // Deu certo! Salva os dados na sessão
        $_SESSION['usuario_id'] = $usuario['id'];
        $_SESSION['nome'] = $usuario['nome'];
        $_SESSION['adm'] = $usuario['adm'];
        
        header("Location: pages/BolãodaCopa.php"); // Vai para a área restrita
        exit;
        
    } else {
        // Deu errado! Volta pro index com erro
        $_SESSION['erro'] = "E-mail ou senha incorretos.";
        header("Location: ../index.php");
        exit;
    }
}
?>