<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link href="<?= BASE; ?>App/assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= BASE; ?>App/assets/css/font-awesome.css" rel="stylesheet">
    <link href="<?php echo BASE;?>App/assets/css/style.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <!--Box de Alerta-->
    <div class="boxerror alerta ">
        <h4><i class="icon icones "></i><span class="titulo"></span></h4>
        <div class="result"></div>
    </div>
    <!--Fim Box Alerta-->
    <div class="login-box">
        <h1>Criar nova conta</h1>
        <form method="POST" class="form" data-controller="login/create">
            <p>Nome</p>
            <input type="text" name="nome" placeholder="Digite o seu nome" class=""><br>
            <p>E-mail</p>
            <input type="text" name="email" placeholder="Digite o seu email" class=""><br>
            <p>Senha</p>
            <input type="password" name="senha" placeholder="Digite a sua senha" class=""><br>

            <button>Criar conta</button>

            <div class="create_login" >
                <h4>Já possui uma conta?</h4>
                <a href="<?php echo BASE;?>login">Clique aqui!</a>
            </div>
        </form>
    </div>
</div>
<script src="<?php echo BASE;?>App/assets/js/jquery.js"></script>
<script src="<?php echo BASE;?>App/assets/js/bootstrap.min.js"></script>
<script type="text/javascript">
    var BASE = '<?php echo BASE; ?>';
</script>
<script src="<?= BASE; ?>App/assets/js/ajax.js"></script>
</body>
</html>