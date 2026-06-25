<?php
session_start();

// Barreira de segurança: se não tem sessão, expulsa pro login
if (!isset($_SESSION['usuario_id'])) {
    header("Location: index.php");
    exit;
}
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
            <p class="t" id="u">Usuário: </p>
            <p class="t" id="e">Email: </p>
            <a href="Login.html" class="sair"><p>Logout </p></a>
        </div>
    </div>
    <div class="Corp">
        <form id="idform" method="post">
            <fieldset>
                <legend class="Ti">Faça seu Palpite</legend>
                <div class="mb-3 tamcaixa">
                    <label for="partida" class="form-label" style="color:white;">Jogos disponíveis</label>
                    <select required class="form-select" id="partida">
                        <!--Aqui vai adicionar as opções criadas pelo ADM. Opções abaixo são genéricas-->
                        <option selected disabled>Escolha uma partida</option>
                        <option value="1">Brasil x Escocia</option>
                        <option value="2">Uruguai x Cabo Verde</option>
                    </select>
                </div>
                <div class="mb-3 d-flex align-items-center justify-content-center gap-2 tamcaixa">
                    <input type="number" class="form-control text-center" min="0" placeholder="0" style="width: 60px;">
                    <span class="fw-bold">x</span>
                    <input type="number" class="form-control text-center" min="0" placeholder="0" style="width: 60px;">
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
                <p>teste</p>
                <!--Atualizar aqui a lista de erros-->
            </div>
        </div>
        <div class="ranking">
            <h3>RANKING PALPITEIRO</h3>
            <div id="listarank">
                <p>teste</p>
                <!--Atualizar aqui o ranking-->
            </div>
        </div>
        <div class="acertos">
            <h3>SEUS ACERTOS</h3>
            <div id="listaacertos">
                <p>teste</p>
                <!--Atualizar aqui a lista de acertos-->
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.min.js" integrity="sha384-G/EV+4j2dNv+tEPo3++6LCgdCROaejBqfUeNjuKAiuXbjrxilcCdDz6ZAVfHWe1Y" crossorigin="anonymous"></script>
    <script type="text/javascript" src="javahome.js"></script>
</body>
</html>