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
            <p class="t" id="uadm">Usuário: </p>
            <div class="botuser">
                <a href="pages/BolãodaCopa.html" class="sair">Pagina principal</a>
                <a href="pages/LoginADM.html" class="sair" id="log">Logout</a>
            </div>
        </div>
    </div>
    <div class="Corp">
        <div class="area-form">
            <form id="formCriar" method="post">
                <fieldset class="criativo">
                    <legend class="Ti">
                        Criar partida</legend>
                    <div class="mb-3 tamcaixa">
                        <label class="form-label" style="color:white;">Time 1</label>
                        <input required type="text" class="form-control"placeholder="Nome do primeiro time">
                    </div>
                    <div class="mb-3 tamcaixa">
                        <label class="form-label" style="color:white;">
                            Time 2
                        </label>
                        <input required type="text" class="form-control"placeholder="Nome do segundo time">
                    </div>
                    <div class="mb-3 botao">
                        <button type="submit" class="btn btn-success">Postar</button>
                    </div>
                </fieldset>
            </form>
            <form id="formAtualizar" method="post">
                <fieldset class="atualização">
                    <legend class="Ti">Atualizar resultado</legend>
                    <div class="mb-3 tamcaixa">
                        <label class="form-label" style="color:white;">Jogos existentes</label>
                        <select required class="form-select">
                            <option selected disabled>Escolha uma partida</option>
                            <option>Brasil x Escocia</option>
                            <option>Uruguai x Cabo Verde</option>
                        </select>
                    </div>
                    <div class="placar">
                        <input type="number" class="form-control text-center" min="0" placeholder="0">
                        <span class="fw-bold text-white">X</span>
                        <input type="number" class="form-control text-center" min="0" placeholder="0">
                    </div>
                    <div class="mb-3 botao">
                        <button type="submit"class="btn btn-success">Postar</button>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
    <div class="Rank">
        <div class="erros">
            <h3>PARTIDAS</h3>
            <div id="listapartidas">
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
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.min.js" integrity="sha384-G/EV+4j2dNv+tEPo3++6LCgdCROaejBqfUeNjuKAiuXbjrxilcCdDz6ZAVfHWe1Y" crossorigin="anonymous"></script>
    <script type="text/javascript" src="javaadm.js"></script>
</body>
</html>