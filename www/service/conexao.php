<?php
   
    $host = "db";
    $user="root";
    $pass ="root";
    $dbname = "copa_db";

    try{
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
    //Configurar o pdo para lançar exceções sempre que houver um erro 
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo "Conectado com sucesso!!!";
    }
    catch (PDOException $e) {
        echo "Erro ao conectar: " . $e->getMessage();
        exit;
    }

   
?>