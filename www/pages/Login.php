<?php
session_start();

// Se o usuário já estiver logado, joga ele para a página correta
if (isset($_SESSION['usuario_id'])) {
    // Adicionado um isset() por segurança para evitar erros caso 'adm' não exista
    if (isset($_SESSION['adm']) && $_SESSION['adm'] == 1) {
        header("Location: pages/ADMPage.php");
    } else {
        header("Location: pages/BolãodaCopa.php");
    }
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Bolão da Copa</title>
    <link rel="stylesheet" type="text/css" href="../style/estilologin.css">
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@700&family=Poppins:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
</head>
<body>
    <div id="titulo" class="container-fluid topo cabecalho">
        <img src="../img/logo2026.png" id="logo">
        <div class="texto-titulo">
            <h1>BOLÃO DA COPA!!!</h1>
            <p>Defina o seu placar!!!</p>
        </div>
    </div>
    
    <div>
        <p class="part">
            Faça seus palpites das partidas da Copa do Mundo de 2026, 
            sem gastar nenhum dinheiro, e seja o maior pontuador!!!
        </p>
    </div>

    <div class="container">
        <form method="post" action="service/login.php">
            <fieldset>
                <legend class="te">Entre na disputa</legend>
                
                <?php 
                if (isset($_SESSION['erro'])) {
                    echo "<div class='alert alert-danger tamcaixa' role='alert'>" . $_SESSION['erro'] . "</div>";
                    unset($_SESSION['erro']);
                }
                ?>

                <div class="mb-3 tamcaixa">
                    <label for="n" class="te form-label">Email</label>
                    <input required type="email" id="n" class="form-control" name="email" placeholder="Digite seu email">
                </div>
                
                <div class="mb-3 tamcaixa">
                    <label for="s" class="te form-label">Senha</label>
                    <input required type="password" id="s" class="form-control" name="senha" placeholder="Digite sua senha">
                </div>
                
                <div class="mb-3">
                    <button type="submit" class="btn btn-success tamcaixa mb-3" id="jslogin">Entrar</button>
                    <a href="pages/Cadastro.php" class="btn btn-primary tamcaixa mb-3">Cadastre-se</a>
                </div>
            </fieldset>
        </form>
    </div>
    <br>
    <div>
        <img src="../img/bola.png" id="bola">
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="../script/javalogin.js"></script>
</body>
</html>