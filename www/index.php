
<?php
$host = 'db'; // EM VEZ DE 'localhost', use o nome do serviço do docker-compose
$banco = 'copa_db';
$usuario = 'root';
$senha = 'root';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$banco;charset=utf8", $usuario, $senha);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Conectado ao MySQL com sucesso via Docker!";
} catch (PDOException $e) {
    echo "Erro na conexão: " . $e->getMessage();
}
?>