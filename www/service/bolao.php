<?php
    
    require_once 'conexao.php';


    class Bolao {

        public function insert($jogo_id, $usuario_id, $palpite_time1, $palpite_time2) {
            $con = conectar();
            
            try {
                $sql = "INSERT INTO bolao (jogo, usuario, resultado_selecao1, resultado_selecao2) 
                        VALUES (:jogo, :usuario, :resultado1, :resultado2)";
                        
                $stmt = $con->prepare($sql);
                
                $stmt->execute([
                    ':jogo'       => $jogo_id,
                    ':usuario'    => $usuario_id,
                    ':resultado1' => $palpite_time1,
                    ':resultado2' => $palpite_time2
                ]);

                return true; 

            } catch(PDOException $e) {
                echo "<script>alert('Erro ao registrar palpite: " . $e->getMessage() . "');</script>";
                return false;
            }
        }

        public function listar($usuario_id) {
            $con = conectar();

            $sql = "SELECT 
                        b.id,
                        j.selecao1, 
                        j.selecao2, 
                        b.resultado_selecao1 AS palpite_time1, 
                        b.resultado_selecao2 AS palpite_time2,
                        j.resultado_selecao1 AS real_time1,
                        j.resultado_selecao2 AS real_time2
                    FROM bolao b
                    INNER JOIN jogo j ON b.jogo = j.id
                    WHERE b.usuario = :usuario_id";
                    

            $stmt = $con->prepare($sql);
            
            $stmt->execute([':usuario_id' => $usuario_id]);
            
            $lista = $stmt->fetchAll(PDO::FETCH_OBJ);

            return $lista;
        }

        public function contarAcertos($usuario_id) {
            $con = conectar();

            $sql = "SELECT COUNT(*) AS total_acertos
                    FROM bolao b
                    INNER JOIN jogo j ON b.jogo = j.id
                    WHERE b.usuario = :usuario_id
                    AND j.resultado_selecao1 IS NOT NULL 
                    AND j.resultado_selecao2 IS NOT NULL
                    AND b.resultado_selecao1 = j.resultado_selecao1 
                    AND b.resultado_selecao2 = j.resultado_selecao2";

            $stmt = $con->prepare($sql);
            $stmt->execute([':usuario_id' => $usuario_id]);

            $resultado = $stmt->fetch(PDO::FETCH_OBJ);

            return $resultado->total_acertos;
        }

        public function contarErros($usuario_id) {
            $con = conectar();

            $sql = "SELECT COUNT(*) AS total_erros
                    FROM bolao b
                    INNER JOIN jogo j ON b.jogo = j.id
                    WHERE b.usuario = :usuario_id
                    AND j.resultado_selecao1 IS NOT NULL 
                    AND j.resultado_selecao2 IS NOT NULL
                    AND (b.resultado_selecao1 != j.resultado_selecao1 OR b.resultado_selecao2 != j.resultado_selecao2)";

            $stmt = $con->prepare($sql);
            $stmt->execute([':usuario_id' => $usuario_id]);

            $resultado = $stmt->fetch(PDO::FETCH_OBJ);

            return $resultado->total_erros;
        }

    }

    $class_bolao = new Bolao();
  
  
