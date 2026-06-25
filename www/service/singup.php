<?php
session_start();
require 'conexao.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = trim($_POST['nome']);
    $email = trim($_POST['email']);
    $senha = trim($_POST['senha']);

    // Busca o usuário pelo email
    $create = $pdo->prepare("INSERT INTO usuarios (nome, senha, email, adm) VALUES (:nome, :senha, :email, 0)");
    $create->execute(['nome' => $nome, 'email' => $email, 'senha' => $senha]);
    //$usuario = $consulta->fetch(PDO::FETCH_ASSOC);

    header("Location: ../index.php");
    
}
?>