<?php
session_start();

// Barreira de segurança: se não tem sessão, expulsa pro login
if (!isset($_SESSION['usuario_id'])) {
    header("Location: ../index.php");
    exit;
}
// Se o usuário já estiver logado, joga ele para a página correta
if (isset($_SESSION['usuario_id'])) {
    // Adicionado um isset() por segurança para evitar erros caso 'adm' não exista
    if (isset($_SESSION['adm']) && $_SESSION['adm'] != 1) {
        header("Location: ../index.php");
        exit;
    }
}

require_once '../service/jogo.php';
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrativo</title>
    <link rel="stylesheet" type="text/css" href="../style/estiloadm.css">
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@700&family=Poppins:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>
<body>
    <div class="Cabe">
        <div id="foto">
            <img src="../img/logo2026.png">
        </div>
        <div id="tit">
            <p class="font">Área administrativa</p>
        </div>
        <div id="user"> <!--Adicionar no usuário e senha para exibir o nome e email do usuário-->
            <p class="t" id="u">Usuário: <?php echo htmlspecialchars($_SESSION['nome']); ?></p>
            <div class="botuser">
                <a href="BolãodaCopa.php" class="sair">Pagina principal</a>
                <a href="../service/logout.php" class="sair" id="log">Logout</a>
            </div>
        </div>
    </div>
    <div class="Corp">
        <div class="area-form">
            <form id="formCriar" action="../service/addJogo.php" method="post">
                <fieldset class="criativo">
                    <legend class="Ti">
                        Criar partida</legend>
                    <div class="mb-3 tamcaixa">
                        <label class="form-label" style="color:white;">Time 1</label>
                        <input required name="selecao1" type="text" class="form-control"placeholder="Nome do primeiro time">
                    </div>
                    <div class="mb-3 tamcaixa">
                        <label class="form-label" style="color:white;">
                            Time 2
                        </label>
                        <input required name="selecao2" type="text" class="form-control"placeholder="Nome do segundo time">
                    </div>
                    <div class="mb-3 botao">
                        <button type="submit" class="btn btn-success">Postar</button>
                    </div>
                </fieldset>
            </form>
            <form id="formAtualizar" action="../service/updateJogo.php" method="post">
                <fieldset class="atualização">
                    <legend class="Ti">Atualizar resultado</legend>
                    <div class="mb-3 tamcaixa">
                        <label class="form-label" style="color:white;">Jogos existentes</label>
                        <select required name="jogo_id" class="form-select">
                            <option selected disabled>Escolha uma partida</option>
                            <?php
                                $lista_jogos = $class_jogos->listar();
                                foreach ($lista_jogos as $jogo) {
                            ?>
                            <option value=<?php echo htmlspecialchars($jogo->id); ?>><?php echo htmlspecialchars($jogo->selecao1); ?> x <?php echo htmlspecialchars($jogo->selecao2); ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="placar">
                        <input required name="resultado_selecao1" type="number" class="form-control text-center" min="0" placeholder="0">
                        <span class="fw-bold text-white">X</span>
                        <input required name="resultado_selecao2" type="number" class="form-control text-center" min="0" placeholder="0">
                    </div>
                    <div class="mb-3 botao">
                        <button type="submit"class="btn btn-success">Postar</button>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
    
<div id="listapartidas" class="mt-4">
    <h2 class="text-white fw-bold mb-4">Gerenciar Partidas</h2>

    <?php 
    $listaDeJogos = $class_jogos->listar(); 
    
    if (empty($listaDeJogos)): 
    ?>
        <p class="text-white fs-4">Nenhuma partida cadastrada.</p>
    <?php else: ?>
        
        <table class="table text-white mt-3 fs-5">
            <thead class="border-bottom border-light fs-4">
                <tr>
                    <th class="bg-transparent text-white">Partida</th>
                    <th class="text-center bg-transparent text-white">Placar Real</th>
                    <th class="text-center bg-transparent text-white">Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($listaDeJogos as $jogo): ?>
                    <tr class="border-bottom border-secondary">
                        
                        <td class="align-middle bg-transparent text-white fw-bold">
                            <?php echo htmlspecialchars($jogo->selecao1 . " X " . $jogo->selecao2); ?>
                        </td>
                        
                        <td class="text-center align-middle bg-transparent text-white">
                            <?php 
                            if ($jogo->resultado_selecao1 !== null) {
                                echo htmlspecialchars($jogo->resultado_selecao1 . " - " . $jogo->resultado_selecao2);
                            } else {
                                echo "<span class='badge bg-secondary fs-6'>Sem resultado</span>";
                            }
                            ?>
                        </td>
                        
                        <td class="text-center align-middle bg-transparent text-white">
                            
                            <form method="POST" action="../service/deleteJogo.php" onsubmit="return confirm('ATENÇÃO: Tem certeza que deseja apagar o jogo <?php echo htmlspecialchars($jogo->selecao1 . " X " . $jogo->selecao2); ?>? Isso não pode ser desfeito!');">
                                
                                <input type="hidden" name="id_jogo" value="<?php echo htmlspecialchars($jogo->id); ?>">
                                
                                <button type="submit" class="btn btn-danger btn-lg fw-bold shadow-sm">Apagar</button>
                            </form>
                            
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

    <?php endif; ?>
</div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.min.js" integrity="sha384-G/EV+4j2dNv+tEPo3++6LCgdCROaejBqfUeNjuKAiuXbjrxilcCdDz6ZAVfHWe1Y" crossorigin="anonymous"></script>
</body>
</html>