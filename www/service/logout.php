<?php
session_start();

// Destrói todas as informações da sessão atual
session_destroy();

// Redireciona de volta para a tela de login
header("Location: index.php");
exit;
?>