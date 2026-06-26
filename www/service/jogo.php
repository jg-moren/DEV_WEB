<?php
    
    require_once 'conexao.php';


    class Jogo {

        public function insert( $selecao1, $selecao2 ){

            $con = conectar();
            try{
                $sql = "INSERT INTO jogo (selecao1, selecao2) values (:selecao1, :selecao2)";
                $stmt = $con->prepare($sql);
                $stmt->execute([
                ':selecao1'=> $selecao1,
                ':selecao2'=> $selecao2
                ]);

            }
            catch(PDOException $e){
               echo "Erro ao enviar a mensagem: " . $e->getMessage();
            }
        }

        public function listar(){
            $con = conectar();

            $stmt = $con->prepare("SELECT id, selecao1, selecao2, resultado_selecao1, resultado_selecao2 from jogo;");
            $stmt->execute([]);

            $lista = $stmt->fetchAll(PDO::FETCH_OBJ);

            return $lista;
        }

        public function atualizar( $id, $resultado_selecao1, $resultado_selecao2){

            $con = conectar();
            $stmt = $con->prepare("UPDATE jogo set resultado_selecao1 = :resultado_selecao1, resultado_selecao2 = :resultado_selecao2 where id = :id");

            $stmt->execute([
                ':resultado_selecao1'=> $resultado_selecao1,
                ':resultado_selecao2'=> $resultado_selecao2,
                ':id'=> $id
            ]);
            //echo "<h1 style='color:green'>Dados atualizados com sucesso!!!!</h1>";

        }

        public function deletar($id) {
            $con = conectar();
            
            try {
                // Comando SQL para apagar onde o ID for igual ao recebido
                $stmt = $con->prepare("DELETE FROM jogo WHERE id = :id");
                $stmt->execute([':id' => $id]);
                
                return true; // Sucesso
            } catch (PDOException $e) {
                // Se der erro (ex: jogo tem palpites vinculados), retorna falso
                return false; 
            }
        }

        // public function excluir($cpf){

        //     $con = conectar();
    
        //     $sql = "DELETE from cliente where cpf = :cpf";
        //     $stmt = $con->prepare($sql);
        //     $stmt->execute([
        //         ':cpf' => $cpf
        //     ]);
        //     echo "<h1 style='color:green'>Dados excluidos com sucesso!!!!</h1>";
        // }


    }

    $class_jogos = new Jogo();
  
  
/*
    //Para cadastrar descomente a linha 
    $cli->setNome('Fernando augusto ');
    $cli->setCpf('11224466');
    $cli->setTel('21-9246-0102');
    $cli->setEndereco('Rua: Teste, cidade exemplo....');
    $cli->cadCliente();
*/

    //Descomente a linha para consultar um cliente pelo cpf
    //$cli->consultar('11224466');
    
    
/*  
    //Descomente para atualizar os dados na base 
    $cli->setNome('Maria Fernanda');
    $cli->setCpf('123456');
    $cli->setTel('21-99112-0102');
    $cli->setEndereco('Rua: Teste, cidade exemplo....');
    $cli->atualizar();
*/

    //Descomente para excluir uma nova informação 
    //$cli->excluir('123456');


    //Descomente para listar todos os dados inseridos 
    //$cli->listar();
?>