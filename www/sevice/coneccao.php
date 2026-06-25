<?php
    function conectar(){
        $host = 'localhost:3308';
        $user = 'root';
        $pws = '100388';
        $dbname = 'aula';

        try{
        $conexao = new PDO("mysql:host=$host;dbname=$dbname", $user, $pws);
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