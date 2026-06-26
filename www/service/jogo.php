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

        }

        public function deletar($id) {
            $con = conectar();
            
            try {
                $stmt = $con->prepare("DELETE FROM jogo WHERE id = :id");
                $stmt->execute([':id' => $id]);
                
                return true;
            } catch (PDOException $e) {
                return false; 
            }
        }


    }

    $class_jogos = new Jogo();
  
  