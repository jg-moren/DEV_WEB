<?php
   
    function conectar(){
        $host = "db";
        $user="root";
        $pass ="root";
        $dbname = "copa_db";

        try{
        $conexao = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
        //Configurar o pdo para lançar exceções sempre que houver um erro 
        $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //echo "Conectado com sucesso!!!";
        return $conexao;
        }
        catch (PDOException $e) {
            echo "Erro ao conectar: " . $e->getMessage();
            exit;
        }
    }
?>