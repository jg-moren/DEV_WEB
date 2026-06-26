<?php
session_start();

// Barreira de segurança: se não tem sessão, expulsa pro login
if (!isset($_SESSION['usuario_id'])) {
    header("Location: ../index.php");
    exit;
}


require_once '../service/jogo.php';
require_once '../service/bolao.php';
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bolão da Copa (Menu)</title>
    <link rel="stylesheet" type="text/css" href="../style/Home.css">
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@700&family=Poppins:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>
<body>
    <div class="Cabe">
        <div id="foto">
            <img src="../img/logo2026.png">
        </div>
        <div id="tit">
            <p class="font">BOLÃO DA COPA</p>
        </div>
        <div id="user"> <!--Adicionar no usuário e senha para exibir o nome e email do usuário-->
            <p class="t" id="u">Usuário: <?php echo htmlspecialchars($_SESSION['nome']); ?></p>
            <p class="t" id="e">Email: <?php echo htmlspecialchars($_SESSION['email']); ?></p>
            <?php if (isset($_SESSION['adm']) && $_SESSION['adm'] == 1): ?>
                <a href="ADMPage.php" class="sair">Pagina ADM</a>
            <?php endif; ?>
            <a href="../service/logout.php" class="sair"><p>Logout </p></a>
            
        </div>
    </div>
    <div class="Corp">
        <form id="idform" action="../service/addBolao.php" method="post">
            <fieldset>
                <legend class="Ti">Faça seu Palpite</legend>
                <div class="mb-3 tamcaixa">
                    <label for="partida" class="form-label" style="color:white;">Jogos disponíveis</label>
                    <select  class="form-select" name="jogo_id" id="partida" required>
                        <option selected disabled>Escolha uma partida</option>
                        <?php
                        $lista_jogos = $class_jogos->listar();
                        foreach ($lista_jogos as $jogo) {
                        ?>
                        <option value=<?php echo htmlspecialchars($jogo->id); ?>><?php echo htmlspecialchars($jogo->selecao1); ?> x <?php echo htmlspecialchars($jogo->selecao2); ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="mb-3 d-flex align-items-center justify-content-center gap-2 tamcaixa">
                    <input type="number" name="palpite1" class="form-control text-center" min="0" placeholder="0" required style="width: 60px;">
                    <span class="fw-bold">x</span>
                    <input type="number" name="palpite2" class="form-control text-center" min="0" placeholder="0" required style="width: 60px;">
                </div>
                <div class="mb-3 tamcaixa" style="text-align: center;">
                    <button type="submit" class="btn btn-success" id="jslogin">Confirmar</button>
                </div>
            </fieldset>
        </form>
    </div>
    <div class="Rank">
        <div class="erros">
            <h3>SEUS ERROS</h3>
            <div id="listaerros">
                <p><?php echo $class_bolao->contarErros($_SESSION['usuario_id']) ?></p>
                <!--Atualizar aqui a lista de erros-->
            </div>
        </div>
        


            
        <div class="acertos">
            <h3>SEUS ACERTOS</h3>
            <div id="listaacertos">
                <p><?php echo $class_bolao->contarAcertos($_SESSION['usuario_id']) ?></p>
            </div>
        </div>
    </div>
    
<?php
// 1. Chame a sua função e guarde o resultado em uma variável
// (Isso deve ficar no topo do seu arquivo, ou onde você instancia sua classe)
$listaDePalpites = $class_bolao->listar($_SESSION['usuario_id']); 
?>
<div class="container mt-4">
    <h3 class="text-center text-white mb-4">Meus Palpites</h3>
    
    <div class="row justify-content-center">
        
        <?php if (empty($listaDePalpites)): ?>
            <div class="col-12">
                <div class="alert alert-warning text-center">
                    Você ainda não deu nenhum palpite! Vá para a página inicial e comece a jogar.
                </div>
            </div>
        <?php else: ?>
            
            <?php foreach ($listaDePalpites as $palpite): ?>
                
                <?php
                // LÓGICA DE CORES: Descobre o status do jogo para pintar o cartão
                $cor_cartao = 'bg-secondary'; // Padrão: Cinza (Aguardando jogo)
                $texto_status = 'Aguardando Jogo ⏳';

                // Verifica se o jogo já tem um resultado real
                if ($palpite->real_time1 !== null && $palpite->real_time2 !== null) {
                    // Verifica se o palpite bateu exatamente com o placar real
                    if ($palpite->palpite_time1 == $palpite->real_time1 && $palpite->palpite_time2 == $palpite->real_time2) {
                        $cor_cartao = 'bg-success'; // Verde: Acertou na mosca
                        $texto_status = 'Acerto Exato! 🎯';
                    } else {
                        $cor_cartao = 'bg-danger'; // Vermelho: Errou o placar
                        $texto_status = 'Errou ❌';
                    }
                }
                ?>
                
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card text-white <?php echo $cor_cartao; ?> shadow h-100 border-0">
                        
                        <div class="card-header text-center fw-bold text-uppercase border-bottom border-light opacity-75">
                            <?php echo $texto_status; ?>
                        </div>
                        
                        <div class="card-body text-center">
                            
                            <h5 class="card-title mb-3 fs-4">
                                <?php echo htmlspecialchars($palpite->selecao1); ?> 
                                <span class="text-warning fw-bold mx-1">X</span> 
                                <?php echo htmlspecialchars($palpite->selecao2); ?>
                            </h5>
                            
                            <div class="mb-3">
                                <p class="mb-1 small text-uppercase fw-bold opacity-75">Meu Palpite</p>
                                <span class="badge bg-light text-dark fs-5 shadow-sm">
                                    <?php echo htmlspecialchars($palpite->palpite_time1); ?>
                                </span>
                                <span class="fw-bold mx-1 text-light">-</span>
                                <span class="badge bg-light text-dark fs-5 shadow-sm">
                                    <?php echo htmlspecialchars($palpite->palpite_time2); ?>
                                </span>
                            </div>
                            
                            <hr class="border-light opacity-25">
                            
                            <div>
                                <p class="mb-1 small text-uppercase fw-bold opacity-75">Resultado Oficial</p>
                                <?php if ($palpite->real_time1 !== null && $palpite->real_time2 !== null): ?>
                                    <span class="badge bg-dark text-white fs-6">
                                        <?php echo htmlspecialchars($palpite->real_time1); ?>
                                    </span>
                                    <span class="fw-bold mx-1 text-light">-</span>
                                    <span class="badge bg-dark text-white fs-6">
                                        <?php echo htmlspecialchars($palpite->real_time2); ?>
                                    </span>
                                <?php else: ?>
                                    <span class="badge bg-dark text-white opacity-50">Não finalizado</span>
                                <?php endif; ?>
                            </div>

                        </div>
                    </div>
                </div>

            <?php endforeach; ?>
        <?php endif; ?>
        
    </div>
</div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.min.js" integrity="sha384-G/EV+4j2dNv+tEPo3++6LCgdCROaejBqfUeNjuKAiuXbjrxilcCdDz6ZAVfHWe1Y" crossorigin="anonymous"></script>
</body>
</html>