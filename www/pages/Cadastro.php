<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastre-se</title>
    <link rel="stylesheet" type="text/css" href="../style/estilocadastro.css">
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@700&family=Poppins:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>
<body>
    <div class="prin">
        <form method="post" action="../service/singup.php" id="idform">
            <fieldset>
                <legend class="Ti">Crie sua conta</legend>
                <div class="mb-3 tamcaixa">
                    <label for="nome" class="form-label">Nome</label>
                    <input required type="text" name="nome" class="form-control" id="nome" placeholder="Digite o nome para seu perfil">
                </div>
                <div class="mb-3 tamcaixa">
                    <label for="em" class="form-label">E-mail</label>
                    <input required type="email" name="email" class="form-control" id="em" placeholder="Digite seu e-mail para cadastro">
                </div>
                <div class="mb-3 tamcaixa">
                    <label for="se" class="form-label">Senha</label>
                    <input required type="password" name= "senha" id="se" class="form-control" placeholder= "Digite a sua senha">
                </div>
                <div class="mb-3 tamcaixa">
                    <label for="se2" class="form-label">Confirmar senha</label>
                    <input required type="password" id="se2" class="form-control" placeholder= "Repita sua senha novamente">
                </div>
                <div class="mb-3 tamcaixa" style="text-align: center;">
                    <button type="submit" class="btn btn-success" id="jslogin">Confirmar</button>
                </div>
            </fieldset>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.min.js" integrity="sha384-G/EV+4j2dNv+tEPo3++6LCgdCROaejBqfUeNjuKAiuXbjrxilcCdDz6ZAVfHWe1Y" crossorigin="anonymous"></script>
    <script type="text/javascript" src="javacadastro.js"></script>
</body>
</html>