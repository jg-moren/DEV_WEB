<?php
    
    require_once 'conexao.php';


    class Bolao {

        public function insert($jogo_id, $usuario_id, $palpite_time1, $palpite_time2) {
            $con = conectar();
            
            try {
                // 1. O número de colunas bate exatamente com o número de "binds" (:variavel)
                $sql = "INSERT INTO bolao (jogo, usuario, resultado_selecao1, resultado_selecao2) 
                        VALUES (:jogo, :usuario, :resultado1, :resultado2)";
                        
                $stmt = $con->prepare($sql);
                
                // 2. Os nomes aqui batem perfeitamente com os do VALUES acima
                $stmt->execute([
                    ':jogo'       => $jogo_id,
                    ':usuario'    => $usuario_id,
                    ':resultado1' => $palpite_time1,
                    ':resultado2' => $palpite_time2
                ]);

                return true; // Retorna verdadeiro se deu tudo certo

            } catch(PDOException $e) {
                // Exibe o erro de forma clara se algo falhar no banco
                echo "<script>alert('Erro ao registrar palpite: " . $e->getMessage() . "');</script>";
                return false;
            }
        }

        public function listar($usuario_id) {
            $con = conectar();

            // O SQL com INNER JOIN e ALIAS (AS) para evitar conflito de nomes
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
            
            // Filtra apenas os palpites do usuário que está logado
            $stmt->execute([':usuario_id' => $usuario_id]);
            
            $lista = $stmt->fetchAll(PDO::FETCH_OBJ);

            // Retorna todos os registros como um array de objetos
            return $lista;
        }

        public function contarAcertos($usuario_id) {
            $con = conectar();

            // Compara diretamente as colunas de palpite com as colunas de resultado real
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

            // Busca o resultado. Como usamos AS total_acertos, podemos ler direto essa propriedade
            $resultado = $stmt->fetch(PDO::FETCH_OBJ);

            // Retorna apenas o número (ex: 0, 3, 5)
            return $resultado->total_acertos;
        }

        public function contarErros($usuario_id) {
            $con = conectar();

            // Usamos != (diferente) e OR (ou) para contar os erros
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

            // Retorna apenas o número de erros
            return $resultado->total_erros;
        }

        // public function atualizar(){

        //     $con = conectar();

        //     $sql = "UPDATE cliente set nome = :nome, tel = :tel, endereco = :endereco where cpf = :cpf ";
        //     $stmt = $con->prepare($sql);

        //     $stmt->execute([
        //         ':nome'=> $this->getNome(),
        //         ':tel'=> $this->getTel(),
        //         ':cpf'=>$this->getCpf(),
        //         ':endereco'=>$this->getEndereco()
        //     ]);
        //     echo "<h1 style='color:green'>Dados atualizados com sucesso!!!!</h1>";

        // }

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

    $class_bolao = new Bolao();
  
  
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