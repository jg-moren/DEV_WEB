<?php
session_start();
require 'conexao.php';


$pdo = conectar();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = trim($_POST['email']);
    $senha = trim($_POST['senha']);

    $consulta = $pdo->prepare("SELECT id, nome, email, senha, adm FROM usuarios WHERE email = :email");
    $consulta->execute(['email' => $email]);
    $usuario = $consulta->fetch(PDO::FETCH_ASSOC);

    if ($usuario && $senha == password_verify($senha, $usuario['senha'])) {
        
        $_SESSION['usuario_id'] = $usuario['id'];
        $_SESSION['nome'] = $usuario['nome'];
        $_SESSION['email'] = $usuario['email'];
        $_SESSION['adm'] = $usuario['adm'];
        
        header("Location: ../pages/BolãodaCopa.php");
        exit;
        
    } else {
        $_SESSION['erro'] = "E-mail ou senha incorretos.";
        header("Location: ../index.php");
        exit;
    }
}
?>